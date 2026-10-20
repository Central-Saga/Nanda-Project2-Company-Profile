@extends('layouts.public')

@section('seo')
    <x-seo-meta
        title="Portofolio Proyek & Studi Kasus Digital"
        description="Eksplorasi kumpulan proyek aplikasi web, aplikasi mobile, desain antarmuka UI/UX, dan transformasi sistem digital oleh PT. Central Saga Mandala."
    />
@endsection

@section('content')
    <!-- Header Hero -->
    <section class="relative pt-16 pb-16 md:pt-20 md:pb-20 overflow-hidden bg-ambient-mesh border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399] mb-4">
                <span class="text-[#10B981]">&bull;</span>
                <span>PORTOFOLIO &amp; REKAM JEJAK</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white mb-4">
                Karya &amp; Studi Kasus Nyata
            </h1>
            <p class="text-base sm:text-lg text-[#A0ADA5] max-w-2xl mx-auto">
                Setiap proyek merupakan dedikasi terhadap performa, keamanan, dan pengalaman pengguna berkelas dunia.
            </p>
        </div>
    </section>

    <!-- Filters & Search Toolbar -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-6">
        <div class="glass-panel rounded-2xl p-4 sm:p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 border border-white/10">
            <!-- Category Filter Tabs -->
            <div class="flex items-center space-x-2 overflow-x-auto pb-2 md:pb-0 font-mono text-xs">
                <a href="{{ route('projects.index') }}"
                   class="px-4 py-2 rounded-xl transition-all whitespace-nowrap {{ !request('category') || request('category') === 'all' ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white glass-pill' }}">
                    Semua ({{ $projects->total() }})
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('projects.index', ['category' => $cat, 'q' => request('q')]) }}"
                       class="px-4 py-2 rounded-xl transition-all whitespace-nowrap {{ request('category') === $cat ? 'bg-[#10B981] text-[#080D0B] font-bold shadow-md' : 'text-[#A0ADA5] hover:text-white glass-pill' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('projects.index') }}" class="flex items-center space-x-2 w-full md:w-auto">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="relative w-full md:w-64">
                    <input type="text"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="Cari proyek / klien..."
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
    </section>

    <!-- Projects Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @if ($projects->isEmpty())
            <div class="glass-panel rounded-3xl p-16 text-center border-dashed border-white/20">
                <p class="text-base text-[#A0ADA5] font-mono mb-4">
                    Tidak ada proyek yang sesuai dengan kriteria pencarian Anda.
                </p>
                <a href="{{ route('projects.index') }}" class="text-xs font-mono text-[#34D399] hover:underline">
                    Reset Filter Pencarian &rarr;
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($projects as $project)
                    <article class="glass-panel rounded-3xl p-6 sm:p-7 flex flex-col justify-between group border border-white/10 hover:border-[#10B981]/50 transition-all shadow-lg hover:shadow-[0_20px_45px_rgba(16,185,129,0.12)]">
                        <div>
                            @if (!empty($project->thumbnail))
                                <div class="mb-5 overflow-hidden rounded-2xl bg-[#080D0B] border border-white/10 aspect-[16/10] relative">
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}"
                                         alt="{{ $project->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                         loading="lazy">
                                    <div class="absolute top-3 left-3">
                                        <span class="px-2.5 py-1 rounded-lg text-[11px] font-mono font-semibold bg-[#080D0B]/85 text-[#34D399] border border-white/10 backdrop-blur-md">
                                            {{ $project->category }}
                                        </span>
                                    </div>
                                    @if ($project->is_featured)
                                        <div class="absolute top-3 right-3">
                                            <span class="px-2.5 py-1 rounded-lg text-[10px] font-mono font-bold bg-[#10B981] text-[#080D0B]">
                                                FEATURED
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="flex items-center justify-between text-xs font-mono text-[#A0ADA5] mb-2.5">
                                <span>{{ $project->client ?? 'Klien Mitra' }}</span>
                                @if (!empty($project->completion_date))
                                    <span>{{ $project->completion_date }}</span>
                                @endif
                            </div>

                            <h2 class="text-xl font-bold text-white mb-2.5 group-hover:text-[#34D399] transition-colors leading-snug">
                                <a href="{{ route('projects.show', $project->slug) }}">
                                    {{ $project->title }}
                                </a>
                            </h2>

                            <p class="text-xs sm:text-sm text-[#A0ADA5] leading-relaxed mb-5">
                                {{ Str::limit($project->description, 140) }}
                            </p>

                            @if (!empty($project->tech_stack) && is_array($project->tech_stack))
                                <div class="flex flex-wrap gap-1.5 mb-5">
                                    @foreach (array_slice($project->tech_stack, 0, 4) as $stack)
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-mono bg-white/[0.04] text-[#A0ADA5] border border-white/5">
                                            {{ $stack }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono">
                            <a href="{{ route('projects.show', $project->slug) }}" class="inline-flex items-center text-[#10B981] group-hover:text-[#34D399] font-semibold">
                                Pelajari Detail &rarr;
                            </a>
                            @if (!empty($project->external_url))
                                <a href="{{ $project->external_url }}" target="_blank" rel="noopener noreferrer" class="text-[#A0ADA5] hover:text-white underline">
                                    Live URL &nearr;
                                </a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $projects->links() }}
            </div>
        @endif
    </section>
@endsection

