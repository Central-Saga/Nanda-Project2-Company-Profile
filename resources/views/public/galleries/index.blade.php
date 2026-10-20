@extends('layouts.public')

@section('seo')
    <x-seo-meta title="Portofolio Galeri" />
@endsection

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
    <!-- Header -->
    <div class="border-l-2 border-[#10B981] pl-6 mb-12">
        <div class="inline-flex items-center space-x-2 text-xs font-mono text-[#34D399] font-semibold mb-2">
            <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
            <span>PORTOFOLIO LENGKAP</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mt-1">
            Galeri Portofolio
        </h1>
        <p class="text-sm sm:text-base text-[#A0ADA5] mt-2 max-w-xl">
            Seluruh dokumentasi proyek, desain visual, dan hasil implementasi aplikasi {{ $siteProfile->company_name ?? '' }}.
        </p>
    </div>

    <!-- Gallery Grid -->
    @if ($galleries->isEmpty())
        <div class="glass-panel p-12 text-center rounded-2xl border-dashed border-white/20">
            <p class="text-sm text-[#A0ADA5] font-mono">
                Belum ada foto portofolio yang ditampilkan saat ini.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($galleries as $gallery)
                <div class="group glass-panel rounded-2xl p-3.5 overflow-hidden shadow-sm transition-all border border-white/10">
                    <div class="relative overflow-hidden rounded-xl bg-[#080D0B] aspect-[4/3] border border-white/5">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}"
                             alt="{{ $gallery->title ?? 'Portofolio' }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 cursor-pointer"
                             loading="lazy"
                             onclick="openLightbox('{{ asset('storage/' . $gallery->image_path) }}', '{{ addslashes($gallery->title ?? 'Portofolio') }}')">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none flex items-end p-4">
                            <span class="text-xs font-mono text-[#34D399] font-semibold">KLIK UNTUK MEMPERBESAR</span>
                        </div>
                    </div>
                    @if (!empty($gallery->title))
                        <div class="pt-3 px-1 flex items-center justify-between">
                            <h2 class="text-sm font-semibold text-[#F5F7F5] truncate group-hover:text-[#34D399] transition-colors">
                                {{ $gallery->title }}
                            </h2>
                            <span class="text-[10px] font-mono text-[#A0ADA5] uppercase">LIHAT</span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</section>

<!-- Accessible Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-50 bg-[#080D0B]/95 hidden flex items-center justify-center p-4 backdrop-blur-md" onclick="closeLightbox(event)">
    <div class="relative max-w-4xl max-h-[90vh] glass-panel rounded-2xl p-3 flex flex-col items-center shadow-2xl border border-white/15">
        <button type="button"
                onclick="closeLightboxDirect()"
                class="absolute -top-10 right-0 text-[#A0ADA5] hover:text-[#34D399] text-xs font-mono font-semibold p-2 focus:outline-none focus:ring-2 focus:ring-[#10B981] min-h-[44px] min-w-[44px] flex items-center justify-center"
                aria-label="Tutup pratinjau gambar">
            ✕ TUTUP
        </button>
        <img id="lightbox-img" src="" alt="Pratinjau Galeri" class="max-h-[80vh] w-auto object-contain rounded-xl">
        <p id="lightbox-caption" class="text-xs text-[#A0ADA5] mt-2 py-1 text-center font-mono font-medium"></p>
    </div>
</div>

<script>
    function openLightbox(src, caption) {
        const modal = document.getElementById('lightbox');
        const img = document.getElementById('lightbox-img');
        const cap = document.getElementById('lightbox-caption');
        if (!modal || !img) return;

        img.src = src;
        cap.textContent = caption || '';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLightboxDirect() {
        const modal = document.getElementById('lightbox');
        if (!modal) return;
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    function closeLightbox(e) {
        if (e.target.id === 'lightbox') {
            closeLightboxDirect();
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightboxDirect();
        }
    });
</script>
@endsection
