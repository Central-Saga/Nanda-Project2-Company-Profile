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
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
      <div className="max-w-2xl space-y-3">
        <span className="text-xs font-mono uppercase tracking-widest text-red-500">
          Kapabilitas
        </span>
        <h1 className="text-3xl font-bold text-white uppercase">
          Layanan Rekayasa Perangkat Lunak
        </h1>
        <p className="text-sm text-zinc-400 font-sans">
          Fokus pada rekayasa sistem yang reliabel, arsitektur terukur, dan performa tinggi untuk mendukung misi bisnis kritis.
        </p>
      </div>

      {services.length === 0 ? (
        <div className="p-12 text-center border border-zinc-900 rounded-lg text-zinc-500 font-mono text-xs">
          Belum ada data layanan yang diterbitkan.
        </div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {services.map((service) => {
            const trans = service.translations[0];
            return (
              <div
                key={service.id}
                className="p-6 bg-zinc-950 border border-zinc-900 hover:border-zinc-800 rounded-lg space-y-4 transition flex flex-col justify-between"
              >
                <div className="space-y-3">
                  <div className="text-xs font-mono text-zinc-600">
                    /{service.slug}
                  </div>
                  <h2 className="text-lg font-bold text-white">
                    {trans?.name || service.slug}
                  </h2>
                  <p className="text-xs text-zinc-400 leading-relaxed font-sans">
                    {trans?.summary || "Spesifikasi arsitektur komputasi dan implementasi perangkat lunak."}
                  </p>
                </div>

                <div className="pt-4 border-t border-zinc-900">
                  <Link
                    href={`/layanan/${service.slug}`}
                    className="text-xs font-mono text-red-500 hover:text-red-400 transition"
                  >
                    Pelajari Selengkapnya &rarr;
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
