@extends('layouts.admin')

@section('title', 'Edit Proyek: ' . $project->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="border-l-2 border-[#10B981] pl-4">
        <span class="text-[11px] font-mono text-[#34D399] tracking-wider uppercase block">
            MANAJEMEN PORTOFOLIO
        </span>
        <h1 class="text-2xl font-extrabold text-white mt-1">
            Edit Proyek: {{ $project->title }}
        </h1>
        <p class="text-xs text-[#A0ADA5] font-mono mt-1">
            Perbarui data proyek, rincian teknis, dan visibilitas publik.
        </p>
    </div>

    <form method="POST" action="{{ route('admin.proyek.update', $project->id) }}" enctype="multipart/form-data" class="glass-panel rounded-3xl p-6 sm:p-8 border border-white/10 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Judul Proyek -->
            <div>
                <label for="title" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Judul Proyek <span class="text-[#34D399]">*</span>
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title', $project->title) }}"
                       required
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border @error('title') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
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
                       value="{{ old('slug', $project->slug) }}"
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border @error('slug') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                @error('slug')
                    <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <!-- Kategori -->
            <div>
                <label for="category" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Kategori <span class="text-[#34D399]">*</span>
                </label>
                <input type="text"
                       id="category"
                       name="category"
                       value="{{ old('category', $project->category) }}"
                       required
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border @error('category') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                @error('category')
                    <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Klien -->
            <div>
                <label for="client" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Klien / Mitra
                </label>
                <input type="text"
                       id="client"
                       name="client"
                       value="{{ old('client', $project->client) }}"
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
            </div>

            <!-- Waktu Pengerjaan -->
            <div>
                <label for="completion_date" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Waktu Pengerjaan
                </label>
                <input type="text"
                       id="completion_date"
                       name="completion_date"
                       value="{{ old('completion_date', $project->completion_date) }}"
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Tech Stack (Koma) -->
            <div>
                <label for="tech_stack" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Tech Stack (Pisahkan dengan koma)
                </label>
                @php
                    $techStackString = is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : $project->tech_stack;
                @endphp
                <input type="text"
                       id="tech_stack"
                       name="tech_stack"
                       value="{{ old('tech_stack', $techStackString) }}"
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none"
                       placeholder="Laravel, Vue.js, Tailwind, PostgreSQL">
            </div>

            <!-- Tautan Live Eksternal -->
            <div>
                <label for="external_url" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Tautan Live / Demo URL (Opsional)
                </label>
                <input type="url"
                       id="external_url"
                       name="external_url"
                       value="{{ old('external_url', $project->external_url) }}"
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border @error('external_url') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                @error('external_url')
                    <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Thumbnail Image -->
        <div>
            <label for="thumbnail" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                Ganti Foto Thumbnail
            </label>
            @if ($project->thumbnail)
                <div class="mb-3 flex items-center space-x-3">
                    <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-24 h-16 object-cover rounded-xl border border-white/10">
                    <span class="text-xs font-mono text-[#A0ADA5]">Thumbnail saat ini</span>
                </div>
            @endif
            <input type="file"
                   id="thumbnail"
                   name="thumbnail"
                   accept="image/*"
                   class="w-full px-3 py-2 text-xs bg-black/40 border border-white/10 rounded-xl text-[#A0ADA5] file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#10B981] file:text-[#080D0B] hover:file:bg-[#34D399]">
            @error('thumbnail')
                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Ringkasan Singkat -->
        <div>
            <label for="description" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                Ringkasan Singkat <span class="text-[#34D399]">*</span>
            </label>
            <textarea id="description"
                      name="description"
                      rows="3"
                      required
                      class="w-full p-4 text-sm bg-black/40 border @error('description') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">{{ old('description', $project->description) }}</textarea>
            @error('description')
                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Isi Studi Kasus Detail -->
        <div>
            <label for="content" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                Detail Studi Kasus &amp; Tantangan Teknis (Opsional)
            </label>
            <textarea id="content"
                      name="content"
                      rows="7"
                      class="w-full p-4 text-sm bg-black/40 border border-white/10 rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">{{ old('content', $project->content) }}</textarea>
        </div>

        <!-- Opsi Status -->
        <div class="flex flex-wrap items-center gap-6 pt-2 border-t border-white/10 font-mono text-xs">
            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $project->is_published) ? 'checked' : '' }} class="rounded border-white/20 text-[#10B981] focus:ring-[#10B981]">
                <span class="text-white font-medium">Publikasikan Langsung</span>
            </label>

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }} class="rounded border-white/20 text-[#10B981] focus:ring-[#10B981]">
                <span class="text-[#34D399] font-medium">Jadikan Proyek Unggulan (Tampil di Beranda)</span>
            </label>

            <div class="flex items-center space-x-2 ml-auto">
                <label for="sort_order" class="text-[#A0ADA5]">Urutan:</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" class="w-16 px-2 py-1 bg-black/40 border border-white/10 rounded-lg text-white text-xs text-center">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-4 border-t border-white/10">
            <a href="{{ route('admin.proyek.index') }}" class="px-4 py-2 text-xs font-mono text-[#A0ADA5] hover:text-white transition-colors">
                &larr; Batal
            </a>
            <button type="submit" class="btn-emerald px-6 py-2.5 text-xs font-mono font-semibold rounded-xl">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

