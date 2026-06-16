<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Safari Tours - Adventure Awaits')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Discover amazing safari adventures in East Africa. Wildlife tours, cultural experiences, and unforgettable journeys await you.')">
    <meta name="keywords" content="@yield('meta_keywords', 'safari, tours, wildlife, Africa, adventure, travel, booking')">
    <link rel="icon" type="image/png" href="{{ asset('images/browserlogo.jpeg') }}">

    {{-- ============================================================
         SMART ROBOTS + CANONICAL
         Pages with query params (?page=, ?activity=, ?category= etc.)
         are marked noindex so Google does not index them.
         The canonical always strips the query string.
    ============================================================ --}}
    @php
        $hasQueryParams = request()->hasAny([
            'page', 'activity', 'category', 'tag', 'filter', 'search', 'sort', 'q'
        ]);
        $baseUrl = url(request()->path());
    @endphp

    @if($hasQueryParams)
        <meta name="robots" content="noindex, follow">
    @else
        <meta name="robots" content="index, follow">
    @endif

    <link rel="canonical" href="@yield('canonical', $baseUrl)" />
    <link rel="alternate" hreflang="en" href="@yield('canonical', $baseUrl)" />

    <!-- Open Graph Tags -->
    <meta property="og:title" content="@yield('og_title', 'Safari Tours - Adventure Awaits')">
    <meta property="og:description" content="@yield('og_description', 'Discover amazing safari adventures in East Africa.')">
    <meta property="og:image" content="@yield('og_image', asset('images/safari-og.jpg'))">
    <meta property="og:url" content="{{ $baseUrl }}">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Rwanda Budget Safaris')">
    <meta name="twitter:description" content="@yield('twitter_description')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/safari-og.jpg'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-lVDNHE2B.css') }}">
    <script type="module" src="{{ asset('build/assets/app-BLNZwArW.js') }}"></script>

    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">

    <!-- Navigation Component -->
    <x-navigation />

    <!-- Page Header Section -->
    @hasSection('page-header')
        @yield('page-header')
    @endif

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer Component -->
    <x-footer />

    <!-- Additional Scripts -->
    @stack('scripts')

</body>
</html>