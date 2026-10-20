@extends('layouts.admin')

@section('title', 'Edit Layanan: ' . $service->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="border-l-2 border-[#10B981] pl-4">
        <span class="text-[11px] font-mono text-[#34D399] tracking-wider uppercase block">
            MANAJEMEN LAYANAN
        </span>
        <h1 class="text-2xl font-extrabold text-white mt-1">
            Edit Layanan: {{ $service->title }}
        </h1>
        <p class="text-xs text-[#A0ADA5] font-mono mt-1">
            Perbarui data layanan, daftar manfaat, serta teknologi pendukung.
        </p>
    </div>

    <form method="POST" action="/admin/layanan/{{ $service->id }}" enctype="multipart/form-data" class="glass-panel rounded-3xl p-6 sm:p-8 border border-white/10 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Judul -->
            <div>
                <label for="title" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Judul Layanan <span class="text-[#34D399]">*</span>
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title', $service->title) }}"
                       required
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border @error('title') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                @error('title')
                    <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug -->
            <div>
                <label for="slug" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Slug URL
                </label>
                <input type="text"
                       id="slug"
                       name="slug"
                       value="{{ old('slug', $service->slug) }}"
                       required
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border @error('slug') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                @error('slug')
                    <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="description" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                Deskripsi Lengkap <span class="text-[#34D399]">*</span>
            </label>
            <textarea id="description"
                      name="description"
                      rows="5"
                      required
                      class="w-full p-4 text-sm bg-black/40 border @error('description') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none leading-relaxed">{{ old('description', $service->description) }}</textarea>
            @error('description')
                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Benefits -->
            <div>
                <label for="benefits" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Manfaat / Keunggulan (Pisahkan per baris)
                </label>
                @php
                    $benefitsText = is_array($service->benefits) ? implode("\n", $service->benefits) : $service->benefits;
                @endphp
                <textarea id="benefits"
                          name="benefits"
                          rows="4"
                          class="w-full p-3 text-xs font-mono bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">{{ old('benefits', $benefitsText) }}</textarea>
            </div>

            <!-- Tech Stack -->
            <div>
                <label for="tech_stack" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Tech Stack Terkait (Pisahkan koma)
                </label>
                @php
                    $techStackText = is_array($service->tech_stack) ? implode(', ', $service->tech_stack) : $service->tech_stack;
                @endphp
                <textarea id="tech_stack"
                          name="tech_stack"
                          rows="4"
                          class="w-full p-3 text-xs font-mono bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">{{ old('tech_stack', $techStackText) }}</textarea>
            </div>
        </div>

        <!-- Gambar Layanan -->
        <div>
            <label class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                Gambar Layanan Saat Ini
            </label>
            @if (!empty($service->image))
                <div class="mb-3 flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $service->image) }}"
                         alt="{{ $service->title }}"
                         class="w-28 h-16 object-cover rounded-xl border border-white/10">
                    <span class="text-xs font-mono text-[#A0ADA5]">
                        Tersimpan di storage
                    </span>
                </div>
            @endif

            <label for="image" class="block text-xs font-mono text-[#A0ADA5] mb-1">
                Ganti Gambar Representasi (Opsional, JPG, PNG, atau WebP, maks 2MB)
            </label>
            <input type="file"
                   id="image"
                   name="image"
                   accept="image/*"
                   class="w-full px-3 py-2 text-xs bg-black/40 border border-white/10 rounded-xl text-[#A0ADA5] file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#10B981] file:text-[#080D0B] hover:file:bg-[#34D399]">
            @error('image')
                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Opsi Status -->
        <div class="flex flex-wrap items-center gap-6 pt-2 border-t border-white/10 font-mono text-xs">
            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }} class="rounded border-white/20 text-[#10B981] focus:ring-[#10B981]">
                <span class="text-white font-medium">Aktifkan Layanan di Publik</span>
            </label>

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }} class="rounded border-white/20 text-[#10B981] focus:ring-[#10B981]">
                <span class="text-[#34D399] font-medium">Tandai Sebagai Layanan Unggulan</span>
            </label>

            <div class="flex items-center space-x-2 ml-auto">
                <label for="sort_order" class="text-[#A0ADA5]">Urutan:</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="w-16 px-2 py-1 bg-black/40 border border-white/10 rounded-lg text-white text-xs text-center">
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between pt-4 border-t border-white/10">
            <a href="/admin/layanan" class="px-4 py-2 text-xs font-mono text-[#A0ADA5] hover:text-white transition-colors">
                &larr; Batal
            </a>
            <button type="submit" class="btn-emerald px-6 py-2.5 text-xs font-mono font-semibold rounded-xl">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
