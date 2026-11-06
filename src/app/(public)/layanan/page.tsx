import { prisma } from "@/lib/prisma";
import Link from "next/link";

export const metadata = {
  title: "Layanan Rekayasa Sistem",
};

export default async function ServicesPage() {
  const services = await prisma.service.findMany({
    where: { isPublished: true, deletedAt: null },
    include: {
      translations: { where: { locale: "id" } },
    },
    orderBy: { sortOrder: "asc" },
  });

  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 space-y-12">
      <div className="max-w-2xl space-y-3">
        <span className="text-xs font-semibold uppercase tracking-wider text-red-500">
          Kapabilitas
        </span>
        <h1 className="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          Layanan Rekayasa Perangkat Lunak
        </h1>
        <p className="text-sm sm:text-base text-zinc-400 leading-relaxed font-normal">
          Fokus pada rekayasa sistem yang reliabel, arsitektur terukur, dan performa tinggi untuk mendukung misi bisnis kritis.
        </p>
      </div>

      {services.length === 0 ? (
        <div className="p-12 text-center rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl text-zinc-400 text-sm">
          Belum ada data layanan yang diterbitkan.
        </div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {services.map((service) => {
            const trans = service.translations[0];
            return (
              <div
                key={service.id}
                className="p-7 rounded-2xl bg-white/[0.03] hover:bg-white/[0.05] border border-white/[0.08] hover:border-white/[0.18] backdrop-blur-xl space-y-4 transition flex flex-col justify-between group shadow-xl"
              >
                <div className="space-y-4">
                  <div className="w-10 h-10 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-400">
                    <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                  </div>
                  <h2 className="text-lg font-bold text-white group-hover:text-red-300 transition-colors">
                    {trans?.name || service.slug}
                  </h2>
                  <p className="text-sm text-zinc-400 leading-relaxed">
                    {trans?.summary || "Spesifikasi arsitektur komputasi dan implementasi perangkat lunak."}
                  </p>
                </div>

                <div className="pt-6 border-t border-white/[0.06]">
                  <Link
                    href={`/layanan/${service.slug}`}
                    className="text-xs font-semibold text-zinc-300 group-hover:text-white transition flex items-center gap-1.5"
                  >
                    <span>Pelajari Selengkapnya</span>
                    <span>&rarr;</span>
                  </Link>
                </div>
              </div>
            );
          })}
        </div>
      )}
    </div>
  );
}
