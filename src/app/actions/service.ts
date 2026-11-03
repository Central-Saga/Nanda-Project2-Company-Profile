"use server";

import { prisma } from "@/lib/prisma";
import { requireAuth } from "@/lib/auth";
import { serviceSchema } from "@/lib/validations/crud";
import { revalidatePath } from "next/cache";
import type { ActionState } from "./auth";

export async function createServiceAction(
  _prevState: ActionState | null,
  formData: FormData
): Promise<ActionState> {
  const user = await requireAuth();

  const rawData = {
    slug: formData.get("slug"),
    icon: formData.get("icon"),
    sortOrder: formData.get("sortOrder"),
    isPublished: formData.get("isPublished") === "on",
    name: formData.get("name"),
    tagline: formData.get("tagline"),
    summary: formData.get("summary"),
    description: formData.get("description"),
  };

  const parsed = serviceSchema.safeParse(rawData);
  if (!parsed.success) {
    return { success: false, errors: parsed.error.flatten().fieldErrors };
  }

  const data = parsed.data;

  const existingSlug = await prisma.service.findUnique({ where: { slug: data.slug } });
  if (existingSlug) {
    return { success: false, errors: { slug: ["Slug sudah digunakan"] } };
  }

  const service = await prisma.service.create({
    data: {
      slug: data.slug,
      icon: data.icon || null,
      sortOrder: data.sortOrder,
      isPublished: data.isPublished,
      translations: {
        create: {
          locale: "id",
          name: data.name,
          tagline: data.tagline || null,
          summary: data.summary || null,
          description: data.description || null,
        },
      },
    },
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "CREATE",
      entityType: "Service",
      entityId: service.id,
      newValues: JSON.parse(JSON.stringify(data)),
    },
  });

  revalidatePath("/admin/services");
  return { success: true, message: "Layanan berhasil ditambahkan", redirectUrl: "/admin/services" };
}

export async function updateServiceAction(
  _prevState: ActionState | null,
  formData: FormData
): Promise<ActionState> {
  const user = await requireAuth();

  const id = formData.get("id") as string;
  if (!id) return { success: false, message: "ID layanan tidak ditemukan" };

  const rawData = {
    slug: formData.get("slug"),
    icon: formData.get("icon"),
    sortOrder: formData.get("sortOrder"),
    isPublished: formData.get("isPublished") === "on",
    name: formData.get("name"),
    tagline: formData.get("tagline"),
    summary: formData.get("summary"),
    description: formData.get("description"),
  };

  const parsed = serviceSchema.safeParse(rawData);
  if (!parsed.success) {
    return { success: false, errors: parsed.error.flatten().fieldErrors };
  }

  const data = parsed.data;

  const existing = await prisma.service.findUnique({ where: { id } });
  if (!existing || existing.deletedAt) {
    return { success: false, message: "Layanan tidak ditemukan" };
  }

  const slugConflict = await prisma.service.findFirst({
    where: { slug: data.slug, id: { not: id } },
  });
  if (slugConflict) {
    return { success: false, errors: { slug: ["Slug sudah digunakan"] } };
  }

  await prisma.service.update({
    where: { id },
    data: {
      slug: data.slug,
      icon: data.icon || null,
      sortOrder: data.sortOrder,
      isPublished: data.isPublished,
      translations: {
        upsert: {
          where: { serviceId_locale: { serviceId: id, locale: "id" } },
          create: {
            locale: "id",
            name: data.name,
            tagline: data.tagline || null,
            summary: data.summary || null,
            description: data.description || null,
          },
          update: {
            name: data.name,
            tagline: data.tagline || null,
            summary: data.summary || null,
            description: data.description || null,
          },
        },
      },
    },
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "UPDATE",
      entityType: "Service",
      entityId: id,
      newValues: JSON.parse(JSON.stringify(data)),
    },
  });

  revalidatePath("/admin/services");
  return { success: true, message: "Layanan berhasil diperbarui", redirectUrl: "/admin/services" };
}

export async function deleteServiceAction(id: string): Promise<ActionState> {
  const user = await requireAuth();

  const existing = await prisma.service.findUnique({ where: { id } });
  if (!existing) {
    return { success: false, message: "Layanan tidak ditemukan" };
  }

  // Soft delete
  await prisma.service.update({
    where: { id },
    data: { deletedAt: new Date(), isPublished: false },
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "DELETE",
      entityType: "Service",
      entityId: id,
      newValues: { slug: existing.slug },
    },
  });

  revalidatePath("/admin/services");
  return { success: true, message: "Layanan berhasil dihapus" };
}
