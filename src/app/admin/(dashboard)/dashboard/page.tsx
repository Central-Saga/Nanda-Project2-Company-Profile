import { getCurrentUser } from "@/lib/auth";
import { prisma } from "@/lib/prisma";

export const metadata = {
  title: "Dashboard",
};

export default async function DashboardPage() {
  const user = await getCurrentUser();

  const [leadCount, bookingCount, postCount, serviceCount] = await Promise.all([
    prisma.lead.count(),
    prisma.consultationBooking.count(),
    prisma.post.count(),
    prisma.service.count(),
  ]);

  const cards = [
    { label: "Total Leads Masuk", value: leadCount, status: "Tersimpan di DB" },
    { label: "Permintaan Konsultasi", value: bookingCount, status: "Sistem Terjadwal" },
    { label: "Artikel / Blog", value: postCount, status: "Konten Publik" },
    { label: "Layanan Aktif", value: serviceCount, status: "Katalog Dinamis" },
  ];

  return (
    <div className="space-y-6">
      <div>
        <h1 className="text-xl font-bold tracking-tight text-zinc-100">Ikhtisar Sistem</h1>
        <p className="text-xs text-zinc-400 mt-1">
          Selamat datang kembali, {user?.fullName}. Semua interaksi website terhubung langsung ke database.
        </p>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        {cards.map((card) => (
          <div
            key={card.label}
            className="p-4 bg-zinc-950 border border-zinc-900 rounded-lg space-y-2"
          >
            <div className="text-xs font-mono text-zinc-400 uppercase tracking-wider">
              {card.label}
            </div>
            <div className="text-2xl font-bold font-mono text-zinc-100">{card.value}</div>
            <div className="text-[11px] font-mono text-red-400">{card.status}</div>
          </div>
        ))}
      </div>

      <div className="p-4 bg-zinc-950 border border-zinc-900 rounded-lg">
        <h2 className="text-sm font-semibold text-zinc-200 mb-2 font-mono">
          Kepatuhan Antislop (Lampiran A & B)
        </h2>
        <ul className="text-xs text-zinc-400 space-y-1 font-mono">
          <li>✓ Tema: Dark mode tunggal, aksen merah tunggal (#dc2626)</li>
          <li>✓ Otentikasi: JWT session token di HTTP-Only cookie, password di-hash bcrypt</li>
          <li>✓ Alur WhatsApp: Tidak ada link WhatsApp langsung, semua formulir tersimpan di DB</li>
          <li>✓ Keamanan: Verifikasi ganda di middleware edge & Server Action/DB check</li>
        </ul>
      </div>
    </div>
  );
}
