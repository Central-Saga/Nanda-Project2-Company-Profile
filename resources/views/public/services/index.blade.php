@extends('layouts.public')

@section('seo')
    <x-seo-meta
        title="Layanan Rekayasa Perangkat Lunak & Desain Digital"
        description="Layanan lengkap PT. Central Saga Mandala mencakup Web Development, Mobile App, UI/UX Design, Cloud Infrastructure, dan IT Consulting."
    />
@endsection

@section('content')
    <!-- Header Hero -->
    <section class="relative pt-16 pb-16 md:pt-20 md:pb-20 overflow-hidden bg-ambient-mesh border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399] mb-4">
                <span class="text-[#10B981]">&bull;</span>
                <span>LAYANAN SPESIALISASI</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white mb-4">
                Solusi Digital &amp; Rekayasa Lunak
            </h1>
            <p class="text-base sm:text-lg text-[#A0ADA5] max-w-2xl mx-auto">
                Dari purwarupa antarmuka hingga arsitektur cloud berskala enterprise, kami menghadirkan kapabilitas teknologi yang disesuaikan dengan kebutuhan bisnis Anda.
            </p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        @if ($services->isEmpty())
            <div class="glass-panel rounded-2xl p-12 text-center border-dashed border-white/20">
                <p class="text-sm text-[#A0ADA5] font-mono">Belum ada layanan yang aktif saat ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                    <article class="glass-panel rounded-3xl p-7 sm:p-8 flex flex-col justify-between group border border-white/10 hover:border-[#10B981]/50 transition-all shadow-lg hover:shadow-[0_15px_35px_rgba(16,185,129,0.15)]">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <span class="font-mono text-xs font-bold text-[#34D399] px-3 py-1 glass-pill rounded-lg">
                                    0{{ $loop->iteration }}
                                </span>
                                @if ($service->is_featured)
                                    <span class="text-[11px] font-mono text-[#10B981] px-2.5 py-0.5 rounded-full bg-[#10B981]/15 border border-[#10B981]/30">
                                        UNGGULAN
                                    </span>
                                @endif
                            </div>

                            @if (!empty($service->image))
                                <div class="mb-6 overflow-hidden rounded-2xl bg-[#080D0B] border border-white/10 aspect-video">
                                    <img src="{{ asset('storage/' . $service->image) }}"
                                         alt="{{ $service->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                         loading="lazy">
                                </div>
                            @endif

                            <h2 class="text-2xl font-bold text-white mb-3 group-hover:text-[#34D399] transition-colors">
                                <a href="{{ route('services.show', $service->slug) }}">
                                    {{ $service->title }}
                                </a>
                            </h2>

                            <p class="text-sm text-[#A0ADA5] leading-relaxed mb-6">
                                {{ Str::limit($service->description, 170) }}
                            </p>

                            @if (!empty($service->benefits) && is_array($service->benefits))
                                <div class="mb-6 space-y-2 text-xs text-[#A0ADA5]">
                                    @foreach (array_slice($service->benefits, 0, 4) as $benefit)
                                        <div class="flex items-center space-x-2">
                                            <span class="text-[#34D399] font-bold">&check;</span>
                                            <span>{{ $benefit }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if (!empty($service->tech_stack) && is_array($service->tech_stack))
                                <div class="flex flex-wrap gap-1.5 mb-6">
                                    @foreach ($service->tech_stack as $stack)
                                        <span class="px-2.5 py-0.5 rounded-md text-[11px] font-mono bg-white/[0.04] text-[#A0ADA5] border border-white/5">
                                            {{ $stack }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="pt-5 border-t border-white/10 flex items-center justify-between text-xs font-mono">
                            <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center font-semibold text-[#10B981] hover:text-[#34D399] transition-colors">
                                Rincian &amp; Studi Kasus &rarr;
                            </a>
                            <a href="{{ route('contact.index') }}?service={{ urlencode($service->title) }}" class="text-[#A0ADA5] hover:text-white underline">
                                Konsultasi
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <!-- Bottom Consultation CTA -->
    <section class="border-t border-white/10 bg-[#060A08] py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h3 class="text-2xl sm:text-3xl font-extrabold text-white mb-3">
                Memiliki Kebutuhan Arsitektur Sistem Khusus?
            </h3>
            <p class="text-sm text-[#A0ADA5] mb-8 max-w-xl mx-auto">
                Diskusikan tantangan teknologi Anda bersama tim engineer dan desainer kami di Tabanan, Bali.
            </p>
            <a href="{{ route('contact.index') }}" class="btn-emerald inline-flex items-center px-8 py-3 text-sm font-semibold rounded-xl">
                Mulai Diskusi Proyek Anda &rarr;
            </a>
        </div>
    </section>
@endsection

