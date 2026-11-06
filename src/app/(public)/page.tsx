import { prisma } from "@/lib/prisma";
import Link from "next/link";
import { TerminalCopy } from "@/components/public/TerminalCopy";

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

  const brandName = company?.companyName || "PT REKASAYA DIGITAL";
  const tagline =
    company?.tagline ||
    "Arsitektur Software Terdistribusi & Rekayasa Sistem Kritis Skala Korporasi";
  const description =
    company?.aboutShort ||
    "Membangun infrastruktur komputasi tangguh, sistem API berkecepatan tinggi, dan platform digital berdaya tahan maksimal tanpa kompromi performa.";

  return (
    <div className="relative overflow-hidden selection:bg-red-950 selection:text-red-200">
      {/* Blueprint Grid Background Pattern */}
      <div 
        className="absolute inset-0 -z-10 pointer-events-none opacity-20"
        style={{
          backgroundImage: "linear-gradient(to right, #27272a 1px, transparent 1px), linear-gradient(to bottom, #27272a 1px, transparent 1px)",
          backgroundSize: "40px 40px"
        }}
      />

      {/* 1. HERO SECTION (Antislop Brutalist Engineering Style) */}
      <section className="relative pt-16 pb-20 md:pt-24 md:pb-28 border-b border-zinc-900">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            {/* Left Content */}
            <div className="lg:col-span-7 space-y-7">
              <div className="inline-flex items-center gap-2.5 px-3 py-1 rounded bg-zinc-950 border border-zinc-800 text-[11px] font-mono tracking-wider text-zinc-300">
                <span className="w-2 h-2 bg-red-600 animate-pulse" />
                <span className="text-zinc-500">//</span>
                <span className="text-red-400 font-semibold uppercase">SPEC-38 COMPLIANT</span>
                <span className="text-zinc-600">&bull;</span>
                <span className="text-zinc-400">ENTERPRISE CORE</span>
              </div>

              <h1 className="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white uppercase font-sans leading-[1.08]">
                {tagline}
              </h1>

              <p className="text-zinc-400 text-sm sm:text-base leading-relaxed max-w-xl font-sans">
                {description}
              </p>

              {/* Interactive Terminal Bar */}
              <div className="pt-2 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <TerminalCopy command="npx rekasaya init --env=production" />
                <Link
                  href="/mulai-proyek"
                  className="px-5 py-2.5 bg-red-600 hover:bg-red-500 text-white rounded text-xs font-mono font-semibold uppercase tracking-wider transition shadow-[0_0_20px_rgba(220,38,38,0.4)]"
                >
                  Mulai Proyek &rarr;
                </Link>
              </div>

              {/* Metadata strip */}
              <div className="pt-6 border-t border-zinc-900/80 grid grid-cols-3 gap-4 text-xs font-mono">
                <div>
                  <div className="text-zinc-500 text-[10px] uppercase">Reliabilitas</div>
                  <div className="text-zinc-200 font-bold mt-0.5">99.98% SLA</div>
                </div>
                <div>
                  <div className="text-zinc-500 text-[10px] uppercase">Arsitektur</div>
                  <div className="text-zinc-200 font-bold mt-0.5">Microservices</div>
                </div>
                <div>
                  <div className="text-zinc-500 text-[10px] uppercase">Alur Order</div>
                  <div className="text-red-400 font-bold mt-0.5">100% Web Engine</div>
                </div>
              </div>
            </div>

            {/* Right Graphic: Antislop Geometric Vektor & Graphic System */}
            <div className="lg:col-span-5">
              <div className="relative mx-auto max-w-md p-6 bg-zinc-950/80 border border-zinc-800 rounded-lg shadow-2xl relative group overflow-hidden">
                <div className="absolute top-0 right-0 w-32 h-32 bg-red-600/10 blur-3xl pointer-events-none" />

                <div className="flex items-center justify-between pb-4 border-b border-zinc-900 text-[11px] font-mono text-zinc-500">
                  <div className="flex items-center gap-2">
                    <span className="w-2 h-2 rounded-full bg-red-600" />
                    <span className="text-zinc-300 font-semibold">CORE_ENGINE.SYS</span>
                  </div>
                  <span className="text-zinc-600">v4.8.2-LTS</span>
                </div>

                <div className="my-6 py-6 border border-zinc-900/80 bg-black/60 rounded flex flex-col items-center justify-center relative">
                  <svg className="w-36 h-36 text-red-600/80 stroke-current" viewBox="0 0 100 100" fill="none">
                    <circle cx="50" cy="50" r="44" strokeWidth="1" strokeDasharray="3 3" className="opacity-40" />
                    <circle cx="50" cy="50" r="32" strokeWidth="1.5" className="opacity-70" />
                    <polygon points="50,18 78,68 22,68" strokeWidth="1.5" strokeLinejoin="round" />
                    <circle cx="50" cy="50" r="5" fill="#dc2626" />
                    <line x1="50" y1="6" x2="50" y2="24" strokeWidth="1.5" />
                    <line x1="50" y1="76" x2="50" y2="94" strokeWidth="1.5" />
                    <line x1="6" y1="50" x2="24" y2="50" strokeWidth="1.5" />
                    <line x1="76" y1="50" x2="94" y2="50" strokeWidth="1.5" />
                  </svg>
                  <div className="mt-4 font-mono text-[11px] tracking-widest text-zinc-400 uppercase">
                    HIGH-CONCURRENCY ARCHITECTURE
                  </div>
                </div>

                <div className="space-y-2 font-mono text-xs text-zinc-400">
                  <div className="flex justify-between py-1 border-b border-zinc-900/60">
                    <span className="text-zinc-500">Database Cluster:</span>
                    <span className="text-zinc-200">PostgreSQL (Neon Cloud)</span>
                  </div>
                  <div className="flex justify-between py-1 border-b border-zinc-900/60">
                    <span className="text-zinc-500">Latency Threshold:</span>
                    <span className="text-emerald-400">&lt; 150ms P99</span>
                  </div>
                  <div className="flex justify-between py-1">
                    <span className="text-zinc-500">Security Guard:</span>
                    <span className="text-red-400">Zero-Trust & Bcrypt</span>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

      {/* 2. SERVICES SECTION */}
      {services.length > 0 && (
        <section className="py-20 border-b border-zinc-900">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-zinc-900 pb-5">
              <div>
                <div className="flex items-center gap-2 text-xs font-mono uppercase tracking-widest text-red-500">
                  <span className="w-1.5 h-1.5 bg-red-600" />
                  <span>/KAPABILITAS_REKAYASA</span>
                </div>
                <h2 className="text-2xl sm:text-3xl font-extrabold text-white mt-1.5 uppercase font-sans">
                  Solusi Komputasi & Perangkat Lunak
                </h2>
              </div>
              <Link
                href="/layanan"
                className="text-xs font-mono text-zinc-400 hover:text-red-400 transition"
              >
                Lihat Seluruh Layanan &rarr;
              </Link>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              {services.map((service, idx) => {
                const trans = service.translations[0];
                return (
                  <div
                    key={service.id}
                    className="p-6 bg-zinc-950/80 border border-zinc-900 hover:border-red-600/50 rounded-lg space-y-4 transition-all duration-200 group relative"
                  >
                    <div className="flex items-center justify-between text-xs font-mono">
                      <span className="text-zinc-600 group-hover:text-red-500 transition-colors">
                        [0{idx + 1}]
                      </span>
                      <span className="text-zinc-600">/{service.slug}</span>
                    </div>
                    <h3 className="text-lg font-bold text-white group-hover:text-red-100 transition-colors">
                      {trans?.name || service.slug}
                    </h3>
                    <p className="text-xs text-zinc-400 line-clamp-3 leading-relaxed">
                      {trans?.summary || "Spesifikasi arsitektur komputasi dan implementasi perangkat lunak."}
                    </p>
                    <div className="pt-2 border-t border-zinc-900 flex justify-between items-center">
                      <Link
                        href={`/layanan/${service.slug}`}
                        className="text-xs font-mono text-zinc-500 group-hover:text-red-400 transition flex items-center gap-1"
                      >
                        <span>Eksplorasi Teknis</span>
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
        <section className="py-20 border-b border-zinc-900">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-zinc-900 pb-5">
              <div>
                <div className="flex items-center gap-2 text-xs font-mono uppercase tracking-widest text-red-500">
                  <span className="w-1.5 h-1.5 bg-red-600" />
                  <span>/PORTFOLIO_MATRIX</span>
                </div>
                <h2 className="text-2xl sm:text-3xl font-extrabold text-white mt-1.5 uppercase font-sans">
                  Studi Kasus & Implementasi Nyata
                </h2>
              </div>
              <Link
                href="/portofolio"
                className="text-xs font-mono text-zinc-400 hover:text-red-400 transition"
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
                    className="p-7 bg-zinc-950/80 border border-zinc-900 hover:border-zinc-800 rounded-lg space-y-4 transition"
                  >
                    <div className="flex items-center justify-between text-xs font-mono">
                      <span className="text-zinc-500">REF: {project.slug}</span>
                      {project.isFeatured && (
                        <span className="px-2 py-0.5 rounded text-[10px] font-mono bg-red-950 text-red-400 border border-red-800/40">
                          PRODUKSI AKTIF
                        </span>
                      )}
                    </div>

                    <h3 className="text-xl font-bold text-white">
                      {trans?.title || project.slug}
                    </h3>

                    {trans?.challenge && (
                      <div className="text-xs text-zinc-400 leading-relaxed">
                        <span className="font-mono text-zinc-500 uppercase">Tantangan: </span>
                        {trans.challenge}
                      </div>
                    )}

                    {trans?.result && (
                      <div className="text-xs text-zinc-300 bg-black/60 p-3.5 rounded border border-zinc-900 font-mono">
                        <span className="text-red-400 font-bold uppercase">&gt; Dampak Teknis: </span>
                        {trans.result}
                      </div>
                    )}

                    <div className="pt-2">
                      <Link
                        href={`/portofolio/${project.slug}`}
                        className="text-xs font-mono text-red-500 hover:text-red-400 transition"
                      >
                        Detail Arsitektur Kasus &rarr;
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
        <section className="py-20 border-b border-zinc-900">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-zinc-900 pb-5">
              <div>
                <div className="flex items-center gap-2 text-xs font-mono uppercase tracking-widest text-red-500">
                  <span className="w-1.5 h-1.5 bg-red-600" />
                  <span>/WAWASAN_TEKNIK</span>
                </div>
                <h2 className="text-2xl sm:text-3xl font-extrabold text-white mt-1.5 uppercase font-sans">
                  Dokumentasi & Riset Arsitektur
                </h2>
              </div>
              <Link
                href="/blog"
                className="text-xs font-mono text-zinc-400 hover:text-red-400 transition"
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
                    className="p-6 bg-zinc-950/80 border border-zinc-900 hover:border-zinc-800 rounded-lg space-y-3 transition flex flex-col justify-between"
                  >
                    <div className="space-y-2.5">
                      <div className="text-[11px] font-mono text-zinc-500">
                        DATE: {dateStr}
                      </div>
                      <h3 className="text-base font-bold text-zinc-100 line-clamp-2">
                        {trans?.title || post.slug}
                      </h3>
                      <p className="text-xs text-zinc-400 line-clamp-3 leading-relaxed">
                        {trans?.content || ""}
                      </p>
                    </div>

                    <div className="pt-4 border-t border-zinc-900">
                      <Link
                        href={`/blog/${post.slug}`}
                        className="text-xs font-mono text-zinc-400 hover:text-red-400 transition"
                      >
                        Baca Catatan Teknik &rarr;
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
      <section className="py-20">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="p-8 sm:p-12 rounded-lg bg-zinc-950 border border-zinc-800 relative overflow-hidden">
            <div className="absolute top-0 right-0 w-64 h-64 bg-red-600/10 blur-3xl pointer-events-none" />
            
            <div className="max-w-2xl space-y-5 relative">
              <div className="inline-flex items-center gap-2 px-2.5 py-1 rounded bg-black border border-zinc-800 text-[10px] font-mono uppercase tracking-wider text-red-400">
                <span>DATABASE PIPELINE ACTIVE</span>
              </div>
              <h2 className="text-2xl sm:text-4xl font-extrabold text-white uppercase font-sans">
                Inisialisasi Proyek Perangkat Lunak Anda
              </h2>
              <p className="text-xs sm:text-sm text-zinc-400 leading-relaxed font-sans">
                Kirimkan brief teknis atau tentukan jadwal konsultasi langsung ke sistem kami. Tanpa alur obrolan WhatsApp yang rawan tercecer: semua requirements terekam aman dalam sistem terpusat.
              </p>
              <div className="flex flex-wrap gap-4 pt-2">
                <Link
                  href="/mulai-proyek"
                  className="px-5 py-2.5 bg-red-600 hover:bg-red-500 text-white rounded text-xs font-mono font-semibold uppercase tracking-wider transition shadow-[0_0_20px_rgba(220,38,38,0.4)]"
                >
                  Isi Brief Proyek Sekarang
                </Link>
                <Link
                  href="/booking"
                  className="px-5 py-2.5 bg-black hover:bg-zinc-900 text-zinc-200 border border-zinc-800 rounded text-xs font-mono uppercase tracking-wider transition"
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
