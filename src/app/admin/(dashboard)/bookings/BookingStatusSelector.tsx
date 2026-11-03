"use client";

import { useTransition } from "react";
import { updateBookingStatusAction } from "@/app/actions/crm";
import type { BookingStatus } from "@prisma/client";

export function BookingStatusSelector({
  bookingId,
  currentStatus,
}: {
  bookingId: string;
  currentStatus: BookingStatus;
}) {
  const [isPending, startTransition] = useTransition();

  function handleChange(e: React.ChangeEvent<HTMLSelectElement>) {
    const newStatus = e.target.value as BookingStatus;
    startTransition(async () => {
      await updateBookingStatusAction(bookingId, newStatus);
    });
  }

  return (
    <select
      defaultValue={currentStatus}
      disabled={isPending}
      onChange={handleChange}
      className="px-2 py-1 bg-zinc-900 border border-zinc-800 text-zinc-200 rounded text-[11px] font-mono focus:outline-none focus:border-red-600 disabled:opacity-50"
    >
      <option value="pending">PENDING</option>
      <option value="confirmed">CONFIRMED</option>
      <option value="completed">COMPLETED</option>
      <option value="cancelled">CANCELLED</option>
      <option value="no_show">NO SHOW</option>
    </select>
  );
}
