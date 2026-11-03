import { prisma } from "@/lib/prisma";
import { notFound } from "next/navigation";
import Link from "next/link";

interface ProjectDetailPageProps {
  params: Promise<{ slug: string }>;
}

export async function generateMetadata({ params }: ProjectDetailPageProps) {
  const { slug } = await params;
  const project = await prisma.project.findFirst({
    where: { slug, isPublished: true, deletedAt: null },
    include: { translations: { where: { locale: "id" } } },
  });

  return {
    title: project?.translations[0]?.title || slug,
  };
}

export default async function ProjectDetailPage({ params }: ProjectDetailPageProps) {
  const { slug } = await params;
  const project = await prisma.project.findFirst({
    where: { slug, isPublished: true, deletedAt: null },
    include: {
      translations: { where: { locale: "id" } },
    },
  });

  if (!project) {
    notFound();
  }

  const trans = project.translations[0];

  return (
    <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
      <Link
        href="/portofolio"
        className="text-xs font-mono text-zinc-500 hover:text-zinc-300 transition"
      >
        &larr; Kembali ke Portofolio
      </Link>

      <div className="space-y-4">
        <div className="flex items-center gap-3">
          <span className="text-xs font-mono uppercase tracking-widest text-red-500">
            Studi Kasus /{project.slug}
          </span>
          {project.isFeatured && (
            <span className="px-2 py-0.5 rounded text-[10px] font-mono bg-red-950 text-red-400 border border-red-800">
              UNGGULAN
            </span>
          )}
        </div>

        <h1 className="text-3xl sm:text-4xl font-bold text-white uppercase">
          {trans?.title || project.slug}
        </h1>
      </div>

      <div className="space-y-6">
        {trans?.challenge && (
          <div className="p-6 bg-zinc-950 border border-zinc-900 rounded-lg space-y-2">
            <h2 className="text-xs font-mono uppercase tracking-wider text-zinc-400">
              Tantangan Masalah
            </h2>
            <p className="text-sm text-zinc-300 font-sans leading-relaxed">
              {trans.challenge}
            </p>
          </div>
        )}

        {trans?.solution && (
          <div className="p-6 bg-zinc-950 border border-zinc-900 rounded-lg space-y-2">
            <h2 className="text-xs font-mono uppercase tracking-wider text-zinc-400">
              Solusi & Pendekatan Teknis
            </h2>
            <p className="text-sm text-zinc-300 font-sans leading-relaxed">
              {trans.solution}
            </p>
          </div>
        )}

        {trans?.result && (
          <div className="p-6 bg-zinc-950 border border-red-900/40 rounded-lg space-y-2">
            <h2 className="text-xs font-mono uppercase tracking-wider text-red-400">
              Hasil Nyata & Dampak
            </h2>
            <p className="text-sm text-zinc-200 font-mono leading-relaxed">
              {trans.result}
            </p>
          </div>
        )}
      </div>

      <div className="p-8 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-lg font-bold text-white uppercase">
          Tertarik Menerapkan Solusi yang Terbukti?
        </h2>
        <p className="text-xs text-zinc-400 font-sans">
          Konsultasikan spesifikasi dan kendala sistem Anda untuk menyusun arsitektur yang tahan uji.
        </p>
        <div className="flex gap-4 pt-2">
          <Link
            href="/mulai-proyek"
            className="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-mono uppercase tracking-wider transition"
          >
            Mulai Proyek
          </Link>
          <Link
            href="/booking"
            className="px-4 py-2 bg-zinc-900 hover:bg-zinc-800 text-zinc-300 border border-zinc-800 rounded text-xs font-mono uppercase tracking-wider transition"
          >
            Konsultasi Teknis
          </Link>
        </div>
      </div>
    </div>
  );
}
