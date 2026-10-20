@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-2 border-[#A84E1C] pl-4">
        <div>
            <h1 class="font-serif text-2xl font-bold text-[#14201C]">
                Galeri Portofolio
            </h1>
            <p class="text-xs text-[#6B6A64] mt-1">
                Kelola foto portofolio dan karya digital {{ config('app.name') }}.
            </p>
        </div>
        <div>
            <a href="/admin/galeri/create" class="inline-flex items-center min-h-[40px] px-4 py-2 text-xs font-medium text-white bg-[#A84E1C] hover:bg-[#8e4116] rounded-[4px] transition-colors">
                + Unggah Foto Baru
            </a>
        </div>
    </div>

    @if ($galleries->isEmpty())
        <div class="bg-white border border-[#DCD5C8] rounded-[4px] p-12 text-center">
            <p class="text-sm text-[#6B6A64] mb-4">
                Belum ada foto portofolio yang diunggah.
            </p>
            <a href="/admin/galeri/create" class="inline-flex items-center text-xs font-semibold text-[#A84E1C] hover:underline">
                Unggah foto pertama &rarr;
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($galleries as $gallery)
                <div class="bg-white border border-[#DCD5C8] rounded-[4px] p-3 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="aspect-[4/3] rounded-[2px] overflow-hidden bg-[#F5F1EA] mb-3">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                 alt="{{ $gallery->title ?? 'Portofolio' }}"
                                 class="w-full h-full object-cover">
                        </div>
                        <p class="text-xs font-semibold text-[#14201C] truncate">
                            {{ $gallery->title ?? 'Tanpa judul' }}
                        </p>
                        <span class="text-[11px] text-[#6B6A64]">
                            Urutan: {{ $gallery->sort_order }}
                        </span>
                    </div>

                    <div class="mt-4 pt-3 border-t border-[#DCD5C8]/60 flex items-center justify-end">
                        <form method="POST" action="/admin/galeri/{{ $gallery->id }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini? File fisik juga akan dihapus.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-semibold text-[#A84E1C] hover:underline">
                                Hapus Foto
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

