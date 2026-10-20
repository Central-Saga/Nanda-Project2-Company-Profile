<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <title>@yield('title', 'Admin Dashboard') | {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#080D0B] text-[#F5F7F5] font-sans antialiased min-h-screen flex flex-col md:flex-row">

    <!-- Mobile Header -->
    <div class="md:hidden bg-[#101713] border-b border-white/10 px-4 py-3 flex items-center justify-between">
        <div class="flex items-center space-x-2.5">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-7 w-7 object-contain">
            <a href="/admin" class="font-bold text-base text-white">
                Admin CMS
            </a>
        </div>
        <div class="flex items-center space-x-2">
            <a href="/" target="_blank" class="p-2 text-[#34D399] hover:bg-white/5 rounded-lg text-xs font-mono" title="Lihat Website">
                Web &nearr;
            </a>
            <button type="button"
                    id="admin-menu-toggle"
                    class="min-w-[44px] min-h-[44px] flex items-center justify-center p-2 rounded-xl text-[#F5F7F5] hover:bg-white/10"
                    aria-label="Buka menu navigasi admin">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Sidebar Navigation -->
    <aside id="admin-sidebar" class="hidden md:flex flex-col w-full md:w-64 bg-[#101713] border-r border-white/10 flex-shrink-0 min-h-screen">
        <!-- Brand Header -->
        <div class="p-5 border-b border-white/10">
            <a href="/admin" class="flex items-center space-x-3 group">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Logo"
                     class="h-9 w-9 object-contain rounded-xl p-0.5 border border-white/10 bg-[#080D0B]">
                <div>
                    <span class="font-bold text-sm tracking-tight text-white group-hover:text-[#34D399] transition-colors block leading-tight">
                        Central Saga
                    </span>
                    <span class="text-[10px] font-mono text-[#10B981] tracking-wider block">
                        ADMIN SAAS v2.5
                    </span>
                </div>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-3 py-4 space-y-1 text-sm font-mono overflow-y-auto" aria-label="Menu Admin">
            <div class="mb-2">
                <a href="/admin" class="flex items-center px-3 py-2.5 rounded-xl font-medium transition-colors {{ request()->is('admin') ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                    <svg class="w-4 h-4 mr-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Ringkasan
                </a>
            </div>

            <!-- KONTEN UTAMA -->
            <div class="pt-3 pb-1">
                <span class="px-3 text-[10px] uppercase font-semibold text-[#A0ADA5]/70 tracking-wider block mb-1">
                    Konten Publik
                </span>
                <a href="/admin/proyek" class="flex items-center px-3 py-2 rounded-xl font-medium transition-colors {{ request()->is('admin/proyek*') ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                    Proyek Portofolio
                </a>
                <a href="/admin/layanan" class="flex items-center px-3 py-2 rounded-xl font-medium transition-colors {{ request()->is('admin/layanan*') ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                    Layanan
                </a>
                <a href="/admin/artikel" class="flex items-center px-3 py-2 rounded-xl font-medium transition-colors {{ request()->is('admin/artikel*') ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                    Artikel &amp; Riset
                </a>
                <a href="/admin/galeri" class="flex items-center px-3 py-2 rounded-xl font-medium transition-colors {{ request()->is('admin/galeri*') ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                    Galeri Foto
                </a>
                <a href="/admin/testimoni" class="flex items-center px-3 py-2 rounded-xl font-medium transition-colors {{ request()->is('admin/testimoni*') ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                    Testimoni Klien
                </a>
            </div>

            <!-- CRM & INQUIRIES -->
            <div class="pt-3 pb-1 border-t border-white/10">
                <span class="px-3 text-[10px] uppercase font-semibold text-[#A0ADA5]/70 tracking-wider block mb-1">
                    CRM &amp; Leads
                </span>
                <a href="/admin/pesan" class="flex items-center justify-between px-3 py-2 rounded-xl font-medium transition-colors {{ request()->is('admin/pesan*') ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                    <span>Inbox &amp; Pipeline</span>
                    @php
                        $unreadCount = \App\Models\ContactMessage::where('status', 'unread')->count();
                    @endphp
                    @if ($unreadCount > 0)
                        <span class="text-xs font-bold px-2 py-0.5 rounded-md bg-[#34D399] text-[#080D0B]">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- MEDIA -->
            <div class="pt-3 pb-1 border-t border-white/10">
                <span class="px-3 text-[10px] uppercase font-semibold text-[#A0ADA5]/70 tracking-wider block mb-1">
                    Aset &amp; Berkas
                </span>
                <a href="/admin/media" class="flex items-center px-3 py-2 rounded-xl font-medium transition-colors {{ request()->is('admin/media*') ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                    Media Library
                </a>
            </div>

            <!-- SISTEM & PENGATURAN -->
            <div class="pt-3 pb-1 border-t border-white/10">
                <span class="px-3 text-[10px] uppercase font-semibold text-[#A0ADA5]/70 tracking-wider block mb-1">
                    Sistem
                </span>
                <a href="/admin/profil" class="flex items-center px-3 py-2 rounded-xl font-medium transition-colors {{ request()->is('admin/profil*') ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                    Profil Usaha &amp; SEO
                </a>
                <a href="/admin/pengguna" class="flex items-center px-3 py-2 rounded-xl font-medium transition-colors {{ request()->is('admin/pengguna*') ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                    Kelola Pengguna
                </a>
                <a href="/admin/aktivitas" class="flex items-center px-3 py-2 rounded-xl font-medium transition-colors {{ request()->is('admin/aktivitas*') ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                    Log Aktivitas
                </a>
                <a href="/admin/password" class="flex items-center px-3 py-2 rounded-xl font-medium transition-colors {{ request()->is('admin/password*') ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white hover:bg-white/[0.05]' }}">
                    Ganti Password
                </a>
            </div>
        </nav>

        <!-- User Info & Logout -->
        <div class="p-4 border-t border-white/10 bg-[#0A100D]">
            <div class="flex items-center justify-between">
                <div class="truncate mr-2">
                    <p class="text-xs font-bold text-white truncate">
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </p>
                    <p class="text-[10px] font-mono text-[#34D399] uppercase tracking-wider">
                        {{ auth()->user()->role ?? 'super_admin' }}
                    </p>
                </div>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit"
                            class="min-h-[32px] px-2.5 py-1 text-xs text-[#EF4444] hover:bg-[#EF4444]/10 rounded-lg font-mono font-medium transition-colors border border-[#EF4444]/30"
                            title="Keluar dari akun">
                        Keluar
                    </button>
                </form>
            </div>
            <div class="mt-3 pt-3 border-t border-white/10 text-center">
                <a href="/" target="_blank" class="text-xs font-mono text-[#34D399] hover:underline flex items-center justify-center space-x-1">
                    <span>Lihat Website Publik</span>
                    <span>&nearr;</span>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content Area with Topbar -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto bg-[#080D0B]">
        <!-- Desktop SaaS Topbar -->
        <header class="hidden md:flex items-center justify-between px-8 py-4 border-b border-white/10 bg-[#0A100D]/80 backdrop-blur-md sticky top-0 z-30">
            <div class="flex items-center space-x-3">
                <span class="text-xs font-mono text-[#A0ADA5]">KONSOL ADMINISTRASI</span>
                <span class="text-white/20">&bull;</span>
                <span class="text-xs font-mono text-[#10B981] font-semibold">ONLINE</span>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Notifications Bell Dropdown -->
                @php
                    $unreadNotifs = \App\Models\AdminNotification::unread()->latest()->limit(5)->get();
                    $unreadNotifCount = $unreadNotifs->count();
                @endphp
                <div class="relative" x-data="{ open: false }">
                    <button type="button"
                            onclick="document.getElementById('notif-dropdown')?.classList.toggle('hidden')"
                            class="relative p-2 rounded-xl text-[#A0ADA5] hover:text-white hover:bg-white/5 border border-white/10 transition-colors"
                            title="Notifikasi Sistem">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        @if ($unreadNotifCount > 0)
                            <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></span>
                        @endif
                    </button>

                    <!-- Dropdown Content -->
                    <div id="notif-dropdown" class="hidden absolute right-0 mt-2 w-80 glass-panel rounded-2xl p-4 border border-white/10 shadow-2xl z-50">
                        <div class="flex items-center justify-between pb-3 mb-3 border-b border-white/10">
                            <span class="text-xs font-mono font-bold text-white">NOTIFIKASI ({{ $unreadNotifCount }})</span>
                            @if ($unreadNotifCount > 0)
                                <form method="POST" action="{{ route('admin.notifications.read-all') }}">
                                    @csrf
                                    <button type="submit" class="text-[10px] font-mono text-[#34D399] hover:underline">
                                        Tandai Semua Dibaca
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div class="space-y-2 max-h-60 overflow-y-auto">
                            @forelse ($unreadNotifs as $notif)
                                <form method="POST" action="{{ route('admin.notifications.read', $notif->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-full text-left p-2.5 rounded-xl bg-white/[0.02] hover:bg-white/[0.06] border border-white/5 transition-colors block">
                                        <p class="text-xs text-white leading-snug">{{ $notif->title }}</p>
                                        <span class="text-[10px] font-mono text-[#A0ADA5] block mt-1">{{ $notif->created_at->diffForHumans() }}</span>
                                    </button>
                                </form>
                            @empty
                                <p class="text-xs font-mono text-[#A0ADA5] text-center py-4">Tidak ada notifikasi baru.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- User Role Badge -->
                <span class="px-3 py-1 rounded-xl text-xs font-mono font-semibold bg-[#10B981]/15 text-[#34D399] border border-[#10B981]/30 uppercase">
                    {{ auth()->user()->role ?? 'Admin' }}
                </span>

                <!-- Quick Link to Public Web -->
                <a href="/" target="_blank" class="px-3.5 py-1.5 rounded-xl text-xs font-mono text-[#A0ADA5] hover:text-white glass-pill border border-white/10 transition-colors flex items-center space-x-1.5">
                    <span>Lihat Web</span>
                    <span>&nearr;</span>
                </a>
            </div>
        </header>

        <!-- Main Inner -->
        <main class="flex-1 p-6 sm:p-8 max-w-7xl w-full mx-auto">
            <!-- Flash Message Alerts -->
            @if (session('success'))
                <div class="mb-6 p-4 border border-[#10B981]/40 bg-[#10B981]/10 text-[#34D399] rounded-xl text-xs font-mono font-medium flex items-center justify-between" role="alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-xs text-[#34D399] hover:underline ml-4">✕ TUTUP</button>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 border border-[#EF4444]/40 bg-[#EF4444]/10 text-[#EF4444] rounded-xl text-xs font-mono font-medium flex items-center justify-between" role="alert">
                    <span>{{ session('error') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-xs text-[#EF4444] hover:underline ml-4">✕ TUTUP</button>
                </div>
            @endif

            {{ $slot ?? '' }}
            @yield('content')
        </main>
    </div>

    <!-- Toggle sidebar on mobile -->
    <script>
        document.getElementById('admin-menu-toggle')?.addEventListener('click', function () {
            const sidebar = document.getElementById('admin-sidebar');
            if (sidebar) {
                sidebar.classList.toggle('hidden');
            }
        });
    </script>
</body>
</html>
