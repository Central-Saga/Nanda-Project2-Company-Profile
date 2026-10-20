@extends('layouts.admin')

@section('title', 'Manajemen Layanan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-2 border-[#D4AF37] pl-4">
        <div>
            <h1 class="text-2xl font-bold text-white">
                Daftar Layanan
            </h1>
            <p class="text-xs font-mono text-[#94A39B] mt-1">
                Kelola layanan dan penawaran keahlian {{ config('app.name') }}.
            </p>
        </div>
        <div>
            <a href="/admin/layanan/create" class="inline-flex items-center min-h-[40px] px-4 py-2 text-xs font-semibold font-mono text-white bg-[#0D5C3A] hover:bg-[#10B981] border border-[#10B981]/40 rounded-[4px] transition-colors">
                + Tambah Layanan
            </a>
        </div>
    </div>

    @if ($services->isEmpty())
        <div class="bg-[#0F1512] border border-[#1F2E26] rounded-[6px] p-12 text-center">
            <p class="text-sm font-mono text-[#94A39B] mb-4">
                Belum ada data layanan yang ditambahkan.
            </p>
            <a href="/admin/layanan/create" class="inline-flex items-center text-xs font-mono font-semibold text-[#10B981] hover:underline">
                Mulai buat layanan pertama &rarr;
            </a>
        </div>
    @else
        <div class="bg-[#0F1512] border border-[#1F2E26] rounded-[6px] overflow-hidden shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs font-mono text-[#F8FAF9]">
                    <thead class="bg-[#080C0A] border-b border-[#1F2E26] text-[#94A39B] uppercase tracking-wider">
                        <tr>
                            <th class="py-3 px-4 w-12 text-center">Urutan</th>
                            <th class="py-3 px-4 w-20">Gambar</th>
                            <th class="py-3 px-4">Judul Layanan</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1F2E26]">
                        @foreach ($services as $service)
                            <tr class="hover:bg-[#18221D] transition-colors">
                                <td class="py-3 px-4 text-center text-[#94A39B]">
                                    {{ $service->sort_order }}
                                </td>
                                <td class="py-3 px-4">
                                    @if (!empty($service->image))
                                        <img src="{{ asset('storage/' . $service->image) }}"
                                             alt="{{ $service->title }}"
                                             class="w-12 h-10 object-cover rounded-[2px] border border-[#1F2E26]">
                                    @else
                                        <span class="inline-block w-12 h-10 bg-[#080C0A] border border-[#1F2E26] text-[#94A39B] text-[10px] leading-[40px] text-center rounded-[2px]">
                                            Polos
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 font-bold text-white">
                                    {{ $service->title }}
                                    <span class="block text-[#94A39B] text-[11px] font-normal truncate max-w-md">
                                        /layanan/{{ $service->slug }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    @if ($service->is_active)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-[2px] text-[10px] font-bold bg-[#10B981]/20 text-[#10B981] border border-[#10B981]/40">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-[2px] text-[10px] font-bold bg-[#EF4444]/20 text-[#EF4444] border border-[#EF4444]/40">
                                            Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="/admin/layanan/{{ $service->id }}/edit" class="text-[#D4AF37] hover:underline font-semibold">
                                            Edit
                                        </a>
                                        <form method="POST" action="/admin/layanan/{{ $service->id }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-[#EF4444] hover:underline">
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
        </div>
    @endif
</div>
@endsection
