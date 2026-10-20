@extends('layouts.admin')

@section('title', 'Inbox & Pipeline CRM Prospek')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-2 border-[#10B981] pl-4">
        <div>
            <span class="text-[11px] font-mono text-[#34D399] tracking-wider uppercase block">
                MINI-CRM &amp; PROSPEK KLIEN
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                Inbox Pesan &amp; Pipeline Prospek
            </h1>
            <p class="text-xs sm:text-sm text-[#A0ADA5] mt-1 font-mono">
                Kelola status tindak lanjut calon klien dari formulir inquiry website.
            </p>
        </div>
    </div>

    <!-- Pipeline KPI Snapshot -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 font-mono text-xs">
        <a href="/admin/pesan" class="glass-panel p-3.5 rounded-2xl border border-white/10 hover:border-[#10B981]/40 transition-colors {{ empty(request('crm_status')) && empty(request('status')) ? 'bg-white/10 text-white' : 'text-[#A0ADA5]' }}">
            <span class="text-[10px] block text-[#A0ADA5]">SEMUA LEADS</span>
            <span class="text-lg font-bold text-white">{{ $crmCounts['total'] ?? 0 }}</span>
        </a>
        <a href="/admin/pesan?crm_status=new" class="glass-panel p-3.5 rounded-2xl border border-white/10 hover:border-blue-500/40 transition-colors {{ request('crm_status') === 'new' ? 'bg-blue-500/20 text-white' : 'text-[#A0ADA5]' }}">
            <span class="text-[10px] block text-blue-400">NEW LEADS</span>
            <span class="text-lg font-bold text-white">{{ $crmCounts['new'] ?? 0 }}</span>
        </a>
        <a href="/admin/pesan?crm_status=in_discussion" class="glass-panel p-3.5 rounded-2xl border border-white/10 hover:border-yellow-500/40 transition-colors {{ request('crm_status') === 'in_discussion' ? 'bg-yellow-500/20 text-white' : 'text-[#A0ADA5]' }}">
            <span class="text-[10px] block text-yellow-400">IN DISCUSSION</span>
            <span class="text-lg font-bold text-white">{{ $crmCounts['in_discussion'] ?? 0 }}</span>
        </a>
        <a href="/admin/pesan?crm_status=proposal_sent" class="glass-panel p-3.5 rounded-2xl border border-white/10 hover:border-amber-500/40 transition-colors {{ request('crm_status') === 'proposal_sent' ? 'bg-amber-500/20 text-white' : 'text-[#A0ADA5]' }}">
            <span class="text-[10px] block text-amber-400">PROPOSAL SENT</span>
            <span class="text-lg font-bold text-white">{{ $crmCounts['proposal_sent'] ?? 0 }}</span>
        </a>
        <a href="/admin/pesan?crm_status=won" class="glass-panel p-3.5 rounded-2xl border border-white/10 hover:border-[#10B981]/40 transition-colors {{ request('crm_status') === 'won' ? 'bg-[#10B981]/20 text-white' : 'text-[#A0ADA5]' }}">
            <span class="text-[10px] block text-[#34D399]">WON / CLOSING</span>
            <span class="text-lg font-bold text-white">{{ $crmCounts['won'] ?? 0 }}</span>
        </a>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="glass-panel rounded-2xl p-4 flex flex-col md:flex-row md:items-center justify-between gap-4 border border-white/10">
        <!-- Read/Unread Filter Tabs -->
        <div class="flex items-center space-x-2 font-mono text-xs">
            <a href="{{ route('admin.pesan.index') }}" class="px-3 py-1.5 rounded-xl font-medium {{ empty($status) ? 'bg-[#10B981] text-[#080D0B] font-bold' : 'text-[#A0ADA5] hover:text-white glass-pill' }}">
                Semua Status
            </a>
            <a href="{{ route('admin.pesan.index', ['status' => 'unread', 'crm_status' => request('crm_status')]) }}" class="px-3 py-1.5 rounded-xl font-medium {{ $status === 'unread' ? 'bg-[#10B981] text-[#080D0B] font-bold' : 'text-[#A0ADA5] hover:text-white glass-pill' }}">
                Belum Dibaca
            </a>
            <a href="{{ route('admin.pesan.index', ['status' => 'read', 'crm_status' => request('crm_status')]) }}" class="px-3 py-1.5 rounded-xl font-medium {{ $status === 'read' ? 'bg-[#10B981] text-[#080D0B] font-bold' : 'text-[#A0ADA5] hover:text-white glass-pill' }}">
                Sudah Dibaca
            </a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.pesan.index') }}" class="flex items-center space-x-2 w-full md:w-auto">
            @if (request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            @if (request('crm_status'))
                <input type="hidden" name="crm_status" value="{{ request('crm_status') }}">
            @endif
            <input type="text"
                   name="q"
                   value="{{ request('q') }}"
                   placeholder="Cari nama, email, perusahaan..."
                   class="px-3.5 py-1.5 text-xs bg-black/40 border border-white/10 rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none w-full md:w-64 font-mono">
            <button type="submit" class="px-3 py-1.5 text-xs font-mono font-medium text-white bg-white/10 hover:bg-white/20 rounded-xl transition-colors">
                Cari
            </button>
        </form>
    </div>

    <!-- Messages Table -->
    <div class="glass-panel rounded-3xl p-6 shadow-xl border border-white/10">
        @if ($messages->isEmpty())
            <div class="text-center py-12 text-xs font-mono text-[#A0ADA5]">
                Tidak ada pesan atau prospek yang sesuai dengan filter ini.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs font-mono text-[#F5F7F5]">
                    <thead class="border-b border-white/10 text-[#A0ADA5] uppercase tracking-wider">
                        <tr>
                            <th class="py-3 px-3 w-32">Waktu</th>
                            <th class="py-3 px-3">Pengirim &amp; Perusahaan</th>
                            <th class="py-3 px-3">Layanan / Subjek</th>
                            <th class="py-3 px-3">Pipeline Stage</th>
                            <th class="py-3 px-3">Handler</th>
                            <th class="py-3 px-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @foreach ($messages as $msg)
                            <tr class="hover:bg-white/[0.03] transition-colors {{ $msg->status === 'unread' ? 'bg-[#10B981]/5 font-semibold' : '' }}">
                                <td class="py-3.5 px-3 text-[#A0ADA5]">
                                    {{ $msg->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="py-3.5 px-3">
                                    <span class="text-white font-bold block">{{ $msg->name }}</span>
                                    <span class="text-[11px] text-[#A0ADA5] block">{{ $msg->email }}</span>
                                    @if ($msg->company_name)
                                        <span class="text-[10px] text-[#34D399] block font-normal">{{ $msg->company_name }}</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-3">
                                    @if ($msg->service_type)
                                        <span class="text-[#34D399] text-[11px] font-bold block">{{ $msg->service_type }}</span>
                                    @endif
                                    <a href="/admin/pesan/{{ $msg->id }}" class="hover:text-[#34D399] text-white">
                                        {{ Str::limit($msg->subject, 45) }}
                                    </a>
                                </td>
                                <td class="py-3.5 px-3">
                                    @php
                                        $crmLabels = [
                                            'new' => ['bg' => 'bg-blue-500/20', 'text' => 'text-blue-400', 'border' => 'border-blue-500/30', 'label' => 'New Lead'],
                                            'contacted' => ['bg' => 'bg-purple-500/20', 'text' => 'text-purple-400', 'border' => 'border-purple-500/30', 'label' => 'Contacted'],
                                            'in_discussion' => ['bg' => 'bg-yellow-500/20', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/30', 'label' => 'In Discussion'],
                                            'proposal_sent' => ['bg' => 'bg-amber-500/20', 'text' => 'text-amber-400', 'border' => 'border-amber-500/30', 'label' => 'Proposal Sent'],
                                            'won' => ['bg' => 'bg-[#10B981]/20', 'text' => 'text-[#34D399]', 'border' => 'border-[#10B981]/40', 'label' => 'Won / Closed'],
                                            'lost' => ['bg' => 'bg-red-500/20', 'text' => 'text-red-400', 'border' => 'border-red-500/30', 'label' => 'Lost'],
                                        ];
                                        $crmState = $crmLabels[$msg->crm_status ?? 'new'] ?? $crmLabels['new'];
                                    @endphp
                                    <span class="px-2.5 py-0.5 rounded text-[10px] font-bold border {{ $crmState['bg'] }} {{ $crmState['text'] }} {{ $crmState['border'] }}">
                                        {{ $crmState['label'] }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-3 text-[#A0ADA5]">
                                    {{ $msg->handler->name ?? '-' }}
                                </td>
                                <td class="py-3.5 px-3 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        @if ($msg->phone)
                                            @php
                                                $waClean = preg_replace('/[^0-9]/', '', $msg->phone);
                                                if (str_starts_with($waClean, '0')) {
                                                    $waClean = '62' . substr($waClean, 1);
                                                }
                                                $waText = urlencode('Halo ' . $msg->name . ', saya dari PT Central Saga Mandala mengenai formulir inquiry Anda...');
                                            @endphp
                                            <a href="https://wa.me/{{ $waClean }}?text={{ $waText }}" target="_blank" rel="noopener noreferrer" class="px-2 py-1 rounded-lg text-xs font-mono text-[#34D399] bg-[#10B981]/15 hover:bg-[#10B981]/25 border border-[#10B981]/30" title="Hubungi via WhatsApp">
                                                WhatsApp &nearr;
                                            </a>
                                        @endif
                                        <a href="/admin/pesan/{{ $msg->id }}" class="px-2.5 py-1 rounded-lg text-xs font-mono text-white hover:bg-white/10 border border-white/10">
                                            Detail &rarr;
                                        </a>
                                        <form method="POST" action="/admin/pesan/{{ $msg->id }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini? Data pribadi pengirim akan dihapus permanen.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 rounded-lg text-xs font-mono text-[#EF4444] hover:bg-[#EF4444]/10 border border-[#EF4444]/30">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($messages->hasPages())
                <div class="mt-6 pt-4 border-t border-white/10">
                    {{ $messages->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
