@extends('layouts.public')

@section('seo')
    <x-seo-meta
        title="Artikel, Riset & Publikasi Teknologi"
        description="Publikasi artikel, wawasan rekayasa software, panduan arsitektur sistem, dan tren desain terkini dari tim PT. Central Saga Mandala."
    />
@endsection

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
    <!-- Header -->
    <div class="border-l-2 border-[#10B981] pl-6 mb-12">
        <div class="inline-flex items-center space-x-2 text-xs font-mono text-[#34D399] font-semibold mb-2">
            <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
            <span>PUBLIKASI &amp; WAWASAN TEKNIS</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mt-1">
            Artikel &amp; Riset Teknologi
        </h1>
        <p class="text-sm sm:text-base text-[#A0ADA5] mt-2 max-w-xl">
            Kumpulan artikel, kabar studio, dan panduan rekayasa teknologi dari tim {{ $siteProfile->company_name ?? '' }}.
        </p>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="glass-panel rounded-2xl p-4 sm:p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 border border-white/10 mb-12">
        <!-- Category Filter Tabs -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-2 md:pb-0 font-mono text-xs">
            <a href="{{ route('articles.index') }}"
               class="px-4 py-2 rounded-xl transition-all whitespace-nowrap {{ !request('category') || request('category') === 'all' ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white glass-pill' }}">
                Semua Kategori ({{ $articles->total() }})
            </a>
            @if (isset($categories))
                @foreach ($categories as $cat)
                    <a href="{{ route('articles.index', ['category' => $cat, 'q' => request('q')]) }}"
                       class="px-4 py-2 rounded-xl transition-all whitespace-nowrap {{ request('category') === $cat ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white glass-pill' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            @endif
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('articles.index') }}" class="flex items-center space-x-2 w-full md:w-auto">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <div class="relative w-full md:w-64">
                <input type="text"
                       name="q"
                       value="{{ request('q') }}"
                       placeholder="Cari topik artikel..."
                       class="w-full px-4 py-2 pl-9 text-xs bg-black/40 border border-white/10 rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                <svg class="w-4 h-4 text-[#A0ADA5] absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <button type="submit" class="px-4 py-2 text-xs font-mono font-medium text-white bg-white/10 hover:bg-white/20 rounded-xl transition-colors">
                Cari
            </button>
        </form>
    </div>

    @if ($articles->isEmpty())
        <div class="glass-panel p-16 text-center rounded-3xl border-dashed border-white/20">
            <p class="text-sm text-[#A0ADA5] font-mono mb-4">
                Belum ada artikel yang sesuai dengan filter saat ini.
            </p>
            <a href="{{ route('articles.index') }}" class="text-xs font-mono text-[#34D399] hover:underline">
                Reset Filter Pencarian &rarr;
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach ($articles as $article)
                <article class="glass-panel rounded-3xl p-6 sm:p-7 flex flex-col justify-between hover:border-[#10B981]/50 transition-all group shadow-sm border border-white/10">
                    <div>
                        @if (!empty($article->cover_image))
                            <div class="mb-5 overflow-hidden rounded-2xl bg-[#080D0B] aspect-[16/9] border border-white/5 relative">
                                <img src="{{ asset('storage/' . $article->cover_image) }}"
                                     alt="{{ $article->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                                @if (!empty($article->category))
                                    <div class="absolute top-3 left-3">
                                        <span class="px-2.5 py-1 rounded-lg text-[10px] font-mono font-semibold bg-[#080D0B]/85 text-[#34D399] border border-white/10 backdrop-blur-md">
                                            {{ $article->category }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <div class="flex items-center justify-between text-xs font-mono mb-2.5">
                            <span class="text-[#34D399] font-semibold">
                                {{ optional($article->published_at)->isoFormat('D MMMM Y') ?? 'Terbaru' }}
                            </span>
                            @if (!empty($article->reading_time))
                                <span class="text-[#A0ADA5]">
                                    {{ $article->reading_time }} mnt baca
                                </span>
                            @endif
                        </div>

                        <h2 class="text-xl font-bold text-white mb-2.5 group-hover:text-[#34D399] transition-colors leading-snug">
                            <a href="/artikel/{{ $article->slug }}" class="focus-visible:ring-2 focus-visible:ring-[#10B981] rounded-lg">
                                {{ $article->title }}
                            </a>
                        </h2>

                        <p class="text-xs sm:text-sm text-[#A0ADA5] leading-relaxed mb-6">
                            {{ Str::limit($article->excerpt, 140) }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono">
                        <span class="text-[#A0ADA5]">
                            {{ $article->author->name ?? 'Tim Editorial' }}
                        </span>
                        <a href="/artikel/{{ $article->slug }}" class="text-[#10B981] font-semibold hover:text-[#34D399] transition-colors">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($articles->hasPages())
            <div class="pt-6 border-t border-white/10">
                {{ $articles->links() }}
            </div>
        @endif
    @endif
</section>
@endsection
