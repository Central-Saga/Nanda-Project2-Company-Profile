@extends('layouts.public')

@section('seo')
    <x-seo-meta
        :og-image="$siteProfile->hero_image ?? null"
    />
@endsection

@section('content')
    <!-- =========================================================================
         01 - HERO SECTION (Modern Swiss Minimalist & Editorial Digital Agency)
         ========================================================================= -->
    <section class="relative pt-20 pb-20 md:pt-32 md:pb-28 overflow-hidden bg-[#080D0B] border-b border-white/[0.08]">
        <!-- Subtle Ambient Lighting Elements -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-[#10B981]/12 blur-[150px] pointer-events-none rounded-full animate-ambient-float"></div>
        <div class="absolute top-1/3 right-10 w-[450px] h-[350px] bg-[#34D399]/8 blur-[140px] pointer-events-none rounded-full animate-ambient-float"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

            <!-- Minimal Editorial Eyebrow -->
            <div class="inline-flex items-center space-x-2 text-xs font-medium tracking-widest uppercase text-[#34D399] mb-6">
                <span>Central Saga Mandala</span>
                <span class="text-white/30">&bull;</span>
                <span class="text-[#A0ADA5]">Software House &amp; Creative Agency Bali</span>
            </div>

            <!-- Main Headline (Swiss Typography) -->
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-[-0.03em] text-white leading-[1.08] mb-7 max-w-4xl mx-auto">
                {{ $siteProfile->hero_title ?? 'Membangun Impian Digital, Dari Bali ke Dunia' }}
            </h1>

            <!-- Narrative Subheadline -->
            <p class="text-base sm:text-lg lg:text-xl text-[#A0ADA5] leading-relaxed mb-10 max-w-2xl mx-auto font-normal">
                {{ $siteProfile->hero_subtitle ?? 'Kami adalah software house dan creative agency di Tabanan, Bali, memadukan ketelitian rekayasa sistem dengan ketajaman estetika visual kelas dunia.' }}
            </p>

            <!-- Dual Confident Action Buttons (Linear & Vercel Style) -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
                <a href="/kontak"
                   class="w-full sm:w-auto inline-flex items-center justify-center bg-white hover:bg-[#F0F2F0] text-[#080D0B] font-semibold text-sm px-8 py-3.5 rounded-xl transition-all duration-200 shadow-[0_2px_20px_rgba(255,255,255,0.2)] hover:shadow-[0_4px_28px_rgba(255,255,255,0.3)] hover:-translate-y-0.5">
                    Mulai Diskusi Proyek
                </a>
                <a href="/proyek"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-[#A0ADA5] hover:text-white font-medium text-sm px-7 py-3.5 rounded-xl transition-all duration-200 border border-white/10 hover:border-white/20 hover:bg-white/[0.04]">
                    <span>Eksplorasi Portofolio</span>
                    <span class="text-sm leading-none">&nearr;</span>
                </a>
            </div>

            <!-- Authentic Interface Preview Frame (Linear & Vercel Inspiration) -->
            <div class="rounded-2xl border border-white/10 bg-[#0C120F] shadow-[0_30px_90px_rgba(0,0,0,0.85)] max-w-5xl mx-auto overflow-hidden text-left reveal">
                <!-- Browser Bar -->
                <div class="px-5 py-3.5 border-b border-white/[0.08] bg-[#0E1612] flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full bg-white/15"></div>
                        <div class="w-3 h-3 rounded-full bg-white/15"></div>
                        <div class="w-3 h-3 rounded-full bg-[#10B981]/80"></div>
                        <span class="text-xs font-mono text-[#A0ADA5] ml-2 hidden sm:inline">centralsaga.mandala / system-architecture</span>
                    </div>
                    <div class="flex items-center space-x-3 text-xs">
                        <span class="inline-flex items-center text-[#34D399] font-mono">
                            <span class="w-2 h-2 rounded-full bg-[#10B981] mr-1.5 animate-pulse"></span>
                            PROD-READY
                        </span>
                    </div>
                </div>

                <!-- Interface Content Grid -->
                <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-3 gap-6 bg-gradient-to-b from-[#0C120F] to-[#080D0B]">
                    <!-- Column 1: Engineering -->
                    <div class="p-5 rounded-xl bg-white/[0.02] border border-white/[0.06]">
                        <span class="text-xs font-mono uppercase tracking-wider text-[#34D399] block mb-2">01 &bull; Software Engineering</span>
                        <h3 class="text-base font-bold text-white mb-2">Arsitektur Modular &amp; Andal</h3>
                        <p class="text-xs text-[#A0ADA5] leading-relaxed">
                            Dibangun di atas fondasi backend teruji, database relasional terindeks, dan API tangguh untuk skalabilitas tinggi.
                        </p>
                    </div>

                    <!-- Column 2: Creative & UI/UX -->
                    <div class="p-5 rounded-xl bg-white/[0.02] border border-white/[0.06]">
                        <span class="text-xs font-mono uppercase tracking-wider text-[#34D399] block mb-2">02 &bull; Creative Direction</span>
                        <h3 class="text-base font-bold text-white mb-2">Desain Antarmuka Berkarakter</h3>
                        <p class="text-xs text-[#A0ADA5] leading-relaxed">
                            Sentuhan visual editorial yang memikat, hierarki informasi jelas, dan pengalaman pengguna yang nyaman di setiap perangkat.
                        </p>
                    </div>

                    <!-- Column 3: Cloud & Delivery -->
                    <div class="p-5 rounded-xl bg-white/[0.02] border border-white/[0.06]">
                        <span class="text-xs font-mono uppercase tracking-wider text-[#34D399] block mb-2">03 &bull; Cloud Infrastructure</span>
                        <h3 class="text-base font-bold text-white mb-2">Deployment &amp; Keamanan</h3>
                        <p class="text-xs text-[#A0ADA5] leading-relaxed">
                            Integrasi otomatis CI/CD, SSL enkripsi menyeluruh, dan optimasi CDN global dengan latensi minimal.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- =========================================================================
         01.1 - SWISS EDITORIAL METRICS GRID (Track Record & Rekam Jejak)
         ========================================================================= -->
    @php
        $rawStats = $siteProfile->stats ?? [];
        if (isset($rawStats['projects_completed']) || isset($rawStats['years_experience'])) {
            $statsData = [
                ['label' => 'Proyek Terselesaikan', 'value' => $rawStats['projects_completed'] ?? '45+'],
                ['label' => 'Tahun Pengalaman Rekayasa', 'value' => $rawStats['years_experience'] ?? '6+'],
                ['label' => 'Tingkat Kepuasan Klien', 'value' => $rawStats['client_satisfaction'] ?? '99%'],
                ['label' => 'Core Software Engineers', 'value' => $rawStats['core_engineers'] ?? '12'],
            ];
        } elseif (is_array($rawStats) && count($rawStats) > 0 && isset($rawStats[0]['label'])) {
            $statsData = $rawStats;
        } else {
            $statsData = [
                ['label' => 'Proyek Terselesaikan', 'value' => '45+'],
                ['label' => 'Tahun Pengalaman Rekayasa', 'value' => '6+'],
                ['label' => 'Tingkat Kepuasan Klien', 'value' => '99%'],
                ['label' => 'Core Software Engineers', 'value' => '12'],
            ];
        }
    @endphp
    <section class="border-b border-white/[0.08] bg-[#070B09]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-white/[0.08] text-left">
                @foreach ($statsData as $st)
                    <div class="py-8 sm:py-10 px-4 sm:px-8 reveal delay-{{ min($loop->iteration * 100, 800) }}">
                        <span class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight block mb-1 font-sans" data-counter="{{ $st['value'] ?? '0' }}">
                            {{ $st['value'] ?? '0' }}
                        </span>
                        <span class="text-xs text-[#A0ADA5] uppercase tracking-wider block font-medium">
                            {{ $st['label'] ?? '' }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =========================================================================
         02 - SERVICES SECTION (Asymmetric Editorial Layout - Inspired by Uniflow & Inside Software)
         ========================================================================= -->
    <section id="layanan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 border-b border-white/[0.08] relative">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 reveal">
            <div>
                <span class="text-xs font-mono uppercase tracking-widest text-[#34D399] block mb-3">
                    01 &bull; Modul Solusi Digital
                </span>
                <h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-[-0.03em] text-white">
                    Layanan Strategis Studio
                </h2>
            </div>
            <div class="mt-6 md:mt-0 flex items-center space-x-4">
                <p class="text-sm text-[#A0ADA5] max-w-sm hidden lg:block">
                    Direkayasa spesifik sesuai target bisnis, bebas dari boilerplate generik, dan siap diskalakan.
                </p>
                <a href="/layanan" class="inline-flex items-center gap-2 whitespace-nowrap shrink-0 text-xs font-mono text-white bg-white/10 hover:bg-white/15 px-4 py-2.5 rounded-xl transition-colors">
                    <span>Semua Layanan</span>
                    <span class="text-sm leading-none">&nearr;</span>
                </a>
            </div>
        </div>

        @if ($services->isEmpty())
            <div class="rounded-2xl p-12 text-center border border-dashed border-white/10 bg-[#0C120F]">
                <p class="text-sm text-[#A0ADA5]">Belum ada layanan yang ditampilkan saat ini.</p>
            </div>
        @else
            @php
                $flagshipService = $services->first();
                $otherServices = $services->slice(1);
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <!-- Large Flagship Service (7 Columns) -->
                @if ($flagshipService)
                    <div class="lg:col-span-7 rounded-3xl p-8 sm:p-10 bg-gradient-to-b from-[#0C1813] to-[#0A120E] border border-[#10B981]/25 flex flex-col justify-between relative overflow-hidden group reveal">
                        <div class="absolute -top-24 -right-24 w-80 h-80 bg-[#10B981]/10 rounded-full blur-3xl pointer-events-none"></div>

                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <span class="text-xs font-mono uppercase tracking-wider px-3 py-1 rounded-full bg-[#10B981]/15 text-[#34D399] border border-[#10B981]/30">
                                    LAYANAN UTAMA &bull; 01
                                </span>
                                <a href="/layanan/{{ $flagshipService->slug }}" class="w-10 h-10 rounded-full bg-[#10B981] text-[#080D0B] flex items-center justify-center font-bold text-sm hover:scale-105 transition-transform">
                                    &nearr;
                                </a>
                            </div>

                            <h3 class="text-2xl sm:text-4xl font-extrabold text-white mb-4 tracking-tight leading-snug">
                                <a href="/layanan/{{ $flagshipService->slug }}" class="hover:text-[#34D399] transition-colors">
                                    {{ $flagshipService->title }}
                                </a>
                            </h3>

                            <p class="text-sm sm:text-base text-[#A0ADA5] leading-relaxed mb-8 max-w-xl">
                                {{ $flagshipService->description }}
                            </p>

                            <!-- Interactive Capability Badges -->
                            @if (!empty($flagshipService->benefits) && is_array($flagshipService->benefits))
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">
                                    @foreach (array_slice($flagshipService->benefits, 0, 4) as $benefit)
                                        <div class="flex items-center space-x-2.5 text-xs text-white/90 bg-white/[0.03] p-2.5 rounded-xl border border-white/[0.06]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
                                            <span class="truncate">{{ $benefit }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Interface Mockup Snippet Inside Flagship -->
                        <div class="rounded-xl border border-white/10 bg-[#080D0B] p-4 text-xs font-mono text-[#A0ADA5] flex items-center justify-between">
                            <span class="text-[#34D399]">Arsitektur: Microservices &bull; Headless API &bull; SSR</span>
                            <a href="/layanan/{{ $flagshipService->slug }}" class="text-white hover:underline">
                                Pelajari Spesifikasi &rarr;
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Supporting Secondary Services (5 Columns Stack) -->
                <div class="lg:col-span-5 flex flex-col justify-between gap-6">
                    @foreach ($otherServices->take(2) as $secService)
                        <div class="rounded-3xl p-7 sm:p-8 bg-[#101713] border border-white/[0.08] hover:border-[#10B981]/40 flex flex-col justify-between group transition-all duration-300 reveal delay-{{ $loop->iteration * 150 }}">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-xs font-mono text-[#A0ADA5] uppercase">
                                        0{{ $loop->iteration + 1 }} &bull; MODUL
                                    </span>
                                    <a href="/layanan/{{ $secService->slug }}" class="w-9 h-9 rounded-full bg-white/5 border border-white/10 text-white flex items-center justify-center text-xs group-hover:bg-[#10B981] group-hover:text-[#080D0B] group-hover:border-[#10B981] transition-all">
                                        &nearr;
                                    </a>
                                </div>
                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 group-hover:text-[#34D399] transition-colors leading-snug">
                                    <a href="/layanan/{{ $secService->slug }}">
                                        {{ $secService->title }}
                                    </a>
                                </h3>
                                <p class="text-xs sm:text-sm text-[#A0ADA5] leading-relaxed mb-4">
                                    {{ Str::limit($secService->description, 140) }}
                                </p>
                            </div>
                            <div class="pt-4 border-t border-white/[0.06] flex items-center justify-between text-xs font-mono text-[#A0ADA5]">
                                <span>KONSULTASI GRATIS</span>
                                <a href="/layanan/{{ $secService->slug }}" class="text-[#34D399] hover:underline">
                                    Rincian Modul &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

    <!-- =========================================================================
         02.5 - PORTFOLIO SHOWCASE SECTION (Editorial Alternating Case Studies)
         ========================================================================= -->
    @if (isset($featuredProjects) && $featuredProjects->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 border-b border-white/[0.08] relative">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 reveal">
                <div>
                    <span class="text-xs font-mono uppercase tracking-widest text-[#34D399] block mb-3">
                        02 &bull; Rekam Jejak Produksi
                    </span>
                    <h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-[-0.03em] text-white">
                        Karya Unggulan Pilihan
                    </h2>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="/proyek" class="inline-flex items-center gap-2 whitespace-nowrap shrink-0 text-xs font-mono text-white bg-white/10 hover:bg-white/15 px-5 py-2.5 rounded-xl transition-colors">
                        <span>Eksplorasi Seluruh Portofolio</span>
                        <span class="text-sm leading-none">&nearr;</span>
                    </a>
                </div>
            </div>

            @php
                $heroProject = $featuredProjects->first();
                $subProjects = $featuredProjects->slice(1);
            @endphp

            <!-- Hero Project 1: Wide Editorial Asymmetric Showcase -->
            @if ($heroProject)
                <div class="rounded-3xl p-8 sm:p-12 bg-[#0E1612] border border-white/[0.08] mb-12 hover:border-[#10B981]/30 transition-all duration-300 reveal">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 sm:gap-12 items-center">
                        <!-- Left 7 Cols: Browser Window Preview Mockup -->
                        <div class="lg:col-span-7">
                            <div class="rounded-2xl border border-white/10 bg-[#080D0B] overflow-hidden shadow-2xl group">
                                <div class="px-4 py-2.5 bg-[#121A15] border-b border-white/10 flex items-center space-x-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-white/20"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-white/20"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-white/20"></span>
                                    <span class="text-[11px] font-mono text-[#A0ADA5] ml-2 truncate">https://preview.centralsaga.com/{{ $heroProject->slug }}</span>
                                </div>
                                <div class="aspect-[16/10] overflow-hidden bg-[#0A100D] relative">
                                    @if (!empty($heroProject->thumbnail))
                                        <img src="{{ asset('storage/' . $heroProject->thumbnail) }}"
                                             alt="{{ $heroProject->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                             loading="lazy">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#101713] to-[#0A100D] p-8 text-center text-[#A0ADA5]">
                                            <span class="font-mono text-sm">[Pratinjau Antarmuka: {{ $heroProject->title }}]</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right 5 Cols: Editorial Project Narrative -->
                        <div class="lg:col-span-5 flex flex-col justify-between space-y-6">
                            <div>
                                <div class="flex items-center space-x-3 text-xs font-mono text-[#34D399] mb-4">
                                    <span class="px-2.5 py-1 rounded-md bg-[#10B981]/10 border border-[#10B981]/20 uppercase">
                                        {{ $heroProject->category }}
                                    </span>
                                    @if (!empty($heroProject->completion_date))
                                        <span class="text-[#A0ADA5]">&bull; {{ $heroProject->completion_date }}</span>
                                    @endif
                                </div>

                                <h3 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight mb-4 leading-tight">
                                    <a href="/proyek/{{ $heroProject->slug }}" class="hover:text-[#34D399] transition-colors">
                                        {{ $heroProject->title }}
                                    </a>
                                </h3>

                                <p class="text-sm sm:text-base text-[#A0ADA5] leading-relaxed mb-6 font-normal">
                                    {{ Str::limit($heroProject->description, 200) }}
                                </p>

                                @if (!empty($heroProject->tech_stack) && is_array($heroProject->tech_stack))
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        @foreach ($heroProject->tech_stack as $stack)
                                            <span class="text-xs font-mono px-3 py-1 rounded-lg bg-white/[0.04] text-[#F5F7F5] border border-white/[0.08]">
                                                {{ $stack }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="pt-6 border-t border-white/10 flex items-center justify-between">
                                <a href="/proyek/{{ $heroProject->slug }}" class="text-sm font-semibold text-white hover:text-[#34D399] transition-colors inline-flex items-center">
                                    Baca Studi Kasus Selengkapnya &rarr;
                                </a>
                                @if (!empty($heroProject->external_url))
                                    <a href="{{ $heroProject->external_url }}" target="_blank" rel="noopener noreferrer" class="text-xs font-mono text-[#A0ADA5] hover:text-white underline">
                                        Kunjungi Live URL &nearr;
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Supporting Projects: 2-Column Alternating Editorial Cards -->
            @if ($subProjects->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($subProjects->take(2) as $proj)
                        <article class="rounded-3xl p-6 sm:p-8 bg-[#101713] border border-white/[0.08] hover:border-[#10B981]/30 transition-all duration-300 flex flex-col justify-between group reveal delay-{{ $loop->iteration * 150 }}">
                            <div>
                                <div class="rounded-2xl border border-white/10 bg-[#080D0B] overflow-hidden mb-6 aspect-[16/10] relative">
                                    @if (!empty($proj->thumbnail))
                                        <img src="{{ asset('storage/' . $proj->thumbnail) }}"
                                             alt="{{ $proj->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                             loading="lazy">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-[#0C120F] text-xs font-mono text-[#A0ADA5]">
                                            [Preview Mockup: {{ $proj->title }}]
                                        </div>
                                    @endif
                                    <div class="absolute top-3 left-3">
                                        <span class="text-[11px] font-mono px-2.5 py-1 rounded-md bg-[#080D0B]/85 text-[#34D399] border border-white/10 backdrop-blur-md">
                                            {{ $proj->category }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between text-xs font-mono text-[#A0ADA5] mb-2">
                                    <span>{{ $proj->client ?? 'Klien Mitra' }}</span>
                                    <span>{{ $proj->completion_date ?? '' }}</span>
                                </div>

                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 group-hover:text-[#34D399] transition-colors leading-snug">
                                    <a href="/proyek/{{ $proj->slug }}">
                                        {{ $proj->title }}
                                    </a>
                                </h3>

                                <p class="text-xs sm:text-sm text-[#A0ADA5] leading-relaxed mb-6">
                                    {{ Str::limit($proj->description, 140) }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-white/[0.06] flex items-center justify-between text-xs font-mono">
                                <a href="/proyek/{{ $proj->slug }}" class="text-[#10B981] group-hover:text-[#34D399] font-semibold">
                                    Studi Kasus &rarr;
                                </a>
                                @if (!empty($proj->external_url))
                                    <a href="{{ $proj->external_url }}" target="_blank" rel="noopener noreferrer" class="text-[#A0ADA5] hover:text-white underline">
                                        Live App &nearr;
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    <!-- =========================================================================
         02.6 - WORKFLOW & PROCESS (Swiss Editorial Horizontal Index)
         ========================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 border-b border-white/[0.08] relative">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 reveal">
            <div>
                <span class="text-xs font-mono uppercase tracking-widest text-[#34D399] block mb-3">
                    03 &bull; Metodologi Eksekusi
                </span>
                <h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-[-0.03em] text-white">
                    Alur Pengerjaan Sistem
                </h2>
            </div>
            <p class="text-sm text-[#A0ADA5] max-w-sm mt-4 md:mt-0">
                Penyampaian terukur dengan iterasi berkala, transparansi kode, dan verifikasi kualitas berlapis.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-white/[0.08] border-y border-white/[0.08]">
            <div class="py-8 md:px-6 first:pl-0 last:pr-0 reveal delay-100">
                <span class="text-2xl font-extrabold text-white/30 block mb-3 font-mono">01</span>
                <h4 class="text-base font-bold text-white mb-2">Riset &amp; Spesifikasi</h4>
                <p class="text-xs text-[#A0ADA5] leading-relaxed">Pemetaan logika bisnis, penentuan arsitektur data, dan definisi kebutuhan fungsional mendalam.</p>
            </div>
            <div class="py-8 md:px-6 first:pl-0 last:pr-0 reveal delay-200">
                <span class="text-2xl font-extrabold text-white/30 block mb-3 font-mono">02</span>
                <h4 class="text-base font-bold text-white mb-2">UI/UX &amp; Desain</h4>
                <p class="text-xs text-[#A0ADA5] leading-relaxed">Wireframing presisi, sistem desain modular, dan validasi kenyamanan interaksi pengguna.</p>
            </div>
            <div class="py-8 md:px-6 first:pl-0 last:pr-0 reveal delay-300">
                <span class="text-2xl font-extrabold text-[#34D399] block mb-3 font-mono">03</span>
                <h4 class="text-base font-bold text-white mb-2">Agile Engineering</h4>
                <p class="text-xs text-[#A0ADA5] leading-relaxed">Pengembangan kode berstandar clean architecture, API modular, dan review kode berkelanjutan.</p>
            </div>
            <div class="py-8 md:px-6 first:pl-0 last:pr-0 reveal delay-400">
                <span class="text-2xl font-extrabold text-white/30 block mb-3 font-mono">04</span>
                <h4 class="text-base font-bold text-white mb-2">QA &amp; Security</h4>
                <p class="text-xs text-[#A0ADA5] leading-relaxed">Pengujian unit otomatis, penetration testing, simulasi beban, dan audit keamanan berlapis.</p>
            </div>
            <div class="py-8 md:px-6 first:pl-0 last:pr-0 reveal delay-500">
                <span class="text-2xl font-extrabold text-white/30 block mb-3 font-mono">05</span>
                <h4 class="text-base font-bold text-white mb-2">Deploy &amp; Rilis</h4>
                <p class="text-xs text-[#A0ADA5] leading-relaxed">Automasi CI/CD ke serverless atau cloud container, pemantauan performa real-time, dan pemeliharaan.</p>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         02.7 - TECHNOLOGY STACK (Eksplorasi Teknologi)
         ========================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 border-b border-white/[0.08] relative">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 reveal">
            <div>
                <span class="text-xs font-mono uppercase tracking-widest text-[#34D399] block mb-3">
                    03.5 &bull; Ekosistem Rekayasa
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-[-0.03em] text-white">
                    Fondasi Teknologi Teruji
                </h2>
            </div>
            <p class="text-sm text-[#A0ADA5] max-w-sm mt-4 md:mt-0">
                Pilihan tumpukan teknologi modern dengan keandalan tinggi, arsitektur modular, dan skalabilitas jangka panjang.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4 text-center">
            <!-- 1. Laravel -->
            <div class="group p-5 rounded-2xl bg-[#0C120F] border border-white/[0.08] hover:border-[#10B981]/40 transition-all duration-300 flex flex-col items-center justify-center text-center reveal delay-100">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/[0.03] border border-white/[0.06] mb-3 group-hover:border-[#FF2D20]/40 group-hover:bg-[#FF2D20]/10 transition-all duration-300">
                    <svg class="w-6 h-6 text-[#FF2D20] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.406 3.513l8.47 4.89-8.47 4.89-8.406-4.89 8.406-4.89zm1.094 11.233v6.754l7.375-4.258v-6.754l-7.375 4.258zm-2.188 0l-7.312-4.258v6.754l7.312 4.258v-6.754zm10.562-3.832l4.126-2.382v-3.793l-4.126 2.382v3.793zm1.094-7.051l3.032 1.75 3.032-1.75-3.032-1.75-3.032 1.75zm5.156 3.258v3.793l4.126-2.382v-3.793l-4.126 2.382z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">Laravel</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Backend Core</span>
            </div>

            <!-- 2. PHP 8.3+ -->
            <div class="group p-5 rounded-2xl bg-[#0C120F] border border-white/[0.08] hover:border-[#10B981]/40 transition-all duration-300 flex flex-col items-center justify-center text-center reveal delay-150">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/[0.03] border border-white/[0.06] mb-3 group-hover:border-[#777BB4]/40 group-hover:bg-[#777BB4]/10 transition-all duration-300">
                    <svg class="w-6 h-6 text-[#777BB4] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-5.7 13.5h-1.8l1.4-7h3c1.8 0 2.8.9 2.6 2.3-.2 1.6-1.7 2.7-3.4 2.7H7.1l-.8 2zm5.5 0h-1.8l1.4-7h1.8l-.6 3.1h1.8c1.8 0 2.8.9 2.6 2.3-.3 1.6-1.8 2.7-3.5 2.7h-1.5l-.4 1.9zm8.2-5c-.2 1.6-1.7 2.7-3.4 2.7H15l-.4 2.3h-1.8l1.4-7h3c1.8 0 2.8.9 2.8 2z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">PHP 8.3+</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Engine</span>
            </div>

            <!-- 3. PostgreSQL -->
            <div class="group p-5 rounded-2xl bg-[#0C120F] border border-white/[0.08] hover:border-[#10B981]/40 transition-all duration-300 flex flex-col items-center justify-center text-center reveal delay-200">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/[0.03] border border-white/[0.06] mb-3 group-hover:border-[#336791]/40 group-hover:bg-[#336791]/10 transition-all duration-300">
                    <svg class="w-6 h-6 text-[#4169E1] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm5.8 13.4c-.4.8-1 1.4-1.8 1.8a5 5 0 0 1-2.4.6 4.9 4.9 0 0 1-3.6-1.5 5.5 5.5 0 0 1-1.4-3.8c0-1.6.5-2.9 1.5-4a5.2 5.2 0 0 1 3.8-1.6c1.3 0 2.4.4 3.3 1.2a5.4 5.4 0 0 1 1.7 3.3h-2.1a3.5 3.5 0 0 0-1-2 3.1 3.1 0 0 0-2-.7 3.2 3.2 0 0 0-2.4 1 4.1 4.1 0 0 0-.9 2.7 4.1 4.1 0 0 0 .9 2.8 3.1 3.1 0 0 0 2.4 1 3 3 0 0 0 2.1-.8 3.6 3.6 0 0 0 1-2.1h-3.1v-1.7h5.2v3.7z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">PostgreSQL</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Relational DB</span>
            </div>

            <!-- 4. Tailwind 4 -->
            <div class="group p-5 rounded-2xl bg-[#0C120F] border border-white/[0.08] hover:border-[#10B981]/40 transition-all duration-300 flex flex-col items-center justify-center text-center reveal delay-250">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/[0.03] border border-white/[0.06] mb-3 group-hover:border-[#38BDF8]/40 group-hover:bg-[#38BDF8]/10 transition-all duration-300">
                    <svg class="w-6 h-6 text-[#38BDF8] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">Tailwind 4</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Design Engine</span>
            </div>

            <!-- 5. Vue / React -->
            <div class="group p-5 rounded-2xl bg-[#0C120F] border border-white/[0.08] hover:border-[#10B981]/40 transition-all duration-300 flex flex-col items-center justify-center text-center reveal delay-300">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/[0.03] border border-white/[0.06] mb-3 group-hover:border-[#61DAFB]/40 group-hover:bg-[#61DAFB]/10 transition-all duration-300">
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
            <div class="group p-5 rounded-2xl bg-[#0C120F] border border-white/[0.08] hover:border-[#10B981]/40 transition-all duration-300 flex flex-col items-center justify-center text-center reveal delay-350">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/[0.03] border border-white/[0.06] mb-3 group-hover:border-[#02569B]/40 group-hover:bg-[#02569B]/10 transition-all duration-300">
                    <svg class="w-6 h-6 text-[#54C5F8] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14.314 0L2.3 12 6 15.7 21.684 0zm.014 11.072L7.857 17.543 14.328 24H21.7l-6.471-6.457 6.471-6.471z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">Flutter</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Cross-Platform</span>
            </div>

            <!-- 7. Docker -->
            <div class="group p-5 rounded-2xl bg-[#0C120F] border border-white/[0.08] hover:border-[#10B981]/40 transition-all duration-300 flex flex-col items-center justify-center text-center reveal delay-400">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/[0.03] border border-white/[0.06] mb-3 group-hover:border-[#2496ED]/40 group-hover:bg-[#2496ED]/10 transition-all duration-300">
                    <svg class="w-6 h-6 text-[#2496ED] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M13.983 11.078h2.119a.186.186 0 00.186-.185V9.006a.186.186 0 00-.186-.186h-2.119a.185.185 0 00-.185.185v1.888c0 .102.083.185.185.185m-2.954-5.43h2.118a.186.186 0 00.186-.186V3.574a.186.186 0 00-.186-.185h-2.118a.185.185 0 00-.185.185v1.888c0 .102.082.185.185.185m0 2.716h2.118a.187.187 0 00.186-.186V6.29a.186.186 0 00-.186-.185h-2.118a.185.185 0 00-.185.185v1.887c0 .102.082.186.185.186m-2.93 0h2.12a.186.186 0 00.184-.186V6.29a.185.185 0 00-.185-.185H8.1a.185.185 0 00-.185.185v1.887c0 .102.083.186.185.186m-2.964 0h2.119a.186.186 0 00.185-.186V6.29a.185.185 0 00-.185-.185H5.136a.186.186 0 00-.186.185v1.887c0 .102.084.186.186.186m5.893 2.715h2.119a.186.186 0 00.186-.185V9.006a.186.186 0 00-.186-.186h-2.119a.185.185 0 00-.185.185v1.888c0 .102.082.185.185.185m-2.93 0h2.12a.185.185 0 00.184-.185V9.006a.185.185 0 00-.184-.186h-2.12a.185.185 0 00-.184.185v1.888c0 .102.083.185.185.185m-2.964 0h2.119a.185.185 0 00.185-.185V9.006a.185.185 0 00-.185-.186h-2.119a.186.186 0 00-.186.185v1.888c0 .102.084.185.186.185m-2.928 0h2.119a.185.185 0 00.185-.185V9.006a.185.185 0 00-.185-.186H2.208a.186.186 0 00-.186.185v1.888c0 .102.084.185.186.185M23.97 11.23a8.91 8.91 0 00-3.69-5.188l-.348-.22-.245.333a5.534 5.534 0 01-2.905 1.956c-.23.056-.279.16-.273.395.034 1.25-.422 1.99-1.284 2.502l-.248.147.28.077c1.37.378 2.656.974 3.738 1.838.283.226.544.475.787.745.228.252.483.336.81.25.753-.198 1.393-.574 1.92-1.127.18-.188.354-.388.517-.608zM.002 12.825a7.35 7.35 0 003.542 5.867 13.978 13.978 0 006.183 2.06c4.606.402 8.877-.853 12.39-3.792.21-.176.413-.36.61-.55.158-.152.12-.24-.075-.316a12.636 12.636 0 00-4.434-.848c-3.155-.008-6.195.834-9.155 1.737-.87.265-1.74.52-2.63.703-.362.074-.632-.01-.84-.31a3.633 3.633 0 01-.482-1.42 12.32 12.32 0 01-.077-1.736.21.21 0 00-.21-.23H.27a.266.266 0 00-.268.253v.852z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-white block mb-0.5 group-hover:text-[#34D399] transition-colors">Docker</span>
                <span class="text-[10px] font-mono text-[#A0ADA5]">Containers</span>
            </div>

            <!-- 8. AWS / Cloud -->
            <div class="group p-5 rounded-2xl bg-[#0C120F] border border-white/[0.08] hover:border-[#10B981]/40 transition-all duration-300 flex flex-col items-center justify-center text-center reveal delay-450">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white/[0.03] border border-white/[0.06] mb-3 group-hover:border-[#FF9900]/40 group-hover:bg-[#FF9900]/10 transition-all duration-300">
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
         03 - ABOUT / IDENTITY SECTION (Editorial Narrative Studio)
         ========================================================================= -->
    <section id="tentang" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 border-b border-white/[0.08] relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start reveal">
            <!-- Left Info (7 cols) -->
            <div class="lg:col-span-7 space-y-8">
                <div>
                    <span class="text-xs font-mono uppercase tracking-widest text-[#34D399] block mb-3">
                        04 &bull; Filosofi &amp; Identitas Studio
                    </span>
                    <h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-[-0.03em] text-white leading-[1.1]">
                        Memadukan Rekayasa Lunak dan Ketajaman Estetika
                    </h2>
                </div>

                <p class="text-base sm:text-lg text-[#A0ADA5] leading-relaxed font-normal">
                    {{ $siteProfile->about_story ?? ($siteProfile->company_name ?? 'PT. Central Saga Mandala') . ' adalah studio digital yang lahir dan berakar di Tabanan, Bali. Kami percaya bahwa perangkat lunak terbaik bukan hanya tentang baris kode yang berjalan tanpa cela, melainkan juga pengalaman interaktif yang intuitif, anggun, dan bernilai bisnis terukur.' }}
                </p>

                <!-- 2 Editorial Fact Columns with Left Accent Line -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 pt-4 border-t border-white/[0.08]">
                    <div class="border-l-2 border-[#10B981] pl-5">
                        <span class="text-xs font-mono text-[#34D399] font-bold uppercase tracking-wider block mb-1">Berbasis di Tabanan, Bali</span>
                        <p class="text-xs text-[#A0ADA5] leading-relaxed">Menghadirkan kenyamanan kolaborasi langsung di Bali maupun integrasi kerja jarak jauh standar global.</p>
                    </div>
                    <div class="border-l-2 border-white/20 pl-5">
                        <span class="text-xs font-mono text-white font-bold uppercase tracking-wider block mb-1">Standar Rekayasa Modern</span>
                        <p class="text-xs text-[#A0ADA5] leading-relaxed">Penerapan pengujian unit otomatis, clean architecture, serta kepatuhan tinggi terhadap performa dan keamanan.</p>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="/tentang" class="inline-flex items-center text-sm font-semibold text-white hover:text-[#34D399] transition-colors">
                        Baca Selengkapnya Profil &amp; Nilai Perusahaan &rarr;
                    </a>
                </div>
            </div>

            <!-- Right Editorial Principles (5 cols) -->
            <div class="lg:col-span-5">
                <div class="rounded-3xl p-8 sm:p-10 bg-[#101713] border border-white/[0.08] relative">
                    <div class="flex items-center justify-between pb-5 mb-6 border-b border-white/[0.08]">
                        <span class="text-xs font-mono uppercase text-[#A0ADA5]">Prinsip Rekayasa</span>
                        <span class="text-xs font-mono text-[#34D399]">Central Saga</span>
                    </div>
                    <ul class="space-y-6 text-sm text-[#F5F7F5]">
                        <li class="flex items-start space-x-3.5">
                            <span class="text-[#10B981] font-bold text-base">&bull;</span>
                            <div>
                                <strong class="text-white block font-semibold mb-0.5">Kejelasan Fungsional</strong>
                                <span class="text-xs text-[#A0ADA5] leading-relaxed">Setiap fitur dibangun untuk menjawab kebutuhan pengguna riil, bukan sekadar hiasan kosmetik.</span>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3.5">
                            <span class="text-[#10B981] font-bold text-base">&bull;</span>
                            <div>
                                <strong class="text-white block font-semibold mb-0.5">Kerapian Arsitektural</strong>
                                <span class="text-xs text-[#A0ADA5] leading-relaxed">Struktur data yang terorganisir, terdokumentasi, dan mudah dirawat oleh tim engineer masa depan.</span>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3.5">
                            <span class="text-[#10B981] font-bold text-base">&bull;</span>
                            <div>
                                <strong class="text-white block font-semibold mb-0.5">Kemitraan Jangka Panjang</strong>
                                <span class="text-xs text-[#A0ADA5] leading-relaxed">Kami mendampingi pertumbuhan produk digital Anda mulai dari inisiasi konsep hingga fase scaling.</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         04 - GALERI / PORTOFOLIO SECTION (Editorial Showcase)
         ========================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 border-b border-white/[0.08] relative">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 reveal">
            <div>
                <span class="text-xs font-mono uppercase tracking-widest text-[#34D399] block mb-3">
                    05 &bull; Dokumentasi Visual
                </span>
                <h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-[-0.03em] text-white">
                    Galeri &amp; Karya Studio
                </h2>
                <p class="text-sm sm:text-base text-[#A0ADA5] mt-3 max-w-xl">
                    Dokumentasi visual pengerjaan platform digital, arsitektur antarmuka, dan sistem aplikasi klien.
                </p>
            </div>
            <div class="mt-6 md:mt-0">
                <a href="/galeri" class="inline-flex items-center gap-1.5 whitespace-nowrap shrink-0 text-sm font-semibold text-white hover:text-[#34D399] transition-colors">
                    <span>Lihat Seluruh Galeri</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

        @if ($galleries->isEmpty())
            <div class="rounded-3xl p-12 text-center border border-dashed border-white/10 bg-[#101713]">
                <p class="text-sm text-[#A0ADA5] font-mono">
                    Belum ada foto portofolio yang ditampilkan saat ini.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach ($galleries as $gallery)
                    <div class="rounded-3xl p-4 bg-[#101713] border border-white/[0.08] hover:border-[#10B981]/40 transition-all duration-300 group reveal delay-{{ $loop->iteration * 100 }}">
                        <div class="relative overflow-hidden rounded-2xl bg-[#080D0B] aspect-[4/3] border border-white/10">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                 alt="{{ $gallery->title ?? 'Portofolio' }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 cursor-pointer"
                                 loading="lazy"
                                 onclick="openLightbox('{{ asset('storage/' . $gallery->image_path) }}', '{{ addslashes($gallery->title ?? 'Portofolio') }}')">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none flex items-end p-4">
                                <span class="text-xs font-mono text-[#34D399] font-semibold">KLIK UNTUK MEMPERBESAR</span>
                            </div>
                        </div>
                        @if (!empty($gallery->title))
                            <div class="pt-4 px-2 flex items-center justify-between">
                                <h3 class="text-sm font-bold text-white truncate group-hover:text-[#34D399] transition-colors">
                                    {{ $gallery->title }}
                                </h3>
                                <span class="text-[11px] font-mono text-[#A0ADA5] uppercase tracking-wider">DETAIL &nearr;</span>
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
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 border-b border-white/[0.08] relative">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 reveal">
                <div>
                    <span class="text-xs font-mono uppercase tracking-widest text-[#34D399] block mb-3">
                        06 &bull; Bukti Kepercayaan Mitra
                    </span>
                    <h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-[-0.03em] text-white">
                        Apa Kata Klien
                    </h2>
                </div>
                <p class="text-sm text-[#A0ADA5] max-w-sm mt-4 md:mt-0">
                    Kemitraan nyata dan dampak terukur yang kami bangun bersama para pemilik bisnis dan organisasi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($testimonials as $testimonial)
                    <div class="rounded-3xl p-8 bg-[#101713] border border-white/[0.08] flex flex-col justify-between reveal delay-{{ $loop->iteration * 100 }}">
                        <div>
                            <div class="flex items-center space-x-1 text-[#34D399] mb-6">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <blockquote class="text-base text-white/90 leading-relaxed mb-8 font-normal">
                                &ldquo;{{ $testimonial->message ?? $testimonial->quote }}&rdquo;
                            </blockquote>
                        </div>
                        <div class="pt-5 border-t border-white/[0.06] flex items-center space-x-3.5">
                            <div class="w-10 h-10 rounded-full bg-[#10B981]/15 border border-[#10B981]/30 flex items-center justify-center font-bold text-[#34D399] text-sm font-mono">
                                {{ strtoupper(substr($testimonial->name ?? ($testimonial->client_name ?? 'K'), 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white leading-tight">
                                    {{ $testimonial->name ?? $testimonial->client_name }}
                                </h4>
                                @if (!empty($testimonial->role) || !empty($testimonial->company))
                                    <p class="text-xs text-[#A0ADA5] font-mono mt-0.5">
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
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 border-b border-white/[0.08] relative">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 reveal">
            <div>
                <span class="text-xs font-mono uppercase tracking-widest text-[#34D399] block mb-3">
                    07 &bull; Wawasan &amp; Publikasi
                </span>
                <h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-[-0.03em] text-white">
                    Tulisan &amp; Riset Terkini
                </h2>
                <p class="text-sm sm:text-base text-[#A0ADA5] mt-3 max-w-xl">
                    Refleksi seputar rekayasa sistem, desain produk digital, dan panduan teknis dari studio kami.
                </p>
            </div>
            <div class="mt-6 md:mt-0">
                <a href="/artikel" class="inline-flex items-center gap-1.5 whitespace-nowrap shrink-0 text-sm font-semibold text-white hover:text-[#34D399] transition-colors">
                    <span>Lihat Seluruh Artikel</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

        @if ($articles->isEmpty())
            <div class="rounded-3xl p-12 text-center border border-dashed border-white/10 bg-[#101713]">
                <p class="text-sm text-[#A0ADA5] font-mono">
                    Belum ada artikel yang dipublikasikan saat ini.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                    <article class="rounded-3xl p-6 sm:p-7 bg-[#101713] border border-white/[0.08] hover:border-[#10B981]/30 transition-all duration-300 flex flex-col justify-between group reveal delay-{{ $loop->iteration * 100 }}">
                        <div>
                            @if (!empty($article->cover_image))
                                <div class="mb-5 overflow-hidden rounded-2xl bg-[#080D0B] aspect-[16/9] border border-white/10">
                                    <img src="{{ asset('storage/' . $article->cover_image) }}"
                                         alt="{{ $article->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                         loading="lazy">
                                </div>
                            @endif

                            <div class="flex items-center justify-between text-xs font-mono mb-3 text-[#A0ADA5]">
                                <span class="text-[#34D399]">
                                    {{ optional($article->published_at)->isoFormat('D MMMM Y') ?? 'Terbaru' }}
                                </span>
                                @if (!empty($article->reading_time))
                                    <span>
                                        {{ $article->reading_time }} mnt baca
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-lg sm:text-xl font-bold text-white mb-3 group-hover:text-[#34D399] transition-colors leading-snug">
                                <a href="/artikel/{{ $article->slug }}" class="focus-visible:ring-2 focus-visible:ring-[#10B981] rounded-lg">
                                    {{ $article->title }}
                                </a>
                            </h3>

                            <p class="text-xs sm:text-sm text-[#A0ADA5] leading-relaxed mb-6 font-normal">
                                {{ Str::limit($article->excerpt, 135) }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-white/[0.06] flex items-center justify-between text-xs font-mono">
                            <span class="text-[#A0ADA5]">
                                {{ $article->author->name ?? 'Tim Studio' }}
                            </span>
                            <a href="/artikel/{{ $article->slug }}" class="font-semibold text-white group-hover:text-[#34D399] transition-colors">
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
    <section id="kontak" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            <!-- Left Info (5 cols) -->
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <span class="text-xs font-mono uppercase tracking-widest text-[#34D399] block mb-3">
                        08 &bull; Kontak &amp; Kolaborasi
                    </span>
                    <h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-[-0.03em] text-white leading-[1.08] mb-4">
                        Mari Bangun Solusi Anda
                    </h2>
                    <p class="text-base text-[#A0ADA5] leading-relaxed font-normal">
                        Diskusikan ide proyek, kebutuhan sistem perangkat lunak, atau kemitraan digital jangka panjang bersama tim kami.
                    </p>
                </div>

                <div class="space-y-4 pt-4 border-t border-white/[0.08]">
                    @if (!empty($siteProfile->email))
                        <div class="p-5 rounded-2xl bg-[#101713] border border-white/[0.08]">
                            <span class="text-xs uppercase font-mono text-[#34D399] block mb-1">Email Resmi</span>
                            <a href="mailto:{{ $siteProfile->email }}" class="text-base font-medium text-white hover:text-[#34D399] transition-colors">
                                {{ $siteProfile->email }}
                            </a>
                        </div>
                    @endif
                    @if (!empty($siteProfile->phone))
                        <div class="p-5 rounded-2xl bg-[#101713] border border-white/[0.08]">
                            <span class="text-xs uppercase font-mono text-[#34D399] block mb-1">Telepon &amp; WhatsApp</span>
                            <span class="text-base font-medium text-white">{{ $siteProfile->phone }}</span>
                        </div>
                    @endif
                    @if (!empty($siteProfile->address))
                        <div class="p-5 rounded-2xl bg-[#101713] border border-white/[0.08]">
                            <span class="text-xs uppercase font-mono text-[#34D399] block mb-1">Lokasi Studio</span>
                            <span class="text-sm text-[#A0ADA5] leading-relaxed block">{{ $siteProfile->address }}</span>
                        </div>
                    @endif
                </div>

                <div class="pt-2">
                    <a href="/kontak" class="inline-flex items-center text-sm font-semibold text-[#34D399] hover:underline">
                        Buka Formulir Inquiry Proyek Lengkap &rarr;
                    </a>
                </div>
            </div>

            <!-- Right Form (7 cols) -->
            <div class="lg:col-span-7 rounded-3xl p-8 sm:p-10 bg-[#101713] border border-white/[0.08]">
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
                                class="w-full min-h-[48px] px-6 py-3.5 text-sm font-semibold text-[#080D0B] bg-white hover:bg-[#F0F2F0] rounded-xl flex items-center justify-center space-x-2 transition-all shadow-[0_4px_20px_rgba(255,255,255,0.15)]">
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
