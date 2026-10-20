@props([
    'title' => null,
    'description' => null,
    'ogType' => 'website',
    'ogImage' => null,
    'canonical' => null,
])

@php
    $siteProfile = \App\Models\SiteProfile::first();
    $companyName = $siteProfile->company_name ?? config('app.name');
    $tagline = $siteProfile->tagline ?? '';

    // Calculate full title: if title is explicitly provided, append company name.
    // Otherwise fallback to company_name | tagline (or just company_name if tagline empty).
    if ($title) {
        $pageTitle = $title . ' | ' . $companyName;
    } else {
        $pageTitle = $tagline ? ($companyName . ' | ' . $tagline) : $companyName;
    }

    $metaDescription = $description ?: ($tagline ?: 'Software House & Creative Agency di Bali.');
    $currentUrl = $canonical ?: url()->current();

    // Prepare og:image url if image exists
    $ogImageUrl = null;
    if ($ogImage) {
        $ogImageUrl = str_starts_with($ogImage, 'http') ? $ogImage : asset('storage/' . $ogImage);
    }
@endphp

<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
<link rel="canonical" href="{{ $currentUrl }}">

<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:url" content="{{ $currentUrl }}">
@if ($ogImageUrl)
<meta property="og:image" content="{{ $ogImageUrl }}">
@endif
<meta name="twitter:card" content="summary_large_image">

