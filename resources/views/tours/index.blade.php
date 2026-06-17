@extends('layouts.app')

{{-- ============================================================
     SEO META
     ============================================================ --}}
@section('title', 'Uganda & Rwanda Safari Packages 2026-2030 | Budget Gorilla Trekking & Wildlife Tours')
@section('meta_description', 'Browse affordable Uganda and Rwanda safari packages from $1,300. Gorilla trekking Bwindi, chimp tracking Kibale, Nile game drives Murchison Falls. All-inclusive, small groups, local guides.')
@section('meta_keywords', 'Uganda Rwanda safari packages 2026-2030, budget gorilla trekking packages, affordable Uganda safari, Bwindi trekking package, Kibale chimp tracking tour, Murchison Falls safari, Queen Elizabeth NP package, Rwanda Volcanoes safari, small group Uganda safari, all-inclusive safari East Africa')
@section('canonical', 'https://rwandabudgetsafaris.com/tours')

@section('og_title', 'Uganda & Rwanda Safari Packages 2026-2030 — All-Inclusive, Budget to Luxury')
@section('og_description', 'Gorilla trekking, chimp tracking, Big Five game drives and Nile cruises across Uganda and Rwanda. Packages from $1,300 with permits, lodges and local guides included.')
@section('og_image', asset('images/BIG FIVE.jpg'))
@section('og_type', 'website')


@section('page-header')
<header id="tours-hero" class="relative w-full overflow-hidden" style="height:460px;">

    <img id="hero-img"
         src="{{ $headerImage ?? asset('images/GORILLA.jpg') }}"
         alt="Uganda and Rwanda safari packages 2026 — gorilla trekking, game drives and wildlife tours"
         class="absolute inset-0 w-full h-full object-cover object-center"
         style="transform:translateY(0); will-change:transform;"
         onerror="this.style.display:'none'">

    <div class="absolute inset-0"
         style="background:linear-gradient(to bottom, rgba(5,20,10,.45) 0%, rgba(5,20,10,.72) 100%);"></div>

    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4 sm:px-6">

        <span class="inline-block border border-green-400/60 bg-green-900/40 text-green-300
                     text-xs font-bold tracking-[.2em] uppercase px-5 py-2 rounded-full mb-5">
            Kampala-Based · Est. 2010 · No Middlemen
        </span>

        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white
                   leading-tight mb-4 drop-shadow-lg max-w-4xl">
            Uganda &amp; Rwanda Safari Packages
            <span class="text-green-400">2026 -20230</span>
        </h1>

        <p class="text-white/80 text-sm sm:text-base md:text-lg max-w-2xl mb-6 leading-relaxed">
            Gorilla trekking · Chimp tracking · Nile game drives · Big Five safaris ·
            Birdwatching · Cultural experiences
        </p>

        <div class="flex flex-wrap justify-center gap-2 mb-6">
            <span class="bg-white/15 backdrop-blur-sm border border-white/20 text-white text-xs font-semibold px-4 py-1.5 rounded-full">
                From $1,300 / person
            </span>
            <span class="bg-white/15 backdrop-blur-sm border border-white/20 text-white text-xs font-semibold px-4 py-1.5 rounded-full">
                Gorilla Permits Included
            </span>
            <span class="bg-white/15 backdrop-blur-sm border border-white/20 text-white text-xs font-semibold px-4 py-1.5 rounded-full">
                Max 8 Per Group
            </span>
            <span class="bg-white/15 backdrop-blur-sm border border-white/20 text-white text-xs font-semibold px-4 py-1.5 rounded-full">
                Local UWA-Certified Guides
            </span>
        </div>

        <nav aria-label="Breadcrumb">
            <ol class="flex items-center gap-2 text-xs sm:text-sm text-white/50"
                itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('index') }}" itemprop="item" class="hover:text-white transition-colors">
                        <span itemprop="name">Home</span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="text-white/30">/</li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name" class="text-white/80 font-medium">Safari Packages</span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </nav>
    </div>
</header>
@endsection


@section('content')
<div class="w-full overflow-x-hidden">

    {{-- ════════════════════════════════════════════════════════
         INTRO + DESTINATION PILLS + WHY US
    ════════════════════════════════════════════════════════ --}}
    <section class="py-12 sm:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Intro copy --}}
            <div class="max-w-3xl mx-auto text-center mb-10">
                <span class="text-green-600 font-bold text-xs uppercase tracking-[.2em]">
                    Two Countries · One Booking
                </span>
                <h2 class="mt-3 text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 leading-tight">
                    Every Package Includes Permits,<br class="hidden sm:block"> Lodges, Meals &amp; Local Guides
                </h2>
                <p class="mt-4 text-gray-600 text-base sm:text-lg leading-relaxed">
                    Rwanda Budget Safaris is a Kampala-based operator  not an aggregator. We purchase
                    Uganda gorilla permits (<strong>$800 p/p</strong>) and Rwanda Volcanoes permits
                    (<strong>$1,500 p/p</strong>) directly from the authorities, employ our own guides and
                    run our own 4WD fleet. Browse our packages below, then
                    <a href="{{ route('contact') }}" class="text-green-600 font-semibold hover:underline">
                        contact us
                    </a>
                    to customise any itinerary to your dates and budget.
                </p>
            </div>

            {{-- Destination pills --}}
            <div class="flex flex-wrap justify-center gap-2 mb-10">
                @foreach([
                    'Bwindi Gorilla Trekking',
                    'Rwanda Volcanoes NP',
                    'Mgahinga Gorillas',
                    'Kibale Chimp Tracking',
                    'Queen Elizabeth NP',
                    'Murchison Falls',
                    'Kidepo Valley',
                    'Uganda Birding',
                ] as $dest)
                <span class="bg-green-50 border border-green-200 text-green-800 text-xs font-semibold
                             px-4 py-1.5 rounded-full">{{ $dest }}</span>
                @endforeach
            </div>

            {{-- Three pillars --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 bg-gray-50 rounded-2xl p-6 sm:p-8
                        border border-gray-100">

                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs mt-1 leading-relaxed">
                            We buy gorilla permits directly from UWA and RDB  no reseller fee added to your quote.
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">Our Own Guides &amp; Vehicles</p>
                        <p class="text-gray-500 text-xs mt-1 leading-relaxed">
                            UWA-certified guides and a maintained 4WD fleet — no subcontracting, no surprises on the road.
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 bg-orange-100 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">Itemised, Transparent Quotes</p>
                        <p class="text-gray-500 text-xs mt-1 leading-relaxed">
                            Every quote lists permit cost, lodge rate, meals, park fees and guide fee — line by line.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════
         STICKY FILTER BAR — logic untouched
    ════════════════════════════════════════════════════════ --}}
    <section id="tour-filters"
             class="py-4 sm:py-5 bg-white border-y border-gray-200 shadow-sm sticky z-40"
             style="top: var(--nav-height, 70px);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 sm:gap-3 mb-3 sm:mb-4">
                <div>
                    <h2 class="text-base sm:text-xl font-black text-gray-900 leading-tight">
                        All Safari Packages
                    </h2>
                    <p class="text-gray-400 text-xs mt-0.5">{{ $tours->total() }} packages available</p>
                </div>
                <button id="mobile-filter-toggle"
                        class="md:hidden inline-flex items-center gap-1.5 px-4 py-2 bg-green-600
                               text-white rounded-lg text-xs font-semibold self-start">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>
                    Filters
                </button>
            </div>

            <div id="filter-form-wrap" class="hidden md:block">
                <form id="filter-form" method="GET" action="{{ route('tours.index') }}#tour-filters"
                      class="flex flex-col gap-3 md:flex-row md:flex-wrap md:items-end">

                    @foreach([
                        ['name'=>'category',    'label'=>'Category',     'placeholder'=>'All Categories',  'items'=>$availableCategories,   'fmt'=>'ucfirst'],
                        ['name'=>'type',        'label'=>'Tour Type',    'placeholder'=>'All Types',        'items'=>$availableTypes,        'fmt'=>'ucfirst'],
                        ['name'=>'destination', 'label'=>'Destination',  'placeholder'=>'All Destinations', 'items'=>$availableDestinations, 'fmt'=>'none'],
                    ] as $f)
                    <div class="w-full md:flex-1 md:min-w-[120px]">
                        <label class="block text-xs font-medium text-gray-500 mb-1 md:hidden">{{ $f['label'] }}</label>
                        <select name="{{ $f['name'] }}"
                                class="tour-filter w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl
                                       focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
                            <option value="">{{ $f['placeholder'] }}</option>
                            @foreach($f['items'] as $item)
                                <option value="{{ $item }}" {{ request($f['name'])==$item ? 'selected' : '' }}>
                                    {{ $f['fmt']==='ucfirst' ? ucfirst($item) : $item }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endforeach

                    <div class="w-full md:flex-1 md:min-w-[120px]">
                        <label class="block text-xs font-medium text-gray-500 mb-1 md:hidden">Price Range</label>
                        <select name="price_range"
                                class="tour-filter w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl
                                       focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
                            <option value="">Any Price</option>
                            @if($priceRanges['min'] > 0 && $priceRanges['max'] > 0)
                                @php
                                    $step   = ($priceRanges['max'] - $priceRanges['min']) / 4;
                                    $ranges = [
                                        'low'      => [$priceRanges['min'],         $priceRanges['min']+$step],
                                        'mid-low'  => [$priceRanges['min']+$step,   $priceRanges['min']+$step*2],
                                        'mid-high' => [$priceRanges['min']+$step*2, $priceRanges['min']+$step*3],
                                        'high'     => [$priceRanges['min']+$step*3, $priceRanges['max']],
                                    ];
                                @endphp
                                @foreach($ranges as $key=>[$mn,$mx])
                                    <option value="{{ $key }}" {{ request('price_range')==$key ? 'selected' : '' }}>
                                        ${{ number_format($mn) }} – ${{ number_format($mx) }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="w-full md:flex-1 md:min-w-[120px]">
                        <label class="block text-xs font-medium text-gray-500 mb-1 md:hidden">Sort By</label>
                        <select name="sort"
                                class="tour-filter w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl
                                       focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
                            <option value="">Sort By</option>
                            @foreach([
                                'price_low'      => 'Price: Low to High',
                                'price_high'     => 'Price: High to Low',
                                'duration_short' => 'Duration: Short to Long',
                                'duration_long'  => 'Duration: Long to Short',
                                'newest'         => 'Newest First',
                                'title_az'       => 'Title: A–Z',
                                'title_za'       => 'Title: Z–A',
                            ] as $val=>$lbl)
                                <option value="{{ $val }}" {{ request('sort')==$val ? 'selected' : '' }}>{{ $lbl }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-2 md:hidden">
                        <button type="submit"
                                class="flex-1 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white
                                       rounded-xl text-sm font-semibold">
                            Apply Filters
                        </button>
                        @if(request()->hasAny(['category','type','destination','duration','price_range','sort']))
                            <a href="{{ route('tours.index') }}#tour-filters"
                               class="px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl text-sm font-semibold">
                                Clear
                            </a>
                        @endif
                    </div>

                    @if(request()->hasAny(['category','type','destination','duration','price_range','sort']))
                        <a href="{{ route('tours.index') }}#tour-filters"
                           class="hidden md:inline-flex items-center gap-1.5 px-3 py-2.5 bg-gray-100
                                  hover:bg-gray-200 text-gray-600 rounded-xl text-sm font-medium whitespace-nowrap">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Clear All
                        </a>
                    @endif
                </form>

                @if(request()->hasAny(['category','type','destination','duration','price_range','sort']))
                    <div class="mt-3 flex flex-wrap gap-2 items-center">
                        <span class="text-xs text-gray-400 font-semibold uppercase tracking-wide">Active:</span>
                        @if(request('category'))
                            <span class="inline-flex items-center bg-green-100 text-green-800 px-2.5 py-1 rounded-full text-xs font-medium">
                                {{ ucfirst(request('category')) }}
                                <a href="{{ request()->fullUrlWithQuery(['category'=>null]) }}#tour-filters" class="ml-1.5 font-bold opacity-60 hover:opacity-100">&times;</a>
                            </span>
                        @endif
                        @if(request('type'))
                            <span class="inline-flex items-center bg-blue-100 text-blue-800 px-2.5 py-1 rounded-full text-xs font-medium">
                                {{ ucfirst(request('type')) }}
                                <a href="{{ request()->fullUrlWithQuery(['type'=>null]) }}#tour-filters" class="ml-1.5 font-bold opacity-60 hover:opacity-100">&times;</a>
                            </span>
                        @endif
                        @if(request('destination'))
                            <span class="inline-flex items-center bg-purple-100 text-purple-800 px-2.5 py-1 rounded-full text-xs font-medium">
                                {{ request('destination') }}
                                <a href="{{ request()->fullUrlWithQuery(['destination'=>null]) }}#tour-filters" class="ml-1.5 font-bold opacity-60 hover:opacity-100">&times;</a>
                            </span>
                        @endif
                        @if(request('duration'))
                            <span class="inline-flex items-center bg-orange-100 text-orange-800 px-2.5 py-1 rounded-full text-xs font-medium">
                                {{ request('duration') }} {{ request('duration')==1 ? 'Day' : 'Days' }}
                                <a href="{{ request()->fullUrlWithQuery(['duration'=>null]) }}#tour-filters" class="ml-1.5 font-bold opacity-60 hover:opacity-100">&times;</a>
                            </span>
                        @endif
                        @if(request('price_range'))
                            <span class="inline-flex items-center bg-pink-100 text-pink-800 px-2.5 py-1 rounded-full text-xs font-medium">
                                {{ ucfirst(str_replace('-',' ',request('price_range'))) }}
                                <a href="{{ request()->fullUrlWithQuery(['price_range'=>null]) }}#tour-filters" class="ml-1.5 font-bold opacity-60 hover:opacity-100">&times;</a>
                            </span>
                        @endif
                        @if(request('sort'))
                            <span class="inline-flex items-center bg-gray-100 text-gray-700 px-2.5 py-1 rounded-full text-xs font-medium">
                                {{ ucfirst(str_replace('_',' ',request('sort'))) }}
                                <a href="{{ request()->fullUrlWithQuery(['sort'=>null]) }}#tour-filters" class="ml-1.5 font-bold opacity-60 hover:opacity-100">&times;</a>
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════
         TOUR CARDS — markup restyled, all PHP/routes untouched
    ════════════════════════════════════════════════════════ --}}
    <section id="tours-results" class="py-10 sm:py-14 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Mobile view toggle --}}
            <div class="md:hidden mb-5 flex justify-center">
                <div class="bg-white border border-gray-200 rounded-xl p-1 inline-flex shadow-sm">
                    <button id="grid-view"
                            class="px-4 py-2 rounded-lg text-xs font-bold bg-green-600 text-white transition-all">
                        Grid
                    </button>
                    <button id="horizontal-view"
                            class="px-4 py-2 rounded-lg text-xs font-bold text-gray-500 transition-all">
                        Swipe
                    </button>
                </div>
            </div>

            {{-- ── GRID VIEW ── --}}
            <div id="grid-container"
                 class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-7">

                @forelse($tours as $tour)
                <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden
                                hover:shadow-xl transition-all duration-300 group flex flex-col"
                         itemscope itemtype="https://schema.org/TouristTrip">

                    {{-- Image --}}
                    <div class="relative h-48 sm:h-56 overflow-hidden shrink-0">
                        @if($tour->featured_image)
                            <img src="{{ asset('storage/'.$tour->featured_image) }}"
                                 alt="{{ $tour->title }} — Uganda Rwanda safari package"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                 loading="lazy"
                                 itemprop="image">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-green-800 to-green-500
                                        flex items-center justify-center">
                                <svg class="w-14 h-14 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif

                        {{-- Badges --}}
                        <span class="absolute top-3 left-3 bg-green-600/90 backdrop-blur-sm
                                     text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wide">
                            {{ $tour->category ?? 'Safari' }}
                        </span>
                        <span class="absolute top-3 right-3 bg-black/50 backdrop-blur-sm
                                     text-white text-[10px] font-bold px-2.5 py-1 rounded-full">
                            {{ $tour->itineraries->count() ?: 'Multi' }}
                            {{ $tour->itineraries->count()==1 ? 'Day' : 'Days' }}
                        </span>
                        @if($tour->type)
                            <span class="absolute bottom-3 left-3 bg-blue-600/80 backdrop-blur-sm
                                         text-white text-[10px] font-bold px-2.5 py-1 rounded-full">
                                {{ $tour->type }}
                            </span>
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="p-4 sm:p-5 flex flex-col flex-1">

                        <h3 class="font-black text-gray-900 text-sm sm:text-base leading-snug mb-2 line-clamp-2"
                            itemprop="name">
                            {{ $tour->title }}
                        </h3>

                        <p class="text-gray-500 text-xs sm:text-sm leading-relaxed line-clamp-2 mb-3 flex-1"
                           itemprop="description">
                            {{ Str::limit($tour->description, 110) }}
                        </p>

                        <div class="flex items-center gap-1.5 mb-4 text-xs text-gray-400">
                            <svg class="w-3.5 h-3.5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="line-clamp-1" itemprop="touristType">
                                {{ $tour->destinations ?: 'Uganda & Rwanda, East Africa' }}
                            </span>
                        </div>

                        <div class="flex items-end justify-between mb-4"
                             itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                            <div>
                                @if($tour->prices && $tour->prices->count() > 0)
                                    @php $minPrice = $tour->prices->min('price'); @endphp
                                    <meta itemprop="priceCurrency" content="USD">
                                    <meta itemprop="price" content="{{ $minPrice }}">
                                    <meta itemprop="availability" content="https://schema.org/InStock">
                                    <p class="text-[10px] text-gray-400 mb-0.5">From</p>
                                    <p class="text-xl sm:text-2xl font-black text-green-600 leading-none">
                                        ${{ number_format($minPrice) }}
                                        <span class="text-xs font-normal text-gray-400">/ person</span>
                                    </p>
                                @else
                                    <p class="text-green-600 font-bold text-sm">Ask for pricing</p>
                                @endif
                            </div>
                            <div class="flex items-center gap-1 text-xs text-gray-400">
                                <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                4.9
                            </div>
                        </div>

                        <div class="flex gap-2 mt-auto">
                            <a href="{{ route('tours.show', $tour->slug) }}"
                               class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center
                                      py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-colors"
                               itemprop="url">
                                View Package
                            </a>
                            <button onclick="quickBook('{{ $tour->slug }}')"
                                    title="Book {{ $tour->title }}"
                                    class="bg-gray-900 hover:bg-gray-700 text-white px-3 py-2.5
                                           rounded-xl transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </article>

                @empty
                <div class="col-span-full text-center py-16">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-500 mb-2">No Packages Found</h3>
                    @if(request()->hasAny(['category','type','destination','duration','price_range','sort']))
                        <p class="text-gray-400 text-sm mb-5">
                            Try removing a filter to see more Uganda and Rwanda safari packages.
                        </p>
                        <a href="{{ route('tours.index') }}#tour-filters"
                           class="bg-green-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm
                                  hover:bg-green-700 transition-colors">
                            Clear Filters
                        </a>
                    @else
                        <p class="text-gray-400 text-sm">New packages are added regularly — check back soon.</p>
                    @endif
                </div>
                @endforelse
            </div>

            {{-- ── SLIDE / SWIPE VIEW (mobile) ── --}}
            <div id="horizontal-container" class="hidden">
                <div class="flex gap-4 overflow-x-auto pb-4 snap-x snap-mandatory
                            scrollbar-hide -mx-4 px-4">
                    @forelse($tours as $tour)
                    <div class="flex-shrink-0 w-60 snap-start bg-white rounded-2xl
                                shadow-sm border border-gray-100 overflow-hidden">
                        <div class="relative h-36 overflow-hidden">
                            @if($tour->featured_image)
                                <img src="{{ asset('storage/'.$tour->featured_image) }}"
                                     alt="{{ $tour->title }}"
                                     class="w-full h-full object-cover" loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-green-800 to-green-500
                                            flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <span class="absolute top-2 left-2 bg-green-600/90 text-white
                                         text-[10px] font-bold px-2 py-0.5 rounded-full">
                                {{ $tour->category ?? 'Safari' }}
                            </span>
                        </div>
                        <div class="p-3">
                            <h3 class="text-xs font-bold text-gray-900 mb-1.5 line-clamp-2 leading-snug">
                                {{ $tour->title }}
                            </h3>
                            <div class="flex items-center gap-1 mb-2 text-[10px] text-gray-400">
                                <svg class="w-3 h-3 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                <span class="line-clamp-1">{{ $tour->destinations ?: 'Uganda & Rwanda' }}</span>
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                @if($tour->prices && $tour->prices->count() > 0)
                                    @php $minPrice = $tour->prices->min('price'); @endphp
                                    <p class="text-sm font-black text-green-600">
                                        ${{ number_format($minPrice) }}<span class="text-[10px] font-normal text-gray-400"> /pp</span>
                                    </p>
                                @else
                                    <p class="text-green-600 text-xs font-bold">Ask for price</p>
                                @endif
                                <div class="flex items-center gap-0.5 text-[10px] text-gray-400">
                                    <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    4.9
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('tours.show', $tour->slug) }}"
                                   class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center
                                          py-2 rounded-xl text-[11px] font-bold transition-colors">
                                    View
                                </a>
                                <button onclick="quickBook('{{ $tour->slug }}')"
                                        class="bg-gray-900 hover:bg-gray-700 text-white px-2.5 py-2
                                               rounded-xl transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                        <p class="text-gray-400 text-sm py-10 text-center w-full">No packages available.</p>
                    @endforelse
                </div>
            </div>

            {{-- Pagination — untouched --}}
            @if($tours->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $tours->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════
         ABOUT / SEO COPY
    ════════════════════════════════════════════════════════ --}}
    <section class="py-14 sm:py-20 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-8">
                <span class="text-green-600 font-bold text-xs uppercase tracking-[.2em]">About These Packages</span>
                <h2 class="mt-2 text-2xl sm:text-3xl font-black text-gray-900">
                    What You're Actually Booking
                </h2>
            </div>

            <div class="prose prose-sm sm:prose-base text-gray-600 max-w-none space-y-4 leading-relaxed">
                <p>
                    Every package on this page is operated by our own team in Kampala — we are not a listings
                    platform and we do not pass your enquiry to a third party. When you book a
                    <strong>Uganda gorilla trekking package</strong>, we purchase your permit directly from
                    Uganda Wildlife Authority at the official $800 rate and assign one of our own
                    UWA-certified guides for the trek. When you book a
                    <strong>Rwanda gorilla trekking package</strong>, we handle the $1,500 Rwanda Development
                    Board permit and arrange your transfer from Kigali.
                </p>
                <p>
                    Our most popular <strong>Uganda safari packages</strong> cover four main circuits.
                    The <strong>western circuit</strong> combines gorilla trekking in Bwindi Impenetrable Forest
                    with chimpanzee tracking in Kibale National Park and a game drive in Queen Elizabeth National Park —
                    this is our most requested multi-park itinerary and suits travellers with 6 to 10 days.
                    The <strong>northern circuit</strong> focuses on Murchison Falls National Park, Uganda's largest
                    protected area, where Nile boat cruises bring you within metres of hippos and Nile crocodiles
                    and the savannah game drives produce large elephant herds, Rothschild's giraffe and lion.
                    <strong>Kidepo Valley National Park</strong> packages suit travellers looking for a true
                    wilderness experience — it is Uganda's most remote and least visited park, sharing its
                    ecosystem with South Sudan, and delivers outstanding predator sightings.
                </p>
                <p>
                    All packages are fully customisable.
                    <a href="{{ route('contact') }}" class="text-green-600 font-semibold hover:underline">
                        Send us your dates and group size
                    </a>
                    and we will build a bespoke itinerary with a line-by-line price breakdown within two hours.
                </p>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════
         FAQ
    ════════════════════════════════════════════════════════ --}}
    <section class="py-14 sm:py-20 bg-gray-50 border-t border-gray-100">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-10">
                <span class="text-green-600 font-bold text-xs uppercase tracking-[.2em]">Package Questions</span>
                <h2 class="mt-2 text-2xl sm:text-3xl font-black text-gray-900">
                    Frequently Asked Questions
                </h2>
            </div>

            @php
            $faqs = [
                [
                    'q' => 'What is included in your Uganda and Rwanda safari packages?',
                    'a' => 'All packages include the gorilla or activity permit (purchased directly from the authority), return 4WD transport from Entebbe or Kigali, accommodation for every night of the safari, all meals on safari, national park entrance fees and a UWA-certified guide. International flights, visas, travel insurance and personal spending money are not included, and we list every inclusion clearly on each package page.',
                ],
                [
                    'q' => 'How much does a Uganda gorilla trekking package cost?',
                    'a' => 'Our most affordable Uganda gorilla trekking package starts at $1,300 per person for a 3-day itinerary departing from Entebbe. This covers the $800 gorilla permit, transport, one night\'s accommodation near Bwindi, all meals and a guide. Prices increase with additional nights, park combinations and lodge upgrades.',
                ],
                [
                    'q' => 'Can I combine Uganda and Rwanda gorilla trekking in one trip?',
                    'a' => 'Yes — this is one of our most popular itineraries. A typical combination is 3 nights trekking in Bwindi (Uganda, $800 permit) followed by a border crossing to Rwanda for 1 or 2 nights in Volcanoes National Park ($1,500 permit), ending in Kigali. We handle all cross-border logistics, accommodation and transfers.',
                ],
                [
                    'q' => 'How far in advance do I need to book?',
                    'a' => 'For peak season travel (June–October and December–January) we recommend booking at least 3 months in advance, as gorilla permits sell out. Outside peak season, 4–6 weeks is usually sufficient, though we can sometimes source last-minute permits through our direct relationship with Uganda Wildlife Authority — contact us and we will check immediately.',
                ],
                [
                    'q' => 'Can I build a custom safari package?',
                    'a' => 'Every itinerary we offer can be customised. Tell us your travel dates, budget per person, group size and which parks or activities interest you — we will build a tailored itinerary with a clear, itemised price within two hours. We specialise in private, solo, couple and small-group packages.',
                ],
                [
                    'q' => 'What is your cancellation policy?',
                    'a' => 'Cancellations 60 or more days before departure incur minimal fees. Between 30–59 days, 50% of the total is forfeited. Within 30 days the full cost is non-refundable because gorilla permits cannot be resold at short notice. Full terms are sent with your booking confirmation — please ask any questions before you pay a deposit.',
                ],
            ];
            @endphp

            <div class="space-y-3">
                @foreach($faqs as $faq)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden"
                     itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-toggle w-full text-left px-5 sm:px-6 py-4 sm:py-5
                                   flex items-center justify-between gap-4
                                   focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-inset
                                   hover:bg-gray-50 transition-colors">
                        <span class="font-bold text-gray-900 text-sm sm:text-base leading-snug"
                              itemprop="name">{{ $faq['q'] }}</span>
                        <svg class="faq-icon w-5 h-5 text-green-600 shrink-0 transition-transform duration-300"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer hidden px-5 sm:px-6 pb-5"
                         itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p class="text-gray-500 text-sm leading-relaxed" itemprop="text">{{ $faq['a'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════
         CTA
    ════════════════════════════════════════════════════════ --}}
    <section class="relative py-16 sm:py-24 overflow-hidden">
        <img src="{{ asset('images/GORILLA.jpg') }}" alt="" aria-hidden="true"
             class="absolute inset-0 w-full h-full object-cover object-center pointer-events-none"
             onerror="this.style.display='none'">
        <div class="absolute inset-0"
             style="background:linear-gradient(135deg,rgba(5,40,20,.88) 0%,rgba(5,40,20,.75) 100%);"></div>

        <div class="relative z-10 max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">

            <span class="inline-block border border-green-400/40 bg-green-900/30 text-green-300
                         text-xs font-bold tracking-[.18em] uppercase px-5 py-2 rounded-full mb-6">
                Ready to Book?
            </span>

            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white
                       leading-tight mb-4">
                Can't Find Exactly What You Need?
            </h2>
            <p class="text-white text-sm sm:text-base md:text-lg max-w-2xl mx-auto mb-2 leading-relaxed">
                Every package on this page can be adjusted to your travel dates, group size and budget.
                Send us the details and we'll have a tailored itinerary with a clear price in your inbox
                within two hours.
            </p>
            <p class="text-green-400 text-xs sm:text-sm font-semibold mb-9">
                Uganda permits from $800 · Rwanda permits from $1,500 · No hidden fees
            </p>

            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center">
                <a href="{{ route('contact') }}"
                   class="w-full sm:w-auto bg-red-500 hover:bg-green-50 text-white font-black
                          px-8 py-4 rounded-xl text-base sm:text-lg transition-all hover:scale-[1.02]
                          shadow-2xl text-center">
                    Request for a tour 
                </a>
                <a href="tel:+256781282344"
                   class="w-full sm:w-auto border-2 border-white/60 hover:border-white
                          text-white hover:bg-white/10 font-bold px-8 py-4 rounded-xl
                          text-base sm:text-lg transition-all text-center">
                    Call +256 781 282 344
                </a>
                <a href="https://wa.me/256781282344"
                   class="w-full sm:w-auto bg-green-500 hover:bg-green-400 text-white font-bold
                          px-8 py-4 rounded-xl text-base sm:text-lg transition-all
                          flex items-center justify-center gap-2 shadow-xl">
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                    </svg>
                    WhatsApp Us
                </a>
            </div>
        </div>
    </section>

</div>


@push('styles')
<style>
    .scrollbar-hide { -ms-overflow-style:none; scrollbar-width:none; }
    .scrollbar-hide::-webkit-scrollbar { display:none; }
    .line-clamp-1 { display:-webkit-box; -webkit-line-clamp:1; -webkit-box-orient:vertical; overflow:hidden; }
    .line-clamp-2 { display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
</style>
@endpush


@push('scripts')

@verbatim
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "TouristInformationCenter",
  "name": "Rwanda Budget Safaris",
  "url": "https://rwandabudgetsafaris.com",
  "telephone": "+256781282344",
  "email": "info@rwandabudgetsafaris.com",
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "UG",
    "addressLocality": "Kampala"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.9",
    "reviewCount": "147",
    "bestRating": "5"
  },
  "priceRange": "$1300 - $8000",
  "description": "Kampala-based budget safari operator running gorilla trekking packages in Uganda and Rwanda. Direct permit purchase, local certified guides, all-inclusive pricing.",
  "areaServed": ["Uganda", "Rwanda", "Kenya", "Tanzania"]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Home",            "item": "https://rwandabudgetsafaris.com" },
    { "@type": "ListItem", "position": 2, "name": "Safari Packages", "item": "https://rwandabudgetsafaris.com/tours" }
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What is included in your Uganda and Rwanda safari packages?",
      "acceptedAnswer": { "@type": "Answer", "text": "All packages include the gorilla or activity permit, 4WD transport, accommodation, all meals, park entry fees and a certified guide. International flights, visas and travel insurance are not included." }
    },
    {
      "@type": "Question",
      "name": "How much does a Uganda gorilla trekking package cost?",
      "acceptedAnswer": { "@type": "Answer", "text": "Uganda gorilla trekking packages start at $1,300 per person for a 3-day itinerary, including the $800 permit, transport, accommodation and meals." }
    },
    {
      "@type": "Question",
      "name": "Can I combine Uganda and Rwanda gorilla trekking in one trip?",
      "acceptedAnswer": { "@type": "Answer", "text": "Yes. A popular option is Bwindi ($800 permit) followed by a cross-border transfer to Rwanda's Volcanoes NP ($1,500 permit), ending in Kigali. We handle all logistics." }
    },
    {
      "@type": "Question",
      "name": "Can I build a custom safari package?",
      "acceptedAnswer": { "@type": "Answer", "text": "Every package can be customised. Send us your dates, budget and group size and we will build a tailored itinerary with an itemised quote within two hours." }
    }
  ]
}
</script>
@endverbatim

<script type="application/ld+json">
{!! json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'ItemList',
    'name'            => 'Uganda & Rwanda Safari Packages 2026',
    'description'     => 'All-inclusive gorilla trekking, chimp tracking, Big Five game drives and wildlife tours across Uganda and Rwanda.',
    'url'             => 'https://rwandabudgetsafaris.com/tours',
    'itemListElement' => $tours->map(function ($tour, $i) {
        $item = [
            '@type'       => 'ListItem',
            'position'    => $i + 1,
            'name'        => $tour->title,
            'url'         => route('tours.show', $tour->slug),
            'description' => Str::limit($tour->description, 150),
        ];
        if ($tour->prices && $tour->prices->count() > 0) {
            $minPrice = $tour->prices->min('price');
            if ($minPrice !== null && is_numeric($minPrice)) {
                $item['offers'] = [
                    '@type'         => 'Offer',
                    'priceCurrency' => 'USD',
                    'price'         => (float) $minPrice,
                    'availability'  => 'https://schema.org/InStock',
                ];
            }
        }
        return $item;
    })->values()->all(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

<script>
(function () {

    /* Parallax hero */
    var img  = document.getElementById('hero-img');
    var hero = document.getElementById('tours-hero');
    if (img && hero) {
        window.addEventListener('scroll', function () {
            if (window.scrollY < hero.offsetTop + hero.offsetHeight + 200) {
                img.style.transform = 'translateY(' + (window.scrollY * 0.25) + 'px)';
            }
        }, { passive: true });
    }

    document.addEventListener('DOMContentLoaded', function () {

        /* Scroll to filters if hash present */
        if (window.location.hash === '#tour-filters') {
            setTimeout(function () {
                var el   = document.getElementById('tour-filters');
                var navH = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--nav-height')) || 70;
                if (el) window.scrollTo({ top: el.getBoundingClientRect().top + window.scrollY - navH, behavior: 'smooth' });
            }, 100);
        }

        /* Mobile filter toggle */
        var toggle = document.getElementById('mobile-filter-toggle');
        var wrap   = document.getElementById('filter-form-wrap');
        if (toggle) toggle.addEventListener('click', function () {
            wrap.classList.toggle('hidden');
            wrap.classList.toggle('block');
        });

        /* Auto-submit filters on desktop */
        document.querySelectorAll('.tour-filter').forEach(function (s) {
            s.addEventListener('change', function () {
                if (window.innerWidth >= 768) document.getElementById('filter-form').submit();
            });
        });

        /* Grid / Swipe toggle */
        var gridBtn  = document.getElementById('grid-view');
        var slideBtn = document.getElementById('horizontal-view');
        var gridC    = document.getElementById('grid-container');
        var slideC   = document.getElementById('horizontal-container');
        if (gridBtn) {
            gridBtn.addEventListener('click', function () {
                gridBtn.classList.add('bg-green-600','text-white');
                gridBtn.classList.remove('text-gray-500');
                slideBtn.classList.remove('bg-green-600','text-white');
                slideBtn.classList.add('text-gray-500');
                gridC.classList.remove('hidden');
                slideC.classList.add('hidden');
            });
            slideBtn.addEventListener('click', function () {
                slideBtn.classList.add('bg-green-600','text-white');
                slideBtn.classList.remove('text-gray-500');
                gridBtn.classList.remove('bg-green-600','text-white');
                gridBtn.classList.add('text-gray-500');
                slideC.classList.remove('hidden');
                gridC.classList.add('hidden');
            });
        }

        /* FAQ accordion */
        document.querySelectorAll('.faq-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var answer = this.nextElementSibling;
                var icon   = this.querySelector('.faq-icon');
                var isOpen = !answer.classList.contains('hidden');
                // close all
                document.querySelectorAll('.faq-answer').forEach(function (a) { a.classList.add('hidden'); });
                document.querySelectorAll('.faq-icon').forEach(function (i) { i.style.transform = ''; });
                // open clicked if it was closed
                if (!isOpen) {
                    answer.classList.remove('hidden');
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        });

        /* Quick book */
        window.quickBook = function (slug) { window.location.href = '/tours/' + slug + '#booking'; };
    });

})();
</script>

@endpush
@endsection