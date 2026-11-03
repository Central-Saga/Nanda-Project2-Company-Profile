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
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
      <div className="max-w-2xl space-y-3">
        <span className="text-xs font-mono uppercase tracking-widest text-red-500">
          Rekam Jejak
        </span>
        <h1 className="text-3xl font-bold text-white uppercase">
          Portofolio & Rekayasa Teruji
        </h1>
        <p className="text-sm text-zinc-400 font-sans">
          Dokumentasi arsitektur dan hasil nyata yang telah diimplementasikan untuk berbagai ekosistem teknologi.
        </p>
      </div>

      {projects.length === 0 ? (
        <div className="p-12 text-center border border-zinc-900 rounded-lg text-zinc-500 font-mono text-xs">
          Belum ada portofolio yang dipublikasikan.
        </div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          {projects.map((project) => {
            const trans = project.translations[0];
            return (
              <div
                key={project.id}
                className="p-6 bg-zinc-950 border border-zinc-900 hover:border-zinc-800 rounded-lg space-y-4 transition flex flex-col justify-between"
              >
                <div className="space-y-3">
                  <div className="flex items-center justify-between text-xs font-mono text-zinc-500">
                    <span>/{project.slug}</span>
                    {project.isFeatured && (
                      <span className="px-2 py-0.5 rounded text-[10px] bg-red-950 text-red-400 border border-red-800">
                        UNGGULAN
                      </span>
                    )}
                  </div>

                  <h2 className="text-lg font-bold text-white">
                    {trans?.title || project.slug}
                  </h2>

                  {trans?.challenge && (
                    <div className="text-xs text-zinc-400 font-sans">
                      <span className="font-mono text-zinc-500 uppercase">Tantangan: </span>
                      {trans.challenge}
                    </div>
                  )}

                  {trans?.result && (
                    <div className="text-xs text-zinc-300 bg-zinc-900/60 p-3 rounded border border-zinc-900 font-mono">
                      <span className="text-red-400 uppercase">Dampak: </span>
                      {trans.result}
                    </div>
                  )}
                </div>

                <div className="pt-4 border-t border-zinc-900">
                  <Link
                    href={`/portofolio/${project.slug}`}
                    className="text-xs font-mono text-red-500 hover:text-red-400 transition"
                  >
                    Buka Studi Kasus Lengkap &rarr;
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
