"use server";

import { prisma } from "@/lib/prisma";
import { requireAuth } from "@/lib/auth";
import { revalidatePath } from "next/cache";
import type { ActionState } from "./auth";
import type { LeadStatus, BookingStatus } from "@prisma/client";

export async function updateLeadStatusAction(
  leadId: string,
  status: LeadStatus
): Promise<ActionState> {
  const user = await requireAuth();

  const existing = await prisma.lead.findUnique({ where: { id: leadId } });
  if (!existing) return { success: false, message: "Lead tidak ditemukan" };

  await prisma.lead.update({
    where: { id: leadId },
    data: { status },
  });

  await prisma.leadStatusHistory.create({
    data: {
      leadId,
      fromStatus: existing.status,
      toStatus: status,
      changedBy: user.id,
    },
  });

  revalidatePath("/admin/leads");
  return { success: true, message: `Status lead diperbarui menjadi ${status}` };
}

export async function updateBookingStatusAction(
  bookingId: string,
  status: BookingStatus,
  adminNote?: string
): Promise<ActionState> {
  const user = await requireAuth();

  const existing = await prisma.consultationBooking.findUnique({ where: { id: bookingId } });
  if (!existing) return { success: false, message: "Booking tidak ditemukan" };

  await prisma.consultationBooking.update({
    where: { id: bookingId },
    data: {
      status,
      adminNote: adminNote || existing.adminNote,
      handledBy: user.id,
    },
  });

  revalidatePath("/admin/bookings");
  return { success: true, message: `Status konsultasi diperbarui menjadi ${status}` };
}
