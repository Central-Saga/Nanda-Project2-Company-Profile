import { prisma } from "@/lib/prisma";
import Link from "next/link";

export default async function HomePage() {
  const [company, services, projects, posts] = await Promise.all([
    prisma.companyProfile.findFirst(),
    prisma.service.findMany({
      where: { isPublished: true, deletedAt: null },
      include: {
        translations: { where: { locale: "id" } },
      },
      orderBy: { sortOrder: "asc" },
      take: 6,
    }),
    prisma.project.findMany({
      where: { isPublished: true, deletedAt: null },
      include: {
        translations: { where: { locale: "id" } },
      },
      orderBy: { createdAt: "desc" },
      take: 4,
    }),
    prisma.post.findMany({
      where: { status: "published", deletedAt: null },
      include: {
        translations: { where: { locale: "id" } },
      },
      orderBy: { publishedAt: "desc" },
      take: 3,
    }),
  ]);

  const brandName = company?.companyName || "SOFTWARE HOUSE";
  const tagline =
    company?.tagline ||
    "Rekayasa sistem perangkat lunak kritis, arsitektur data terdistribusi, dan platform web berkinerja tinggi.";
  const description =
    company?.aboutShort ||
    "Membangun infrastruktur digital tangguh untuk mendukung operasi bisnis skala enterprise.";

  return (
    <div className="space-y-24 py-12 md:py-20">
      {/* 1. HERO SECTION */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="max-w-3xl space-y-6">
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded bg-zinc-900 border border-zinc-800 text-[11px] font-mono text-zinc-400">
            <span className="w-2 h-2 rounded-none bg-red-600 animate-pulse" />
            <span>KEMAMPUAN REKAYASA &bull; ENTERPRISE SCALE</span>
          </div>

          <h1 className="text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white font-sans uppercase">
            {tagline}
          </h1>

          <p className="text-zinc-400 text-sm sm:text-base leading-relaxed max-w-2xl font-sans">
            {description}
          </p>

          <div className="flex flex-wrap items-center gap-4 pt-4">
            <Link
              href="/mulai-proyek"
              className="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-mono font-medium uppercase tracking-wider transition"
            >
              Mulai Proyek Bersama
            </Link>
            <Link
              href="/booking"
              className="px-5 py-2.5 bg-zinc-900 hover:bg-zinc-800 text-zinc-200 border border-zinc-800 rounded text-xs font-mono uppercase tracking-wider transition"
            >
              Jadwalkan Konsultasi Teknis
            </Link>
          </div>
        </div>
      </section>

      {/* 2. SERVICES SECTION - Only if data exists */}
      {services.length > 0 && (
        <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
          <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-zinc-900 pb-4">
            <div>
              <span className="text-xs font-mono uppercase tracking-widest text-red-500">
                Layanan Kami
              </span>
              <h2 className="text-xl sm:text-2xl font-bold text-white mt-1">
                Kapabilitas & Keahlian Sistem
              </h2>
            </div>
            <Link
              href="/layanan"
              className="text-xs font-mono text-zinc-400 hover:text-white transition"
            >
              Lihat Seluruh Layanan &rarr;
            </Link>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {services.map((service) => {
              const trans = service.translations[0];
              return (
                <div
                  key={service.id}
                  className="p-6 bg-zinc-950 border border-zinc-900 hover:border-zinc-800 rounded-lg space-y-3 transition group"
                >
                  <div className="text-xs font-mono text-zinc-600 group-hover:text-red-500 transition">
                    /{service.slug}
                  </div>
                  <h3 className="text-base font-bold text-zinc-100">
                    {trans?.name || service.slug}
                  </h3>
                  <p className="text-xs text-zinc-400 line-clamp-3 leading-relaxed">
                    {trans?.summary || "Spesifikasi arsitektur komputasi dan implementasi perangkat lunak."}
                  </p>
                  <div className="pt-2">
                    <Link
                      href={`/layanan/${service.slug}`}
                      className="text-xs font-mono text-zinc-500 group-hover:text-red-400 transition"
                    >
                      Detail Layanan &rarr;
                    </Link>
                  </div>
                </div>
              );
            })}
          </div>
        </section>
      )}

      {/* 3. PORTFOLIO SECTION - Only if data exists */}
      {projects.length > 0 && (
        <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
          <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-zinc-900 pb-4">
            <div>
              <span className="text-xs font-mono uppercase tracking-widest text-red-500">
                Studi Kasus & Portofolio
              </span>
              <h2 className="text-xl sm:text-2xl font-bold text-white mt-1">
                Hasil Nyata Rekayasa Perangkat Lunak
              </h2>
            </div>
            <Link
              href="/portofolio"
              className="text-xs font-mono text-zinc-400 hover:text-white transition"
            >
              Lihat Seluruh Portofolio &rarr;
            </Link>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {projects.map((project) => {
              const trans = project.translations[0];
              return (
                <div
                  key={project.id}
                  className="p-6 bg-zinc-950 border border-zinc-900 hover:border-zinc-800 rounded-lg space-y-4 transition"
                >
                  <div className="flex items-center justify-between text-xs font-mono text-zinc-500">
                    <span>{project.slug}</span>
                    {project.isFeatured && (
                      <span className="px-2 py-0.5 rounded text-[10px] bg-red-950/60 text-red-400 border border-red-800/40">
                        UNGGULAN
                      </span>
                    )}
                  </div>

                  <h3 className="text-lg font-bold text-white">
                    {trans?.title || project.slug}
                  </h3>

                  {trans?.challenge && (
                    <div className="text-xs text-zinc-400">
                      <span className="font-mono text-zinc-500 uppercase">Tantangan: </span>
                      {trans.challenge}
                    </div>
                  )}

                  {trans?.result && (
                    <div className="text-xs text-zinc-300 bg-zinc-900/40 p-3 rounded border border-zinc-900 font-mono">
                      <span className="text-red-400 uppercase">Dampak: </span>
                      {trans.result}
                    </div>
                  )}

                  <div>
                    <Link
                      href={`/portofolio/${project.slug}`}
                      className="text-xs font-mono text-red-500 hover:text-red-400 transition"
                    >
                      Baca Studi Kasus Lengkap &rarr;
                    </Link>
                  </div>
                </div>
              );
            })}
          </div>
        </section>
      )}

      {/* 4. BLOG / ARTICLES SECTION - Only if published data exists */}
      {posts.length > 0 && (
        <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
          <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-zinc-900 pb-4">
            <div>
              <span className="text-xs font-mono uppercase tracking-widest text-red-500">
                Wawasan & Publikasi
              </span>
              <h2 className="text-xl sm:text-2xl font-bold text-white mt-1">
                Catatan Arsitektur & Teknologi
              </h2>
            </div>
            <Link
              href="/blog"
              className="text-xs font-mono text-zinc-400 hover:text-white transition"
            >
              Lihat Arsip Publikasi &rarr;
            </Link>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {posts.map((post) => {
              const trans = post.translations[0];
              const dateStr = post.publishedAt
                ? post.publishedAt.toISOString().split("T")[0]
                : "";

              return (
                <div
                  key={post.id}
                  className="p-5 bg-zinc-950 border border-zinc-900 hover:border-zinc-800 rounded-lg space-y-3 transition flex flex-col justify-between"
                >
                  <div className="space-y-2">
                    <div className="text-[11px] font-mono text-zinc-500">
                      {dateStr}
                    </div>
                    <h3 className="text-sm font-bold text-zinc-100 line-clamp-2">
                      {trans?.title || post.slug}
                    </h3>
                    <p className="text-xs text-zinc-400 line-clamp-3">
                      {trans?.content || ""}
                    </p>
                  </div>

                  <div className="pt-3">
                    <Link
                      href={`/blog/${post.slug}`}
                      className="text-xs font-mono text-zinc-400 hover:text-white transition"
                    >
                      Baca Selengkapnya &rarr;
                    </Link>
                  </div>
                </div>
              );
            })}
          </div>
        </section>
      )}

      {/* 5. DIRECT ENGAGEMENT CTA (Anti-WhatsApp: direct to web brief or booking) */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="p-8 sm:p-12 rounded-lg bg-zinc-950 border border-zinc-900 relative overflow-hidden">
          <div className="max-w-2xl space-y-4">
            <span className="text-xs font-mono uppercase tracking-widest text-red-500">
              Mulai Kolaborasi
            </span>
            <h2 className="text-2xl sm:text-3xl font-bold text-white uppercase">
              Diskusikan Kebutuhan Arsitektur Sistem Anda
            </h2>
            <p className="text-xs sm:text-sm text-zinc-400 leading-relaxed">
              Kirimkan brief teknis atau jadwalkan sesi konsultasi daring. Semua data tersimpan aman dan terkelola langsung di platform internal kami.
            </p>
            <div className="flex flex-wrap gap-4 pt-2">
              <Link
                href="/mulai-proyek"
                className="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-mono uppercase tracking-wider transition"
              >
                Isi Brief Proyek
              </Link>
              <Link
                href="/booking"
                className="px-4 py-2 bg-zinc-900 hover:bg-zinc-800 text-zinc-300 border border-zinc-800 rounded text-xs font-mono uppercase tracking-wider transition"
              >
                Jadwalkan Konsultasi
              </Link>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
