@extends('layouts.admin')

@section('title', 'Unggah Foto Galeri')

@section('content')
<div class="max-w-2xl space-y-6">
    <div class="border-l-2 border-[#A84E1C] pl-4">
        <h1 class="font-serif text-2xl font-bold text-[#14201C]">
            Unggah Foto Portofolio
        </h1>
        <p class="text-xs text-[#6B6A64] mt-1">
            Foto akan dioptimalkan dan dikonversi ke format WebP secara otomatis.
        </p>
    </div>

    <div class="bg-white border border-[#DCD5C8] rounded-[4px] p-6 sm:p-8 shadow-xs">
        <form method="POST" action="/admin/galeri" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Foto -->
            <div>
                <label for="image" class="block text-sm font-medium text-[#14201C] mb-1.5">
                    File Foto <span class="text-[#A84E1C]">*</span>
                </label>
                <input type="file"
                       id="image"
                       name="image"
                       required
                       accept="image/jpeg,image/png,image/webp"
                       class="block w-full text-xs text-[#6B6A64] file:mr-4 file:py-2.5 file:px-4 file:rounded-[4px] file:border-0 file:text-xs file:font-semibold file:bg-[#DCD5C8]/50 file:text-[#14201C] hover:file:bg-[#DCD5C8] cursor-pointer">
                <p class="text-[11px] text-[#8A867B] mt-1.5">
                    Format: JPG, PNG, atau WebP. Maksimal 5MB.
                </p>
                @error('image')
                    <p class="text-xs text-[#A84E1C] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Judul -->
            <div>
                <label for="title" class="block text-sm font-medium text-[#14201C] mb-1.5">
                    Judul Proyek / Keterangan (Opsional)
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title') }}"
                       class="w-full min-h-[44px] px-3.5 py-2.5 text-sm bg-white border @error('title') border-[#A84E1C] @else border-[#8A867B] @enderror rounded-[4px] text-[#14201C] placeholder-[#8A867B] focus:border-[#A84E1C] focus:ring-1 focus:ring-[#A84E1C] focus:outline-none"
                       placeholder="Contoh: Desain Antarmuka Aplikasi Fintech">
                @error('title')
                    <p class="text-xs text-[#A84E1C] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Urutan -->
            <div>
                <label for="sort_order" class="block text-sm font-medium text-[#14201C] mb-1.5">
                    Urutan Tampilan
                </label>
                <input type="number"
                       id="sort_order"
                       name="sort_order"
                       value="{{ old('sort_order', 0) }}"
                       class="w-full min-h-[44px] px-3.5 py-2.5 text-sm bg-white border @error('sort_order') border-[#A84E1C] @else border-[#8A867B] @enderror rounded-[4px] text-[#14201C] focus:border-[#A84E1C] focus:ring-1 focus:ring-[#A84E1C] focus:outline-none">
                @error('sort_order')
                    <p class="text-xs text-[#A84E1C] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="pt-4 border-t border-[#DCD5C8] flex items-center space-x-4">
                <button type="submit"
                        class="min-h-[44px] px-6 py-2.5 text-sm font-medium text-white bg-[#A84E1C] hover:bg-[#8e4116] rounded-[4px] transition-colors focus-visible:ring-2 focus-visible:ring-[#A84E1C]">
                    Unggah ke Galeri
                </button>
                <a href="/admin/galeri" class="min-h-[44px] inline-flex items-center px-4 py-2 text-sm text-[#6B6A64] hover:text-[#14201C]">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

