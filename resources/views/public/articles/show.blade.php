@extends('layouts.public')

@section('seo')
    <x-seo-meta
        :title="$article->seo_title ?? $article->title"
        :description="$article->seo_description ?? $article->excerpt"
        og-type="article"
        :og-image="$article->cover_image"
    />
@endsection

@section('content')
<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
    <!-- Back Link -->
    <div class="mb-8">
        <a href="/artikel" class="inline-flex items-center text-xs font-mono font-semibold text-[#A0ADA5] hover:text-[#34D399] transition-colors focus-visible:ring-2 focus-visible:ring-[#10B981] rounded-lg">
            &larr; KEMBALI KE DAFTAR ARTIKEL
        </a>
    </div>

    <!-- Article Header -->
    <header class="border-l-2 border-[#10B981] pl-6 mb-10">
        <div class="flex flex-wrap items-center gap-3 text-xs font-mono text-[#34D399] font-semibold mb-3">
            @if (!empty($article->category))
                <span class="px-2.5 py-0.5 rounded-lg bg-[#10B981]/20 text-[#34D399] border border-[#10B981]/30">
                    {{ $article->category }}
                </span>
            @endif
            <span>{{ optional($article->published_at)->isoFormat('D MMMM Y') ?? 'Terbaru' }}</span>
            @if (!empty($article->reading_time))
                <span class="text-white/20">&bull;</span>
                <span class="text-[#A0ADA5]">{{ $article->reading_time }} menit membaca</span>
            @endif
            <span class="text-white/20">&bull;</span>
            <span class="text-[#A0ADA5]">PENULIS: {{ $article->author->name ?? 'Tim Editorial' }}</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mt-2 leading-[1.2]">
            {{ $article->title }}
        </h1>
        <p class="text-base sm:text-lg text-[#A0ADA5] mt-4 leading-relaxed font-normal">
            {{ $article->excerpt }}
        </p>
    </header>

    <!-- Cover Image if exists -->
    @if (!empty($article->cover_image))
        <div class="mb-12 overflow-hidden rounded-3xl border border-white/10 bg-[#101713] p-2 glass-panel shadow-2xl">
            <img src="{{ asset('storage/' . $article->cover_image) }}"
                 alt="{{ $article->title }}"
                 class="w-full h-auto max-h-[520px] object-cover rounded-2xl"
                 loading="eager">
        </div>
    @endif

    <!-- Content Body -->
    <div class="glass-panel rounded-3xl p-8 sm:p-12 text-[#F5F7F5] text-base sm:text-lg leading-relaxed space-y-5 mb-12 border border-white/10 shadow-lg">
        {!! nl2br(e($article->content)) !!}
    </div>

    <!-- Tags if available -->
    @if (!empty($article->tags))
        <div class="mb-12 flex flex-wrap items-center gap-2">
            <span class="text-xs font-mono text-[#A0ADA5] mr-2">TOPIK TERKAIT:</span>
            @foreach (explode(',', $article->tags) as $tag)
                @if (trim($tag))
                    <a href="{{ route('articles.index', ['tag' => trim($tag)]) }}" class="px-3 py-1 rounded-xl text-xs font-mono bg-white/[0.04] text-[#A0ADA5] hover:text-[#34D399] border border-white/5 transition-colors">
                        #{{ trim($tag) }}
                    </a>
                @endif
            @endforeach
        </div>
    @endif

    <!-- Related Articles -->
    @if (isset($relatedArticles) && $relatedArticles->isNotEmpty())
        <div class="border-t border-white/10 pt-12 mb-16">
            <h3 class="text-xl font-bold text-white mb-6">Artikel Terkait Lainnya</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($relatedArticles as $relArticle)
                    <div class="glass-panel rounded-2xl p-5 border border-white/10 hover:border-[#10B981]/40 transition-all flex flex-col justify-between">
                        <div>
                            @if (!empty($relArticle->cover_image))
                                <div class="overflow-hidden rounded-xl aspect-[16/9] bg-[#080D0B] mb-3">
                                    <img src="{{ asset('storage/' . $relArticle->cover_image) }}" alt="{{ $relArticle->title }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <span class="text-[10px] font-mono text-[#34D399] block mb-1">
                                {{ optional($relArticle->published_at)->format('d M Y') ?? 'Terbaru' }}
                            </span>
                            <h4 class="text-sm font-bold text-white leading-snug mb-2">
                                <a href="{{ route('articles.show', $relArticle->slug) }}" class="hover:text-[#34D399]">
                                    {{ $relArticle->title }}
                                </a>
                            </h4>
                        </div>
                        <a href="{{ route('articles.show', $relArticle->slug) }}" class="text-xs font-mono text-[#10B981] hover:underline mt-3">
                            Baca Artikel &rarr;
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Bottom Footer Navigation -->
    <div class="pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 font-mono text-sm">
        <a href="/artikel" class="font-semibold text-[#34D399] hover:underline">
            &larr; Lihat artikel lainnya
        </a>
        <a href="{{ route('contact.index') }}" class="btn-emerald inline-flex items-center justify-center min-h-[44px] px-6 py-2.5 font-semibold text-white rounded-xl focus-visible:ring-2 focus-visible:ring-[#10B981]">
            Diskusikan proyek Anda
        </a>
    </div>
</article>
@endsection
