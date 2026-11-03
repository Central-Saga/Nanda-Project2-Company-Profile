"use server";

import { prisma } from "@/lib/prisma";
import { requireAuth } from "@/lib/auth";
import { projectSchema } from "@/lib/validations/crud";
import { revalidatePath } from "next/cache";
import type { ActionState } from "./auth";

export async function createProjectAction(
  _prevState: ActionState | null,
  formData: FormData
): Promise<ActionState> {
  const user = await requireAuth();

  const rawData = {
    slug: formData.get("slug"),
    projectUrl: formData.get("projectUrl"),
    startedAt: formData.get("startedAt"),
    completedAt: formData.get("completedAt"),
    durationMonths: formData.get("durationMonths") || "",
    teamSize: formData.get("teamSize") || "",
    isFeatured: formData.get("isFeatured") === "on",
    isPublished: formData.get("isPublished") === "on",
    sortOrder: formData.get("sortOrder"),
    title: formData.get("title"),
    summary: formData.get("summary"),
    challenge: formData.get("challenge"),
    solution: formData.get("solution"),
    result: formData.get("result"),
    content: formData.get("content"),
  };

  const parsed = projectSchema.safeParse(rawData);
  if (!parsed.success) {
    return { success: false, errors: parsed.error.flatten().fieldErrors };
  }

  const data = parsed.data;

  const existingSlug = await prisma.project.findUnique({ where: { slug: data.slug } });
  if (existingSlug) {
    return { success: false, errors: { slug: ["Slug sudah digunakan"] } };
  }

  const project = await prisma.project.create({
    data: {
      slug: data.slug,
      projectUrl: data.projectUrl || null,
      startedAt: data.startedAt ? new Date(data.startedAt) : null,
      completedAt: data.completedAt ? new Date(data.completedAt) : null,
      durationMonths: data.durationMonths ? Number(data.durationMonths) : null,
      teamSize: data.teamSize ? Number(data.teamSize) : null,
      isFeatured: data.isFeatured,
      isPublished: data.isPublished,
      sortOrder: data.sortOrder,
      translations: {
        create: {
          locale: "id",
          title: data.title,
          summary: data.summary || null,
          challenge: data.challenge || null,
          solution: data.solution || null,
          result: data.result || null,
          content: data.content || null,
        },
      },
    },
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "CREATE",
      entityType: "Project",
      entityId: project.id,
      newValues: { slug: data.slug, title: data.title },
    },
  });

  revalidatePath("/admin/portfolio");
  return { success: true, message: "Proyek berhasil ditambahkan", redirectUrl: "/admin/portfolio" };
}

export async function updateProjectAction(
  _prevState: ActionState | null,
  formData: FormData
): Promise<ActionState> {
  const user = await requireAuth();

  const id = formData.get("id") as string;
  if (!id) return { success: false, message: "ID proyek tidak ditemukan" };

  const rawData = {
    slug: formData.get("slug"),
    projectUrl: formData.get("projectUrl"),
    startedAt: formData.get("startedAt"),
    completedAt: formData.get("completedAt"),
    durationMonths: formData.get("durationMonths") || "",
    teamSize: formData.get("teamSize") || "",
    isFeatured: formData.get("isFeatured") === "on",
    isPublished: formData.get("isPublished") === "on",
    sortOrder: formData.get("sortOrder"),
    title: formData.get("title"),
    summary: formData.get("summary"),
    challenge: formData.get("challenge"),
    solution: formData.get("solution"),
    result: formData.get("result"),
    content: formData.get("content"),
  };

  const parsed = projectSchema.safeParse(rawData);
  if (!parsed.success) {
    return { success: false, errors: parsed.error.flatten().fieldErrors };
  }

  const data = parsed.data;

  const existing = await prisma.project.findUnique({ where: { id } });
  if (!existing || existing.deletedAt) {
    return { success: false, message: "Proyek tidak ditemukan" };
  }

  const slugConflict = await prisma.project.findFirst({
    where: { slug: data.slug, id: { not: id } },
  });
  if (slugConflict) {
    return { success: false, errors: { slug: ["Slug sudah digunakan"] } };
  }

  await prisma.project.update({
    where: { id },
    data: {
      slug: data.slug,
      projectUrl: data.projectUrl || null,
      startedAt: data.startedAt ? new Date(data.startedAt) : null,
      completedAt: data.completedAt ? new Date(data.completedAt) : null,
      durationMonths: data.durationMonths ? Number(data.durationMonths) : null,
      teamSize: data.teamSize ? Number(data.teamSize) : null,
      isFeatured: data.isFeatured,
      isPublished: data.isPublished,
      sortOrder: data.sortOrder,
      translations: {
        upsert: {
          where: { projectId_locale: { projectId: id, locale: "id" } },
          create: {
            locale: "id",
            title: data.title,
            summary: data.summary || null,
            challenge: data.challenge || null,
            solution: data.solution || null,
            result: data.result || null,
            content: data.content || null,
          },
          update: {
            title: data.title,
            summary: data.summary || null,
            challenge: data.challenge || null,
            solution: data.solution || null,
            result: data.result || null,
            content: data.content || null,
          },
        },
      },
    },
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "UPDATE",
      entityType: "Project",
      entityId: id,
      newValues: { slug: data.slug, title: data.title },
    },
  });

  revalidatePath("/admin/portfolio");
  return { success: true, message: "Proyek berhasil diperbarui", redirectUrl: "/admin/portfolio" };
}

export async function deleteProjectAction(id: string): Promise<ActionState> {
  const user = await requireAuth();

  const existing = await prisma.project.findUnique({ where: { id } });
  if (!existing) {
    return { success: false, message: "Proyek tidak ditemukan" };
  }

  await prisma.project.update({
    where: { id },
    data: { deletedAt: new Date(), isPublished: false },
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "DELETE",
      entityType: "Project",
      entityId: id,
      newValues: { slug: existing.slug },
    },
  });

  revalidatePath("/admin/portfolio");
  return { success: true, message: "Proyek berhasil dihapus" };
}
