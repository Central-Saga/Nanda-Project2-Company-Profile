@extends('layouts.admin')

@section('title', 'Manajemen Artikel')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-2 border-[#A84E1C] pl-4">
        <div>
            <h1 class="font-serif text-2xl font-bold text-[#14201C]">
                Artikel & Berita
            </h1>
            <p class="text-xs text-[#6B6A64] mt-1">
                Kelola publikasi tulisan, wawasan, dan berita resmi perusahaan.
            </p>
        </div>
        <div>
            <a href="/admin/artikel/create" class="inline-flex items-center min-h-[40px] px-4 py-2 text-xs font-medium text-white bg-[#A84E1C] hover:bg-[#8e4116] rounded-[4px] transition-colors">
                + Tulis Artikel Baru
            </a>
        </div>
    </div>

    @if ($articles->isEmpty())
        <div class="bg-white border border-[#DCD5C8] rounded-[4px] p-12 text-center">
            <p class="text-sm text-[#6B6A64] mb-4">
                Belum ada artikel yang dibuat.
            </p>
            <a href="/admin/artikel/create" class="inline-flex items-center text-xs font-semibold text-[#A84E1C] hover:underline">
                Tulis artikel pertama Anda &rarr;
            </a>
        </div>
    @else
        <div class="bg-white border border-[#DCD5C8] rounded-[4px] overflow-hidden shadow-xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-[#14201C]">
                    <thead class="bg-[#F5F1EA]/50 border-b border-[#DCD5C8] text-[#8A867B] uppercase tracking-wider">
                        <tr>
                            <th class="py-3 px-4 w-20">Sampul</th>
                            <th class="py-3 px-4">Judul Artikel</th>
                            <th class="py-3 px-4">Penulis</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Tanggal Terbit</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DCD5C8]/60">
                        @foreach ($articles as $article)
                            <tr class="hover:bg-[#F5F1EA]/30 transition-colors">
                                <td class="py-3 px-4">
                                    @if (!empty($article->cover_image))
                                        <img src="{{ asset('storage/' . $article->cover_image) }}"
                                             alt="{{ $article->title }}"
                                             class="w-14 h-10 object-cover rounded-[2px] border border-[#DCD5C8]">
                                    @else
                                        <span class="inline-block w-14 h-10 bg-[#DCD5C8]/40 text-[#8A867B] text-[10px] leading-[40px] text-center rounded-[2px]">
                                            Polos
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <span class="font-bold text-sm text-[#14201C] block">
                                        {{ $article->title }}
                                    </span>
                                    <span class="text-[#6B6A64] font-mono text-[11px]">
                                        /artikel/{{ $article->slug }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-[#6B6A64]">
                                    {{ $article->author->name ?? 'Anonim' }}
                                </td>
                                <td class="py-3 px-4">
                                    @if ($article->status === 'published')
                                        <span class="px-2 py-0.5 rounded-[2px] text-[11px] font-semibold bg-[#2F6B5C]/15 text-[#2F6B5C]">
                                            Terbit
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-[2px] text-[11px] font-semibold bg-[#8A867B]/20 text-[#6B6A64]">
                                            Draf
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-[#6B6A64]">
                                    {{ optional($article->published_at)->format('d/m/Y H:i') ?? '-' }}
                                </td>
                                <td class="py-3 px-4 text-right space-x-2">
                                    <a href="/admin/artikel/{{ $article->id }}/edit" class="text-xs font-semibold text-[#14201C] hover:text-[#A84E1C]">
                                        Edit
                                    </a>
                                    <span class="text-[#DCD5C8]">|</span>
                                    <form method="POST" action="/admin/artikel/{{ $article->id }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
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
            @if ($articles->hasPages())
                <div class="p-4 border-t border-[#DCD5C8]">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    @endif
</div>
@endsection

