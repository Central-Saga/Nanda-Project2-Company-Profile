"use server";

import { prisma } from "@/lib/prisma";
import { requireAuth } from "@/lib/auth";
import { companyProfileSchema } from "@/lib/validations/crud";
import type { ActionState } from "./auth";

export async function updateCompanyProfileAction(
  _prevState: ActionState | null,
  formData: FormData
): Promise<ActionState> {
  const user = await requireAuth();

  const rawData = {
    companyName: formData.get("companyName"),
    tagline: formData.get("tagline"),
    aboutShort: formData.get("aboutShort"),
    address: formData.get("address"),
    phone: formData.get("phone"),
    emailPublic: formData.get("emailPublic"),
    operatingHours: formData.get("operatingHours"),
    socialLinks: formData.get("socialLinks"),
  };

  const parsed = companyProfileSchema.safeParse(rawData);
  if (!parsed.success) {
    return { success: false, errors: parsed.error.flatten().fieldErrors };
  }

  const data = parsed.data;

  // Parse JSON fields
  let operatingHours = null;
  let socialLinks = null;
  try {
    if (data.operatingHours) operatingHours = JSON.parse(data.operatingHours);
  } catch {
    return { success: false, errors: { operatingHours: ["Format JSON tidak valid"] } };
  }
  try {
    if (data.socialLinks) socialLinks = JSON.parse(data.socialLinks);
  } catch {
    return { success: false, errors: { socialLinks: ["Format JSON tidak valid"] } };
  }

  const existing = await prisma.companyProfile.findFirst();
  if (!existing) {
    return { success: false, message: "Profil perusahaan belum diinisialisasi di seed" };
  }

  await prisma.companyProfile.update({
    where: { id: existing.id },
    data: {
      companyName: data.companyName,
      tagline: data.tagline || null,
      aboutShort: data.aboutShort || null,
      address: data.address || null,
      phone: data.phone || null,
      emailPublic: data.emailPublic || null,
      operatingHours,
      socialLinks,
      updatedBy: user.id,
    },
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "UPDATE",
      entityType: "CompanyProfile",
      entityId: existing.id,
      newValues: JSON.parse(JSON.stringify(data)),
    },
  });

  return { success: true, message: "Profil perusahaan berhasil diperbarui" };
}
