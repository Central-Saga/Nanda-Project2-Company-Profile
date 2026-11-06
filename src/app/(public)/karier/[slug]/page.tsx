import { prisma } from "@/lib/prisma";
import Link from "next/link";
import { notFound } from "next/navigation";

interface Props {
  params: Promise<{ slug: string }>;
}

export async function generateMetadata({ params }: Props) {
  const { slug } = await params;
  const job = await prisma.jobOpening.findUnique({
    where: { slug },
    include: { translations: { where: { locale: "id" } } },
  });

  return {
    title: job?.translations[0]?.title || slug,
  };
}

export default async function JobDetailPage({ params }: Props) {
  const { slug } = await params;
  const job = await prisma.jobOpening.findUnique({
    where: { slug },
    include: {
      translations: { where: { locale: "id" } },
    },
  });

  if (!job || job.status !== "open") {
    notFound();
  }

  const trans = job.translations[0];

  return (
    <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 space-y-10">
      <Link
        href="/karier"
        className="text-xs font-medium text-zinc-400 hover:text-white transition flex items-center gap-1.5"
      >
        <span>&larr;</span>
        <span>Kembali ke Karir</span>
      </Link>

      <div className="space-y-4">
        <div className="flex flex-wrap items-center gap-2 text-xs text-zinc-400 font-medium">
          <span>{job.department || "Engineering"}</span>
          <span>&bull;</span>
          <span className="uppercase">{job.workMode}</span>
          <span>&bull;</span>
          <span className="capitalize">{job.employmentType.replace("_", " ")}</span>
          {job.location && (
            <>
              <span>&bull;</span>
              <span>{job.location}</span>
            </>
          )}
        </div>

        <h1 className="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
          {trans?.title || job.slug}
        </h1>
      </div>

      <div className="space-y-6">
        {trans?.description && (
          <div className="p-8 rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl space-y-3">
            <h2 className="text-xs font-bold uppercase tracking-wider text-zinc-400">
              Deskripsi Pekerjaan
            </h2>
            <div className="text-sm text-zinc-300 leading-relaxed whitespace-pre-line font-normal">
              {trans.description}
            </div>
          </div>
        )}

        {trans?.requirements && (
          <div className="p-8 rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl space-y-3">
            <h2 className="text-xs font-bold uppercase tracking-wider text-zinc-400">
              Kualifikasi & Persyaratan
            </h2>
            <div className="text-sm text-zinc-300 leading-relaxed whitespace-pre-line font-normal">
              {trans.requirements}
            </div>
          </div>
        )}
      </div>

      <div className="p-8 rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl flex flex-col sm:flex-row items-center justify-between gap-6">
        <div>
          <h3 className="text-base font-bold text-white">Tertarik Bergabung?</h3>
          <p className="text-xs text-zinc-400 mt-1">
            Kirimkan profil dan resume teknis Anda melalui saluran resmi kami.
          </p>
        </div>
        <Link
          href="/kontak"
          className="px-6 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 text-white rounded-xl text-xs font-medium transition shadow-lg"
        >
          Lamar Sekarang
        </Link>
      </div>
    </div>
  );
}
