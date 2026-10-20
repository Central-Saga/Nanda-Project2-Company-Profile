@extends('layouts.public')

@section('seo')
    <x-seo-meta
        :og-image="$siteProfile->hero_image ?? null"
    />
@endsection

@section('content')
    <!-- =========================================================================
         01 - HERO SECTION (Modern Digital Agency & Spatial Clarity)
         ========================================================================= -->
    <section class="relative pt-16 pb-24 md:pt-24 md:pb-32 overflow-hidden bg-ambient-mesh border-b border-white/10">
        <!-- Subtle Ambient Lighting Elements -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[750px] h-[360px] bg-[#10B981]/15 blur-[140px] pointer-events-none rounded-full animate-ambient-float"></div>
        <div class="absolute top-1/4 right-5 w-[400px] h-[300px] bg-[#34D399]/10 blur-[130px] pointer-events-none rounded-full animate-ambient-float"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

            <!-- Studio Announcement Pill -->
            <div class="inline-flex items-center space-x-2.5 px-4 py-1.5 glass-pill rounded-full text-xs font-mono text-[#A0ADA5] mb-8 hover:border-[#10B981]/40 transition-colors animate-soft-float">
                <span class="w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></span>
                <span class="text-white font-semibold">{{ $siteProfile->company_name ?? config('app.name') }}</span>
                <span class="text-white/20">&bull;</span>
                <span class="text-[#34D399]">Software House &amp; Creative Agency Bali</span>
            </div>

            <!-- Main Headline -->
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.12] mb-6 max-w-4xl mx-auto">
                {{ $siteProfile->hero_title ?? 'Membangun Impian Digital, Dari Bali ke Dunia' }}
            </h1>

            <!-- Narrative Subheadline -->
            <p class="text-base sm:text-xl text-[#A0ADA5] leading-relaxed mb-10 max-w-2xl mx-auto font-normal">
                {{ $siteProfile->hero_subtitle ?? 'Kami adalah software house dan creative agency yang berkedudukan di Tabanan, Bali, memadukan keindahan desain visual dan keandalan rekayasa sistem digital.' }}
            </p>

            <!-- Refined Action Bar -->
            <div class="max-w-xl mx-auto glass-panel rounded-2xl p-2 sm:p-2.5 flex flex-col sm:flex-row items-center justify-between gap-3 shadow-[0_20px_40px_rgba(0,0,0,0.5)] mb-10">
                <div class="flex items-center space-x-3 px-3 py-1">
                    <img src="{{ asset('images/logo.png') }}"
                         alt="Logo"
                         class="h-7 w-7 object-contain rounded-lg p-0.5 border border-white/10 bg-[#101713]">
                    <span class="text-xs sm:text-sm font-mono text-[#F5F7F5] truncate">
                        {{ $siteProfile->email ?? 'info@centralsaga.com' }}
                    </span>
                </div>
                <div class="flex items-center space-x-2 w-full sm:w-auto">
                    <button type="button"
                            onclick="navigator.clipboard.writeText('{{ $siteProfile->email ?? 'info@centralsaga.com' }}'); alert('Email berhasil disalin ke clipboard!');"
                            class="flex-1 sm:flex-none px-4 py-2 text-xs font-mono font-medium text-[#A0ADA5] hover:text-white glass-pill rounded-xl transition-colors min-h-[40px] flex items-center justify-center"
                            title="Salin email ke clipboard">
                        Salin Email
                    </button>
                    <a href="/kontak"
                       class="flex-1 sm:flex-none px-6 py-2 text-xs font-semibold text-white btn-emerald btn-shimmer rounded-xl min-h-[40px] flex items-center justify-center">
                        Diskusikan Proyek
                    </a>
                </div>
            </div>

            <!-- Capability Tags -->
            <div class="flex flex-wrap items-center justify-center gap-2 mb-16 text-xs font-mono">
                <a href="/layanan" class="px-3.5 py-1.5 glass-pill rounded-xl text-[#A0ADA5] hover:text-[#34D399] transition-colors">
                    Aplikasi Web
                </a>
                <a href="/layanan" class="px-3.5 py-1.5 glass-pill rounded-xl text-[#A0ADA5] hover:text-[#34D399] transition-colors">
                    Aplikasi Mobile
                </a>
                <a href="/layanan" class="px-3.5 py-1.5 glass-pill rounded-xl text-[#A0ADA5] hover:text-[#34D399] transition-colors">
                    Desain UI &amp; UX
                </a>
                <a href="/layanan" class="px-3.5 py-1.5 glass-pill rounded-xl text-[#A0ADA5] hover:text-[#34D399] transition-colors">
                    Sistem Cloud
                </a>
                <a href="/proyek" class="px-3.5 py-1.5 glass-pill rounded-xl text-[#34D399] hover:text-white transition-colors">
                    Portofolio Studio &rarr;
                </a>
            </div>

            <!-- Spatial Clarity Showcase Card (Agency Interface Preview) -->
            <div class="glass-panel rounded-3xl p-6 sm:p-8 text-left max-w-5xl mx-auto border border-white/10 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.7)] relative overflow-hidden">
                <!-- Card Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 mb-6 border-b border-white/10 gap-3">
                    <div class="flex items-center space-x-3">
                        <div class="flex space-x-1.5">
                            <span class="w-3 h-3 rounded-full bg-white/20"></span>
                            <span class="w-3 h-3 rounded-full bg-white/20"></span>
                            <span class="w-3 h-3 rounded-full bg-[#10B981]"></span>
                        </div>
                        <span class="text-xs font-mono text-[#A0ADA5] font-semibold tracking-wider">
                            CENTRAL SAGA MANDALA &bull; CORE PLATFORM
                        </span>
                    </div>
                    <div class="flex items-center space-x-2 text-xs font-mono text-[#34D399]">
                        <span class="w-2 h-2 rounded-full bg-[#10B981] animate-ping"></span>
                        <span>STATUS: OPERASIONAL NORMAL</span>
                    </div>
                </div>

                <!-- 3 Spatial Feature Pillars -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Pillar 1 -->
                    <div class="p-5 rounded-2xl bg-white/[0.02] border border-white/5 hover:border-[#10B981]/30 transition-all">
                        <div class="w-10 h-10 rounded-xl bg-[#10B981]/15 text-[#34D399] flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-white mb-2">
                            Rekayasa Sistem Andal
                        </h2>
                        <p class="text-xs text-[#A0ADA5] leading-relaxed">
                            Arsitektur backend tangguh, keamanan data berlapis, dan performa tinggi yang siap diskalakan sesuai pertumbuhan bisnis Anda.
                        </p>
                    </div>

                    <!-- Pillar 2 -->
                    <div class="p-5 rounded-2xl bg-white/[0.02] border border-white/5 hover:border-[#10B981]/30 transition-all">
                        <div class="w-10 h-10 rounded-xl bg-[#10B981]/15 text-[#34D399] flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-white mb-2">
                            Desain UI &amp; UX Berkarakter
                        </h2>
                        <p class="text-xs text-[#A0ADA5] leading-relaxed">
                            Antarmuka pengguna yang dirancang penuh perhatian terhadap detail visual, kenyamanan interaksi, dan identitas brand yang kuat.
                        </p>
                    </div>

                    <!-- Pillar 3 -->
                    <div class="p-5 rounded-2xl bg-white/[0.02] border border-white/5 hover:border-[#10B981]/30 transition-all">
                        <div class="w-10 h-10 rounded-xl bg-[#10B981]/15 text-[#34D399] flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-white mb-2">
                            Penyampaian Transparan
                        </h2>
                        <p class="text-xs text-[#A0ADA5] leading-relaxed">
                            Komunikasi terbuka, penjaminan mutu berkala, serta kepastian penyelesaian target fungsional tanpa kejutan tak terduga.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- =========================================================================
         01.1 - DYNAMIC METRICS BAR (Agency Track Record)
         ========================================================================= -->
    @php
        $statsData = $siteProfile->stats ?? [
            ['label' => 'Proyek Terselesaikan', 'value' => '45+'],
            ['label' => 'Kepuasan Klien', 'value' => '99.4%'],
            ['label' => 'Tingkat Ketersediaan Sistem', 'value' => '99.9%'],
            ['label' => 'Tahun Pengalaman Rekayasa', 'value' => '5+ Tahun'],
        ];
    @endphp
    <section class="border-b border-white/10 bg-[#060A08]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                @foreach ($statsData as $index => $st)
                    <div class="p-4 rounded-2xl glass-panel spotlight-card reveal delay-{{ ($index + 1) * 100 }}">
                        <span class="text-2xl sm:text-4xl font-extrabold text-[#34D399] font-mono block mb-1" data-counter="{{ $st['value'] ?? '0' }}">
                            {{ $st['value'] ?? '0' }}
                        </span>
                        <span class="text-xs sm:text-sm text-[#A0ADA5] font-mono">
                            {{ $st['label'] ?? '' }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =========================================================================
         02 - LAYANAN SECTION (Minimalist Strategic Services)
         ========================================================================= -->
    <section id="layanan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 border-b border-white/10 relative">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 reveal">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399] mb-3">
                    <span class="text-[#10B981]">&bull;</span>
                    <span>LAYANAN STRATEGIS</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white mt-1">
                    Solusi Perangkat Lunak &amp; Desain
                </h2>
                <p class="text-sm sm:text-base text-[#A0ADA5] mt-2 max-w-2xl">
                    Setiap modul dirancang secara terukur untuk menjawab tantangan bisnis nyata dengan arsitektur teknologi masa kini.
                </p>
            </div>
            <div class="mt-6 md:mt-0 flex items-center space-x-3">
                <a href="/layanan" class="inline-flex items-center px-4 py-2 text-xs font-mono font-medium text-[#A0ADA5] hover:text-white glass-pill rounded-xl min-h-[44px]">
                    Semua Layanan &rarr;
                </a>
                <a href="/kontak" class="inline-flex items-center px-5 py-2.5 text-xs font-mono font-semibold text-white btn-emerald btn-shimmer rounded-xl min-h-[44px]">
                    Konsultasikan Kebutuhan Anda
                </a>
            </div>
        </div>

        @if ($services->isEmpty())
            <div class="glass-panel rounded-2xl p-12 text-center border-dashed border-white/20">
                <p class="text-sm text-[#A0ADA5] font-mono">
                    Belum ada layanan yang ditampilkan saat ini.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($services as $index => $service)
                    <article class="glass-panel spotlight-card reveal delay-{{ (($index % 3) + 1) * 100 }} rounded-2xl p-6 sm:p-8 flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <span class="font-mono text-xs font-bold text-[#34D399] px-2.5 py-1 glass-pill rounded-lg">
                                    LAYANAN 0{{ $index + 1 }}
                                </span>
                                <span class="w-2.5 h-2.5 rounded-full bg-[#10B981]/40 group-hover:bg-[#10B981] transition-colors"></span>
                            </div>

                            @if (!empty($service->image))
                                <div class="mb-6 overflow-hidden rounded-xl bg-[#080D0B] border border-white/10 aspect-video">
                                    <img src="{{ asset('storage/' . $service->image) }}"
                                         alt="{{ $service->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                         loading="lazy">
                                </div>
                            @endif

                            <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 group-hover:text-[#34D399] transition-colors">
                                <a href="/layanan/{{ $service->slug }}" class="focus-visible:ring-2 focus-visible:ring-[#10B981] rounded-lg">
                                    {{ $service->title }}
                                </a>
                            </h3>

                            <p class="text-sm text-[#A0ADA5] leading-relaxed mb-6">
                                {{ Str::limit($service->description, 160) }}
                            </p>

                            @if (!empty($service->benefits) && is_array($service->benefits))
                                <div class="mb-6 space-y-1.5 text-xs text-[#A0ADA5]">
                                    @foreach (array_slice($service->benefits, 0, 3) as $benefit)
                                        <div class="flex items-center space-x-2">
                                            <span class="text-[#34D399] font-bold">&check;</span>
                                            <span class="truncate">{{ $benefit }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono">
                            <span class="text-[#A0ADA5]">
                                SPESIFIKASI KUSTOM
                            </span>
                            <a href="/layanan/{{ $service->slug }}" class="inline-flex items-center min-h-[36px] font-semibold text-[#10B981] hover:text-[#34D399] transition-colors">
                                Pelajari Detail &rarr;
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <!-- =========================================================================
         02.5 - FEATURED PROJECTS SECTION (Editorial Case Studies)
         ========================================================================= -->
    @if (isset($featuredProjects) && $featuredProjects->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 border-b border-white/10 relative">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 reveal">
                <div>
                    <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399] mb-3">
                        <span class="text-[#10B981]">&bull;</span>
                        <span>STUDI KASUS &amp; PORTOFOLIO</span>
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white mt-1">
                        Karya Unggulan Pilihan
                    </h2>
                    <p class="text-sm sm:text-base text-[#A0ADA5] mt-2 max-w-xl">
                        Portofolio sistem dan produk digital yang telah membantu transformasi operasional mitra kami.
                    </p>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="/proyek" class="inline-flex items-center px-5 py-2.5 text-xs font-mono font-semibold text-white btn-emerald btn-shimmer rounded-xl min-h-[44px]">
                        Eksplorasi Seluruh Proyek &rarr;
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($featuredProjects as $project)
                    <article class="glass-panel spotlight-card reveal delay-{{ (($loop->index % 2) + 1) * 150 }} rounded-3xl p-6 sm:p-8 flex flex-col justify-between group border border-white/10 hover:border-[#10B981]/40 transition-all">
                        <div>
                            @if (!empty($project->thumbnail))
                                <div class="mb-6 overflow-hidden rounded-2xl bg-[#080D0B] border border-white/10 aspect-[16/10] relative">
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}"
                                         alt="{{ $project->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                         loading="lazy">
                                    <div class="absolute top-4 left-4">
                                        <span class="px-3 py-1 rounded-lg text-xs font-mono font-semibold bg-[#080D0B]/80 text-[#34D399] border border-white/10 backdrop-blur-md">
                                            {{ $project->category }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-center justify-between text-xs font-mono text-[#A0ADA5] mb-3">
                                <span>{{ $project->client ?? 'Klien Mitra' }}</span>
                                @if (!empty($project->completion_date))
                                    <span>{{ $project->completion_date }}</span>
                                @endif
                            </div>

                            <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-[#34D399] transition-colors leading-snug">
                                <a href="/proyek/{{ $project->slug }}">
                                    {{ $project->title }}
                                </a>
                            </h3>

                            <p class="text-sm text-[#A0ADA5] leading-relaxed mb-6">
                                {{ Str::limit($project->description, 160) }}
                            </p>

                            @if (!empty($project->tech_stack) && is_array($project->tech_stack))
                                <div class="flex flex-wrap gap-1.5 mb-6">
                                    @foreach (array_slice($project->tech_stack, 0, 4) as $stack)
                                        <span class="px-2.5 py-0.5 rounded-md text-[11px] font-mono bg-white/[0.04] text-[#A0ADA5] border border-white/5">
                                            {{ $stack }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono">
                            <a href="/proyek/{{ $project->slug }}" class="inline-flex items-center text-[#10B981] group-hover:text-[#34D399] font-semibold">
                                Lihat Rincian Studi Kasus &rarr;
                            </a>
                            @if (!empty($project->external_url))
                                <a href="{{ $project->external_url }}" target="_blank" rel="noopener noreferrer" class="text-[#A0ADA5] hover:text-white underline">
                                    Kunjungi Live URL &nearr;
                                </a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <!-- =========================================================================
         02.6 - WORKFLOW & PROCESS (Tahapan Pengerjaan Terukur)
         ========================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 border-b border-white/10 relative">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399] mb-3">
                <span class="text-[#10B981]">&bull;</span>
                <span>METODOLOGI EKSEKUSI</span>
            </div>
            <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white mt-1">
                Alur Pengerjaan Sistem Terstandar
            </h2>
            <p class="text-sm sm:text-base text-[#A0ADA5] mt-2">
                Dari inisiasi konsep awal hingga live deployment, seluruh tahapan dilaksanakan dengan koordinasi berkala dan pengujian ketat.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            <div class="glass-panel rounded-2xl p-6 relative">
                <span class="text-xs font-mono text-[#34D399] font-bold block mb-2">01 / RISET</span>
                <h4 class="text-base font-bold text-white mb-2">Analisis &amp; Spesifikasi</h4>
                <p class="text-xs text-[#A0ADA5] leading-relaxed">Penyusunan arsitektur sistem, pemetaan logika bisnis, dan definisi kebutuhan fungsional detail.</p>
            </div>
            <div class="glass-panel rounded-2xl p-6 relative">
                <span class="text-xs font-mono text-[#34D399] font-bold block mb-2">02 / DESAIN</span>
                <h4 class="text-base font-bold text-white mb-2">UI/UX &amp; Prototipe</h4>
                <p class="text-xs text-[#A0ADA5] leading-relaxed">Eksplorasi wireframe, design system, interaksi intuitif, dan validasi kenyamanan antarmuka.</p>
            </div>
            <div class="glass-panel rounded-2xl p-6 relative">
                <span class="text-xs font-mono text-[#34D399] font-bold block mb-2">03 / KODE</span>
                <h4 class="text-base font-bold text-white mb-2">Agile Engineering</h4>
                <p class="text-xs text-[#A0ADA5] leading-relaxed">Pengembangan kode berorientasi clean architecture, API modular, dan git review berlapis.</p>
            </div>
            <div class="glass-panel rounded-2xl p-6 relative">
                <span class="text-xs font-mono text-[#34D399] font-bold block mb-2">04 / UJI</span>
                <h4 class="text-base font-bold text-white mb-2">QA &amp; Security Audit</h4>
                <p class="text-xs text-[#A0ADA5] leading-relaxed">Pengujian unit otomatis, penetration testing, simulasi beban, dan kepatuhan aksesibilitas.</p>
            </div>
            <div class="glass-panel rounded-2xl p-6 relative">
                <span class="text-xs font-mono text-[#34D399] font-bold block mb-2">05 / RILIS</span>
                <h4 class="text-base font-bold text-white mb-2">Deploy &amp; Monitoring</h4>
                <p class="text-xs text-[#A0ADA5] leading-relaxed">Deployment CI/CD ke cloud infrastructure, konfigurasi pemantauan performa, dan pendampingan pasca-rilis.</p>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         02.7 - TECHNOLOGY STACK (Eksplorasi Teknologi)
         ========================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 border-b border-white/10 relative">
        <div class="text-center max-w-2xl mx-auto mb-16 reveal">
            <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399] mb-3">
                <span class="text-[#10B981]">&bull;</span>
                <span>TEKNOLOGI KELAS INDUSTRI</span>
            </div>
            <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white mt-1">
                Fondasi Teknologi Kami
            </h2>
            <p class="text-sm sm:text-base text-[#A0ADA5] mt-2">
                Kami memilih stack modern yang terbukti cepat, aman, dan mudah dipelihara dalam jangka panjang.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4 text-center">
            <!-- 1. Laravel -->
            <div class="group p-4 rounded-2xl glass-panel spotlight-card reveal delay-100 hover:border-[#10B981]/50 hover:bg-white/[0.06] hover:-translate-y-1 transition-all duration-300 flex flex-col items-center justify-center text-center">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/5 border border-white/10 mb-3 group-hover:border-[#FF2D20]/40 group-hover:bg-[#FF2D20]/10 group-hover:shadow-[0_0_20px_rgba(255,45,32,0.25)] transition-all duration-300">
                    <svg class="w-6 h-6 text-[#FF2D20] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.406 3.513l8.47 4.89-8.47 4.89-8.406-4.89 8.406-4.89zm1.094 11.233v6.754l7.375-4.258v-6.754l-7.375 4.258zm-2.188 0l-7.312-4.258v6.754l7.312 4.258v-6.754zm10.562-3.832l4.126-2.382v-3.793l-4.126 2.382v3.793zm1.094-7.051l3.032 1.75 3.032-1.75-3.032-1.75-3.032 1.75zm5.156 3.258v3.793l4.126-2.382v-3.793l-4.126 2.382z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">Laravel</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Backend Core</span>
            </div>

            <!-- 2. PHP 8.3+ -->
            <div class="group p-4 rounded-2xl glass-panel spotlight-card reveal delay-200 hover:border-[#10B981]/50 hover:bg-white/[0.06] hover:-translate-y-1 transition-all duration-300 flex flex-col items-center justify-center text-center">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/5 border border-white/10 mb-3 group-hover:border-[#777BB4]/40 group-hover:bg-[#777BB4]/10 group-hover:shadow-[0_0_20px_rgba(119,123,180,0.25)] transition-all duration-300">
                    <svg class="w-6 h-6 text-[#777BB4] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-5.7 13.5h-1.8l1.4-7h3c1.8 0 2.8.9 2.6 2.3-.2 1.6-1.7 2.7-3.4 2.7H7.1l-.8 2zm5.5 0h-1.8l1.4-7h1.8l-.6 3.1h1.8c1.8 0 2.8.9 2.6 2.3-.3 1.6-1.8 2.7-3.5 2.7h-1.5l-.4 1.9zm8.2-5c-.2 1.6-1.7 2.7-3.4 2.7H15l-.4 2.3h-1.8l1.4-7h3c1.8 0 2.8.9 2.8 2z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">PHP 8.3+</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Engine</span>
            </div>

            <!-- 3. PostgreSQL -->
            <div class="group p-4 rounded-2xl glass-panel spotlight-card reveal delay-300 hover:border-[#10B981]/50 hover:bg-white/[0.06] hover:-translate-y-1 transition-all duration-300 flex flex-col items-center justify-center text-center">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/5 border border-white/10 mb-3 group-hover:border-[#336791]/40 group-hover:bg-[#336791]/10 group-hover:shadow-[0_0_20px_rgba(51,103,145,0.25)] transition-all duration-300">
                    <svg class="w-6 h-6 text-[#4169E1] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm5.8 13.4c-.4.8-1 1.4-1.8 1.8a5 5 0 0 1-2.4.6 4.9 4.9 0 0 1-3.6-1.5 5.5 5.5 0 0 1-1.4-3.8c0-1.6.5-2.9 1.5-4a5.2 5.2 0 0 1 3.8-1.6c1.3 0 2.4.4 3.3 1.2a5.4 5.4 0 0 1 1.7 3.3h-2.1a3.5 3.5 0 0 0-1-2 3.1 3.1 0 0 0-2-.7 3.2 3.2 0 0 0-2.4 1 4.1 4.1 0 0 0-.9 2.7 4.1 4.1 0 0 0 .9 2.8 3.1 3.1 0 0 0 2.4 1 3 3 0 0 0 2.1-.8 3.6 3.6 0 0 0 1-2.1h-3.1v-1.7h5.2v3.7z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">PostgreSQL</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Relational DB</span>
            </div>

            <!-- 4. Tailwind 4 -->
            <div class="group p-4 rounded-2xl glass-panel spotlight-card reveal delay-400 hover:border-[#10B981]/50 hover:bg-white/[0.06] hover:-translate-y-1 transition-all duration-300 flex flex-col items-center justify-center text-center">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/5 border border-white/10 mb-3 group-hover:border-[#38BDF8]/40 group-hover:bg-[#38BDF8]/10 group-hover:shadow-[0_0_20px_rgba(56,189,248,0.25)] transition-all duration-300">
                    <svg class="w-6 h-6 text-[#38BDF8] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">Tailwind 4</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Design Engine</span>
            </div>

            <!-- 5. Vue / React -->
            <div class="group p-4 rounded-2xl glass-panel spotlight-card reveal delay-500 hover:border-[#10B981]/50 hover:bg-white/[0.06] hover:-translate-y-1 transition-all duration-300 flex flex-col items-center justify-center text-center">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/5 border border-white/10 mb-3 group-hover:border-[#61DAFB]/40 group-hover:bg-[#61DAFB]/10 group-hover:shadow-[0_0_20px_rgba(97,218,251,0.25)] transition-all duration-300">
                    <svg class="w-6 h-6 text-[#61DAFB] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <circle cx="12" cy="12" r="2.2" fill="currentColor"/>
                        <ellipse cx="12" cy="12" rx="10" ry="4"/>
                        <ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(60 12 12)"/>
                        <ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(120 12 12)"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">Vue / React</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">SPA / Dynamic UI</span>
            </div>

            <!-- 6. Flutter -->
            <div class="group p-4 rounded-2xl glass-panel spotlight-card reveal delay-600 hover:border-[#10B981]/50 hover:bg-white/[0.06] hover:-translate-y-1 transition-all duration-300 flex flex-col items-center justify-center text-center">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/5 border border-white/10 mb-3 group-hover:border-[#02569B]/40 group-hover:bg-[#02569B]/10 group-hover:shadow-[0_0_20px_rgba(2,86,155,0.25)] transition-all duration-300">
                    <svg class="w-6 h-6 text-[#54C5F8] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14.314 0L2.3 12 6 15.7 21.684 0zm.014 11.072L7.857 17.543 14.328 24H21.7l-6.471-6.457 6.471-6.471z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">Flutter</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Cross-Platform</span>
            </div>

            <!-- 7. Docker -->
            <div class="group p-4 rounded-2xl glass-panel spotlight-card reveal delay-700 hover:border-[#10B981]/50 hover:bg-white/[0.06] hover:-translate-y-1 transition-all duration-300 flex flex-col items-center justify-center text-center">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/5 border border-white/10 mb-3 group-hover:border-[#2496ED]/40 group-hover:bg-[#2496ED]/10 group-hover:shadow-[0_0_20px_rgba(36,150,237,0.25)] transition-all duration-300">
                    <svg class="w-6 h-6 text-[#2496ED] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M13.983 11.078h2.119a.186.186 0 00.186-.185V9.006a.186.186 0 00-.186-.186h-2.119a.185.185 0 00-.185.185v1.888c0 .102.083.185.185.185m-2.954-5.43h2.118a.186.186 0 00.186-.186V3.574a.186.186 0 00-.186-.185h-2.118a.185.185 0 00-.185.185v1.888c0 .102.082.185.185.185m0 2.716h2.118a.187.187 0 00.186-.186V6.29a.186.186 0 00-.186-.185h-2.118a.185.185 0 00-.185.185v1.887c0 .102.082.186.185.186m-2.93 0h2.12a.186.186 0 00.184-.186V6.29a.185.185 0 00-.185-.185H8.1a.185.185 0 00-.185.185v1.887c0 .102.083.186.185.186m-2.964 0h2.119a.186.186 0 00.185-.186V6.29a.185.185 0 00-.185-.185H5.136a.186.186 0 00-.186.185v1.887c0 .102.084.186.186.186m5.893 2.715h2.119a.186.186 0 00.186-.185V9.006a.186.186 0 00-.186-.186h-2.119a.185.185 0 00-.185.185v1.888c0 .102.082.185.185.185m-2.93 0h2.12a.185.185 0 00.184-.185V9.006a.185.185 0 00-.184-.186h-2.12a.185.185 0 00-.184.185v1.888c0 .102.083.185.185.185m-2.964 0h2.119a.185.185 0 00.185-.185V9.006a.185.185 0 00-.185-.186h-2.119a.186.186 0 00-.186.185v1.888c0 .102.084.185.186.185m-2.928 0h2.119a.185.185 0 00.185-.185V9.006a.185.185 0 00-.185-.186H2.208a.186.186 0 00-.186.185v1.888c0 .102.084.185.186.185M23.97 11.23a8.91 8.91 0 00-3.69-5.188l-.348-.22-.245.333a5.534 5.534 0 01-2.905 1.956c-.23.056-.279.16-.273.395.034 1.25-.422 1.99-1.284 2.502l-.248.147.28.077c1.37.378 2.656.974 3.738 1.838.283.226.544.475.787.745.228.252.483.336.81.25.753-.198 1.393-.574 1.92-1.127.18-.188.354-.388.517-.608zM.002 12.825a7.35 7.35 0 003.542 5.867 13.978 13.978 0 006.183 2.06c4.606.402 8.877-.853 12.39-3.792.21-.176.413-.36.61-.55.158-.152.12-.24-.075-.316a12.636 12.636 0 00-4.434-.848c-3.155-.008-6.195.834-9.155 1.737-.87.265-1.74.52-2.63.703-.362.074-.632-.01-.84-.31a3.633 3.633 0 01-.482-1.42 12.32 12.32 0 01-.077-1.736.21.21 0 00-.21-.23H.27a.266.266 0 00-.268.253v.852z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">Docker</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Containers</span>
            </div>

            <!-- 8. AWS / Cloud -->
            <div class="group p-4 rounded-2xl glass-panel spotlight-card reveal delay-800 hover:border-[#10B981]/50 hover:bg-white/[0.06] hover:-translate-y-1 transition-all duration-300 flex flex-col items-center justify-center text-center">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/5 border border-white/10 mb-3 group-hover:border-[#FF9900]/40 group-hover:bg-[#FF9900]/10 group-hover:shadow-[0_0_20px_rgba(255,153,0,0.25)] transition-all duration-300">
                    <svg class="w-6 h-6 text-[#FF9900] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM19 18H6c-2.21 0-4-1.79-4-4 0-2.05 1.53-3.76 3.56-3.97l1.07-.11.5-.95C8.08 7.14 9.94 6 12 6c2.62 0 4.88 1.86 5.39 4.43l.3 1.5 1.53.11c1.56.1 2.78 1.41 2.78 2.96 0 1.65-1.35 3-3 3z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">AWS / Cloud</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Infra &amp; CDN</span>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         03 - ABOUT / IDENTITY SECTION (Storytelling Studio)
         ========================================================================= -->
    <section id="tentang" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 border-b border-white/10 relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center reveal">
            <!-- Left Info (7 cols) -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399]">
                    <span class="text-[#10B981]">&bull;</span>
                    <span>TENTANG STUDIO</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Memadukan Rekayasa Lunak dan Ketajaman Estetika
                </h2>
                <p class="text-base sm:text-lg text-[#A0ADA5] leading-relaxed">
                    {{ $siteProfile->about_story ?? ($siteProfile->company_name ?? 'PT. Central Saga Mandala') . ' adalah studio digital yang lahir dan berakar di Tabanan, Bali. Kami percaya bahwa perangkat lunak terbaik bukan hanya tentang kode yang berjalan tanpa cela, melainkan juga pengalaman interaktif yang intuitif, anggun, dan bernilai bisnis tinggi.' }}
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                    <div class="p-4 rounded-xl glass-panel">
                        <span class="text-xs font-mono text-[#34D399] font-bold block mb-1">BERBASIS DI TABANAN, BALI</span>
                        <p class="text-xs text-[#A0ADA5]">Menghadirkan kenyamanan kolaborasi langsung maupun integrasi kerja jarak jauh standar global.</p>
                    </div>
                    <div class="p-4 rounded-xl glass-panel">
                        <span class="text-xs font-mono text-[#34D399] font-bold block mb-1">STANDAR REKAYASA MODERN</span>
                        <p class="text-xs text-[#A0ADA5]">Penerapan pengujian otomatis, clean code, serta kepatuhan tinggi terhadap performa dan aksesibilitas.</p>
                    </div>
                </div>
                <div class="pt-2">
                    <a href="/tentang" class="inline-flex items-center text-sm font-mono text-[#34D399] hover:underline">
                        Baca Selengkapnya Profil &amp; Nilai Perusahaan &rarr;
                    </a>
                </div>
            </div>

            <!-- Right Showcase Card (5 cols) -->
            <div class="lg:col-span-5">
                <div class="glass-panel rounded-3xl p-8 border border-white/10 relative overflow-hidden">
                    <div class="flex items-center justify-between pb-4 mb-4 border-b border-white/10">
                        <span class="text-xs font-mono text-[#A0ADA5]">NILAI STUDIO KAMI</span>
                        <span class="text-xs font-mono text-[#34D399]">DEDIKASI KARYA</span>
                    </div>
                    <ul class="space-y-4 text-sm text-[#F5F7F5]">
                        <li class="flex items-start space-x-3">
                            <span class="text-[#10B981] font-bold mt-0.5">&check;</span>
                            <span><strong>Kejelasan Fungsional:</strong> Setiap fitur dibangun untuk menjawab kebutuhan pengguna, bukan sekadar hiasan.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-[#10B981] font-bold mt-0.5">&check;</span>
                            <span><strong>Kerapian Arsitektural:</strong> Struktur data yang terorganisir, aman, dan mudah dikembangkan di masa mendatang.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-[#10B981] font-bold mt-0.5">&check;</span>
                            <span><strong>Kemitraan Jangka Panjang:</strong> Kami mendampingi pertumbuhan produk Anda dari inisiasi hingga deployment.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         04 - GALERI / PORTOFOLIO SECTION (Editorial Showcase)
         ========================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 border-b border-white/10 relative">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399] mb-3">
                    <span class="text-[#10B981]">&bull;</span>
                    <span>PORTOFOLIO PILIHAN</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white mt-1">
                    Dokumentasi Karya Studio
                </h2>
                <p class="text-sm sm:text-base text-[#A0ADA5] mt-2 max-w-xl">
                    Dokumentasi hasil pengerjaan platform web, sistem backend, dan produk digital klien kami.
                </p>
            </div>
            <div class="mt-6 md:mt-0">
                <a href="/galeri" class="inline-flex items-center min-h-[44px] px-5 py-2.5 text-xs font-mono font-semibold text-[#F5F7F5] glass-pill rounded-xl hover:border-[#10B981] transition-all">
                    Lihat Seluruh Galeri &rarr;
                </a>
            </div>
        </div>

        @if ($galleries->isEmpty())
            <div class="glass-panel rounded-2xl p-12 text-center border-dashed border-white/20">
                <p class="text-sm text-[#A0ADA5] font-mono">
                    Belum ada foto portofolio yang ditampilkan saat ini.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($galleries as $gallery)
                    <div class="group glass-panel rounded-2xl p-3.5 overflow-hidden">
                        <div class="relative overflow-hidden rounded-xl bg-[#080D0B] aspect-[4/3] border border-white/5">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                 alt="{{ $gallery->title ?? 'Portofolio' }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 cursor-pointer"
                                 loading="lazy"
                                 onclick="openLightbox('{{ asset('storage/' . $gallery->image_path) }}', '{{ addslashes($gallery->title ?? 'Portofolio') }}')">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none flex items-end p-4">
                                <span class="text-xs font-mono text-[#34D399] font-semibold">KLIK UNTUK MEMPERBESAR</span>
                            </div>
                        </div>
                        @if (!empty($gallery->title))
                            <div class="pt-3 px-2 flex items-center justify-between">
                                <h3 class="text-sm font-semibold text-white truncate group-hover:text-[#34D399] transition-colors">
                                    {{ $gallery->title }}
                                </h3>
                                <span class="text-[10px] font-mono text-[#A0ADA5] uppercase">LIHAT</span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <!-- =========================================================================
         05 - TESTIMONI SECTION (Hanya tampil jika ada testimoni approved)
         ========================================================================= -->
    @if ($testimonials->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 border-b border-white/10 relative">
            <div class="mb-16">
                <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399] mb-3">
                    <span class="text-[#10B981]">&bull;</span>
                    <span>KEPERCAYAAN MITRA</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white mt-1">
                    Apa Kata Mereka
                </h2>
                <p class="text-sm sm:text-base text-[#A0ADA5] mt-2 max-w-xl">
                    Ulasan langsung dari para pemimpin bisnis yang mempercayakan platform digital mereka pada Central Saga Mandala.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($testimonials as $testimonial)
                    <div class="glass-panel rounded-2xl p-6 sm:p-8 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-1 text-[#34D399] mb-4">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <blockquote class="text-sm text-[#F5F7F5] leading-relaxed mb-6 italic">
                                &ldquo;{{ $testimonial->message ?? $testimonial->quote }}&rdquo;
                            </blockquote>
                        </div>
                        <div class="pt-4 border-t border-white/10 flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-[#10B981]/20 border border-[#10B981]/40 flex items-center justify-center font-bold text-white text-sm font-mono">
                                {{ strtoupper(substr($testimonial->name ?? ($testimonial->client_name ?? 'K'), 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white leading-tight">
                                    {{ $testimonial->name ?? $testimonial->client_name }}
                                </h4>
                                @if (!empty($testimonial->role) || !empty($testimonial->company))
                                    <p class="text-xs text-[#A0ADA5] font-mono">
                                        {{ $testimonial->role ?? $testimonial->company }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- =========================================================================
         06 - ARTIKEL SECTION (Editorial Insights & Research)
         ========================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 border-b border-white/10 relative">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399] mb-3">
                    <span class="text-[#10B981]">&bull;</span>
                    <span>WAWASAN &amp; RISET</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white mt-1">
                    Kabar dan Tulisan Terbaru
                </h2>
                <p class="text-sm sm:text-base text-[#A0ADA5] mt-2 max-w-xl">
                    Berbagi pengetahuan seputar pengembangan aplikasi, tren desain, dan teknologi digital.
                </p>
            </div>
            <div class="mt-6 md:mt-0">
                <a href="/artikel" class="inline-flex items-center min-h-[44px] px-5 py-2.5 text-xs font-mono font-semibold text-[#F5F7F5] glass-pill rounded-xl hover:border-[#10B981] transition-all">
                    Lihat Seluruh Artikel &rarr;
                </a>
            </div>
        </div>

        @if ($articles->isEmpty())
            <div class="glass-panel rounded-2xl p-12 text-center border-dashed border-white/20">
                <p class="text-sm text-[#A0ADA5] font-mono">
                    Belum ada artikel yang dipublikasikan saat ini.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($articles as $article)
                    <article class="glass-panel rounded-2xl p-6 flex flex-col justify-between group">
                        <div>
                            @if (!empty($article->cover_image))
                                <div class="mb-5 overflow-hidden rounded-xl bg-[#080D0B] aspect-[16/9] border border-white/5">
                                    <img src="{{ asset('storage/' . $article->cover_image) }}"
                                         alt="{{ $article->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                         loading="lazy">
                                </div>
                            @endif

                            <div class="flex items-center justify-between text-xs font-mono mb-2.5">
                                <span class="text-[#34D399] font-semibold">
                                    {{ optional($article->published_at)->isoFormat('D MMMM Y') ?? 'Terbaru' }}
                                </span>
                                @if (!empty($article->reading_time))
                                    <span class="text-[#A0ADA5]">
                                        {{ $article->reading_time }} mnt baca
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-[#34D399] transition-colors leading-snug">
                                <a href="/artikel/{{ $article->slug }}" class="focus-visible:ring-2 focus-visible:ring-[#10B981] rounded-lg">
                                    {{ $article->title }}
                                </a>
                            </h3>

                            <p class="text-sm text-[#A0ADA5] leading-relaxed mb-6">
                                {{ Str::limit($article->excerpt, 135) }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono">
                            <span class="text-[#A0ADA5]">
                                {{ $article->author->name ?? 'Tim Editorial' }}
                            </span>
                            <a href="/artikel/{{ $article->slug }}" class="font-semibold text-[#10B981] hover:text-[#34D399]">
                                Baca Artikel &rarr;
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <!-- =========================================================================
         07 - KONTAK SECTION (Clean Direct Inquiries)
         ========================================================================= -->
    <section id="kontak" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            <!-- Left Info (5 cols) -->
            <div class="lg:col-span-5">
                <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399] mb-3">
                    <span class="text-[#10B981]">&bull;</span>
                    <span>INISIASI PROYEK</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white mt-1 mb-4 leading-tight">
                    Mari Bangun Solusi Anda
                </h2>
                <p class="text-sm sm:text-base text-[#A0ADA5] leading-relaxed mb-8">
                    Sampaikan ide, kebutuhan aplikasi, atau pertanyaan seputar kolaborasi proyek digital Anda. Tim kami akan merespons pesan Anda secepatnya.
                </p>

                <div class="space-y-4 font-mono text-sm">
                    @if (!empty($siteProfile->email))
                        <div class="glass-panel rounded-2xl p-5">
                            <span class="text-xs uppercase text-[#34D399] font-semibold block mb-1">EMAIL RESMI</span>
                            <a href="mailto:{{ $siteProfile->email }}" class="text-white hover:text-[#34D399] transition-colors underline">
                                {{ $siteProfile->email }}
                            </a>
                        </div>
                    @endif
                    @if (!empty($siteProfile->phone))
                        <div class="glass-panel rounded-2xl p-5">
                            <span class="text-xs uppercase text-[#34D399] font-semibold block mb-1">TELEPON &amp; WHATSAPP</span>
                            <span class="text-white">{{ $siteProfile->phone }}</span>
                        </div>
                    @endif
                    @if (!empty($siteProfile->address))
                        <div class="glass-panel rounded-2xl p-5">
                            <span class="text-xs uppercase text-[#34D399] font-semibold block mb-1">LOKASI KANTOR</span>
                            <span class="text-[#A0ADA5]">{{ $siteProfile->address }}</span>
                        </div>
                    @endif
                </div>

                <div class="mt-6">
                    <a href="/kontak" class="inline-flex items-center text-sm font-mono text-[#34D399] hover:underline">
                        Buka Formulir Inquiry Proyek Lengkap &rarr;
                    </a>
                </div>
            </div>

            <!-- Right Form (7 cols) -->
            <div class="lg:col-span-7 glass-panel rounded-3xl p-8 sm:p-10 shadow-2xl border border-white/10">
                @if (session('success'))
                    <div class="mb-6 p-4 border border-[#10B981]/40 bg-[#10B981]/15 rounded-xl text-sm font-medium text-[#10B981]" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="/kontak" class="space-y-5" novalidate>
                    @csrf

                    <!-- Honeypot Field -->
                    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Nama -->
                        <div>
                            <label for="contact-name" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                                Nama Lengkap <span class="text-[#34D399]">*</span>
                            </label>
                            <input type="text"
                                   id="contact-name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   class="w-full min-h-[44px] px-4 py-3 text-sm bg-black/40 border @error('name') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none transition-colors"
                                   placeholder="Nama Anda">
                            @error('name')
                                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="contact-email" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                                Alamat Email <span class="text-[#34D399]">*</span>
                            </label>
                            <input type="email"
                                   id="contact-email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   class="w-full min-h-[44px] px-4 py-3 text-sm bg-black/40 border @error('email') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none transition-colors"
                                   placeholder="email@example.com">
                            @error('email')
                                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Telepon (Opsional) -->
                        <div>
                            <label for="contact-phone" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                                WhatsApp / Telepon (Opsional)
                            </label>
                            <input type="tel"
                                   id="contact-phone"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   class="w-full min-h-[44px] px-4 py-3 text-sm bg-black/40 border @error('phone') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none transition-colors"
                                   placeholder="+62 812 3456 7890">
                            @error('phone')
                                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subjek -->
                        <div>
                            <label for="contact-subject" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                                Subjek <span class="text-[#34D399]">*</span>
                            </label>
                            <input type="text"
                                   id="contact-subject"
                                   name="subject"
                                   value="{{ old('subject') }}"
                                   required
                                   class="w-full min-h-[44px] px-4 py-3 text-sm bg-black/40 border @error('subject') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none transition-colors"
                                   placeholder="Contoh: Konsultasi Pembuatan Aplikasi Web">
                            @error('subject')
                                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Pesan -->
                    <div>
                        <label for="contact-message" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Kebutuhan Proyek <span class="text-[#34D399]">*</span>
                        </label>
                        <textarea id="contact-message"
                                  name="message"
                                  rows="4"
                                  required
                                  class="w-full p-4 text-sm bg-black/40 border @error('message') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none transition-colors"
                                  placeholder="Ceritakan gambaran sistem yang ingin Anda bangun, ekspektasi waktu, atau tantangan bisnis saat ini...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Kirim -->
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full min-h-[48px] px-6 py-3 text-sm font-semibold text-white btn-emerald rounded-xl flex items-center justify-center space-x-2">
                            <span>Kirimkan Pesan Anda</span>
                            <span>&rarr;</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Accessible Lightbox Modal for Portfolio -->
    <div id="lightbox-modal"
         class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden items-center justify-center p-4"
         role="dialog"
         aria-modal="true"
         aria-label="Tampilan Foto Portofolio">
        <div class="relative max-w-4xl max-h-[90vh] flex flex-col items-center">
            <button type="button"
                    onclick="closeLightbox()"
                    class="absolute -top-12 right-0 text-white/70 hover:text-white text-sm font-mono p-2 focus:outline-none"
                    aria-label="Tutup foto">
                [TUTUP &times;]
            </button>
            <img id="lightbox-img" src="" alt="Pratinjau Portofolio" class="max-h-[80vh] w-auto rounded-2xl border border-white/10 shadow-2xl">
            <p id="lightbox-caption" class="mt-4 text-sm text-[#A0ADA5] font-mono text-center"></p>
        </div>
    </div>

    <script>
        function openLightbox(src, caption) {
            const modal = document.getElementById('lightbox-modal');
            const img = document.getElementById('lightbox-img');
            const cap = document.getElementById('lightbox-caption');
            if (modal && img) {
                img.src = src;
                cap.textContent = caption || '';
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeLightbox() {
            const modal = document.getElementById('lightbox-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = '';
            }
        }

        document.getElementById('lightbox-modal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
@endsection
