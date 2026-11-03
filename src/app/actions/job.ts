"use server";

import { prisma } from "@/lib/prisma";
import { requireAuth } from "@/lib/auth";
import { jobOpeningSchema } from "@/lib/validations/crud";
import { revalidatePath } from "next/cache";
import type { ActionState } from "./auth";

export async function createJobAction(
  _prevState: ActionState | null,
  formData: FormData
): Promise<ActionState> {
  const user = await requireAuth();

  const rawData = {
    slug: formData.get("slug"),
    department: formData.get("department"),
    employmentType: formData.get("employmentType") || "full_time",
    workMode: formData.get("workMode") || "onsite",
    location: formData.get("location"),
    salaryMin: formData.get("salaryMin") || "",
    salaryMax: formData.get("salaryMax") || "",
    showSalary: formData.get("showSalary") === "on",
    status: formData.get("status") || "draft",
    closesAt: formData.get("closesAt") || "",
    title: formData.get("title"),
    description: formData.get("description"),
    responsibilities: formData.get("responsibilities"),
    requirements: formData.get("requirements"),
    benefits: formData.get("benefits"),
  };

  const parsed = jobOpeningSchema.safeParse(rawData);
  if (!parsed.success) {
    return { success: false, errors: parsed.error.flatten().fieldErrors };
  }

  const data = parsed.data;

  const existingSlug = await prisma.jobOpening.findUnique({ where: { slug: data.slug } });
  if (existingSlug) {
    return { success: false, errors: { slug: ["Slug sudah digunakan"] } };
  }

  const job = await prisma.jobOpening.create({
    data: {
      slug: data.slug,
      department: data.department || null,
      employmentType: data.employmentType,
      workMode: data.workMode,
      location: data.location || null,
      salaryMin: data.salaryMin ? Number(data.salaryMin) : null,
      salaryMax: data.salaryMax ? Number(data.salaryMax) : null,
      showSalary: data.showSalary,
      status: data.status,
      closesAt: data.closesAt ? new Date(data.closesAt) : null,
      openedAt: data.status === "open" ? new Date() : null,
      createdBy: user.id,
      translations: {
        create: {
          locale: "id",
          title: data.title,
          description: data.description || null,
          responsibilities: data.responsibilities || null,
          requirements: data.requirements || null,
          benefits: data.benefits || null,
        },
      },
    },
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "CREATE",
      entityType: "JobOpening",
      entityId: job.id,
      newValues: { slug: data.slug, title: data.title },
    },
  });

  revalidatePath("/admin/careers");
  return { success: true, message: "Lowongan karir berhasil dibuat", redirectUrl: "/admin/careers" };
}

export async function updateJobAction(
  _prevState: ActionState | null,
  formData: FormData
): Promise<ActionState> {
  const user = await requireAuth();

  const id = formData.get("id") as string;
  if (!id) return { success: false, message: "ID lowongan tidak ditemukan" };

  const rawData = {
    slug: formData.get("slug"),
    department: formData.get("department"),
    employmentType: formData.get("employmentType") || "full_time",
    workMode: formData.get("workMode") || "onsite",
    location: formData.get("location"),
    salaryMin: formData.get("salaryMin") || "",
    salaryMax: formData.get("salaryMax") || "",
    showSalary: formData.get("showSalary") === "on",
    status: formData.get("status") || "draft",
    closesAt: formData.get("closesAt") || "",
    title: formData.get("title"),
    description: formData.get("description"),
    responsibilities: formData.get("responsibilities"),
    requirements: formData.get("requirements"),
    benefits: formData.get("benefits"),
  };

  const parsed = jobOpeningSchema.safeParse(rawData);
  if (!parsed.success) {
    return { success: false, errors: parsed.error.flatten().fieldErrors };
  }

  const data = parsed.data;

  const existing = await prisma.jobOpening.findUnique({ where: { id } });
  if (!existing) {
    return { success: false, message: "Lowongan tidak ditemukan" };
  }

  const slugConflict = await prisma.jobOpening.findFirst({
    where: { slug: data.slug, id: { not: id } },
  });
  if (slugConflict) {
    return { success: false, errors: { slug: ["Slug sudah digunakan"] } };
  }

  await prisma.jobOpening.update({
    where: { id },
    data: {
      slug: data.slug,
      department: data.department || null,
      employmentType: data.employmentType,
      workMode: data.workMode,
      location: data.location || null,
      salaryMin: data.salaryMin ? Number(data.salaryMin) : null,
      salaryMax: data.salaryMax ? Number(data.salaryMax) : null,
      showSalary: data.showSalary,
      status: data.status,
      closesAt: data.closesAt ? new Date(data.closesAt) : null,
      openedAt: data.status === "open" && !existing.openedAt ? new Date() : existing.openedAt,
      translations: {
        upsert: {
          where: { jobId_locale: { jobId: id, locale: "id" } },
          create: {
            locale: "id",
            title: data.title,
            description: data.description || null,
            responsibilities: data.responsibilities || null,
            requirements: data.requirements || null,
            benefits: data.benefits || null,
          },
          update: {
            title: data.title,
            description: data.description || null,
            responsibilities: data.responsibilities || null,
            requirements: data.requirements || null,
            benefits: data.benefits || null,
          },
        },
      },
    },
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "UPDATE",
      entityType: "JobOpening",
      entityId: id,
      newValues: { slug: data.slug, title: data.title },
    },
  });

  revalidatePath("/admin/careers");
  return { success: true, message: "Lowongan karir berhasil diperbarui", redirectUrl: "/admin/careers" };
}

export async function deleteJobAction(id: string): Promise<ActionState> {
  const user = await requireAuth();

  const existing = await prisma.jobOpening.findUnique({ where: { id } });
  if (!existing) {
    return { success: false, message: "Lowongan tidak ditemukan" };
  }

  await prisma.jobOpening.delete({ where: { id } });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "DELETE",
      entityType: "JobOpening",
      entityId: id,
      newValues: { slug: existing.slug },
    },
  });

  revalidatePath("/admin/careers");
  return { success: true, message: "Lowongan karir berhasil dihapus" };
}
