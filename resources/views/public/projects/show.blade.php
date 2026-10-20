@extends('layouts.public')

@section('seo')
    <x-seo-meta
        :title="$project->title . ' - Studi Kasus Portofolio'"
        :description="Str::limit($project->description, 155)"
        :og-image="$project->thumbnail"
    />
@endsection

@section('content')
<article class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
    <!-- Back Link -->
    <div class="mb-8">
        <a href="{{ route('projects.index') }}" class="inline-flex items-center text-xs font-mono font-semibold text-[#A0ADA5] hover:text-[#34D399] transition-colors focus-visible:ring-2 focus-visible:ring-[#10B981] rounded-lg">
            &larr; KEMBALI KE PORTOFOLIO
        </a>
    </div>

    <!-- Project Header -->
    <div class="border-l-2 border-[#10B981] pl-6 mb-8">
        <div class="inline-flex items-center space-x-2 text-xs font-mono text-[#34D399] font-semibold mb-2">
            <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
            <span>STUDI KASUS &bull; {{ strtoupper($project->category) }}</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white mt-1">
            {{ $project->title }}
        </h1>
    </div>

    <!-- Metadata Grid -->
    <div class="glass-panel rounded-2xl p-6 mb-10 grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs font-mono border border-white/10">
        <div>
            <span class="text-[#A0ADA5] block mb-1">KLIEN</span>
            <span class="text-white font-bold">{{ $project->client ?? 'Mitra Strategis' }}</span>
        </div>
        <div>
            <span class="text-[#A0ADA5] block mb-1">WAKTU SELESAI</span>
            <span class="text-white font-bold">{{ $project->completion_date ?? 'Selesai' }}</span>
        </div>
        <div>
            <span class="text-[#A0ADA5] block mb-1">KATEGORI</span>
            <span class="text-[#34D399] font-bold">{{ $project->category }}</span>
        </div>
        <div>
            <span class="text-[#A0ADA5] block mb-1">TAUTAN SISTEM</span>
            @if (!empty($project->external_url))
                <a href="{{ $project->external_url }}" target="_blank" rel="noopener noreferrer" class="text-[#10B981] hover:underline font-bold flex items-center space-x-1">
                    <span>Buka Tautan</span>
                    <span>&nearr;</span>
                </a>
            @else
                <span class="text-[#A0ADA5]">Internal / Confidential</span>
            @endif
        </div>
    </div>

    <!-- Main Thumbnail -->
    @if (!empty($project->thumbnail))
        <div class="mb-12 overflow-hidden rounded-3xl border border-white/10 bg-[#101713] p-2 glass-panel shadow-2xl">
            <img src="{{ asset('storage/' . $project->thumbnail) }}"
                 alt="{{ $project->title }}"
                 class="w-full h-auto max-h-[550px] object-cover rounded-2xl"
                 loading="eager">
        </div>
    @endif

    <!-- Content Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 mb-16">
        <!-- Main Case Study Content (8 cols) -->
        <div class="lg:col-span-8 space-y-8">
            <!-- Ringkasan Proyek -->
            <div class="glass-panel rounded-3xl p-8 sm:p-10 border border-white/10">
                <h2 class="text-xl font-bold text-white mb-4">Ikhtisar &amp; Ringkasan Proyek</h2>
                <p class="text-base sm:text-lg text-[#A0ADA5] leading-relaxed">
                    {{ $project->description }}
                </p>
            </div>

            <!-- Detail Studi Kasus -->
            @if (!empty($project->content))
                <div class="glass-panel rounded-3xl p-8 sm:p-10 border border-white/10 text-[#F5F7F5] space-y-4 leading-relaxed text-sm sm:text-base">
                    <h3 class="text-xl font-bold text-white mb-2">Solusi &amp; Implementasi Teknis</h3>
                    <div class="space-y-4 text-[#A0ADA5]">
                        {!! nl2br(e($project->content)) !!}
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar Specs (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Tech Stack Box -->
            @if (!empty($project->tech_stack) && is_array($project->tech_stack))
                <div class="glass-panel rounded-3xl p-6 border border-white/10">
                    <h4 class="text-xs uppercase font-mono font-semibold text-[#34D399] tracking-wider mb-4">
                        TEKNOLOGI YANG DIGUNAKAN
                    </h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($project->tech_stack as $stack)
                            <span class="px-3 py-1.5 rounded-xl text-xs font-mono bg-white/[0.05] text-white border border-white/10">
                                {{ $stack }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quick Inquiry Card -->
            <div class="glass-panel rounded-3xl p-6 border border-white/10">
                <h4 class="text-xs uppercase font-mono font-semibold text-[#34D399] tracking-wider mb-2">
                    KEMBANGKAN SISTEM SERUPA
                </h4>
                <p class="text-xs text-[#A0ADA5] mb-5 leading-relaxed">
                    Tertarik membangun solusi seperti {{ $project->title }} untuk bisnis atau institusi Anda?
                </p>
                <a href="{{ route('contact.index') }}?service={{ urlencode($project->category) }}" class="btn-emerald w-full inline-flex items-center justify-center min-h-[44px] px-4 py-2.5 text-xs font-semibold rounded-xl text-center">
                    Konsultasikan Proyek &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Related Projects -->
    @if (isset($relatedProjects) && $relatedProjects->isNotEmpty())
        <div class="border-t border-white/10 pt-16 mb-16">
            <h3 class="text-2xl font-bold text-white mb-8">Studi Kasus Lainnya di Kategori Serupa</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($relatedProjects as $rel)
                    <article class="glass-panel rounded-2xl p-5 border border-white/10 hover:border-[#10B981]/50 transition-all flex flex-col justify-between">
                        <div>
                            @if (!empty($rel->thumbnail))
                                <div class="overflow-hidden rounded-xl aspect-[16/10] bg-[#080D0B] mb-4">
                                    <img src="{{ asset('storage/' . $rel->thumbnail) }}" alt="{{ $rel->title }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <span class="text-[10px] font-mono text-[#34D399] block mb-1 uppercase">{{ $rel->category }}</span>
                            <h4 class="text-base font-bold text-white mb-2">
                                <a href="{{ route('projects.show', $rel->slug) }}" class="hover:text-[#34D399]">
                                    {{ $rel->title }}
                                </a>
                            </h4>
                            <p class="text-xs text-[#A0ADA5] line-clamp-2 mb-4">
                                {{ $rel->description }}
                            </p>
                        </div>
                        <a href="{{ route('projects.show', $rel->slug) }}" class="text-xs font-mono text-[#10B981] hover:underline">
                            Lihat Rincian &rarr;
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    @endif
</article>
@endsection

