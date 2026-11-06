import { prisma } from "@/lib/prisma";
import Link from "next/link";

export const metadata = {
  title: "Portofolio & Studi Kasus",
};

export default async function PortfolioPage() {
  const projects = await prisma.project.findMany({
    where: { isPublished: true, deletedAt: null },
    include: {
      translations: { where: { locale: "id" } },
    },
    orderBy: { createdAt: "desc" },
  });

  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 space-y-12">
      <div className="max-w-2xl space-y-3">
        <span className="text-xs font-semibold uppercase tracking-wider text-red-500">
          Rekam Jejak
        </span>
        <h1 className="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          Portofolio & Rekayasa Teruji
        </h1>
        <p className="text-sm sm:text-base text-zinc-400 leading-relaxed font-normal">
          Dokumentasi arsitektur dan hasil nyata yang telah diimplementasikan untuk berbagai ekosistem teknologi.
        </p>
      </div>

      {projects.length === 0 ? (
        <div className="p-12 text-center rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl text-zinc-400 text-sm">
          Belum ada portofolio yang dipublikasikan.
        </div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          {projects.map((project) => {
            const trans = project.translations[0];
            return (
              <div
                key={project.id}
                className="p-8 rounded-2xl bg-white/[0.03] hover:bg-white/[0.05] border border-white/[0.08] hover:border-white/[0.18] backdrop-blur-xl space-y-5 transition flex flex-col justify-between shadow-xl"
              >
                <div className="space-y-4">
                  <div className="flex items-center justify-between">
                    <span className="text-xs font-medium text-zinc-400">
                      Studi Kasus
                    </span>
                    {project.isFeatured && (
                      <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20">
                        Unggulan
                      </span>
                    )}
                  </div>

                  <h2 className="text-xl font-bold text-white">
                    {trans?.title || project.slug}
                  </h2>

                  {trans?.challenge && (
                    <div className="text-sm text-zinc-400 leading-relaxed">
                      <span className="font-semibold text-zinc-300">Tantangan: </span>
                      {trans.challenge}
                    </div>
                  )}

                  {trans?.result && (
                    <div className="text-sm text-zinc-200 bg-white/[0.04] p-4 rounded-xl border border-white/[0.08] backdrop-blur-md">
                      <span className="text-red-400 font-semibold">Hasil & Dampak: </span>
                      {trans.result}
                    </div>
                  )}
                </div>

                <div className="pt-4 border-t border-white/[0.06]">
                  <Link
                    href={`/portofolio/${project.slug}`}
                    className="text-xs font-semibold text-red-400 hover:text-red-300 transition flex items-center gap-1.5"
                  >
                    <span>Buka Studi Kasus Lengkap</span>
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
