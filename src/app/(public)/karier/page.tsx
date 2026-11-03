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
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
      <div className="max-w-2xl space-y-3">
        <span className="text-xs font-mono uppercase tracking-widest text-red-500">
          Karir & Budaya Kerja
        </span>
        <h1 className="text-3xl font-bold text-white uppercase">
          Bergabung Bersama Tim Rekayasa
        </h1>
        <p className="text-sm text-zinc-400 font-sans">
          Bekerja bersama praktisi rekayasa perangkat lunak dalam memecahkan masalah arsitektur skala tinggi dan sistem terdistribusi.
        </p>
      </div>

      {jobs.length === 0 ? (
        <div className="p-12 text-center border border-zinc-900 rounded-lg text-zinc-500 font-mono text-xs">
          Saat ini belum ada posisi lowongan terbuka. Silakan periksa kembali di waktu mendatang.
        </div>
      ) : (
        <div className="space-y-4">
          {jobs.map((job) => {
            const trans = job.translations[0];
            return (
              <div
                key={job.id}
                className="p-6 bg-zinc-950 border border-zinc-900 hover:border-zinc-800 rounded-lg flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition"
              >
                <div className="space-y-1">
                  <div className="flex items-center gap-2 text-xs font-mono text-zinc-500">
                    <span>{job.department || "Engineering"}</span>
                    <span>&bull;</span>
                    <span className="uppercase">{job.workMode}</span>
                    <span>&bull;</span>
                    <span className="uppercase">{job.employmentType.replace("_", " ")}</span>
                  </div>

                  <h2 className="text-lg font-bold text-white">
                    {trans?.title || job.slug}
                  </h2>

                  {job.location && (
                    <div className="text-xs text-zinc-400 font-sans">
                      Lokasi: {job.location}
                    </div>
                  )}
                </div>

                <div>
                  <Link
                    href={`/karier/${job.slug}`}
                    className="inline-block px-4 py-2 bg-zinc-900 hover:bg-zinc-800 text-zinc-200 border border-zinc-800 rounded text-xs font-mono uppercase tracking-wider transition"
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
