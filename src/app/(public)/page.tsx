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

  const tagline =
    company?.tagline ||
    "Arsitektur Software Modern & Rekayasa Sistem Berkinerja Tinggi";
  const description =
    company?.aboutShort ||
    "Membangun infrastruktur komputasi tangguh, sistem API berkecepatan tinggi, dan platform digital berdaya tahan maksimal untuk skala bisnis enterprise.";

  return (
    <div className="relative overflow-hidden">
      {/* Ambient Radial Glowing Orbs for Dark Glassmorphism */}
      <div className="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[450px] bg-red-600/15 blur-[140px] rounded-full pointer-events-none -z-10" />
      <div className="absolute top-[600px] right-0 w-[500px] h-[400px] bg-rose-600/10 blur-[130px] rounded-full pointer-events-none -z-10" />
      <div className="absolute top-[1400px] left-0 w-[500px] h-[400px] bg-red-700/10 blur-[140px] rounded-full pointer-events-none -z-10" />

      {/* 1. HERO SECTION */}
      <section className="relative pt-20 pb-24 md:pt-32 md:pb-36 border-b border-white/[0.06]">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="max-w-3xl mx-auto text-center space-y-8">
            
            {/* Pill Badge */}
            <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/[0.04] border border-white/[0.1] text-xs font-medium text-zinc-300 backdrop-blur-xl shadow-lg">
              <span className="w-2 h-2 rounded-full bg-red-500 animate-pulse shadow-[0_0_8px_rgba(239,68,68,0.9)]" />
              <span>Rekayasa Perangkat Lunak Skala Enterprise</span>
            </div>

            {/* Main Heading */}
            <h1 className="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-white leading-[1.12]">
              {tagline}
            </h1>

            {/* Description */}
            <p className="text-zinc-400 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto font-normal">
              {description}
            </p>

            {/* Action Buttons */}
            <div className="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
              <Link
                href="/mulai-proyek"
                className="w-full sm:w-auto px-7 py-3.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 text-white rounded-xl text-sm font-semibold transition-all shadow-[0_0_30px_rgba(220,38,38,0.4)] hover:shadow-[0_0_40px_rgba(220,38,38,0.6)] border border-red-500/30"
              >
                Mulai Proyek Anda &rarr;
              </Link>
              <Link
                href="/booking"
                className="w-full sm:w-auto px-7 py-3.5 bg-white/[0.04] hover:bg-white/[0.08] text-zinc-200 border border-white/[0.12] hover:border-white/[0.2] rounded-xl text-sm font-medium transition backdrop-blur-xl"
              >
                Jadwalkan Konsultasi
              </Link>
            </div>

            {/* Glass Stats Bar */}
            <div className="pt-10 grid grid-cols-3 gap-4 max-w-xl mx-auto">
              <div className="p-4 rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl text-center">
                <div className="text-xl sm:text-2xl font-bold text-white tracking-tight">99.98%</div>
                <div className="text-xs text-zinc-400 mt-1 font-medium">Uptime SLA</div>
              </div>
              <div className="p-4 rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl text-center">
                <div className="text-xl sm:text-2xl font-bold text-white tracking-tight">&lt; 150ms</div>
                <div className="text-xs text-zinc-400 mt-1 font-medium">Latensi Respons</div>
              </div>
              <div className="p-4 rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl text-center">
                <div className="text-xl sm:text-2xl font-bold text-white tracking-tight">100%</div>
                <div className="text-xs text-zinc-400 mt-1 font-medium">Data Terpusat</div>
              </div>
            </div>

          </div>
        </div>
      </section>

      {/* 2. SERVICES SECTION */}
      {services.length > 0 && (
        <section className="py-24 border-b border-white/[0.06]">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
              <div>
                <span className="text-xs font-semibold uppercase tracking-wider text-red-500">
                  Kapabilitas Rekayasa
                </span>
                <h2 className="text-2xl sm:text-3xl font-bold text-white mt-2 tracking-tight">
                  Layanan & Solusi Arsitektur
                </h2>
              </div>
              <Link
                href="/layanan"
                className="text-sm font-medium text-zinc-400 hover:text-white transition"
              >
                Lihat Semua Layanan &rarr;
              </Link>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              {services.map((service) => {
                const trans = service.translations[0];
                return (
                  <div
                    key={service.id}
                    className="p-7 rounded-2xl bg-white/[0.03] hover:bg-white/[0.05] border border-white/[0.08] hover:border-white/[0.18] backdrop-blur-xl transition-all duration-300 flex flex-col justify-between group shadow-xl"
                  >
                    <div className="space-y-4">
                      <div className="w-10 h-10 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-400">
                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                      </div>
                      <h3 className="text-lg font-semibold text-white group-hover:text-red-300 transition-colors">
                        {trans?.name || service.slug}
                      </h3>
                      <p className="text-sm text-zinc-400 leading-relaxed line-clamp-3">
                        {trans?.summary || "Spesifikasi arsitektur komputasi dan implementasi perangkat lunak berkinerja tinggi."}
                      </p>
                    </div>

                    <div className="pt-6 mt-6 border-t border-white/[0.06]">
                      <Link
                        href={`/layanan/${service.slug}`}
                        className="text-xs font-semibold text-zinc-300 group-hover:text-white transition flex items-center gap-1.5"
                      >
                        <span>Pelajari Lebih Lanjut</span>
                        <span>&rarr;</span>
                      </Link>
                    </div>
                  </div>
                );
              })}
            </div>
          </div>
        </section>
      )}

      {/* 3. PORTFOLIO MATRIX SECTION */}
      {projects.length > 0 && (
        <section className="py-24 border-b border-white/[0.06]">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
              <div>
                <span className="text-xs font-semibold uppercase tracking-wider text-red-500">
                  Studi Kasus
                </span>
                <h2 className="text-2xl sm:text-3xl font-bold text-white mt-2 tracking-tight">
                  Implementasi & Hasil Nyata
                </h2>
              </div>
              <Link
                href="/portofolio"
                className="text-sm font-medium text-zinc-400 hover:text-white transition"
              >
                Lihat Semua Portofolio &rarr;
              </Link>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              {projects.map((project) => {
                const trans = project.translations[0];
                return (
                  <div
                    key={project.id}
                    className="p-8 rounded-2xl bg-white/[0.03] hover:bg-white/[0.05] border border-white/[0.08] hover:border-white/[0.18] backdrop-blur-xl transition-all duration-300 space-y-5 shadow-xl"
                  >
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

                    <h3 className="text-xl font-bold text-white">
                      {trans?.title || project.slug}
                    </h3>

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

                    <div className="pt-2">
                      <Link
                        href={`/portofolio/$Studi Kasus`}
                        className="text-xs font-semibold text-red-400 hover:text-red-300 transition"
                      >
                        Detail Studi Kasus &rarr;
                      </Link>
                    </div>
                  </div>
                );
              })}
            </div>
          </div>
        </section>
      )}

      {/* 4. BLOG / PUBLICATIONS SECTION */}
      {posts.length > 0 && (
        <section className="py-24 border-b border-white/[0.06]">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
              <div>
                <span className="text-xs font-semibold uppercase tracking-wider text-red-500">
                  Wawasan & Riset
                </span>
                <h2 className="text-2xl sm:text-3xl font-bold text-white mt-2 tracking-tight">
                  Publikasi & Catatan Teknik
                </h2>
              </div>
              <Link
                href="/blog"
                className="text-sm font-medium text-zinc-400 hover:text-white transition"
              >
                Lihat Semua Artikel &rarr;
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
                    className="p-7 rounded-2xl bg-white/[0.03] hover:bg-white/[0.05] border border-white/[0.08] hover:border-white/[0.18] backdrop-blur-xl transition-all duration-300 flex flex-col justify-between space-y-4 shadow-xl"
                  >
                    <div className="space-y-3">
                      <div className="text-xs text-zinc-500">
                        {dateStr}
                      </div>
                      <h3 className="text-base font-bold text-white line-clamp-2">
                        {trans?.title || post.slug}
                      </h3>
                      <p className="text-sm text-zinc-400 line-clamp-3 leading-relaxed">
                        {trans?.content || ""}
                      </p>
                    </div>

                    <div className="pt-4 border-t border-white/[0.06]">
                      <Link
                        href={`/blog/${post.slug}`}
                        className="text-xs font-semibold text-zinc-300 hover:text-white transition"
                      >
                        Baca Artikel &rarr;
                      </Link>
                    </div>
                  </div>
                );
              })}
            </div>
          </div>
        </section>
      )}

      {/* 5. DIRECT ENGAGEMENT (ANTI-WHATSAPP STRICT) */}
      <section className="py-24">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="p-8 sm:p-14 rounded-3xl bg-gradient-to-b from-white/[0.06] to-white/[0.02] border border-white/[0.1] backdrop-blur-2xl relative overflow-hidden shadow-2xl">
            <div className="absolute top-0 right-0 w-80 h-80 bg-red-600/15 blur-[120px] rounded-full pointer-events-none" />
            
            <div className="max-w-2xl space-y-6 relative">
              <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-500/10 border border-red-500/20 text-xs font-medium text-red-400">
                <span>Alur Sistem Terintegrasi</span>
              </div>
              <h2 className="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                Konsultasikan Kebutuhan Sistem Perangkat Lunak Anda
              </h2>
              <p className="text-sm sm:text-base text-zinc-400 leading-relaxed">
                Kirimkan brief teknis atau tentukan jadwal konsultasi daring langsung melalui formulir terintegrasi kami. Semua kebutuhan terekam aman di sistem internal tanpa risiko tercecer.
              </p>
              <div className="flex flex-wrap gap-4 pt-2">
                <Link
                  href="/mulai-proyek"
                  className="px-6 py-3 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 text-white rounded-xl text-sm font-semibold transition shadow-[0_0_25px_rgba(220,38,38,0.4)] border border-red-500/30"
                >
                  Isi Brief Proyek Sekarang
                </Link>
                <Link
                  href="/booking"
                  className="px-6 py-3 bg-white/[0.05] hover:bg-white/[0.09] text-zinc-200 border border-white/[0.12] rounded-xl text-sm font-medium transition backdrop-blur-xl"
                >
                  Jadwalkan Konsultasi Teknis
                </Link>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
