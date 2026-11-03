"use server";

import { prisma } from "@/lib/prisma";
import { requireAuth } from "@/lib/auth";
import { postSchema } from "@/lib/validations/crud";
import { revalidatePath } from "next/cache";
import type { ActionState } from "./auth";

export async function createPostAction(
  _prevState: ActionState | null,
  formData: FormData
): Promise<ActionState> {
  const user = await requireAuth();

  const rawData = {
    slug: formData.get("slug"),
    categoryId: formData.get("categoryId") || "",
    status: formData.get("status") || "draft",
    isFeatured: formData.get("isFeatured") === "on",
    title: formData.get("title"),
    excerpt: formData.get("excerpt"),
    content: formData.get("content"),
  };

  const parsed = postSchema.safeParse(rawData);
  if (!parsed.success) {
    return { success: false, errors: parsed.error.flatten().fieldErrors };
  }

  const data = parsed.data;

  const existingSlug = await prisma.post.findUnique({ where: { slug: data.slug } });
  if (existingSlug) {
    return { success: false, errors: { slug: ["Slug sudah digunakan"] } };
  }

  const post = await prisma.post.create({
    data: {
      slug: data.slug,
      authorId: user.id,
      categoryId: data.categoryId || null,
      status: data.status,
      isFeatured: data.isFeatured,
      publishedAt: data.status === "published" ? new Date() : null,
      translations: {
        create: {
          locale: "id",
          title: data.title,
          excerpt: data.excerpt || null,
          content: data.content,
        },
      },
    },
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "CREATE",
      entityType: "Post",
      entityId: post.id,
      newValues: JSON.parse(JSON.stringify(data)),
    },
  });

  revalidatePath("/admin/blog");
  return { success: true, message: "Artikel berhasil dibuat", redirectUrl: "/admin/blog" };
}

export async function updatePostAction(
  _prevState: ActionState | null,
  formData: FormData
): Promise<ActionState> {
  const user = await requireAuth();

  const id = formData.get("id") as string;
  if (!id) return { success: false, message: "ID artikel tidak ditemukan" };

  const rawData = {
    slug: formData.get("slug"),
    categoryId: formData.get("categoryId") || "",
    status: formData.get("status") || "draft",
    isFeatured: formData.get("isFeatured") === "on",
    title: formData.get("title"),
    excerpt: formData.get("excerpt"),
    content: formData.get("content"),
  };

  const parsed = postSchema.safeParse(rawData);
  if (!parsed.success) {
    return { success: false, errors: parsed.error.flatten().fieldErrors };
  }

  const data = parsed.data;

  const existing = await prisma.post.findUnique({ where: { id } });
  if (!existing || existing.deletedAt) {
    return { success: false, message: "Artikel tidak ditemukan" };
  }

  const slugConflict = await prisma.post.findFirst({
    where: { slug: data.slug, id: { not: id } },
  });
  if (slugConflict) {
    return { success: false, errors: { slug: ["Slug sudah digunakan"] } };
  }

  const shouldPublish = data.status === "published" && !existing.publishedAt;

  await prisma.post.update({
    where: { id },
    data: {
      slug: data.slug,
      categoryId: data.categoryId || null,
      status: data.status,
      isFeatured: data.isFeatured,
      publishedAt: shouldPublish ? new Date() : existing.publishedAt,
      translations: {
        upsert: {
          where: { postId_locale: { postId: id, locale: "id" } },
          create: {
            locale: "id",
            title: data.title,
            excerpt: data.excerpt || null,
            content: data.content,
          },
          update: {
            title: data.title,
            excerpt: data.excerpt || null,
            content: data.content,
          },
        },
      },
    },
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "UPDATE",
      entityType: "Post",
      entityId: id,
      newValues: JSON.parse(JSON.stringify(data)),
    },
  });

  revalidatePath("/admin/blog");
  return { success: true, message: "Artikel berhasil diperbarui", redirectUrl: "/admin/blog" };
}

export async function deletePostAction(id: string): Promise<ActionState> {
  const user = await requireAuth();

  const existing = await prisma.post.findUnique({ where: { id } });
  if (!existing) {
    return { success: false, message: "Artikel tidak ditemukan" };
  }

  await prisma.post.update({
    where: { id },
    data: { deletedAt: new Date() },
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "DELETE",
      entityType: "Post",
      entityId: id,
      newValues: { slug: existing.slug },
    },
  });

  revalidatePath("/admin/blog");
  return { success: true, message: "Artikel berhasil dihapus" };
}
