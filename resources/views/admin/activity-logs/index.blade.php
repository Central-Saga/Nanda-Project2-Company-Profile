@extends('layouts.admin')

@section('title', 'Log Aktivitas Sistem')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-2 border-[#10B981] pl-4">
        <div>
            <span class="text-[11px] font-mono text-[#34D399] tracking-wider uppercase block">
                AUDIT LOG &amp; KEAMANAN
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                Log Aktivitas Sistem
            </h1>
            <p class="text-xs sm:text-sm text-[#A0ADA5] mt-1 font-mono">
                Catatan riwayat tindakan, perubahan data konten, dan otorisasi oleh administrator.
            </p>
        </div>
    </div>

    <div class="glass-panel rounded-3xl p-6 border border-white/10 shadow-xl overflow-x-auto">
        @if ($logs->isEmpty())
            <div class="text-center py-12 text-xs font-mono text-[#A0ADA5]">
                Belum ada rekaman aktivitas dalam sistem.
            </div>
        @else
            <table class="w-full text-left text-xs font-mono text-[#F5F7F5]">
                <thead class="border-b border-white/10 text-[#A0ADA5] uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-3">Waktu</th>
                        <th class="py-3 px-3">Pengguna</th>
                        <th class="py-3 px-3">Aktivitas / Aksi</th>
                        <th class="py-3 px-3">Modul</th>
                        <th class="py-3 px-3 text-right">Alamat IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($logs as $log)
                        <tr class="hover:bg-white/[0.03] transition-colors">
                            <td class="py-3.5 px-3 text-[#A0ADA5] whitespace-nowrap">
                                {{ $log->created_at->format('d/m/Y H:i:s') }}
                            </td>
                            <td class="py-3.5 px-3">
                                @if ($log->user)
                                    <span class="text-white font-bold">{{ $log->user->name }}</span>
                                    <span class="text-[10px] text-[#A0ADA5] block">{{ $log->user->email }}</span>
                                @else
                                    <span class="text-[#A0ADA5]">Sistem / Tamu</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3">
                                <span class="text-white">{{ $log->action }}</span>
                            </td>
                            <td class="py-3.5 px-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-white/[0.05] text-[#34D399] border border-white/10 uppercase">
                                    {{ $log->subject_type ?: 'General' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 text-right text-[#A0ADA5]">
                                {{ $log->ip_address ?: '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 pt-4 border-t border-white/10">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

