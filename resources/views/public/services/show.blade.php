@extends('layouts.public')

@section('seo')
    <x-seo-meta
        :title="$service->title . ' - Layanan PT. Central Saga Mandala'"
        :description="Str::limit($service->description, 155)"
        :og-image="$service->image"
    />
@endsection

@section('content')
<article class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
    <!-- Back Link -->
    <div class="mb-8">
        <a href="{{ route('services.index') }}" class="inline-flex items-center text-xs font-mono font-semibold text-[#A0ADA5] hover:text-[#34D399] transition-colors focus-visible:ring-2 focus-visible:ring-[#10B981] rounded-lg">
            &larr; KEMBALI KE SEMUA LAYANAN
        </a>
    </div>

    <!-- Section Header -->
    <div class="border-l-2 border-[#10B981] pl-6 mb-8">
        <div class="inline-flex items-center space-x-2 text-xs font-mono text-[#34D399] font-semibold mb-2">
            <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
            <span>SPESIFIKASI LAYANAN DIGITAL</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white mt-1">
            {{ $service->title }}
        </h1>
    </div>

    <!-- Image if exists -->
    @if (!empty($service->image))
        <div class="mb-10 overflow-hidden rounded-3xl border border-white/10 bg-[#101713] p-2 glass-panel shadow-2xl">
            <img src="{{ asset('storage/' . $service->image) }}"
                 alt="{{ $service->title }}"
                 class="w-full h-auto max-h-[500px] object-cover rounded-2xl"
                 loading="eager">
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12">
        <!-- Main Description (8 cols) -->
        <div class="lg:col-span-8 space-y-8">
            <div class="glass-panel rounded-3xl p-8 sm:p-10 text-[#F5F7F5] text-base sm:text-lg leading-relaxed space-y-4 border border-white/10">
                <h2 class="text-xl font-bold text-white mb-2">Deskripsi Layanan</h2>
                <div class="space-y-4 text-[#A0ADA5]">
                    {!! nl2br(e($service->description)) !!}
                </div>
            </div>

            <!-- Benefits / Keunggulan Layanan -->
            @if (!empty($service->benefits) && is_array($service->benefits))
                <div class="glass-panel rounded-3xl p-8 sm:p-10 border border-white/10">
                    <h3 class="text-lg font-bold text-white mb-6">Manfaat &amp; Keunggulan Strategis</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($service->benefits as $benefit)
                            <div class="flex items-start space-x-3 p-3.5 rounded-2xl bg-white/[0.02] border border-white/5">
                                <span class="w-5 h-5 rounded-full bg-[#10B981]/20 text-[#34D399] flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">&check;</span>
                                <span class="text-xs sm:text-sm text-[#F5F7F5]">{{ $benefit }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Tech Stack Card -->
            @if (!empty($service->tech_stack) && is_array($service->tech_stack))
                <div class="glass-panel rounded-3xl p-6 border border-white/10">
                    <h4 class="text-xs uppercase font-mono font-semibold text-[#34D399] tracking-wider mb-4">
                        TEKNOLOGI YANG DIGUNAKAN
                    </h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($service->tech_stack as $stack)
                            <span class="px-3 py-1 rounded-xl text-xs font-mono bg-white/[0.05] text-white border border-white/10">
                                {{ $stack }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Direct Contact Box -->
            <div class="glass-panel rounded-3xl p-6 border border-white/10">
                <h4 class="text-xs uppercase font-mono font-semibold text-[#34D399] tracking-wider mb-2">
                    KONSULTASI LANGSUNG
                </h4>
                <p class="text-xs text-[#A0ADA5] mb-4">
                    Punya ide proyek menggunakan {{ $service->title }}? Tim arsitek kami siap berdiskusi.
                </p>
                <a href="{{ route('contact.index') }}?service={{ urlencode($service->title) }}" class="btn-emerald w-full inline-flex items-center justify-center min-h-[44px] px-4 py-2.5 text-xs font-semibold rounded-xl text-center">
                    Mulai Konsultasi &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Related Projects Section -->
    @if (isset($relatedProjects) && $relatedProjects->isNotEmpty())
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-white mb-6">Proyek &amp; Implementasi Terkait</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($relatedProjects as $relProject)
                    <div class="glass-panel rounded-2xl p-5 border border-white/10 hover:border-[#10B981]/40 transition-all flex flex-col justify-between">
                        <div>
                            @if (!empty($relProject->thumbnail))
                                <div class="overflow-hidden rounded-xl aspect-video bg-[#080D0B] mb-4">
                                    <img src="{{ asset('storage/' . $relProject->thumbnail) }}" alt="{{ $relProject->title }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <span class="text-[10px] font-mono text-[#34D399] block mb-1 uppercase">{{ $relProject->category }}</span>
                            <h4 class="text-base font-bold text-white mb-2">
                                <a href="{{ route('projects.show', $relProject->slug) }}" class="hover:text-[#34D399]">
                                    {{ $relProject->title }}
                                </a>
                            </h4>
                            <p class="text-xs text-[#A0ADA5] line-clamp-2 mb-4">
                                {{ $relProject->description }}
                            </p>
                        </div>
                        <a href="{{ route('projects.show', $relProject->slug) }}" class="text-xs font-mono text-[#10B981] hover:underline">
                            Lihat Studi Kasus &rarr;
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Bottom CTA Card -->
    <div class="glass-panel rounded-3xl p-8 sm:p-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6 shadow-xl border border-white/10">
        <div>
            <span class="font-mono text-xs text-[#34D399] font-semibold block mb-1">
                INISIASI KOLABORASI
            </span>
            <h2 class="text-2xl font-bold text-white mb-2">
                Siap mewujudkan sistem digital Anda?
            </h2>
            <p class="text-sm text-[#A0ADA5]">
                Dapatkan estimasi arsitektur, estimasi biaya, dan penjadwalan pengerjaan yang transparan.
            </p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('contact.index') }}?service={{ urlencode($service->title) }}" class="btn-emerald inline-flex items-center justify-center min-h-[44px] px-8 py-3.5 text-sm font-semibold rounded-xl focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#10B981]">
                Diskusikan Proyek Anda
            </a>
        </div>
    </div>
</article>
@endsection
