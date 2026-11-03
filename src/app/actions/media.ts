"use server";

import { revalidatePath } from "next/cache";
import { prisma } from "@/lib/prisma";
import { requireAuth } from "@/lib/auth";
import { uploadToStorage, deleteFromStorage } from "@/lib/storage";
import crypto from "crypto";

const ALLOWED_MIME_TYPES = [
  "image/jpeg",
  "image/png",
  "image/webp",
  "image/svg+xml",
  "application/pdf",
];

const MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB

export async function uploadMediaAction(formData: FormData) {
  try {
    const user = await requireAuth();
    const file = formData.get("file") as File | null;
    const folder = (formData.get("folder") as string) || "general";
    const altText = (formData.get("altText") as string) || "";

    if (!file || file.size === 0) {
      return { success: false, error: "File tidak ditemukan atau kosong." };
    }

    if (file.size > MAX_FILE_SIZE) {
      return {
        success: false,
        error: "Ukuran file melebihi batas maksimal 10MB.",
      };
    }

    if (!ALLOWED_MIME_TYPES.includes(file.type)) {
      return {
        success: false,
        error: `Tipe file ${file.type} tidak didukung. Harap unggah JPEG, PNG, WEBP, SVG, atau PDF.`,
      };
    }

    const arrayBuffer = await file.arrayBuffer();
    const buffer = Buffer.from(arrayBuffer);

    // Compute SHA-256 Checksum
    const checksumSha256 = crypto
      .createHash("sha256")
      .update(buffer)
      .digest("hex");

    // Clean filename and make unique key
    const sanitizedName = file.name.replace(/[^a-zA-Z0-9.-]/g, "_");
    const uniqueKey = `${folder}/${Date.now()}-${sanitizedName}`;

    // Upload to S3/MinIO
    const { url, key } = await uploadToStorage({
      key: uniqueKey,
      buffer,
      mimeType: file.type,
    });

    // Save record to MediaFile table
    const media = await prisma.mediaFile.create({
      data: {
        uploadedBy: user.id,
        storageKey: key,
        url,
        originalName: file.name,
        mimeType: file.type,
        sizeBytes: file.size,
        altText: altText || null,
        folder,
        checksumSha256,
        isPublic: true,
      },
    });

    // Audit log
    await prisma.auditLog.create({
      data: {
        userId: user.id,
        action: "CREATE",
        entityType: "MediaFile",
        entityId: media.id,
        newValues: {
          originalName: file.name,
          key,
          sizeBytes: file.size,
        },
      },
    });

    revalidatePath("/admin/media");

    return {
      success: true,
      data: {
        id: media.id,
        url: media.url,
        key: media.storageKey,
        originalName: media.originalName,
      },
    };
  } catch (error: any) {
    console.error("uploadMediaAction error:", error);
    return {
      success: false,
      error: error.message || "Gagal mengunggah file ke media storage.",
    };
  }
}

export async function deleteMediaAction(id: string) {
  try {
    const user = await requireAuth();

    const media = await prisma.mediaFile.findUnique({
      where: { id },
    });

    if (!media) {
      return { success: false, error: "Berkas media tidak ditemukan." };
    }

    // Try deleting from storage
    try {
      await deleteFromStorage(media.storageKey);
    } catch (s3Error) {
      console.warn("Storage deletion error (ignored for DB cleanup):", s3Error);
    }

    // Soft delete or hard delete in DB
    await prisma.mediaFile.update({
      where: { id },
      data: { deletedAt: new Date() },
    });

    await prisma.auditLog.create({
      data: {
        userId: user.id,
        action: "DELETE",
        entityType: "MediaFile",
        entityId: id,
        oldValues: {
          originalName: media.originalName,
          key: media.storageKey,
        },
      },
    });

    revalidatePath("/admin/media");
    return { success: true };
  } catch (error: any) {
    return {
      success: false,
      error: error.message || "Gagal menghapus berkas media.",
    };
  }
}
