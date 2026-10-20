@extends('layouts.public')

@section('seo')
    <title>Halaman Tidak Ditemukan | {{ $siteProfile->company_name ?? config('app.name') }}</title>
    <meta name="robots" content="noindex, follow">
@endsection

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32">
    <div class="border-l-2 border-[#10B981] pl-6 sm:pl-8">
        <span class="font-mono text-xs font-semibold tracking-wider text-[#34D399] uppercase flex items-center space-x-2">
            <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
            <span>404: TIDAK DITEMUKAN</span>
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-white mt-4 mb-4">
            Halaman ini tidak ada.
        </h1>
        <p class="text-base sm:text-lg text-[#A0ADA5] max-w-xl leading-relaxed mb-8">
            Coba kembali ke halaman utama untuk menemukan informasi yang Anda cari.
        </p>
        <div>
            <a href="/" class="btn-emerald inline-flex items-center justify-center min-h-[44px] px-8 py-3.5 text-sm font-semibold rounded-xl focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#10B981]">
                Kembali ke halaman utama
            </a>
        </div>
    </div>
</section>
@endsection
