@extends('layouts.admin')

@section('title', 'Ringkasan Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-2 border-[#10B981] pl-4">
        <div>
            <span class="text-[11px] font-mono text-[#34D399] tracking-wider uppercase block">
                KONSOL SAAS &bull; ADMINISTRASI UTAMA
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                Ringkasan Platform &amp; CRM
            </h1>
            <p class="text-xs sm:text-sm text-[#A0ADA5] mt-1 font-mono">
                Pantau performa website, kelola pipeline prospek, dan mutasi konten.
            </p>
        </div>
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.proyek.create') }}" class="btn-emerald inline-flex items-center px-4 py-2 text-xs font-mono font-semibold rounded-xl">
                + Proyek Baru
            </a>
            <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-mono font-semibold text-white bg-white/10 hover:bg-white/20 rounded-xl transition-colors">
                + Tulis Artikel
            </a>
        </div>
    </div>

    <!-- Stats Overview Cards (5 Key Metrics) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <!-- Card 1: Proyek -->
        <div class="glass-panel rounded-2xl p-5 shadow-lg flex flex-col justify-between hover:border-[#10B981]/50 transition-colors border border-white/10">
            <div>
                <span class="text-[10px] uppercase tracking-wider text-[#A0ADA5] font-mono font-semibold block">
                    TOTAL PROYEK
                </span>
                <p class="text-3xl font-extrabold text-white mt-2 font-mono">
                    {{ $counts['projects'] ?? 0 }}
                </p>
                <span class="text-[11px] font-mono text-[#34D399] mt-1 block">
                    {{ $counts['projects_featured'] ?? 0 }} Unggulan
                </span>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <a href="{{ route('admin.proyek.index') }}" class="text-xs font-mono text-[#34D399] font-semibold hover:underline">
                    Kelola Proyek &rarr;
                </a>
            </div>
        </div>

        <!-- Card 2: Layanan -->
        <div class="glass-panel rounded-2xl p-5 shadow-lg flex flex-col justify-between hover:border-[#10B981]/50 transition-colors border border-white/10">
            <div>
                <span class="text-[10px] uppercase tracking-wider text-[#A0ADA5] font-mono font-semibold block">
                    LAYANAN AKTIF
                </span>
                <p class="text-3xl font-extrabold text-white mt-2 font-mono">
                    {{ $counts['services'] }}
                </p>
                <span class="text-[11px] font-mono text-[#A0ADA5] mt-1 block">
                    Modul Spesialisasi
                </span>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <a href="/admin/layanan" class="text-xs font-mono text-[#34D399] font-semibold hover:underline">
                    Kelola Layanan &rarr;
                </a>
            </div>
        </div>

        <!-- Card 3: Artikel CMS -->
        <div class="glass-panel rounded-2xl p-5 shadow-lg flex flex-col justify-between hover:border-[#10B981]/50 transition-colors border border-white/10">
            <div>
                <span class="text-[10px] uppercase tracking-wider text-[#A0ADA5] font-mono font-semibold block">
                    ARTIKEL &amp; RISET
                </span>
                <div class="flex items-baseline space-x-2 mt-2 font-mono">
                    <span class="text-3xl font-extrabold text-white">
                        {{ $counts['articles_total'] }}
                    </span>
                    @if ($counts['articles_draft'] > 0)
                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-yellow-500/20 text-yellow-400">
                            {{ $counts['articles_draft'] }} draft
                        </span>
                    @endif
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <a href="/admin/artikel" class="text-xs font-mono text-[#34D399] font-semibold hover:underline">
                    Kelola Artikel &rarr;
                </a>
            </div>
        </div>

        <!-- Card 4: Total CRM Leads -->
        <div class="glass-panel rounded-2xl p-5 shadow-lg flex flex-col justify-between hover:border-[#10B981]/50 transition-colors border border-white/10">
            <div>
                <span class="text-[10px] uppercase tracking-wider text-[#A0ADA5] font-mono font-semibold block">
                    TOTAL INQUIRIES
                </span>
                <div class="flex items-baseline space-x-2 mt-2 font-mono">
                    <span class="text-3xl font-extrabold text-white">
                        {{ $counts['leads_total'] ?? 0 }}
                    </span>
                    @if ($counts['messages_unread'] > 0)
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-[#10B981] text-[#080D0B]">
                            {{ $counts['messages_unread'] }} baru
                        </span>
                    @endif
                </div>
                <span class="text-[11px] font-mono text-[#A0ADA5] mt-1 block">
                    {{ $counts['leads_in_discussion'] ?? 0 }} Dalam Diskusi
                </span>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <a href="/admin/pesan" class="text-xs font-mono text-[#34D399] font-semibold hover:underline">
                    Pipeline CRM &rarr;
                </a>
            </div>
        </div>

        <!-- Card 5: Won Deals -->
        <div class="glass-panel rounded-2xl p-5 shadow-lg flex flex-col justify-between hover:border-[#10B981]/50 transition-colors border border-white/10">
            <div>
                <span class="text-[10px] uppercase tracking-wider text-[#A0ADA5] font-mono font-semibold block">
                    DEALS WON
                </span>
                <p class="text-3xl font-extrabold text-[#34D399] mt-2 font-mono">
                    {{ $counts['leads_won'] ?? 0 }}
                </p>
                <span class="text-[11px] font-mono text-[#A0ADA5] mt-1 block">
                    Kemitraan Terkonfirmasi
                </span>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <a href="/admin/pesan?crm_status=won" class="text-xs font-mono text-[#34D399] font-semibold hover:underline">
                    Lihat Klien Won &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Analytics & Inquiry Trends Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Monthly Trends Chart (8 cols) -->
        <div class="lg:col-span-8 glass-panel rounded-3xl p-6 border border-white/10 shadow-xl">
            <div class="flex items-center justify-between mb-6 pb-3 border-b border-white/10">
                <div>
                    <h3 class="text-sm font-mono font-bold text-white uppercase tracking-wider">
                        TREN INQUIRY MASUK (6 BULAN TERAKHIR)
                    </h3>
                    <p class="text-xs text-[#A0ADA5]">Statistik volume prospek proyek masuk dari formulir dan kontak publik</p>
                </div>
                <span class="text-xs font-mono text-[#34D399] font-semibold">
                    AKTUAL
                </span>
            </div>

            <!-- CSS / SVG Bar Chart -->
            @php
                $maxTrend = max(1, ...array_map(fn($t) => $t['count'], $monthlyTrends));
            @endphp
            <div class="h-48 flex items-end justify-between gap-4 pt-6 px-4">
                @foreach ($monthlyTrends as $trend)
                    @php
                        $heightPercent = max(10, min(100, (int)(($trend['count'] / $maxTrend) * 100)));
                    @endphp
                    <div class="flex-1 flex flex-col items-center h-full justify-end group">
                        <span class="text-[11px] font-mono font-bold text-[#34D399] mb-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            {{ $trend['count'] }}
                        </span>
                        <div class="w-full max-w-[48px] bg-white/[0.05] rounded-xl overflow-hidden flex flex-col justify-end p-1 border border-white/5 hover:border-[#10B981]/60 transition-all">
                            <div class="w-full bg-gradient-to-t from-[#10B981]/40 to-[#34D399] rounded-lg transition-all duration-500" style="height: {{ $heightPercent }}%;"></div>
                        </div>
                        <span class="text-[10px] font-mono text-[#A0ADA5] mt-2 truncate w-full text-center">
                            {{ $trend['month'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Service Category Distribution (4 cols) -->
        <div class="lg:col-span-4 glass-panel rounded-3xl p-6 border border-white/10 shadow-xl flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-mono font-bold text-white uppercase tracking-wider mb-2">
                    DISTRIBUSI KATEGORI
                </h3>
                <p class="text-xs text-[#A0ADA5] mb-5">Komposisi proyek berdasarkan spesialisasi</p>

                <div class="space-y-3 font-mono text-xs">
                    @forelse ($serviceCategories as $cat)
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-white/[0.02] border border-white/5">
                            <span class="text-white truncate">{{ $cat->category }}</span>
                            <span class="px-2 py-0.5 rounded-md bg-[#10B981]/20 text-[#34D399] font-bold">
                                {{ $cat->count }}
                            </span>
                        </div>
                    @empty
                        <p class="text-xs text-[#A0ADA5] py-4 text-center">Belum ada data kategori.</p>
                    @endforelse
                </div>
            </div>

            <div class="pt-4 border-t border-white/10 text-center">
                <a href="{{ route('admin.proyek.create') }}" class="text-xs font-mono text-[#34D399] hover:underline">
                    + Tambahkan Proyek Baru &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- CRM Leads Pipeline & Recent Messages -->
    <div class="glass-panel rounded-3xl p-6 sm:p-7 shadow-xl border border-white/10">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 mb-6 border-b border-white/10 gap-3">
            <div>
                <h2 class="text-sm font-mono font-bold uppercase tracking-wider text-white flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></span>
                    <span>PIPELINE PROSPEK &amp; INQUIRY TERAKHIR</span>
                </h2>
                <p class="text-xs text-[#A0ADA5] mt-0.5">Kelola status komunikasi calon klien langsung dari dashboard</p>
            </div>
            <div class="flex items-center space-x-2 text-xs font-mono">
                <a href="/admin/pesan?crm_status=new" class="px-2.5 py-1 rounded-lg bg-blue-500/20 text-blue-400 border border-blue-500/30">
                    New ({{ $counts['leads_new'] ?? 0 }})
                </a>
                <a href="/admin/pesan?crm_status=in_discussion" class="px-2.5 py-1 rounded-lg bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                    In Discussion ({{ $counts['leads_in_discussion'] ?? 0 }})
                </a>
                <a href="/admin/pesan" class="text-[#34D399] font-semibold hover:underline ml-2">
                    Buka Seluruh CRM &rarr;
                </a>
            </div>
        </div>

        @if ($recentMessages->isEmpty())
            <div class="text-center py-10 text-xs font-mono text-[#A0ADA5]">
                Belum ada inquiry yang masuk.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs font-mono text-[#F5F7F5]">
                    <thead class="border-b border-white/10 text-[#A0ADA5] uppercase tracking-wider">
                        <tr>
                            <th class="py-3 px-3">Tanggal</th>
                            <th class="py-3 px-3">Klien &amp; Perusahaan</th>
                            <th class="py-3 px-3">Layanan / Subjek</th>
                            <th class="py-3 px-3">Status Pipeline</th>
                            <th class="py-3 px-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @foreach ($recentMessages as $msg)
                            <tr class="hover:bg-white/[0.03] transition-colors">
                                <td class="py-3.5 px-3 text-[#A0ADA5]">
                                    {{ $msg->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="py-3.5 px-3">
                                    <span class="font-bold text-white block">{{ $msg->name }}</span>
                                    <span class="text-[11px] text-[#A0ADA5] block">{{ $msg->company_name ?: $msg->email }}</span>
                                </td>
                                <td class="py-3.5 px-3">
                                    <span class="text-[#34D399] block font-semibold">{{ $msg->service_type ?: 'Umum' }}</span>
                                    <span class="text-[#A0ADA5] text-[11px] truncate max-w-xs block">{{ Str::limit($msg->subject, 40) }}</span>
                                </td>
                                <td class="py-3.5 px-3">
                                    @php
                                        $crmLabels = [
                                            'new' => ['bg' => 'bg-blue-500/20', 'text' => 'text-blue-400', 'border' => 'border-blue-500/30', 'label' => 'New Lead'],
                                            'contacted' => ['bg' => 'bg-purple-500/20', 'text' => 'text-purple-400', 'border' => 'border-purple-500/30', 'label' => 'Contacted'],
                                            'in_discussion' => ['bg' => 'bg-yellow-500/20', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/30', 'label' => 'In Discussion'],
                                            'proposal_sent' => ['bg' => 'bg-amber-500/20', 'text' => 'text-amber-400', 'border' => 'border-amber-500/30', 'label' => 'Proposal Sent'],
                                            'won' => ['bg' => 'bg-[#10B981]/20', 'text' => 'text-[#34D399]', 'border' => 'border-[#10B981]/40', 'label' => 'Won'],
                                            'lost' => ['bg' => 'bg-red-500/20', 'text' => 'text-red-400', 'border' => 'border-red-500/30', 'label' => 'Lost'],
                                        ];
                                        $crmState = $crmLabels[$msg->crm_status ?? 'new'] ?? $crmLabels['new'];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold border {{ $crmState['bg'] }} {{ $crmState['text'] }} {{ $crmState['border'] }}">
                                        {{ $crmState['label'] }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-3 text-right">
                                    <a href="/admin/pesan/{{ $msg->id }}" class="text-[#34D399] font-semibold hover:underline">
                                        Detail &rarr;
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Recent System Activities Feed -->
    <div class="glass-panel rounded-3xl p-6 sm:p-7 shadow-xl border border-white/10">
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-white/10">
            <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-white">
                LOG AKTIVITAS SISTEM TERKINI
            </h3>
            <a href="{{ route('admin.aktivitas.index') }}" class="text-xs font-mono text-[#34D399] hover:underline">
                Lihat Seluruh Log &rarr;
            </a>
        </div>
        <div class="space-y-3 font-mono text-xs">
            @forelse ($recentActivities as $act)
                <div class="flex items-start justify-between p-3 rounded-xl bg-white/[0.02] border border-white/5">
                    <div class="flex items-center space-x-2.5">
                        <span class="w-2 h-2 rounded-full bg-[#10B981]"></span>
                        <span class="text-white">{{ $act->action }}</span>
                        @if ($act->user)
                            <span class="text-[#A0ADA5]">oleh <strong class="text-white">{{ $act->user->name }}</strong></span>
                        @endif
                    </div>
                    <span class="text-[10px] text-[#A0ADA5]">
                        {{ $act->created_at->diffForHumans() }}
                    </span>
                </div>
            @empty
                <p class="text-xs text-[#A0ADA5] text-center py-4">Belum ada catatan aktivitas.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
