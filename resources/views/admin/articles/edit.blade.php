@extends('layouts.admin')

@section('title', 'Edit Artikel: ' . $article->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="border-l-2 border-[#10B981] pl-4">
        <span class="text-[11px] font-mono text-[#34D399] tracking-wider uppercase block">
            PUBLIKASI &amp; CMS
        </span>
        <h1 class="text-2xl font-extrabold text-white mt-1">
            Edit Artikel: {{ $article->title }}
        </h1>
        <p class="text-xs text-[#A0ADA5] font-mono mt-1">
            Penulis: {{ $article->author->name ?? 'Anonim' }} &bull; Dibuat: {{ $article->created_at->format('d/m/Y H:i') }}
        </p>
    </div>

    <form method="POST" action="/admin/artikel/{{ $article->id }}" enctype="multipart/form-data" class="glass-panel rounded-3xl p-6 sm:p-8 border border-white/10 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Judul -->
            <div>
                <label for="title" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Judul Artikel <span class="text-[#34D399]">*</span>
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title', $article->title) }}"
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
                       value="{{ old('slug', $article->slug) }}"
                       required
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border @error('slug') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                @error('slug')
                    <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <!-- Category -->
            <div>
                <label for="category" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Kategori
                </label>
                <input type="text"
                       id="category"
                       name="category"
                       value="{{ old('category', $article->category ?? 'Engineering') }}"
                       list="article-categories"
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
                <datalist id="article-categories">
                    <option value="Engineering">
                    <option value="UI/UX Design">
                    <option value="Cloud & DevOps">
                    <option value="Studio News">
                    <option value="Insights">
                </datalist>
            </div>

            <!-- Tags -->
            <div>
                <label for="tags" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Tags (Pisahkan koma)
                </label>
                <input type="text"
                       id="tags"
                       name="tags"
                       value="{{ old('tags', $article->tags) }}"
                       placeholder="laravel, postgresql, clean code"
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
            </div>

            <!-- Status Publikasi -->
            <div>
                <label for="status" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Status Publikasi <span class="text-[#34D399]">*</span>
                </label>
                <select id="status"
                        name="status"
                        required
                        class="w-full px-4 py-2.5 text-sm bg-[#101713] border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
                    <option value="published" {{ old('status', $article->status) === 'published' ? 'selected' : '' }}>Published (Tampil di Publik)</option>
                    <option value="draft" {{ old('status', $article->status) === 'draft' ? 'selected' : '' }}>Draft (Konsep Internal)</option>
                </select>
                @error('status')
                    <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Ringkasan / Excerpt -->
        <div>
            <label for="excerpt" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                Ringkasan Singkat (Excerpt) <span class="text-[#34D399]">*</span>
            </label>
            <textarea id="excerpt"
                      name="excerpt"
                      rows="3"
                      required
                      class="w-full p-4 text-sm bg-black/40 border @error('excerpt') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:outline-none leading-relaxed">{{ old('excerpt', $article->excerpt) }}</textarea>
            @error('excerpt')
                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Isi Artikel -->
        <div>
            <label for="content" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                Isi Artikel Lengkap <span class="text-[#34D399]">*</span>
            </label>
            <textarea id="content"
                      name="content"
                      rows="12"
                      required
                      class="w-full p-4 text-sm bg-black/40 border @error('content') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:outline-none leading-relaxed">{{ old('content', $article->content) }}</textarea>
            @error('content')
                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Gambar Sampul -->
        <div>
            <label class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                Gambar Sampul Saat Ini
            </label>
            @if (!empty($article->cover_image))
                <div class="mb-3 flex items-center space-x-3">
                    <img src="{{ asset('storage/' . $article->cover_image) }}"
                         alt="{{ $article->title }}"
                         class="w-28 h-16 object-cover rounded-xl border border-white/10">
                    <span class="text-xs font-mono text-[#A0ADA5]">Sampul aktif di publik</span>
                </div>
            @endif

            <label for="cover_image" class="block text-xs font-mono text-[#A0ADA5] mb-1">
                Ganti Gambar Sampul (Opsional, JPG, PNG, atau WebP, maks 3MB)
            </label>
            <input type="file"
                   id="cover_image"
                   name="cover_image"
                   accept="image/*"
                   class="w-full px-3 py-2 text-xs bg-black/40 border border-white/10 rounded-xl text-[#A0ADA5] file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#10B981] file:text-[#080D0B] hover:file:bg-[#34D399]">
            @error('cover_image')
                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- SEO Metadata -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-white/10">
            <div>
                <label for="seo_title" class="block text-xs font-mono uppercase font-semibold text-[#A0ADA5] mb-1.5">
                    Judul Meta SEO
                </label>
                <input type="text"
                       id="seo_title"
                       name="seo_title"
                       value="{{ old('seo_title', $article->seo_title) }}"
                       placeholder="Maks 60-70 karakter"
                       class="w-full px-4 py-2 text-xs bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
            </div>

            <div>
                <label for="seo_description" class="block text-xs font-mono uppercase font-semibold text-[#A0ADA5] mb-1.5">
                    Deskripsi Meta SEO
                </label>
                <input type="text"
                       id="seo_description"
                       name="seo_description"
                       value="{{ old('seo_description', $article->seo_description) }}"
                       placeholder="Maks 155-160 karakter"
                       class="w-full px-4 py-2 text-xs bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between pt-4 border-t border-white/10">
            <a href="/admin/artikel" class="px-4 py-2 text-xs font-mono text-[#A0ADA5] hover:text-white transition-colors">
                &larr; Batal
            </a>
            <button type="submit" class="btn-emerald px-6 py-2.5 text-xs font-mono font-semibold rounded-xl">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
