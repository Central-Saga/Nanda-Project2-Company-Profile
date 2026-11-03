import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import Link from "next/link";

export default async function DashboardPage() {
  const [
    servicesCount,
    projectsCount,
    postsCount,
    jobsCount,
    leadsCount,
    bookingsCount,
    mediaCount,
    recentLeads,
    recentBookings,
    recentAudits,
  ] = await Promise.all([
    prisma.service.count({ where: { deletedAt: null } }),
    prisma.project.count({ where: { deletedAt: null } }),
    prisma.post.count({ where: { deletedAt: null } }),
    prisma.jobOpening.count(),
    prisma.lead.count(),
    prisma.consultationBooking.count(),
    prisma.mediaFile.count({ where: { deletedAt: null } }),
    prisma.lead.findMany({
      orderBy: { createdAt: "desc" },
      take: 5,
    }),
    prisma.consultationBooking.findMany({
      orderBy: { createdAt: "desc" },
      take: 5,
      include: { lead: true },
    }),
    prisma.auditLog.findMany({
      orderBy: { createdAt: "desc" },
      take: 6,
      include: { user: true },
    }),
  ]);

  const stats = [
    { label: "Total Inbound Leads", value: leadsCount, href: "/admin/leads", alert: leadsCount > 0 },
    { label: "Jadwal Konsultasi", value: bookingsCount, href: "/admin/bookings", alert: bookingsCount > 0 },
    { label: "Layanan Aktif", value: servicesCount, href: "/admin/services" },
    { label: "Portofolio & Studi Kasus", value: projectsCount, href: "/admin/projects" },
    { label: "Artikel / Publikasi", value: postsCount, href: "/admin/posts" },
    { label: "Lowongan Kerja", value: jobsCount, href: "/admin/careers" },
    { label: "Aset Media S3", value: mediaCount, href: "/admin/media" },
  ];

  return (
    <div className="space-y-8">
      <PageHeader
        title="Ringkasan Operasional Sistem"
        description="Pantau metriks inbound CRM, jadwal konsultasi klien, dan status konten platform secara langsung."
      />

      {/* Grid Statistik Anti-Slop (No gradients, clear border & typography) */}
      <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
        {stats.map((s) => (
          <Link
            key={s.label}
            href={s.href}
            className="p-4 rounded-lg bg-zinc-950 border border-zinc-900 hover:border-zinc-800 transition-colors block space-y-1"
          >
            <div className="text-[11px] font-mono uppercase tracking-wider text-zinc-500">
              {s.label}
            </div>
            <div className="text-2xl font-bold font-mono text-zinc-100 flex items-center justify-between">
              <span>{s.value}</span>
              {s.alert && <span className="w-2 h-2 rounded-full bg-red-600" />}
            </div>
          </Link>
        ))}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {/* Inbound CRM Leads Terbaru */}
        <div className="space-y-4">
          <div className="flex items-center justify-between">
            <h2 className="text-sm font-bold font-mono uppercase tracking-wider text-zinc-300">
              Inbound Leads Terbaru
            </h2>
            <Link
              href="/admin/leads"
              className="text-xs font-mono text-red-500 hover:underline"
            >
              Lihat Semua &rarr;
            </Link>
          </div>
          <div className="bg-zinc-950 border border-zinc-900 rounded-lg divide-y divide-zinc-900 overflow-hidden">
            {recentLeads.length === 0 ? (
              <div className="p-6 text-center text-xs font-mono text-zinc-600">
                Belum ada data inbound leads di database.
              </div>
            ) : (
              recentLeads.map((l) => (
                <div key={l.id} className="p-4 flex items-center justify-between text-xs font-mono">
                  <div>
                    <div className="text-zinc-200 font-sans font-medium">{l.fullName}</div>
                    <div className="text-zinc-500">{l.email} {l.companyName ? `• ${l.companyName}` : ""}</div>
                  </div>
                  <span className="px-2 py-0.5 rounded border border-zinc-800 text-[10px] text-zinc-400 uppercase">
                    {l.sourceType}
                  </span>
                </div>
              ))
            )}
          </div>
        </div>

        {/* Jadwal Konsultasi Terbaru */}
        <div className="space-y-4">
          <div className="flex items-center justify-between">
            <h2 className="text-sm font-bold font-mono uppercase tracking-wider text-zinc-300">
              Jadwal Konsultasi Masuk
            </h2>
            <Link
              href="/admin/bookings"
              className="text-xs font-mono text-red-500 hover:underline"
            >
              Lihat Semua &rarr;
            </Link>
          </div>
          <div className="bg-zinc-950 border border-zinc-900 rounded-lg divide-y divide-zinc-900 overflow-hidden">
            {recentBookings.length === 0 ? (
              <div className="p-6 text-center text-xs font-mono text-zinc-600">
                Belum ada reservasi konsultasi teknis di database.
              </div>
            ) : (
              recentBookings.map((b) => (
                <div key={b.id} className="p-4 flex items-center justify-between text-xs font-mono">
                  <div>
                    <div className="text-zinc-200 font-sans font-medium">
                      {b.lead?.fullName || "Klien Terdaftar"}
                    </div>
                    <div className="text-zinc-500">
                      {new Date(b.preferredDate).toLocaleDateString("id-ID")} • {b.preferredTimeSlot}
                    </div>
                  </div>
                  <span className="px-2 py-0.5 rounded bg-zinc-900 text-[10px] text-zinc-400 uppercase">
                    {b.status}
                  </span>
                </div>
              ))
            )}
          </div>
        </div>
      </div>

      {/* Log Audit Terkini */}
      <div className="space-y-4">
        <h2 className="text-sm font-bold font-mono uppercase tracking-wider text-zinc-300">
          Riwayat Perubahan & Audit Log Sistem
        </h2>
        <div className="bg-zinc-950 border border-zinc-900 rounded-lg divide-y divide-zinc-900 overflow-hidden">
          {recentAudits.length === 0 ? (
            <div className="p-6 text-center text-xs font-mono text-zinc-600">
              Belum ada aktivitas audit log tercatat.
            </div>
          ) : (
            recentAudits.map((a) => (
              <div key={a.id} className="p-3 flex items-center justify-between text-xs font-mono">
                <div className="flex items-center gap-3">
                  <span className="text-red-500 font-bold uppercase">{a.action}</span>
                  <span className="text-zinc-300">{a.entityType}</span>
                  <span className="text-zinc-600">({a.entityId?.slice(0, 8)}...)</span>
                </div>
                <div className="text-zinc-500 text-[11px]">
                  {a.user?.fullName || "Sistem"} • {new Date(a.createdAt).toLocaleString("id-ID")}
                </div>
              </div>
            ))
          )}
        </div>
      </div>
    </div>
  );
}
