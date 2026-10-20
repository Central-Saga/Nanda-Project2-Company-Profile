@extends('layouts.admin')

@section('title', 'Kelola Proyek Portofolio')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-2 border-[#10B981] pl-4">
        <div>
            <span class="text-[11px] font-mono text-[#34D399] tracking-wider uppercase block">
                KONTEN PUBLIK
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                Proyek Portofolio
            </h1>
            <p class="text-xs sm:text-sm text-[#A0ADA5] mt-1 font-mono">
                Kelola daftar studi kasus, showcase sistem digital, dan portofolio klien.
            </p>
        </div>
        <div>
            <a href="{{ route('admin.proyek.create') }}" class="btn-emerald inline-flex items-center px-5 py-2.5 text-xs font-mono font-semibold rounded-xl">
                + Tambah Proyek Baru
            </a>
        </div>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="glass-panel rounded-2xl p-4 flex flex-col md:flex-row md:items-center justify-between gap-4 border border-white/10">
        <div class="flex items-center space-x-2 overflow-x-auto font-mono text-xs pb-2 md:pb-0">
            <a href="{{ route('admin.proyek.index') }}"
               class="px-3.5 py-1.5 rounded-xl transition-all whitespace-nowrap {{ !request('category') || request('category') === 'all' ? 'bg-[#10B981] text-[#080D0B] font-bold' : 'text-[#A0ADA5] hover:text-white glass-pill' }}">
                Semua ({{ $projects->total() }})
            </a>
            @foreach ($categories as $cat)
                <a href="{{ route('admin.proyek.index', ['category' => $cat, 'q' => request('q')]) }}"
                   class="px-3.5 py-1.5 rounded-xl transition-all whitespace-nowrap {{ request('category') === $cat ? 'bg-[#10B981] text-[#080D0B] font-bold' : 'text-[#A0ADA5] hover:text-white glass-pill' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('admin.proyek.index') }}" class="flex items-center space-x-2 w-full md:w-auto">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <input type="text"
                   name="q"
                   value="{{ request('q') }}"
                   placeholder="Cari proyek / klien..."
                   class="px-3.5 py-1.5 text-xs bg-black/40 border border-white/10 rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none w-full md:w-56 font-mono">
            <button type="submit" class="px-3 py-1.5 text-xs font-mono font-medium text-white bg-white/10 hover:bg-white/20 rounded-xl transition-colors">
                Cari
            </button>
        </form>
    </div>

    <!-- Table List -->
    <div class="glass-panel rounded-3xl p-6 shadow-xl border border-white/10">
        @if ($projects->isEmpty())
            <div class="text-center py-12 text-xs font-mono text-[#A0ADA5]">
                Belum ada proyek yang terdaftar.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs font-mono text-[#F5F7F5]">
                    <thead class="border-b border-white/10 text-[#A0ADA5] uppercase tracking-wider">
                        <tr>
                            <th class="py-3 px-3">Thumbnail</th>
                            <th class="py-3 px-3">Judul &amp; Klien</th>
                            <th class="py-3 px-3">Kategori</th>
                            <th class="py-3 px-3">Tech Stack</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @foreach ($projects as $proj)
                            <tr class="hover:bg-white/[0.03] transition-colors">
                                <td class="py-3 px-3 w-20">
                                    @if ($proj->thumbnail)
                                        <img src="{{ asset('storage/' . $proj->thumbnail) }}" alt="{{ $proj->title }}" class="w-16 h-10 object-cover rounded-lg border border-white/10">
                                    @else
                                        <div class="w-16 h-10 rounded-lg bg-[#101713] border border-white/5 flex items-center justify-center text-[10px] text-[#A0ADA5]">
                                            No img
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-3">
                                    <span class="font-bold text-white text-sm block">{{ $proj->title }}</span>
                                    <span class="text-[#A0ADA5] text-[11px] block">{{ $proj->client ?: 'Internal' }} &bull; {{ $proj->completion_date ?: '-' }}</span>
                                </td>
                                <td class="py-3 px-3">
                                    <span class="px-2 py-0.5 rounded-md bg-white/[0.05] text-[#34D399] border border-white/10 text-[11px]">
                                        {{ $proj->category }}
                                    </span>
                                </td>
                                <td class="py-3 px-3">
                                    @if (!empty($proj->tech_stack) && is_array($proj->tech_stack))
                                        <div class="flex flex-wrap gap-1 max-w-xs">
                                            @foreach (array_slice($proj->tech_stack, 0, 3) as $st)
                                                <span class="text-[10px] text-[#A0ADA5] bg-white/[0.03] px-1.5 py-0.5 rounded">
                                                    {{ $st }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-[#A0ADA5]">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3">
                                    <div class="space-y-1">
                                        @if ($proj->is_published)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#10B981]/20 text-[#34D399] border border-[#10B981]/40 block w-max">
                                                PUBLISHED
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-yellow-500/20 text-yellow-400 border border-yellow-500/40 block w-max">
                                                DRAFT
                                            </span>
                                        @endif

                                        @if ($proj->is_featured)
                                            <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-purple-500/20 text-purple-300 border border-purple-500/40 block w-max">
                                                FEATURED
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-3 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('projects.show', $proj->slug) }}" target="_blank" class="px-2.5 py-1 rounded-lg text-xs text-[#A0ADA5] hover:text-white hover:bg-white/5 border border-white/10" title="Pratinjau Publik">
                                            Web &nearr;
                                        </a>
                                        <a href="{{ route('admin.proyek.edit', $proj->id) }}" class="px-2.5 py-1 rounded-lg text-xs text-[#34D399] hover:bg-[#34D399]/10 border border-[#34D399]/30">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.proyek.destroy', $proj->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 rounded-lg text-xs text-[#EF4444] hover:bg-[#EF4444]/10 border border-[#EF4444]/30">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 pt-4 border-t border-white/10">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

