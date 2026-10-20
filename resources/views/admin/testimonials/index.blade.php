@extends('layouts.admin')

@section('title', 'Manajemen Testimoni')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-2 border-[#A84E1C] pl-4">
        <div>
            <h1 class="font-serif text-2xl font-bold text-[#14201C]">
                Testimoni Klien
            </h1>
            <p class="text-xs text-[#6B6A64] mt-1">
                Moderasi ulasan dan testimoni mitra kerja {{ config('app.name') }}.
            </p>
        </div>
        <div>
            <a href="/admin/testimoni/create" class="inline-flex items-center min-h-[40px] px-4 py-2 text-xs font-medium text-white bg-[#A84E1C] hover:bg-[#8e4116] rounded-[4px] transition-colors">
                + Tambah Testimoni Manual
            </a>
        </div>
    </div>

    @if ($testimonials->isEmpty())
        <div class="bg-white border border-[#DCD5C8] rounded-[4px] p-12 text-center">
            <p class="text-sm text-[#6B6A64]">
                Belum ada testimoni yang tercatat.
            </p>
        </div>
    @else
        <div class="bg-white border border-[#DCD5C8] rounded-[4px] overflow-hidden shadow-xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-[#14201C]">
                    <thead class="bg-[#F5F1EA]/50 border-b border-[#DCD5C8] text-[#8A867B] uppercase tracking-wider">
                        <tr>
                            <th class="py-3 px-4 w-12">Foto</th>
                            <th class="py-3 px-4">Nama & Jabatan</th>
                            <th class="py-3 px-4">Kutipan</th>
                            <th class="py-3 px-4">Rating</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-right">Moderasi & Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DCD5C8]/60">
                        @foreach ($testimonials as $t)
                            <tr class="hover:bg-[#F5F1EA]/30 transition-colors">
                                <td class="py-3 px-4">
                                    @if (!empty($t->photo))
                                        <img src="{{ asset('storage/' . $t->photo) }}"
                                             alt="{{ $t->name }}"
                                             class="w-10 h-10 object-cover rounded-full border border-[#DCD5C8]">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-[#DCD5C8]/50 text-[#14201C] flex items-center justify-center font-bold text-[11px]">
                                            {{ strtoupper(substr($t->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <span class="font-bold text-sm text-[#14201C] block">
                                        {{ $t->name }}
                                    </span>
                                    <span class="text-xs text-[#6B6A64]">
                                        {{ $t->role }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 max-w-xs">
                                    <p class="truncate italic text-xs text-[#14201C]">
                                        &ldquo;{{ $t->message }}&rdquo;
                                    </p>
                                </td>
                                <td class="py-3 px-4 text-[#A84E1C] font-mono text-sm">
                                    {{ str_repeat('★', $t->rating) }}
                                </td>
                                <td class="py-3 px-4">
                                    @if ($t->status === 'approved')
                                        <span class="px-2 py-0.5 rounded-[2px] text-[11px] font-semibold bg-[#2F6B5C]/15 text-[#2F6B5C]">
                                            Disetujui
                                        </span>
                                    @elseif ($t->status === 'pending')
                                        <span class="px-2 py-0.5 rounded-[2px] text-[11px] font-semibold bg-[#A84E1C]/15 text-[#A84E1C]">
                                            Menunggu
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-[2px] text-[11px] font-semibold bg-[#8A867B]/20 text-[#6B6A64]">
                                            Disembunyikan
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-right space-x-2">
                                    @if ($t->status !== 'approved')
                                        <form method="POST" action="/admin/testimoni/{{ $t->id }}/approve" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-xs font-semibold text-[#2F6B5C] hover:underline">
                                                Setujui
                                            </button>
                                        </form>
                                        <span class="text-[#DCD5C8]">|</span>
                                    @endif

                                    @if ($t->status !== 'hidden')
                                        <form method="POST" action="/admin/testimoni/{{ $t->id }}/hide" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-xs font-semibold text-[#6B6A64] hover:underline">
                                                Sembunyikan
                                            </button>
                                        </form>
                                        <span class="text-[#DCD5C8]">|</span>
                                    @endif

                                    <a href="/admin/testimoni/{{ $t->id }}/edit" class="text-xs font-semibold text-[#14201C] hover:text-[#A84E1C]">
                                        Edit
                                    </a>
                                    <span class="text-[#DCD5C8]">|</span>
                                    <form method="POST" action="/admin/testimoni/{{ $t->id }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-semibold text-[#A84E1C] hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection

