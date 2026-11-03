import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import { EmptyState } from "@/components/admin/EmptyState";
import { BookingStatusSelector } from "./BookingStatusSelector";

export const metadata = {
  title: "Konsultasi Terjadwal",
};

export default async function BookingsPage() {
  const bookings = await prisma.consultationBooking.findMany({
    include: {
      lead: true,
    },
    orderBy: { preferredDate: "desc" },
  });

  return (
    <div>
      <PageHeader
        title="Jadwal Konsultasi Proyek"
        description="Kelola reservasi konsultasi teknis yang diajukan langsung lewat platform website."
      />

      {bookings.length === 0 ? (
        <EmptyState
          title="Belum ada permintaan konsultasi"
          description="Klien dapat menjadwalkan sesi konsultasi arsitektur melalui portal publik."
        />
      ) : (
        <div className="border border-zinc-900 rounded-lg overflow-hidden bg-zinc-950">
          <table className="w-full text-left text-xs font-mono">
            <thead className="bg-zinc-900/60 text-zinc-400 uppercase tracking-wider border-b border-zinc-900">
              <tr>
                <th className="py-3 px-4">Nama Klien</th>
                <th className="py-3 px-4">Kontak</th>
                <th className="py-3 px-4">Tanggal Diajukan</th>
                <th className="py-3 px-4">Slot Waktu</th>
                <th className="py-3 px-4">Topik</th>
                <th className="py-3 px-4">Status</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-zinc-900 text-zinc-300">
              {bookings.map((booking) => (
                <tr key={booking.id} className="hover:bg-zinc-900/30 transition">
                  <td className="py-3 px-4 font-medium text-zinc-100 font-sans">
                    {booking.lead.fullName}
                  </td>
                  <td className="py-3 px-4 text-zinc-400">
                    <div>{booking.lead.email}</div>
                    {booking.lead.phone && (
                      <div className="text-[11px] text-zinc-500">{booking.lead.phone}</div>
                    )}
                  </td>
                  <td className="py-3 px-4 text-zinc-300">
                    {booking.preferredDate.toISOString().split("T")[0]}
                  </td>
                  <td className="py-3 px-4 text-zinc-400 font-bold">
                    {booking.preferredTimeSlot}
                  </td>
                  <td className="py-3 px-4 text-zinc-300 font-sans">
                    {booking.topic || "-"}
                  </td>
                  <td className="py-3 px-4">
                    <BookingStatusSelector
                      bookingId={booking.id}
                      currentStatus={booking.status}
                    />
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      )}
    </div>
  );
}
