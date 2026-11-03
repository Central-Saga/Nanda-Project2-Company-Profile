import { prisma } from "@/lib/prisma";
import { notFound } from "next/navigation";
import Link from "next/link";

interface JobDetailPageProps {
  params: Promise<{ slug: string }>;
}

export async function generateMetadata({ params }: JobDetailPageProps) {
  const { slug } = await params;
  const job = await prisma.jobOpening.findFirst({
    where: { slug, status: "open" },
    include: { translations: { where: { locale: "id" } } },
  });

  return {
    title: job?.translations[0]?.title || slug,
  };
}

export default async function JobDetailPage({ params }: JobDetailPageProps) {
  const { slug } = await params;
  const job = await prisma.jobOpening.findFirst({
    where: { slug, status: "open" },
    include: {
      translations: { where: { locale: "id" } },
    },
  });

  if (!job) {
    notFound();
  }

  const trans = job.translations[0];

  return (
    <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
      <Link
        href="/karier"
        className="text-xs font-mono text-zinc-500 hover:text-zinc-300 transition"
      >
        &larr; Kembali ke Peluang Karir
      </Link>

      <div className="space-y-4">
        <div className="flex flex-wrap items-center gap-2 text-xs font-mono text-zinc-500">
          <span>{job.department || "Engineering"}</span>
          <span>&bull;</span>
          <span className="uppercase">{job.workMode}</span>
          <span>&bull;</span>
          <span className="uppercase">{job.employmentType.replace("_", " ")}</span>
          {job.location && (
            <>
              <span>&bull;</span>
              <span>{job.location}</span>
            </>
          )}
        </div>

        <h1 className="text-3xl sm:text-4xl font-bold text-white uppercase">
          {trans?.title || job.slug}
        </h1>
      </div>

      <div className="space-y-8">
        {trans?.description && (
          <div className="p-6 bg-zinc-950 border border-zinc-900 rounded-lg space-y-3">
            <h2 className="text-xs font-mono uppercase tracking-wider text-zinc-400">
              Deskripsi Posisi
            </h2>
            <div className="text-sm text-zinc-300 font-sans leading-relaxed whitespace-pre-line">
              {trans.description}
            </div>
          </div>
        )}

        {trans?.responsibilities && (
          <div className="p-6 bg-zinc-950 border border-zinc-900 rounded-lg space-y-3">
            <h2 className="text-xs font-mono uppercase tracking-wider text-zinc-400">
              Tanggung Jawab Utama
            </h2>
            <div className="text-sm text-zinc-300 font-sans leading-relaxed whitespace-pre-line">
              {trans.responsibilities}
            </div>
          </div>
        )}

        {trans?.requirements && (
          <div className="p-6 bg-zinc-950 border border-zinc-900 rounded-lg space-y-3">
            <h2 className="text-xs font-mono uppercase tracking-wider text-zinc-400">
              Kualifikasi & Persyaratan Teknis
            </h2>
            <div className="text-sm text-zinc-300 font-sans leading-relaxed whitespace-pre-line">
              {trans.requirements}
            </div>
          </div>
        )}

        {trans?.benefits && (
          <div className="p-6 bg-zinc-950 border border-zinc-900 rounded-lg space-y-3">
            <h2 className="text-xs font-mono uppercase tracking-wider text-zinc-400">
              Benefit & Lingkungan Kerja
            </h2>
            <div className="text-sm text-zinc-300 font-sans leading-relaxed whitespace-pre-line">
              {trans.benefits}
            </div>
          </div>
        )}
      </div>

      <div className="p-8 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-lg font-bold text-white uppercase">
          Tertarik dengan Posisi Ini?
        </h2>
        <p className="text-xs text-zinc-400 font-sans">
          Kirimkan resume dan portofolio teknis Anda melalui formulir kontak kami dengan menyertakan posisi yang dituju.
        </p>
        <div>
          <Link
            href="/kontak"
            className="inline-block px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-mono uppercase tracking-wider transition"
          >
            Kirim Berkas Lamaran Melalui Formulir
          </Link>
        </div>
      </div>
    </div>
  );
}
