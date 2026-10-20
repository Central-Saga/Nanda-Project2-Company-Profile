@extends('layouts.admin')

@section('title', 'Detail Pesan & Prospek: ' . $message->name)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-2 border-[#10B981] pl-4">
        <div>
            <span class="text-[11px] font-mono text-[#34D399] tracking-wider uppercase block">
                DETAIL INQUIRY &bull; MINI-CRM
            </span>
            <h1 class="text-2xl font-extrabold text-white mt-1">
                Inquiry: {{ $message->name }}
            </h1>
            <p class="text-xs text-[#A0ADA5] font-mono mt-1">
                Diterima pada {{ $message->created_at->format('d F Y, H:i') }} WITA
            </p>
        </div>
        <div>
            <a href="/admin/pesan" class="px-3.5 py-1.5 rounded-xl text-xs font-mono text-[#A0ADA5] hover:text-white glass-pill border border-white/10 transition-colors">
                &larr; Kembali ke Inbox
            </a>
        </div>
    </div>

    <!-- Message Details Card -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-white/10 shadow-xl space-y-6">
        <!-- Status & Quick Action Bar -->
        <div class="flex flex-wrap items-center justify-between pb-4 border-b border-white/10 gap-4">
            <div class="flex items-center space-x-3 text-xs font-mono">
                <span class="text-[#A0ADA5]">Status Baca:</span>
                @if ($message->status === 'unread')
                    <span class="px-2.5 py-0.5 rounded-md font-bold bg-[#10B981]/20 text-[#34D399] border border-[#10B981]/40">
                        Belum Dibaca
                    </span>
                    <form method="POST" action="/admin/pesan/{{ $message->id }}/read" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-xs font-semibold text-[#34D399] hover:underline ml-2">
                            Tandai Sudah Dibaca
                        </button>
                    </form>
                @else
                    <span class="px-2.5 py-0.5 rounded-md font-bold bg-white/10 text-white border border-white/10">
                        Sudah Dibaca
                    </span>
                    @if ($message->handler)
                        <span class="text-[#A0ADA5]">
                            (Oleh: {{ $message->handler->name }})
                        </span>
                    @endif
                @endif
            </div>

            <div class="flex items-center space-x-3">
                @if ($message->phone)
                    @php
                        $waClean = preg_replace('/[^0-9]/', '', $message->phone);
                        if (str_starts_with($waClean, '0')) {
                            $waClean = '62' . substr($waClean, 1);
                        }
                        $waText = urlencode('Halo ' . $message->name . ', saya dari PT Central Saga Mandala ingin menindaklanjuti pesan Anda terkait ' . ($message->service_type ?: $message->subject) . '...');
                    @endphp
                    <a href="https://wa.me/{{ $waClean }}?text={{ $waText }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="btn-emerald inline-flex items-center px-4 py-2 text-xs font-mono font-semibold rounded-xl">
                        <span>Chat WhatsApp</span>
                        <span>&nearr;</span>
                    </a>
                @endif

                <form method="POST" action="/admin/pesan/{{ $message->id }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini? Data pribadi pengirim akan dihapus permanen.');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-2 rounded-xl text-xs font-mono text-[#EF4444] hover:bg-[#EF4444]/10 border border-[#EF4444]/30">
                        Hapus Pesan
                    </button>
                </form>
            </div>
        </div>

        <!-- CRM Pipeline Stage Manager -->
        <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-[10px] uppercase font-mono font-bold text-[#34D399] tracking-wider block mb-1">
                    STATUS PIPELINE PROSPEK
                </span>
                <p class="text-xs text-[#A0ADA5]">Pindahkan status calon klien sesuai progres komunikasi</p>
            </div>

            <form method="POST" action="{{ route('admin.pesan.status', $message->id) }}" class="flex items-center space-x-2">
                @csrf
                @method('PATCH')
                <select name="crm_status" class="px-3 py-1.5 text-xs font-mono bg-[#101713] border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
                    <option value="new" {{ ($message->crm_status ?? 'new') === 'new' ? 'selected' : '' }}>New Lead</option>
                    <option value="contacted" {{ ($message->crm_status ?? '') === 'contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="in_discussion" {{ ($message->crm_status ?? '') === 'in_discussion' ? 'selected' : '' }}>In Discussion</option>
                    <option value="proposal_sent" {{ ($message->crm_status ?? '') === 'proposal_sent' ? 'selected' : '' }}>Proposal Sent</option>
                    <option value="won" {{ ($message->crm_status ?? '') === 'won' ? 'selected' : '' }}>Won / Closed Deal</option>
                    <option value="lost" {{ ($message->crm_status ?? '') === 'lost' ? 'selected' : '' }}>Lost</option>
                </select>
                <button type="submit" class="btn-emerald px-3.5 py-1.5 text-xs font-mono font-semibold rounded-xl">
                    Perbarui Status
                </button>
            </form>
        </div>

        <!-- Sender Info Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs font-mono p-5 rounded-2xl bg-[#080D0B] border border-white/10">
            <div>
                <span class="text-[#A0ADA5] block mb-1">PENGIRIM</span>
                <span class="font-bold text-sm text-white block">{{ $message->name }}</span>
                @if ($message->company_name)
                    <span class="text-[11px] text-[#34D399]">{{ $message->company_name }}</span>
                @endif
            </div>
            <div>
                <span class="text-[#A0ADA5] block mb-1">EMAIL</span>
                <a href="mailto:{{ $message->email }}" class="font-medium text-[#34D399] hover:underline">
                    {{ $message->email }}
                </a>
            </div>
            <div>
                <span class="text-[#A0ADA5] block mb-1">TELEPON / WA</span>
                <span class="font-medium text-white">{{ $message->phone ?: '-' }}</span>
            </div>
        </div>

        <!-- Extra Inquiry Specs if available -->
        @if ($message->service_type || $message->budget_range)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-mono p-4 rounded-xl bg-white/[0.02] border border-white/5">
                @if ($message->service_type)
                    <div>
                        <span class="text-[#A0ADA5] block mb-0.5">LAYANAN YANG DIMINATI:</span>
                        <span class="text-white font-bold">{{ $message->service_type }}</span>
                    </div>
                @endif
                @if ($message->budget_range)
                    <div>
                        <span class="text-[#A0ADA5] block mb-0.5">ESTIMASI ANGGARAN:</span>
                        <span class="text-[#34D399] font-bold">{{ $message->budget_range }}</span>
                    </div>
                @endif
            </div>
        @endif

        <!-- Subject & Content -->
        <div>
            <h2 class="text-xs uppercase font-mono tracking-wider text-[#A0ADA5] font-semibold mb-1">
                SUBJEK
            </h2>
            <p class="text-xl font-bold text-white">
                {{ $message->subject }}
            </p>
        </div>

        <div>
            <h2 class="text-xs uppercase font-mono tracking-wider text-[#A0ADA5] font-semibold mb-2">
                ISI PESAN &amp; KEBUTUHAN
            </h2>
            <div class="bg-[#080D0B] border border-white/10 p-5 rounded-2xl text-sm text-[#F5F7F5] leading-relaxed whitespace-pre-wrap font-sans">
                {{ $message->message }}
            </div>
        </div>

        <!-- Admin Internal Note Section -->
        <div class="pt-6 border-t border-white/10">
            <h3 class="text-sm font-mono font-bold text-white mb-1">
                Catatan Internal Tim Admin
            </h3>
            <p class="text-xs text-[#A0ADA5] font-mono mb-3">
                Catatan ini hanya dapat dilihat oleh tim internal untuk audit dan histori CRM.
            </p>
            <form method="POST" action="/admin/pesan/{{ $message->id }}/note" class="space-y-3">
                @csrf
                @method('PATCH')
                <textarea name="admin_note"
                          rows="4"
                          class="w-full p-4 text-xs font-mono bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none"
                          placeholder="Tuliskan catatan tindak lanjut (misal: telah dikirimi proposal teknis pada tanggal..., menunggu feedback perihal modul inventory...)">{{ old('admin_note', $message->admin_note) }}</textarea>
                <div class="flex justify-end">
                    <button type="submit"
                            class="btn-emerald min-h-[38px] px-5 py-2 text-xs font-mono font-semibold rounded-xl">
                        Simpan Catatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
