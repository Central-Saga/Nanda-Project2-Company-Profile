<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('seo')
        @yield('seo')
    @else
        <x-seo-meta />
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#080D0B] text-[#F5F7F5] font-sans antialiased selection:bg-[#10B981] selection:text-[#080D0B] min-h-screen flex flex-col">

    <!-- Translucent Sticky Navbar with Floating Island Aesthetic -->
    <header class="sticky top-0 z-50 px-4 sm:px-6 lg:px-8 pt-4 pb-2 transition-all">
        <div class="max-w-7xl mx-auto">
            <div class="glass-panel rounded-2xl px-4 sm:px-6 py-3 flex items-center justify-between border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.4)]">

                <!-- Brand / Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="group flex items-center space-x-3 focus-visible:ring-2 focus-visible:ring-[#10B981] rounded-xl p-1 transition-all">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="Logo {{ $siteProfile->company_name ?? config('app.name') }}"
                             class="h-9 w-9 object-contain rounded-lg p-0.5 border border-white/10 bg-[#101713] group-hover:border-[#10B981]/50 group-hover:shadow-[0_0_12px_rgba(16,185,129,0.3)] transition-all">
                        <div class="flex flex-col">
                            <span class="font-bold text-base tracking-tight text-white group-hover:text-[#34D399] transition-colors leading-tight">
                                {{ $siteProfile->company_name ?? config('app.name') }}
                            </span>
                            @if (!empty($siteProfile->tagline))
                                <span class="text-[11px] text-[#A0ADA5] tracking-wide font-mono hidden sm:block">
                                    {{ $siteProfile->tagline }}
                                </span>
                            @endif
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-1 font-medium text-sm" aria-label="Navigasi Utama">
                    <a href="/" class="px-3.5 py-2 rounded-xl transition-all {{ request()->is('/') ? 'bg-white/10 text-white font-semibold border border-white/10 shadow-inner' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                        Beranda
                    </a>
                    <a href="/layanan" class="px-3.5 py-2 rounded-xl transition-all {{ request()->is('layanan*') ? 'bg-white/10 text-white font-semibold border border-white/10 shadow-inner' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                        Layanan
                    </a>
                    <a href="/proyek" class="px-3.5 py-2 rounded-xl transition-all {{ request()->is('proyek*') || request()->is('galeri*') ? 'bg-white/10 text-white font-semibold border border-white/10 shadow-inner' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                        Portofolio
                    </a>
                    <a href="/artikel" class="px-3.5 py-2 rounded-xl transition-all {{ request()->is('artikel*') ? 'bg-white/10 text-white font-semibold border border-white/10 shadow-inner' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                        Artikel
                    </a>
                    <a href="/tentang" class="px-3.5 py-2 rounded-xl transition-all {{ request()->is('tentang*') ? 'bg-white/10 text-white font-semibold border border-white/10 shadow-inner' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                        Tentang
                    </a>
                    <a href="/kontak" class="px-3.5 py-2 rounded-xl transition-all {{ request()->is('kontak*') ? 'bg-white/10 text-white font-semibold border border-white/10 shadow-inner' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                        Kontak
                    </a>
                </nav>

                <!-- Desktop CTA Button -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="/kontak" class="btn-emerald inline-flex items-center justify-center min-h-[42px] px-5 py-2 text-xs sm:text-sm font-semibold rounded-xl focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#10B981]">
                        Diskusikan Proyek Anda
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex md:hidden">
                    <button type="button"
                            id="mobile-menu-btn"
                            aria-expanded="false"
                            aria-controls="mobile-menu"
                            class="inline-flex items-center justify-center min-w-[42px] min-h-[42px] p-2 text-[#A0ADA5] hover:text-white rounded-xl border border-white/10 bg-white/[0.03] focus-visible:ring-2 focus-visible:ring-[#10B981]"
                            aria-label="Buka menu navigasi">
                        <svg class="w-6 h-6" id="menu-icon-open" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg class="w-6 h-6 hidden" id="menu-icon-close" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Dropdown Panel -->
            <div class="hidden md:hidden mt-2 glass-panel rounded-2xl p-4 border border-white/10 shadow-2xl transition-all" id="mobile-menu">
                <div class="space-y-1">
                    <a href="/" class="block px-4 py-2.5 text-sm font-medium rounded-xl {{ request()->is('/') ? 'bg-white/10 text-[#34D399] font-semibold' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.04]' }}">
                        Beranda
                    </a>
                    <a href="/layanan" class="block px-4 py-2.5 text-sm font-medium {{ request()->is('layanan*') ? 'bg-white/10 text-[#34D399] font-semibold' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.04]' }} rounded-xl">
                        Layanan
                    </a>
                    <a href="/proyek" class="block px-4 py-2.5 text-sm font-medium rounded-xl {{ request()->is('proyek*') || request()->is('galeri*') ? 'bg-white/10 text-[#34D399] font-semibold' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.04]' }}">
                        Portofolio
                    </a>
                    <a href="/artikel" class="block px-4 py-2.5 text-sm font-medium rounded-xl {{ request()->is('artikel*') ? 'bg-white/10 text-[#34D399] font-semibold' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.04]' }}">
                        Artikel
                    </a>
                    <a href="/tentang" class="block px-4 py-2.5 text-sm font-medium {{ request()->is('tentang*') ? 'bg-white/10 text-[#34D399] font-semibold' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.04]' }} rounded-xl">
                        Tentang
                    </a>
                    <a href="/kontak" class="block px-4 py-2.5 text-sm font-medium {{ request()->is('kontak*') ? 'bg-white/10 text-[#34D399] font-semibold' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.04]' }} rounded-xl">
                        Kontak
                    </a>
                    <div class="pt-3 border-t border-white/10 mt-2">
                        <a href="/kontak" class="btn-emerald flex items-center justify-center min-h-[44px] w-full px-4 py-2.5 text-sm font-semibold rounded-xl text-center">
                            Diskusikan Proyek Anda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Refined Minimalist Footer -->
    <footer class="border-t border-white/10 bg-[#060A08] text-[#F5F7F5] mt-24 relative overflow-hidden">
        <!-- Subtle Ambient Footer Light Cone -->
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[700px] h-[300px] bg-[#10B981]/10 blur-[130px] pointer-events-none rounded-full"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 lg:gap-14">

                <!-- Col 1: Studio Identity & Description (5 cols) -->
                <div class="md:col-span-5 space-y-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="Logo {{ $siteProfile->company_name ?? config('app.name') }}"
                             class="h-10 w-10 object-contain rounded-xl p-1 border border-white/10 bg-[#101713]">
                        <div>
                            <h3 class="text-lg font-bold tracking-tight text-white leading-tight">
                                {{ $siteProfile->company_name ?? '' }}
                            </h3>
                            <p class="text-xs text-[#A0ADA5] font-mono">Software House &amp; Creative Agency</p>
                        </div>
                    </div>

                    @if (!empty($siteProfile->tagline))
                        <p class="text-sm text-[#A0ADA5] leading-relaxed max-w-sm">
                            {{ $siteProfile->tagline }}
                        </p>
                    @else
                        <p class="text-sm text-[#A0ADA5] leading-relaxed max-w-sm">
                            Membangun produk digital berkualitas tinggi memadukan kekuatan rekayasa perangkat lunak dan keanggunan desain visual.
                        </p>
                    @endif

                    @if (!empty($siteProfile->address))
                        <p class="text-xs text-[#A0ADA5]/80 leading-relaxed font-mono">
                            {{ $siteProfile->address }}
                        </p>
                    @endif

                    <!-- Operational Studio Status -->
                    <div class="inline-flex items-center space-x-2.5 px-3 py-1.5 glass-panel rounded-full text-xs font-mono text-[#A0ADA5] mt-2">
                        <span class="w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></span>
                        <span class="text-[#34D399] font-medium">STUDIO AKTIF</span>
                        <span class="text-white/20">&bull;</span>
                        <span>TABANAN, BALI</span>
                    </div>
                </div>

                <!-- Col 2: Quick Links (3 cols) -->
                <div class="md:col-span-3">
                    <h4 class="text-xs uppercase tracking-widest text-white font-mono font-semibold mb-4">
                        NAVIGASI
                    </h4>
                    <ul class="space-y-2.5 text-sm text-[#A0ADA5]">
                        <li><a href="/" class="hover:text-[#34D399] transition-colors">Beranda</a></li>
                        <li><a href="/layanan" class="hover:text-[#34D399] transition-colors">Layanan Strategis</a></li>
                        <li><a href="/proyek" class="hover:text-[#34D399] transition-colors">Portofolio Proyek</a></li>
                        <li><a href="/artikel" class="hover:text-[#34D399] transition-colors">Artikel &amp; Riset</a></li>
                        <li><a href="/tentang" class="hover:text-[#34D399] transition-colors">Tentang Studio</a></li>
                        <li><a href="/kontak" class="hover:text-[#34D399] transition-colors">Kontak Langsung</a></li>
                    </ul>
                </div>

                <!-- Col 3: Direct Contact Channels (4 cols) -->
                <div class="md:col-span-4 space-y-4">
                    <h4 class="text-xs uppercase tracking-widest text-white font-mono font-semibold mb-4">
                        HUBUNGI STUDIO
                    </h4>
                    <div class="space-y-3 text-sm text-[#A0ADA5]">
                        @if (!empty($siteProfile->email))
                            <div>
                                <span class="text-[11px] text-[#A0ADA5]/70 font-mono block">EMAIL RESMI</span>
                                <a href="mailto:{{ $siteProfile->email }}" class="text-white hover:text-[#34D399] transition-colors font-mono underline underline-offset-4">
                                    {{ $siteProfile->email }}
                                </a>
                            </div>
                        @endif

                        @if (!empty($siteProfile->phone))
                            <div>
                                <span class="text-[11px] text-[#A0ADA5]/70 font-mono block">TELEPON &amp; WHATSAPP</span>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteProfile->phone) }}" class="text-white hover:text-[#34D399] transition-colors font-mono">
                                    {{ $siteProfile->phone }}
                                </a>
                            </div>
                        @endif

                        @if (!empty($siteProfile->operating_hours))
                            <div class="pt-2 border-t border-white/10">
                                <span class="text-[11px] text-[#A0ADA5]/70 font-mono block">JAM OPERASIONAL</span>
                                <span class="text-white text-xs font-mono">{{ $siteProfile->operating_hours }}</span>
                            </div>
                        @endif
                    </div>

                    @php
                        $socials = array_filter([
                            'Facebook' => $siteProfile->facebook_url ?? null,
                            'Instagram' => $siteProfile->instagram_url ?? null,
                            'LinkedIn' => $siteProfile->linkedin_url ?? null,
                            'Google Maps' => $siteProfile->maps_url ?? null,
                        ]);
                    @endphp

                    @if (count($socials) > 0)
                        <div class="pt-3 border-t border-white/10 flex flex-wrap gap-4 text-xs font-mono">
                            @foreach ($socials as $label => $url)
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="text-[#A0ADA5] hover:text-[#34D399] transition-colors underline underline-offset-2">
                                    {{ $label }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

            <!-- Bottom Copyright Bar -->
            <div class="mt-14 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between text-xs text-[#A0ADA5]/70 font-mono">
                <p>&copy; {{ date('Y') }} {{ $siteProfile->company_name ?? '' }}. Seluruh hak cipta dilindungi.</p>
                <p class="mt-2 sm:mt-0 text-[#34D399]">STUDIO TABANAN, BALI, INDONESIA</p>
            </div>
        </div>
    </footer>

    <!-- Accessible Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const iconOpen = document.getElementById('menu-icon-open');
            const iconClose = document.getElementById('menu-icon-close');

            if (!btn || !menu) return;

            function toggleMenu(show) {
                const isOpen = show !== undefined ? show : menu.classList.contains('hidden');
                if (isOpen) {
                    menu.classList.remove('hidden');
                    iconOpen.classList.add('hidden');
                    iconClose.classList.remove('hidden');
                    btn.setAttribute('aria-expanded', 'true');
                } else {
                    menu.classList.add('hidden');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                }
            }

            btn.addEventListener('click', function () {
                toggleMenu();
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !menu.classList.contains('hidden')) {
                    toggleMenu(false);
                    btn.focus();
                }
            });

            document.addEventListener('click', function (e) {
                if (!menu.contains(e.target) && !btn.contains(e.target) && !menu.classList.contains('hidden')) {
                    toggleMenu(false);
                }
            });
        });
    </script>
</body>
</html>
