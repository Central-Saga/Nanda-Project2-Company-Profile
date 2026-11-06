import { prisma } from "@/lib/prisma";
import Link from "next/link";

export const metadata = {
  title: "Peluang Karir Rekayasa",
};

export default async function CareersPublicPage() {
  const jobs = await prisma.jobOpening.findMany({
    where: { status: "open" },
    include: {
      translations: { where: { locale: "id" } },
    },
    orderBy: { createdAt: "desc" },
  });

  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 space-y-12">
      <div className="max-w-2xl space-y-3">
        <span className="text-xs font-semibold uppercase tracking-wider text-red-500">
          Karir & Budaya Kerja
        </span>
        <h1 className="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          Bergabung Bersama Tim Rekayasa
        </h1>
        <p className="text-sm sm:text-base text-zinc-400 leading-relaxed font-normal">
          Bekerja bersama praktisi rekayasa perangkat lunak dalam memecahkan masalah arsitektur skala tinggi dan sistem terdistribusi.
        </p>
      </div>

      {jobs.length === 0 ? (
        <div className="p-12 text-center rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl text-zinc-400 text-sm">
          Saat ini belum ada posisi lowongan terbuka. Silakan periksa kembali di waktu mendatang.
        </div>
      ) : (
        <div className="space-y-4">
          {jobs.map((job) => {
            const trans = job.translations[0];
            return (
              <div
                key={job.id}
                className="p-7 rounded-2xl bg-white/[0.03] hover:bg-white/[0.05] border border-white/[0.08] hover:border-white/[0.18] backdrop-blur-xl flex flex-col sm:flex-row sm:items-center justify-between gap-6 transition shadow-xl"
              >
                <div className="space-y-2">
                  <div className="flex items-center gap-2 text-xs text-zinc-400 font-medium">
                    <span>{job.department || "Engineering"}</span>
                    <span>&bull;</span>
                    <span className="uppercase">{job.workMode}</span>
                    <span>&bull;</span>
                    <span className="capitalize">{job.employmentType.replace("_", " ")}</span>
                  </div>

                  <h2 className="text-lg font-bold text-white">
                    {trans?.title || job.slug}
                  </h2>

                  {job.location && (
                    <div className="text-xs text-zinc-400">
                      Lokasi: {job.location}
                    </div>
                  )}
                </div>

                <div>
                  <Link
                    href={`/karier/${job.slug}`}
                    className="inline-block px-5 py-2.5 bg-white/[0.04] hover:bg-white/[0.08] text-zinc-200 border border-white/[0.12] rounded-xl text-xs font-medium transition"
                  >
                    Lihat Kualifikasi &rarr;
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
