import { prisma } from "@/lib/prisma";
import Link from "next/link";
import { notFound } from "next/navigation";

interface Props {
  params: Promise<{ slug: string }>;
}

export async function generateMetadata({ params }: Props) {
  const { slug } = await params;
  const project = await prisma.project.findUnique({
    where: { slug },
    include: { translations: { where: { locale: "id" } } },
  });

  return {
    title: project?.translations[0]?.title || slug,
  };
}

export default async function PortfolioDetailPage({ params }: Props) {
  const { slug } = await params;
  const project = await prisma.project.findUnique({
    where: { slug },
    include: {
      translations: { where: { locale: "id" } },
    },
  });

  if (!project || !project.isPublished || project.deletedAt) {
    notFound();
  }

  const trans = project.translations[0];

  return (
    <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 space-y-10">
      <Link
        href="/portofolio"
        className="text-xs font-medium text-zinc-400 hover:text-white transition flex items-center gap-1.5"
      >
        <span>&larr;</span>
        <span>Kembali ke Portofolio</span>
      </Link>

      <div className="space-y-4">
        <div className="flex items-center gap-2">
          <span className="text-xs font-semibold uppercase tracking-wider text-red-500">
            Studi Kasus Rekayasa
          </span>
          {project.isFeatured && (
            <span className="px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20">
              Unggulan
            </span>
          )}
        </div>
        <h1 className="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
          {trans?.title || project.slug}
        </h1>
      </div>

      <div className="space-y-6">
        {trans?.challenge && (
          <div className="p-7 rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl space-y-2">
            <h2 className="text-xs font-bold uppercase tracking-wider text-zinc-400">
              Tantangan Masalah
            </h2>
            <p className="text-sm text-zinc-300 leading-relaxed font-normal">
              {trans.challenge}
            </p>
          </div>
        )}

        {trans?.solution && (
          <div className="p-7 rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl space-y-2">
            <h2 className="text-xs font-bold uppercase tracking-wider text-zinc-400">
              Solusi & Arsitektur
            </h2>
            <p className="text-sm text-zinc-300 leading-relaxed font-normal">
              {trans.solution}
            </p>
          </div>
        )}

        {trans?.result && (
          <div className="p-7 rounded-2xl bg-red-950/20 border border-red-500/20 backdrop-blur-xl space-y-2">
            <h2 className="text-xs font-bold uppercase tracking-wider text-red-400">
              Hasil Nyata & Dampak
            </h2>
            <p className="text-sm text-zinc-200 leading-relaxed font-normal">
              {trans.result}
            </p>
          </div>
        )}
      </div>

      <div className="p-8 rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl flex flex-col sm:flex-row items-center justify-between gap-6">
        <div>
          <h3 className="text-base font-bold text-white">Ingin Hasil Serupa?</h3>
          <p className="text-xs text-zinc-400 mt-1">
            Diskusikan kebutuhan proyek Anda bersama tim arsitek kami.
          </p>
        </div>
        <div className="flex items-center gap-3 w-full sm:w-auto">
          <Link
            href="/mulai-proyek"
            className="w-full sm:w-auto text-center px-5 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 text-white rounded-xl text-xs font-medium transition shadow-lg"
          >
            Mulai Proyek
          </Link>
          <Link
            href="/booking"
            className="w-full sm:w-auto text-center px-5 py-2.5 bg-white/[0.05] hover:bg-white/[0.1] text-zinc-300 border border-white/[0.1] rounded-xl text-xs font-medium transition"
          >
            Konsultasi
          </Link>
        </div>
      </div>
    </div>
  );
}
