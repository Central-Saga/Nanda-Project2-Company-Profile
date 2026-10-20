@extends('layouts.admin')

@section('title', 'Media Library')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-2 border-[#10B981] pl-4">
        <div>
            <span class="text-[11px] font-mono text-[#34D399] tracking-wider uppercase block">
                ASET &amp; FILE MANAGER
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                Media Library
            </h1>
            <p class="text-xs sm:text-sm text-[#A0ADA5] mt-1 font-mono">
                Penyimpanan berkas gambar, logo, ikon, dan dokumen publik.
            </p>
        </div>
        <div class="text-right">
            <span class="text-xs font-mono text-[#A0ADA5] block">TOTAL KAPASITAS TERPAKAI</span>
            <span class="text-sm font-mono font-bold text-white">
                {{ number_format(($totalSize ?? 0) / (1024 * 1024), 2) }} MB
            </span>
        </div>
    </div>

    <!-- Upload Box -->
    <div class="glass-panel rounded-3xl p-6 border border-white/10">
        <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center gap-4">
            @csrf
            <div class="flex-1 w-full">
                <label for="media-file" class="block text-xs font-mono uppercase font-semibold text-[#A0ADA5] mb-1">
                    Unggah Berkas Baru (Maks 10MB)
                </label>
                <input type="file"
                       id="media-file"
                       name="file"
                       required
                       class="w-full px-3 py-2 text-xs bg-black/40 border border-white/10 rounded-xl text-[#A0ADA5] file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#10B981] file:text-[#080D0B] hover:file:bg-[#34D399]">
            </div>
            <div class="pt-5 w-full sm:w-auto">
                <button type="submit" class="btn-emerald w-full sm:w-auto px-6 py-2.5 text-xs font-mono font-semibold rounded-xl min-h-[40px]">
                    Unggah Berkas
                </button>
            </div>
        </form>
    </div>

    <!-- Filter & Search -->
    <div class="glass-panel rounded-2xl p-4 flex flex-col md:flex-row md:items-center justify-between gap-4 border border-white/10">
        <div class="flex items-center space-x-2 font-mono text-xs overflow-x-auto pb-2 md:pb-0">
            <a href="{{ route('admin.media.index') }}"
               class="px-3.5 py-1.5 rounded-xl transition-all whitespace-nowrap {{ !request('type') || request('type') === 'all' ? 'bg-[#10B981] text-[#080D0B] font-bold' : 'text-[#A0ADA5] hover:text-white glass-pill' }}">
                Semua Berkas
            </a>
            <a href="{{ route('admin.media.index', ['type' => 'image', 'q' => request('q')]) }}"
               class="px-3.5 py-1.5 rounded-xl transition-all whitespace-nowrap {{ request('type') === 'image' ? 'bg-[#10B981] text-[#080D0B] font-bold' : 'text-[#A0ADA5] hover:text-white glass-pill' }}">
                Gambar (Images)
            </a>
            <a href="{{ route('admin.media.index', ['type' => 'application', 'q' => request('q')]) }}"
               class="px-3.5 py-1.5 rounded-xl transition-all whitespace-nowrap {{ request('type') === 'application' ? 'bg-[#10B981] text-[#080D0B] font-bold' : 'text-[#A0ADA5] hover:text-white glass-pill' }}">
                Dokumen (PDF/Zip)
            </a>
        </div>

        <form method="GET" action="{{ route('admin.media.index') }}" class="flex items-center space-x-2">
            @if (request('type'))
                <input type="hidden" name="type" value="{{ request('type') }}">
            @endif
            <input type="text"
                   name="q"
                   value="{{ request('q') }}"
                   placeholder="Cari nama berkas..."
                   class="px-3.5 py-1.5 text-xs bg-black/40 border border-white/10 rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none w-full sm:w-56 font-mono">
            <button type="submit" class="px-3 py-1.5 text-xs font-mono font-medium text-white bg-white/10 hover:bg-white/20 rounded-xl transition-colors">
                Cari
            </button>
        </form>
    </div>

    <!-- Media Grid -->
    @if ($files->isEmpty())
        <div class="glass-panel rounded-3xl p-16 text-center border-dashed border-white/20">
            <p class="text-sm font-mono text-[#A0ADA5]">
                Belum ada berkas di Media Library.
            </p>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($files as $file)
                <div class="glass-panel rounded-2xl p-3 border border-white/10 hover:border-[#10B981]/50 transition-all flex flex-col justify-between group">
                    <div>
                        <!-- Preview -->
                        <div class="aspect-square rounded-xl bg-[#080D0B] border border-white/5 overflow-hidden flex items-center justify-center mb-2.5 relative">
                            @if (str_starts_with($file->mime_type, 'image/'))
                                <img src="{{ asset('storage/' . $file->file_path) }}" alt="{{ $file->original_name }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center p-2">
                                    <span class="text-2xl block mb-1">📄</span>
                                    <span class="text-[9px] font-mono text-[#A0ADA5] uppercase block truncate max-w-[80px]">
                                        {{ explode('/', $file->mime_type)[1] ?? 'FILE' }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Name & Size -->
                        <p class="text-xs font-medium text-white truncate mb-1" title="{{ $file->original_name }}">
                            {{ $file->original_name }}
                        </p>
                        <span class="text-[10px] font-mono text-[#A0ADA5] block mb-3">
                            {{ $file->formatted_size }}
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="pt-2 border-t border-white/10 flex items-center justify-between text-xs font-mono">
                        <button type="button"
                                onclick="navigator.clipboard.writeText('{{ asset('storage/' . $file->file_path) }}'); alert('Tautan URL berkas berhasil disalin!');"
                                class="text-[11px] text-[#34D399] hover:underline"
                                title="Salin URL berkas">
                            Salin URL
                        </button>
                        <form method="POST" action="{{ route('admin.media.destroy', $file->id) }}" onsubmit="return confirm('Hapus berkas ini?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-[11px] text-[#EF4444] hover:underline" title="Hapus berkas">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pt-4">
            {{ $files->links() }}
        </div>
    @endif
</div>
@endsection
