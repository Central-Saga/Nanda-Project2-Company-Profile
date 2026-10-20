@extends('layouts.admin')

@section('title', 'Manajemen Pengguna & Peran')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-2 border-[#10B981] pl-4">
        <div>
            <span class="text-[11px] font-mono text-[#34D399] tracking-wider uppercase block">
                SISTEM &amp; KEAMANAN
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                Kelola Pengguna &amp; Hak Akses
            </h1>
            <p class="text-xs sm:text-sm text-[#A0ADA5] mt-1 font-mono">
                Atur otorisasi peran (Super Admin, Admin, Editor) untuk tim pengelola website.
            </p>
        </div>
        <div>
            <a href="{{ route('admin.pengguna.create') }}" class="btn-emerald inline-flex items-center px-4 py-2 text-xs font-mono font-semibold rounded-xl">
                + Tambah Pengguna
            </a>
        </div>
    </div>

    <div class="glass-panel rounded-3xl p-6 border border-white/10 shadow-xl overflow-x-auto">
        <table class="w-full text-left text-xs font-mono text-[#F5F7F5]">
            <thead class="border-b border-white/10 text-[#A0ADA5] uppercase tracking-wider">
                <tr>
                    <th class="py-3 px-3">Nama</th>
                    <th class="py-3 px-3">Email</th>
                    <th class="py-3 px-3">Peran (Role)</th>
                    <th class="py-3 px-3">Status Akun</th>
                    <th class="py-3 px-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @foreach ($users as $u)
                    <tr class="hover:bg-white/[0.03] transition-colors">
                        <td class="py-3.5 px-3">
                            <span class="font-bold text-white text-sm block">{{ $u->name }}</span>
                            @if ($u->id === auth()->id())
                                <span class="text-[10px] text-[#34D399]">(Akun Anda Saat Ini)</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-3 text-[#A0ADA5]">
                            {{ $u->email }}
                        </td>
                        <td class="py-3.5 px-3">
                            @if ($u->role === 'super_admin')
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#10B981]/20 text-[#34D399] border border-[#10B981]/40 uppercase">
                                    Super Admin
                                </span>
                            @elseif ($u->role === 'admin')
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-500/20 text-blue-400 border border-blue-500/40 uppercase">
                                    Admin
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-white/10 text-white border border-white/20 uppercase">
                                    Editor
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-3">
                            @if ($u->is_active ?? true)
                                <span class="text-[#34D399] font-semibold">&bull; Aktif</span>
                            @else
                                <span class="text-[#EF4444] font-semibold">&bull; Nonaktif</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-3 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.pengguna.edit', $u->id) }}" class="px-2.5 py-1 rounded-lg text-xs text-[#34D399] hover:bg-[#34D399]/10 border border-[#34D399]/30">
                                    Edit
                                </a>
                                @if ($u->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.pengguna.destroy', $u->id) }}" onsubmit="return confirm('Hapus pengguna ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 rounded-lg text-xs text-[#EF4444] hover:bg-[#EF4444]/10 border border-[#EF4444]/30">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

