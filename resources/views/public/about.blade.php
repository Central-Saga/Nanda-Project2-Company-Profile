@extends('layouts.public')

@section('seo')
    <x-seo-meta
        title="Tentang Studio & Rekayasa Lunak - PT. Central Saga Mandala"
        description="Profil lengkap PT. Central Saga Mandala, Software House & Creative Agency berkedudukan di Tabanan, Bali. Kenali visi, misi, nilai perusahaan, dan tim kami."
    />
@endsection

@section('content')
    <!-- Header Hero -->
    <section class="relative pt-16 pb-16 md:pt-20 md:pb-20 overflow-hidden bg-ambient-mesh border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399] mb-4">
                <span class="text-[#10B981]">&bull;</span>
                <span>PROFIL STUDIO &amp; NILAI UTAMA</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white mb-4">
                Tentang Central Saga Mandala
            </h1>
            <p class="text-base sm:text-lg text-[#A0ADA5] max-w-2xl mx-auto">
                Studio rekayasa perangkat lunak dan agensi kreatif yang berakar di Tabanan, Bali, mendedikasikan keahlian teknologi untuk skala global.
            </p>
        </div>
    </section>

    <!-- Company Story Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-b border-white/10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs uppercase font-mono font-bold text-[#34D399] tracking-wider block">KISAH KAMI</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                    Menggabungkan Keindahan Bali dengan Standar Rekayasa Global
                </h2>
                <div class="text-[#A0ADA5] text-base leading-relaxed space-y-4">
                    <p>
                        {{ $siteProfile->about_story ?? 'PT. Central Saga Mandala didirikan dengan komitmen menghadirkan produk perangkat lunak yang berkarakter kuat, berperforma tinggi, dan memiliki integritas arsitektural. Kami melihat lanskap teknologi seringkali terpecah antara fungsi yang kaku atau tampilan estetis tanpa pondasi rekayasa yang kokoh.' }}
                    </p>
                    <p>
                        Dari studio kami di Tabanan, Bali, kami memadukan ketenangan dan ketelitian kultur lokal dengan kecepatan eksekusi metodologi Agile. Setiap aplikasi yang kami bangun diperlakukan sebagai karya kebanggaan, dirancang untuk memberi dampak bisnis nyata dan pertumbuhan berkelanjutan bagi klien kami.
                    </p>
                </div>
            </div>
            <div class="lg:col-span-5">
                <div class="glass-panel rounded-3xl p-8 border border-white/10 shadow-2xl relative overflow-hidden">
                    <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-white/10">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain rounded-xl p-1 bg-[#101713] border border-white/10">
                        <div>
                            <h3 class="text-base font-bold text-white">{{ $siteProfile->company_name ?? 'PT. Central Saga Mandala' }}</h3>
                            <span class="text-xs font-mono text-[#A0ADA5]">Tabanan, Bali, Indonesia</span>
                        </div>
                    </div>
                    <div class="space-y-4 font-mono text-xs">
                        <div class="flex justify-between py-2 border-b border-white/5">
                            <span class="text-[#A0ADA5]">BENTUK BADAN</span>
                            <span class="text-white font-semibold">Perseroan Terbatas (PT)</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-white/5">
                            <span class="text-[#A0ADA5]">BIDANG UTAMA</span>
                            <span class="text-[#34D399] font-semibold">Software House &amp; Creative Agency</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-white/5">
                            <span class="text-[#A0ADA5]">TOTAL PORTOFOLIO</span>
                            <span class="text-white font-semibold">{{ $projectsCount }}+ Proyek Terpublikasi</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-[#A0ADA5]">LAYANAN SPESIALISASI</span>
                            <span class="text-white font-semibold">{{ $servicesCount }} Bidang Keahlian</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-b border-white/10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="glass-panel rounded-3xl p-8 sm:p-10 border border-white/10">
                <span class="text-xs uppercase font-mono font-bold text-[#34D399] tracking-wider block mb-3">VISI KAMI</span>
                <h3 class="text-2xl font-bold text-white mb-4">Visi Perusahaan</h3>
                <p class="text-sm sm:text-base text-[#A0ADA5] leading-relaxed">
                    {{ $siteProfile->vision ?? 'Menjadi software house dan studio kreatif rujukan utama dari Indonesia yang diakui secara internasional atas keunggulan rekayasa perangkat lunak, keindahan estetika antarmuka, dan etika kerja yang transparan.' }}
                </p>
            </div>
            <div class="glass-panel rounded-3xl p-8 sm:p-10 border border-white/10">
                <span class="text-xs uppercase font-mono font-bold text-[#34D399] tracking-wider block mb-3">MISI KAMI</span>
                <h3 class="text-2xl font-bold text-white mb-4">Misi Perusahaan</h3>
                <p class="text-sm sm:text-base text-[#A0ADA5] leading-relaxed">
                    {{ $siteProfile->mission ?? 'Membangun solusi digital handal yang memberdayakan efisiensi operasional klien, mendorong transformasi digital yang inklusif, dan memupuk talenta engineer dan desainer lokal menuju panggung teknologi global.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-b border-white/10">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs uppercase font-mono font-bold text-[#34D399] tracking-wider block mb-2">PRINSIP KERJA</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white">Nilai-Nilai Fundamental</h2>
            <p class="text-sm text-[#A0ADA5] mt-2">Komitmen etika dan teknis yang memandu setiap baris kode dan keputusan desain yang kami ambil.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="glass-panel rounded-2xl p-6 sm:p-8 border border-white/10">
                <span class="text-xs font-mono text-[#34D399] font-bold block mb-2">01 / INTEGRITAS TEKNIS</span>
                <h4 class="text-lg font-bold text-white mb-2">Engineering Excellence</h4>
                <p class="text-xs sm:text-sm text-[#A0ADA5] leading-relaxed">
                    Kami menolak kompromi mutu cepat yang menghasilkan utang teknis (technical debt). Kami mengutamakan arsitektur yang bersih, pengujian otomatis, dan dokumentasi yang menyeluruh.
                </p>
            </div>
            <div class="glass-panel rounded-2xl p-6 sm:p-8 border border-white/10">
                <span class="text-xs font-mono text-[#34D399] font-bold block mb-2">02 / KETELITIAN ESTETIKA</span>
                <h4 class="text-lg font-bold text-white mb-2">Design With Purpose</h4>
                <p class="text-xs sm:text-sm text-[#A0ADA5] leading-relaxed">
                    Desain bukan ornamen superficial. Setiap elemen visual, tipografi, dan alur interaksi dirancang untuk mempermudah tugas pengguna dan memperkuat wibawa brand.
                </p>
            </div>
            <div class="glass-panel rounded-2xl p-6 sm:p-8 border border-white/10">
                <span class="text-xs font-mono text-[#34D399] font-bold block mb-2">03 / KEMITRAAN TERBUKA</span>
                <h4 class="text-lg font-bold text-white mb-2">Radical Transparency</h4>
                <p class="text-xs sm:text-sm text-[#A0ADA5] leading-relaxed">
                    Kami menjaga komunikasi tanpa misteri teknis. Laporan kemajuan terukur, penjadwalan transparan, dan saran arsitektur yang berorientasi pada keberhasilan jangka panjang mitra kami.
                </p>
            </div>
        </div>
    </section>

    <!-- Company Journey / Milestones -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-b border-white/10">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-xs uppercase font-mono font-bold text-[#34D399] tracking-wider block mb-2">PERJALANAN KAMI</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white">Milestone &amp; Pertumbuhan</h2>
            </div>

            <div class="space-y-8 relative before:absolute before:inset-0 before:left-4 md:before:left-1/2 before:w-0.5 before:bg-white/10">
                <div class="relative flex items-center md:justify-between group">
                    <div class="hidden md:block w-5/12 text-right pr-8">
                        <span class="text-xs font-mono text-[#34D399] font-bold">2021 &bull; INISIASI</span>
                        <h4 class="text-base font-bold text-white mt-1">Pendirian Studio di Tabanan</h4>
                        <p class="text-xs text-[#A0ADA5] mt-1">Bermula dari tim engineer inti dengan fokus awal pada rekayasa backend enterprise dan custom ERP.</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#10B981] flex items-center justify-center text-[#080D0B] font-bold text-xs z-10 mx-auto">
                        &check;
                    </div>
                    <div class="w-full md:w-5/12 pl-8 md:pl-8">
                        <div class="md:hidden">
                            <span class="text-xs font-mono text-[#34D399] font-bold">2021 &bull; INISIASI</span>
                            <h4 class="text-base font-bold text-white mt-1">Pendirian Studio di Tabanan</h4>
                            <p class="text-xs text-[#A0ADA5] mt-1">Bermula dari tim engineer inti dengan fokus awal pada rekayasa backend enterprise dan custom ERP.</p>
                        </div>
                    </div>
                </div>

                <div class="relative flex items-center md:justify-between group">
                    <div class="w-full md:w-5/12 pr-8 text-left md:text-right hidden md:block">
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#10B981] flex items-center justify-center text-[#080D0B] font-bold text-xs z-10 mx-auto">
                        &check;
                    </div>
                    <div class="w-full md:w-5/12 pl-8">
                        <span class="text-xs font-mono text-[#34D399] font-bold">2023 &bull; EKSPANSI</span>
                        <h4 class="text-base font-bold text-white mt-1">Kombinasi Rekayasa Lunak &amp; Agensi Kreatif</h4>
                        <p class="text-xs text-[#A0ADA5] mt-1">Memperluas kapabilitas ke integrasi UI/UX premium, mobile application, serta solusi cloud multi-region.</p>
                    </div>
                </div>

                <div class="relative flex items-center md:justify-between group">
                    <div class="w-full md:w-5/12 text-left md:text-right pr-8">
                        <span class="text-xs font-mono text-[#34D399] font-bold">SEKARANG &bull; SKALA GLOBAL</span>
                        <h4 class="text-base font-bold text-white mt-1">Mitra Transformasi Digital Lintas Sektor</h4>
                        <p class="text-xs text-[#A0ADA5] mt-1">Melayani puluhan klien perusahaan dari industri pariwisata, keuangan (FinTech), logistik, hingga instansi kreatif.</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#34D399] animate-pulse flex items-center justify-center text-[#080D0B] font-bold text-xs z-10 mx-auto">
                        &bull;
                    </div>
                    <div class="hidden md:block w-5/12 pl-8"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Consultation CTA -->
    <section class="py-20 text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h3 class="text-2xl sm:text-3xl font-extrabold text-white mb-4">
                Ingin Mengetahui Lebih Lanjut Tentang Kerjasama Tim Kami?
            </h3>
            <p class="text-sm text-[#A0ADA5] mb-8 max-w-xl mx-auto">
                Kami siap mengadakan sesi perkenalan, diskusi arsitektur sistem, atau penyusunan estimasi proposal proyek.
            </p>
            <a href="{{ route('contact.index') }}" class="btn-emerald inline-flex items-center px-8 py-3.5 text-sm font-semibold rounded-xl">
                Hubungi Kami Sekarang &rarr;
            </a>
        </div>
    </section>
@endsection

