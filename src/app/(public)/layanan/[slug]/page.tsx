import { prisma } from "@/lib/prisma";
import { notFound } from "next/navigation";
import Link from "next/link";

interface ServiceDetailPageProps {
  params: Promise<{ slug: string }>;
}

export async function generateMetadata({ params }: ServiceDetailPageProps) {
  const { slug } = await params;
  const service = await prisma.service.findFirst({
    where: { slug, isPublished: true, deletedAt: null },
    include: { translations: { where: { locale: "id" } } },
  });

  return {
    title: service?.translations[0]?.name || slug,
  };
}

export default async function ServiceDetailPage({ params }: ServiceDetailPageProps) {
  const { slug } = await params;
  const service = await prisma.service.findFirst({
    where: { slug, isPublished: true, deletedAt: null },
    include: {
      translations: { where: { locale: "id" } },
    },
  });

  if (!service) {
    notFound();
  }

  const trans = service.translations[0];

  return (
    <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
      <Link
        href="/layanan"
        className="text-xs font-mono text-zinc-500 hover:text-zinc-300 transition"
      >
        &larr; Kembali ke Daftar Layanan
      </Link>

      <div className="space-y-4">
        <span className="text-xs font-mono uppercase tracking-widest text-red-500">
          Layanan /{service.slug}
        </span>
        <h1 className="text-3xl sm:text-4xl font-bold text-white uppercase">
          {trans?.name || service.slug}
        </h1>
        {trans?.summary && (
          <p className="text-base text-zinc-300 font-sans leading-relaxed">
            {trans.summary}
          </p>
        )}
      </div>

      {trans?.description && (
        <div className="p-6 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4 text-sm text-zinc-400 font-sans leading-relaxed whitespace-pre-line">
          {trans.description}
        </div>
      )}

      <div className="p-8 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-lg font-bold text-white uppercase">
          Butuh Solusi {trans?.name || "Serupa"}?
        </h2>
        <p className="text-xs text-zinc-400 font-sans">
          Diskusikan arsitektur dan estimasi waktu pengerjaan langsung bersama tim Solution Architect kami.
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
