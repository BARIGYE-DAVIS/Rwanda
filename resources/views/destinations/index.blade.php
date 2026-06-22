@extends('layouts.app')

@section('title', 'Uganda & Rwanda Safari Destinations 2026 | Gorilla Trekking & Wildlife Parks')
@section('meta_description', 'Discover the best Uganda and Rwanda safari destinations — Bwindi gorilla trekking, Kibale chimps, Queen Elizabeth game drives, Murchison Falls and Rwanda Volcanoes NP. Plan your 2026 safari today.')
@section('meta_keywords', 'Uganda safari destinations, Rwanda safari destinations, Bwindi Impenetrable Forest, Kibale National Park, Queen Elizabeth National Park, Murchison Falls National Park, Kidepo Valley safari, Volcanoes National Park Rwanda, Uganda gorilla trekking destination, Rwanda gorilla trekking, best national parks Uganda, budget safari destinations East Africa 2026')

@push('head')
@verbatim
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebPage",
      "@id": "{{ url()->current() }}",
      "name": "Uganda & Rwanda Safari Destinations 2026",
      "description": "Browse every safari destination across Uganda and Rwanda — gorilla trekking, chimp tracking, Big Five game drives and Nile adventures. Kampala-based operator, direct permits, honest prices.",
      "url": "{{ url()->current() }}",
      "inLanguage": "en",
      "publisher": {
        "@type": "TravelAgency",
        "name": "Rwanda Budget Safaris",
        "url": "{{ url('/') }}",
        "telephone": "+256781282344",
        "email": "info@rwandabudgetsafaris.com",
        "address": {
          "@type": "PostalAddress",
          "addressCountry": "UG",
          "addressLocality": "Kampala"
        },
        "areaServed": ["Uganda", "Rwanda"],
        "currenciesAccepted": "USD",
        "priceRange": "$1300 - $8000"
      }
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home",         "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "Destinations", "item": "{{ url()->current() }}" }
      ]
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Which Uganda national parks are best for a first safari?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "For a first Uganda safari, Queen Elizabeth National Park combines Big Five game drives, a Kazinga Channel boat cruise and chimpanzee tracking in one park. Pair it with gorilla trekking in Bwindi Impenetrable Forest for a classic western Uganda itinerary."
          }
        },
        {
          "@type": "Question",
          "name": "How far is Bwindi from Kampala?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Bwindi Impenetrable Forest is roughly 500 km southwest of Kampala — about 8 to 9 hours by road or a 50-minute charter flight to Kihihi or Kisoro airstrip. We arrange all transport from Entebbe or Kampala as part of every gorilla trekking package."
          }
        },
        {
          "@type": "Question",
          "name": "Can I visit Uganda and Rwanda gorilla parks in one trip?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes. A popular itinerary treks gorillas in Bwindi (Uganda, $800 permit) and then crosses the border to Rwanda's Volcanoes National Park ($1,500 permit), ending in Kigali. We handle all border logistics, accommodation and transport."
          }
        },
        {
          "@type": "Question",
          "name": "What is the best time of year to visit Uganda and Rwanda?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "The dry seasons — June to September and December to February — offer the best gorilla trekking conditions and game viewing. However, Uganda and Rwanda are year-round destinations. The green seasons (March–May and October–November) produce lush landscapes and excellent birding."
          }
        },
        {
          "@type": "Question",
          "name": "Do I need a visa for Uganda or Rwanda?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Most nationalities can obtain a Uganda e-Visa online before travel. Rwanda offers visa-on-arrival to citizens of most countries, and the East Africa Tourist Visa covers Uganda, Kenya and Rwanda on a single permit. We advise all clients on visa requirements as part of our pre-trip briefing."
          }
        }
      ]
    }
  ]
}
</script>
@endverbatim
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════
     HERO SLIDESHOW — JS/logic untouched, content new
═══════════════════════════════════════════════════════ --}}
<div class="relative hero-section bg-gray-900 overflow-hidden" role="banner">
    <div class="slideshow-container absolute inset-0">

        @php
            $heroDestinations = \App\Models\Destination::where('is_active', true)
                ->whereNotNull('featured_image')
                ->orWhereNotNull('image')
                ->inRandomOrder()
                ->limit(5)
                ->get();

            if($heroDestinations->isEmpty()) {
                $heroDestinations = $popularDestinations->take(5);
            }
        @endphp

        @foreach($heroDestinations as $index => $heroDestination)
        <div class="slide {{ $index === 0 ? 'slide-active' : '' }} absolute inset-0">
            <div class="parallax-bg absolute inset-0" style="top:-30%; height:160%;">
                @if($heroDestination->featured_image)
                    <img src="{{ asset('storage/' . $heroDestination->featured_image) }}"
                         alt="{{ $heroDestination->name }} safari destination — {{ $heroDestination->country->name ?? 'Uganda & Rwanda' }}"
                         class="parallax-img w-full h-full object-cover">
                @elseif($heroDestination->image)
                    <img src="{{ asset('storage/' . $heroDestination->image) }}"
                         alt="{{ $heroDestination->name }} wildlife park — {{ $heroDestination->country->name ?? 'Uganda & Rwanda' }}"
                         class="parallax-img w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-green-900 via-green-700 to-teal-800"></div>
                @endif
            </div>

            <div class="absolute inset-0"
                 style="background:linear-gradient(to top, rgba(5,20,10,.90) 0%, rgba(5,20,10,.45) 55%, rgba(5,20,10,.25) 100%);"></div>

            <div class="absolute inset-0 flex flex-col justify-end">
                <div class="container mx-auto px-4 pb-14 sm:pb-20">
                    <div class="max-w-2xl">
                        <div class="flex flex-wrap items-center gap-2 mb-3">
                            <span class="border border-green-400/50 bg-green-900/50 text-green-300
                                         text-xs font-bold tracking-[.15em] uppercase px-4 py-1.5 rounded-full">
                                {{ $heroDestination->country->flag_icon ?? '🌍' }}
                                {{ $heroDestination->country->name ?? 'Uganda & Rwanda' }}
                            </span>
                            @if($heroDestination->type)
                            <span class="bg-white/15 text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                                {{ $heroDestination->type }}
                            </span>
                            @endif
                        </div>
                        <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white
                                   mb-3 leading-tight drop-shadow-lg">
                            {{ $heroDestination->name }}
                        </h2>
                        <p class="text-sm sm:text-base md:text-lg text-white/75 mb-5
                                  line-clamp-2 max-w-xl leading-relaxed">
                            {{ $heroDestination->description }}
                        </p>
                        <a href="{{ route('destinations.show', $heroDestination->slug) }}"
                           class="inline-flex items-center bg-green-600 hover:bg-green-500 text-white
                                  px-6 py-3 sm:px-7 sm:py-3.5 rounded-xl text-sm sm:text-base
                                  font-bold transition-all hover:scale-105 shadow-xl gap-2">
                            Explore {{ $heroDestination->name }}
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <button class="slide-control prev absolute left-3 sm:left-5 top-1/2 -translate-y-1/2
                   bg-black/35 hover:bg-black/55 backdrop-blur-sm text-white
                   p-2.5 sm:p-3.5 rounded-full transition z-10"
            aria-label="Previous slide">
        <i class="fas fa-chevron-left text-sm sm:text-base text-white"></i>
    </button>
    <button class="slide-control next absolute right-3 sm:right-5 top-1/2 -translate-y-1/2
                   bg-black/35 hover:bg-black/55 backdrop-blur-sm text-white
                   p-2.5 sm:p-3.5 rounded-full transition z-10"
            aria-label="Next slide">
        <i class="fas fa-chevron-right text-sm sm:text-base text-white"></i>
    </button>

    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-10"
         role="tablist" aria-label="Slideshow navigation">
        @foreach($heroDestinations as $index => $dest)
        <button class="slide-indicator h-2 rounded-full bg-white/40 hover:bg-white
                       transition-all duration-300 {{ $index === 0 ? 'active' : '' }}"
                data-slide="{{ $index }}"
                aria-label="Go to slide {{ $index + 1 }}: {{ $dest->name }}">
        </button>
        @endforeach
    </div>

    <div class="absolute bottom-8 right-8 z-10 animate-bounce hidden sm:flex flex-col
                items-center text-white/60 text-xs gap-1" aria-hidden="true">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
        Scroll
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════
     SEO INTRO STRIP
═══════════════════════════════════════════════════════ --}}
<div class="bg-white border-b border-gray-100 py-8 px-4">
    <div class="container mx-auto max-w-4xl text-center">
        <span class="text-green-600 font-bold text-xs uppercase tracking-[.2em]">
            Kampala-Based · Est. 2010 · Direct Permits
        </span>
        <h1 class="mt-3 text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 leading-tight">
            Uganda &amp; Rwanda Safari Destinations
        </h1>
        <p class="mt-4 text-gray-600 text-sm sm:text-base max-w-3xl mx-auto leading-relaxed">
            We are a locally owned safari company based in Kampala. Every destination below is a
            park or reserve we have been operating in since 2010 — with our own certified guides
            and direct relationships with Uganda Wildlife Authority and Rwanda Development Board.
            Browse by destination, then
            <a href="{{ route('tours.index') }}" class="text-green-600 font-semibold hover:underline">
                view matching packages
            </a>
            or
            <a href="{{ route('custom-tour-requests.create') }}" class="text-green-600 font-semibold hover:underline">
                request a custom itinerary
            </a>.
        </p>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════
     SEARCH
═══════════════════════════════════════════════════════ --}}
<div class="bg-gray-50 border-b border-gray-200 py-5 px-4">
    <div class="container mx-auto max-w-3xl">
        <form method="GET" action="{{ route('destinations.index') }}"
              class="flex flex-col sm:flex-row gap-2 sm:gap-3"
              role="search" aria-label="Search safari destinations">
            <div class="flex-1 relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2
                          text-gray-400 text-sm pointer-events-none" aria-hidden="true"></i>
                <input type="text" name="search"
                       placeholder="Search parks, countries, wildlife experiences…"
                       value="{{ request('search') }}"
                       aria-label="Search destinations"
                       class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-gray-200
                              focus:border-green-500 focus:outline-none text-gray-800 text-sm
                              sm:text-base bg-white shadow-sm">
            </div>
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 px-6 py-3 rounded-xl font-bold
                           transition text-white text-sm sm:text-base whitespace-nowrap
                           flex items-center justify-center gap-2 shadow-sm">
                <i class="fas fa-search" aria-hidden="true"></i>
                Search
            </button>
        </form>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════
     FILTERS — PHP/routes untouched
═══════════════════════════════════════════════════════ --}}
<div class="bg-white shadow-sm sticky top-0 z-40 border-b border-gray-200">
    <div class="container mx-auto px-4 py-3 sm:py-4">
        <form method="GET" action="{{ route('destinations.index') }}"
              class="flex flex-wrap gap-2 sm:gap-4 items-center"
              aria-label="Filter destinations">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            <span class="hidden sm:inline-flex items-center text-gray-400 text-xs font-bold uppercase tracking-widest">
                Filter by:
            </span>

            <select name="country"
                    aria-label="Filter by country"
                    class="flex-1 min-w-0 sm:flex-none px-3 py-2.5 text-sm border border-gray-200
                           rounded-xl focus:ring-2 focus:ring-green-500 bg-white"
                    onchange="this.form.submit()">
                <option value="">🌍 All Countries</option>
                @foreach($countries as $country)
                    <option value="{{ $country->code }}"
                            {{ request('country') == $country->code ? 'selected' : '' }}>
                        {{ $country->flag_icon }} {{ $country->name }}
                    </option>
                @endforeach
            </select>

            <select name="popular"
                    aria-label="Filter by popularity"
                    class="flex-1 min-w-0 sm:flex-none px-3 py-2.5 text-sm border border-gray-200
                           rounded-xl focus:ring-2 focus:ring-green-500 bg-white"
                    onchange="this.form.submit()">
                <option value="">All Destinations</option>
                <option value="1" {{ request('popular') == '1' ? 'selected' : '' }}>
                    ⭐ Most Visited
                </option>
            </select>

            @if(request()->hasAny(['search', 'country', 'popular']))
                <a href="{{ route('destinations.index') }}"
                   class="text-red-500 hover:text-red-700 font-semibold px-3 py-2 text-sm
                          border border-red-200 rounded-xl hover:bg-red-50 transition whitespace-nowrap">
                    <i class="fas fa-times mr-1" aria-hidden="true"></i> Clear
                </a>
            @endif

            <div class="ml-auto text-gray-400 text-xs font-semibold hidden md:block whitespace-nowrap">
                {{ $destinations->total() }} destination{{ $destinations->total() != 1 ? 's' : '' }}
            </div>
        </form>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════
     COUNTRY QUICK-LINKS
═══════════════════════════════════════════════════════ --}}
@if(!request()->hasAny(['search', 'country', 'popular']))
<nav class="bg-gray-50 border-b border-gray-100 py-5 px-4"
     aria-label="Browse destinations by country">
    <div class="container mx-auto max-w-4xl">
        <p class="text-[11px] text-gray-400 uppercase tracking-widest font-bold mb-3 text-center">
            Filter by Country
        </p>
        <div class="flex flex-wrap justify-center gap-2 sm:gap-3">
            @foreach($countries as $country)
            <a href="{{ route('destinations.index', ['country' => $country->code]) }}"
               class="inline-flex items-center gap-2 bg-white border border-gray-200
                      hover:border-green-500 hover:bg-green-50 text-gray-700 hover:text-green-700
                      px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200 shadow-sm">
                <span>{{ $country->flag_icon }}</span>
                <span>{{ $country->name }} Safaris</span>
            </a>
            @endforeach
        </div>
    </div>
</nav>
@endif

{{-- ═══════════════════════════════════════════════════════
     POPULAR / FEATURED DESTINATIONS
═══════════════════════════════════════════════════════ --}}
@if(!request()->hasAny(['search', 'country', 'popular']) && $popularDestinations->count() > 0)
<section class="bg-white py-14 sm:py-20" aria-labelledby="popular-heading">
    <div class="container mx-auto px-4">

        <div class="text-center mb-10 sm:mb-14">
            <span class="text-green-600 font-bold text-xs uppercase tracking-[.2em]">
                Where Our Clients Go Most
            </span>
            <h2 id="popular-heading"
                class="mt-3 text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 leading-tight">
                Most-Booked Uganda &amp; Rwanda Destinations
            </h2>
            <p class="mt-4 text-gray-500 text-base sm:text-lg max-w-2xl mx-auto">
                These are the parks and reserves our clients return to year after year —
                each one operated by our own guides with direct permit access.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($popularDestinations as $destination)
            <article>
                <a href="{{ route('destinations.show', $destination->slug) }}"
                   class="group block h-full">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden
                                hover:shadow-xl transition-all duration-300 h-full flex flex-col">

                        <div class="relative h-56 sm:h-64 overflow-hidden flex-shrink-0">
                            @if($destination->featured_image)
                                <img src="{{ asset('storage/' . $destination->featured_image) }}"
                                     alt="{{ $destination->name }} — {{ $destination->country->name ?? 'Uganda & Rwanda' }} safari"
                                     class="w-full h-full object-cover group-hover:scale-105
                                            transition-transform duration-700"
                                     loading="lazy">
                            @elseif($destination->image)
                                <img src="{{ asset('storage/' . $destination->image) }}"
                                     alt="{{ $destination->name }} — safari destination"
                                     class="w-full h-full object-cover group-hover:scale-105
                                            transition-transform duration-700"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-green-800 to-green-500
                                            flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-white text-5xl opacity-30"
                                       aria-hidden="true"></i>
                                </div>
                            @endif

                            {{-- Popular badge --}}
                            <span class="absolute top-3 right-3 bg-amber-500 text-white
                                         text-[10px] font-bold px-2.5 py-1 rounded-full shadow-md
                                         flex items-center gap-1">
                                <i class="fas fa-star text-[10px]" aria-hidden="true"></i>
                                Popular
                            </span>

                            @if($destination->type)
                            <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm
                                         text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $destination->type }}
                            </span>
                            @endif
                        </div>

                        <div class="p-5 sm:p-6 flex flex-col flex-1">
                            <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-800
                                         text-xs font-bold px-3 py-1 rounded-full mb-3 self-start">
                                {{ $destination->country->flag_icon ?? '🌍' }}
                                {{ $destination->country->name ?? 'Uganda & Rwanda' }}
                            </span>
                            <h3 class="text-lg sm:text-xl font-black text-gray-900 mb-2
                                       group-hover:text-green-600 transition-colors line-clamp-1">
                                {{ $destination->name }}
                            </h3>
                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4 flex-1">
                                {{ $destination->description }}
                            </p>
                            <div class="flex items-center text-green-600 font-bold text-sm
                                        pt-4 border-t border-gray-100 mt-auto gap-1.5">
                                View Destination
                                <i class="fas fa-arrow-right group-hover:translate-x-2
                                          transition-transform" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════
     WHAT WE OFFER — replaces generic "Why East Africa"
═══════════════════════════════════════════════════════ --}}
@if(!request()->hasAny(['search', 'country', 'popular']))
<section class="bg-gray-50 border-y border-gray-100 py-14 sm:py-20 px-4"
         aria-labelledby="offer-heading">
    <div class="container mx-auto max-w-6xl">

        <div class="text-center mb-12">
            <span class="text-green-600 font-bold text-xs uppercase tracking-[.2em]">
                What You'll Find in Each Destination
            </span>
            <h2 id="offer-heading"
                class="mt-3 text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 leading-tight">
                Four Experiences Unique to Uganda &amp; Rwanda
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm
                        hover:shadow-md transition-shadow text-center">
                <div class="text-4xl mb-4">🦍</div>
                <h3 class="font-black text-gray-900 text-base mb-2">Gorilla Trekking</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Bwindi Impenetrable Forest and Mgahinga (Uganda) and Volcanoes National Park
                    (Rwanda) together protect over half the world's remaining mountain gorillas.
                    We hold permits for both countries.
                </p>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm
                        hover:shadow-md transition-shadow text-center">
                <div class="text-4xl mb-4">🐒</div>
                <h3 class="font-black text-gray-900 text-base mb-2">Chimpanzee Tracking</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Kibale National Park has the highest density of chimpanzees in Africa —
                    over 1,500 individuals. Our guides know the habituated communities and
                    secure permits in advance.
                </p>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm
                        hover:shadow-md transition-shadow text-center">
                <div class="text-4xl mb-4">🦁</div>
                <h3 class="font-black text-gray-900 text-base mb-2">Big Five Game Drives</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Queen Elizabeth, Murchison Falls and Kidepo Valley national parks offer
                    Uganda's finest game drives — lion, elephant, buffalo, hippo and leopard
                    in open savannah and riverine habitat.
                </p>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm
                        hover:shadow-md transition-shadow text-center">
                <div class="text-4xl mb-4">🌊</div>
                <h3 class="font-black text-gray-900 text-base mb-2">Nile &amp; Waterfall Cruises</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Murchison Falls is where the entire Nile River squeezes through a 7-metre gap —
                    one of the world's most powerful natural spectacles. Boat cruises bring you
                    metres from hippos and Nile crocodiles.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- Key stats bar --}}
<section class="bg-green-800 py-10 sm:py-12 px-4">
    <div class="container mx-auto max-w-4xl">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
            <div>
                <p class="text-3xl sm:text-4xl font-black text-white">15+</p>
                <p class="text-green-200 text-xs sm:text-sm mt-1">Years operating in Uganda & Rwanda</p>
            </div>
            <div>
                <p class="text-3xl sm:text-4xl font-black text-white">{{ $destinations->total() }}+</p>
                <p class="text-green-200 text-xs sm:text-sm mt-1">Destinations we actively operate in</p>
            </div>
            <div>
                <p class="text-3xl sm:text-4xl font-black text-white">$800</p>
                <p class="text-green-200 text-xs sm:text-sm mt-1">Uganda gorilla permit — bought direct</p>
            </div>
            <div>
                <p class="text-3xl sm:text-4xl font-black text-white">$1500</p>
                <p class="text-green-200 text-xs sm:text-sm mt-1">Rwanda gorilla permit — bought direct</p>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════
     ALL DESTINATIONS GRID — PHP/routes untouched
═══════════════════════════════════════════════════════ --}}
<main id="all-destinations" class="container mx-auto px-4 py-12 sm:py-16">

    @if(!request()->hasAny(['search', 'country', 'popular']))
        <div class="text-center mb-10 sm:mb-14">
            <span class="text-green-600 font-bold text-xs uppercase tracking-[.2em]">
                Every Park We Operate In
            </span>
            <h2 class="mt-3 text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 leading-tight">
                All Uganda &amp; Rwanda Safari Destinations
            </h2>
            <p class="mt-4 text-gray-500 text-base sm:text-lg">
                Click any destination for wildlife details, best travel season,
                accommodation options and matching safari packages.
            </p>
        </div>
    @else
        <div class="mb-8">
            <h2 class="text-2xl sm:text-3xl font-black text-gray-900 mb-2">
                @if(request('country'))
                    {{ $countries->firstWhere('code', request('country'))->flag_icon ?? '' }}
                    Destinations in {{ $countries->firstWhere('code', request('country'))->name ?? 'Selected Country' }}
                @elseif(request('popular'))
                    Most-Visited Destinations
                @elseif(request('search'))
                    Results for "{{ request('search') }}"
                @endif
            </h2>
            <p class="text-gray-400 text-sm">{{ $destinations->total() }} destination(s) found</p>
        </div>
    @endif

    @if($destinations->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
            @foreach($destinations as $destination)
            <article>
                <a href="{{ route('destinations.show', $destination->slug) }}"
                   class="group block h-full">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden
                                hover:shadow-lg transition-all duration-300 h-full flex flex-col">

                        <div class="relative h-48 sm:h-52 overflow-hidden flex-shrink-0
                                    bg-gradient-to-br from-gray-100 to-gray-200">
                            @if($destination->featured_image)
                                <img src="{{ asset('storage/' . $destination->featured_image) }}"
                                     alt="{{ $destination->name }} — {{ $destination->type ?? 'safari destination' }} {{ $destination->country->name ?? '' }}"
                                     class="w-full h-full object-cover group-hover:scale-105
                                            transition-transform duration-700"
                                     loading="lazy">
                            @elseif($destination->image)
                                <img src="{{ asset('storage/' . $destination->image) }}"
                                     alt="{{ $destination->name }} — {{ $destination->country->name ?? 'Uganda & Rwanda' }}"
                                     class="w-full h-full object-cover group-hover:scale-105
                                            transition-transform duration-700"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-green-800 to-teal-700
                                            flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <i class="fas fa-map-marked-alt text-4xl opacity-30 mb-1"
                                           aria-hidden="true"></i>
                                        <p class="text-xs font-semibold opacity-60 px-2">
                                            {{ $destination->name }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @if($destination->is_popular)
                            <span class="absolute top-2.5 left-2.5 bg-amber-500 text-white
                                         text-[10px] font-bold px-2 py-0.5 rounded-full shadow">
                                <i class="fas fa-star text-[9px]" aria-hidden="true"></i>
                            </span>
                            @endif

                            @if($destination->type)
                            <span class="absolute bottom-2 right-2 bg-white/90 backdrop-blur-sm
                                         text-gray-700 text-[10px] font-semibold px-2.5 py-1
                                         rounded-lg shadow-sm">
                                {{ $destination->type }}
                            </span>
                            @endif
                        </div>

                        <div class="p-4 sm:p-5 flex flex-col flex-1">
                            <span class="inline-flex items-center gap-1 bg-green-50 text-green-800
                                         text-[11px] font-bold px-2.5 py-1 rounded-full mb-2 self-start">
                                {{ $destination->country->flag_icon ?? '🌍' }}
                                {{ $destination->country->name ?? 'Uganda & Rwanda' }}
                            </span>
                            <h3 class="text-sm sm:text-base font-black text-gray-900 mb-2
                                       group-hover:text-green-600 transition-colors line-clamp-2">
                                {{ $destination->name }}
                            </h3>
                            <p class="text-gray-500 text-xs leading-relaxed line-clamp-3 mb-3 flex-1">
                                {{ Str::limit($destination->meta_description, 95) }}
                            </p>
                            <div class="flex items-center text-green-600 font-bold text-xs sm:text-sm
                                        pt-3 border-t border-gray-100 mt-auto gap-1.5">
                                View Details
                                <i class="fas fa-arrow-right group-hover:translate-x-1.5
                                          transition-transform text-xs" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>

        <div class="mt-10 sm:mt-14" id="pagination-links">
            {{ $destinations->appends(request()->query())->links() }}
        </div>

    @else
        <div class="text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-search text-gray-300 text-3xl" aria-hidden="true"></i>
            </div>
            <h3 class="text-xl font-black text-gray-600 mb-3">No destinations found</h3>
            <p class="text-gray-400 mb-6 max-w-sm mx-auto text-sm px-4">
                Nothing matched your search. Try removing a filter or browse all destinations below.
            </p>
            <a href="{{ route('destinations.index') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-7 py-3 rounded-xl
                      font-bold text-sm transition-colors shadow-md inline-flex items-center gap-2">
                <i class="fas fa-home" aria-hidden="true"></i>
                All Destinations
            </a>
        </div>
    @endif
</main>

{{-- ═══════════════════════════════════════════════════════
     FAQ — JavaScript logic untouched, questions all new
═══════════════════════════════════════════════════════ --}}
@if(!request()->hasAny(['search', 'country', 'popular']))
<section class="bg-gray-50 border-t border-gray-100 py-14 sm:py-20 px-4"
         aria-labelledby="faq-heading">
    <div class="container mx-auto max-w-3xl">

        <div class="text-center mb-10">
            <span class="text-green-600 font-bold text-xs uppercase tracking-[.2em]">
                Before You Book
            </span>
            <h2 id="faq-heading"
                class="mt-3 text-2xl sm:text-3xl font-black text-gray-900">
                Questions About Uganda &amp; Rwanda Destinations
            </h2>
        </div>

        @php
        $faqs = [
            [
                'q' => 'Which Uganda national parks are best for a first safari?',
                'a' => 'For a first Uganda safari, Queen Elizabeth National Park is the most versatile option — it combines Big Five game drives, a Kazinga Channel boat cruise and chimpanzee tracking in the Kyambura Gorge, all in one park. Pair it with gorilla trekking in Bwindi Impenetrable Forest for a classic 7-day western Uganda itinerary that covers primates, big mammals and birds.',
            ],
            [
                'q' => 'How far is Bwindi Impenetrable Forest from Kampala?',
                'a' => 'Bwindi is approximately 500 km southwest of Kampala — about 8 to 9 hours by road through Fort Portal and Kabale, or a 50-minute charter flight to Kihihi or Kisoro airstrip. We arrange all transport from Entebbe or Kampala as part of every gorilla trekking package, with an overnight stop in Fort Portal or Kabale breaking up the drive.',
            ],
            [
                'q' => 'Can I visit Uganda and Rwanda gorilla parks in one trip?',
                'a' => 'Yes — this is one of our most popular itineraries. A standard combination is 3 nights in Bwindi (Uganda, $800 gorilla permit) followed by a border crossing at Gatuna or Cyanika into Rwanda for 1 or 2 nights at Volcanoes National Park ($1,500 gorilla permit), ending in Kigali. We handle all cross-border logistics, accommodation and transport so you do not need to organise anything separately.',
            ],
            [
                'q' => 'What is the best time of year to visit Uganda and Rwanda?',
                'a' => 'Uganda and Rwanda are year-round safari destinations. The dry seasons — June to September and December to February — offer the most reliable gorilla trekking conditions with firmer forest trails and better visibility. The green seasons (March–May and October–November) produce lush landscapes, far fewer crowds, lower lodge rates and excellent birding, with over 1,000 bird species recorded in Uganda alone.',
            ],
            [
                'q' => 'Do I need a visa for Uganda or Rwanda?',
                'a' => 'Most nationalities obtain a Uganda e-Visa online before departure at visas.immigration.go.ug. Rwanda offers a visa-on-arrival or online e-Visa to citizens of most countries. The East Africa Tourist Visa ($100) covers Uganda, Kenya and Rwanda on a single permit and is the most cost-effective option for multi-country itineraries. We send every client a full visa and entry requirements briefing as part of trip preparation.',
            ],
            [
                'q' => 'What vaccinations do I need for Uganda and Rwanda?',
                'a' => 'Yellow Fever vaccination is mandatory for entry to Uganda and strongly recommended for Rwanda. Additional recommended vaccinations include Typhoid, Hepatitis A and B, and Tetanus. Anti-malaria medication is advised for all destinations except Kigali city. For gorilla trekking, visitors must be symptom-free of respiratory illnesses on the day of the trek to protect the gorillas. Consult a travel health clinic at least 6 weeks before departure.',
            ],
        ];
        @endphp

        <div class="space-y-3" id="faqAccordion">
            @foreach($faqs as $fi => $faq)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <button class="faq-toggle w-full px-5 sm:px-6 py-4 text-left
                               flex items-center justify-between gap-4
                               hover:bg-gray-50 transition-colors
                               focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500"
                        aria-expanded="false"
                        aria-controls="faq-panel-{{ $fi }}"
                        id="faq-btn-{{ $fi }}"
                        type="button">
                    <span class="font-bold text-gray-900 text-sm sm:text-base pr-2">
                        {{ $faq['q'] }}
                    </span>
                    <span class="faq-icon flex-shrink-0 w-7 h-7 rounded-full border-2 border-gray-300
                                 flex items-center justify-center relative transition-colors duration-300">
                        <span class="faq-h absolute w-3 h-0.5 bg-gray-400 rounded
                                     transition-colors duration-300"
                              style="top:50%;left:50%;transform:translate(-50%,-50%);"></span>
                        <span class="faq-v absolute w-0.5 h-3 bg-gray-400 rounded
                                     transition-all duration-300 origin-center"
                              style="top:50%;left:50%;transform:translate(-50%,-50%) scaleY(1);"></span>
                    </span>
                </button>
                <div id="faq-panel-{{ $fi }}"
                     role="region"
                     aria-labelledby="faq-btn-{{ $fi }}"
                     class="faq-panel"
                     style="max-height:0;overflow:hidden;opacity:0;
                            transition:max-height 0.4s cubic-bezier(0.4,0,0.2,1),opacity 0.3s ease;">
                    <div class="px-5 sm:px-6 pb-5 pt-2 text-gray-500 text-sm sm:text-base
                                leading-relaxed border-t border-gray-100">
                        {{ $faq['a'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════
     CTA
═══════════════════════════════════════════════════════ --}}
<section class="relative py-16 sm:py-24 overflow-hidden"
         aria-labelledby="cta-heading">
    <div class="absolute inset-0 bg-gradient-to-br from-green-950 via-green-900 to-gray-900"></div>
    <div class="absolute inset-0 opacity-10"
         style="background:repeating-linear-gradient(45deg,transparent,transparent 40px,rgba(255,255,255,.04) 40px,rgba(255,255,255,.04) 41px);"></div>

    <div class="relative container mx-auto px-4 text-center max-w-3xl">

        <span class="inline-block border border-green-400/40 bg-green-900/30 text-green-300
                     text-xs font-bold tracking-[.18em] uppercase px-5 py-2 rounded-full mb-6">
            Plan Your Safari
        </span>

        <h2 id="cta-heading"
            class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white
                   leading-tight mb-4">
            Found a Destination You Love?
        </h2>
        <p class="text-white/75 text-sm sm:text-base md:text-lg mb-2 max-w-xl mx-auto leading-relaxed">
            Tell us which park or country interests you, your travel dates and group size.
            We'll send back a tailored itinerary with an itemised price — all-inclusive,
            no hidden fees — within two hours.
        </p>
        <p class="text-green-400 text-xs sm:text-sm font-semibold mb-9">
            Uganda permits from $800 · Rwanda permits from $1,500 · Kampala-based team
        </p>

        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center">
            <a href="{{ route('contact') }}"
               class="w-full sm:w-auto bg-white hover:bg-green-50 text-green-900 font-black
                      px-8 py-4 rounded-xl text-base sm:text-lg transition-all
                      hover:scale-[1.02] shadow-2xl text-center">
                <i class="fas fa-envelope mr-2" aria-hidden="true"></i>
                Get in Touch
            </a>
            <a href="{{ route('tours.index') }}"
               class="w-full sm:w-auto border-2 border-white hover:border-white
                      text-white bg-green-600 hover:bg-green-700 font-bold px-8 py-4 rounded-xl
                      text-base sm:text-lg transition-all text-center">
                <i class="fas fa-binoculars mr-2" aria-hidden="true"></i>
                Browse Safari Packages
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
/* ── Slideshow — logic 100% unchanged ───────────────────── */
(function () {
    const slides     = Array.from(document.querySelectorAll('.slide'));
    const indicators = Array.from(document.querySelectorAll('.slide-indicator'));
    const total      = slides.length;
    if (total === 0) return;

    let current = 0, timer = null;

    function goTo(idx) {
        idx = ((idx % total) + total) % total;
        slides[current].classList.remove('slide-active');
        if (indicators[current]) indicators[current].classList.remove('active');
        current = idx;
        slides[current].classList.add('slide-active');
        if (indicators[current]) indicators[current].classList.add('active');
    }
    function startAutoplay() { stopAutoplay(); timer = setInterval(() => goTo(current + 1), 5000); }
    function stopAutoplay()  { if (timer) { clearInterval(timer); timer = null; } }

    document.querySelector('.slide-control.next')?.addEventListener('click', () => { goTo(current + 1); startAutoplay(); });
    document.querySelector('.slide-control.prev')?.addEventListener('click', () => { goTo(current - 1); startAutoplay(); });
    indicators.forEach((dot, i) => dot.addEventListener('click', () => { goTo(i); startAutoplay(); }));
    document.querySelector('.slideshow-container')?.addEventListener('mouseenter', stopAutoplay);
    document.querySelector('.slideshow-container')?.addEventListener('mouseleave', startAutoplay);

    goTo(0); startAutoplay();
})();

/* ── Parallax — logic 100% unchanged ───────────────────── */
(function () {
    const heroSection = document.querySelector('.hero-section');
    if (!heroSection) return;
    const isMobile = window.matchMedia('(max-width: 768px)').matches
                     || /iPad|iPhone|iPod|Android/.test(navigator.userAgent);
    if (isMobile) return;
    const parallaxBgs = document.querySelectorAll('.parallax-bg');
    function applyParallax() {
        const heroRect = heroSection.getBoundingClientRect();
        const heroH    = heroSection.offsetHeight;
        if (heroRect.bottom < 0 || heroRect.top > window.innerHeight) return;
        const scrollProgress = Math.max(0, -heroRect.top) / heroH;
        parallaxBgs.forEach(bg => { bg.style.transform = `translateY(${scrollProgress * 30}%)`; });
    }
    window.addEventListener('scroll', applyParallax, { passive: true });
    applyParallax();
})();

/* ── Pagination scroll — logic 100% unchanged ───────────── */
(function () {
    const section = document.getElementById('all-destinations');
    if (!section) return;
    if (new URLSearchParams(window.location.search).has('page')) {
        setTimeout(() => section.scrollIntoView({ behavior: 'smooth', block: 'start' }), 120);
    }
    const paginationWrap = document.getElementById('pagination-links');
    if (!paginationWrap) return;
    paginationWrap.addEventListener('click', function (e) {
        const link = e.target.closest('a[href]');
        if (!link) return;
        e.preventDefault();
        window.location.href = new URL(link.href).toString();
    });
})();

/* ── FAQ Accordion — logic 100% unchanged ───────────────── */
(function () {
    const toggles = document.querySelectorAll('.faq-toggle');

    function openFaq(btn) {
        const panel = document.getElementById(btn.getAttribute('aria-controls'));
        if (!panel) return;
        btn.setAttribute('aria-expanded', 'true');
        btn.querySelector('.faq-icon').style.borderColor = '#16a34a';
        btn.querySelector('.faq-h').style.backgroundColor = '#16a34a';
        btn.querySelector('.faq-v').style.transform = 'translate(-50%,-50%) scaleY(0)';
        btn.querySelector('.faq-v').style.opacity = '0';
        panel.style.maxHeight = panel.scrollHeight + 'px';
        panel.style.opacity = '1';
    }

    function closeFaq(btn) {
        const panel = document.getElementById(btn.getAttribute('aria-controls'));
        if (!panel) return;
        btn.setAttribute('aria-expanded', 'false');
        btn.querySelector('.faq-icon').style.borderColor = '';
        btn.querySelector('.faq-h').style.backgroundColor = '';
        btn.querySelector('.faq-v').style.transform = '';
        btn.querySelector('.faq-v').style.opacity = '';
        panel.style.maxHeight = '0';
        panel.style.opacity = '0';
    }

    toggles.forEach(btn => {
        btn.addEventListener('click', function () {
            const isOpen = this.getAttribute('aria-expanded') === 'true';
            if (isOpen) { closeFaq(this); }
            else { toggles.forEach(o => { if (o !== this) closeFaq(o); }); openFaq(this); }
        });
    });
})();
</script>

<style>
/* Hero height */
.hero-section { height:75vw; min-height:340px; max-height:600px; }
@media (min-width:640px)  { .hero-section { height:60vw; min-height:420px; max-height:680px; } }
@media (min-width:1024px) { .hero-section { height:80vh; min-height:520px; max-height:800px; } }

.parallax-bg  { will-change:transform; transition:transform .05s linear; }
.slide        { opacity:0; transition:opacity 1s ease-in-out; pointer-events:none; }
.slide.slide-active { opacity:1; pointer-events:auto; }

.slide-indicator { width:8px; background-color:rgba(255,255,255,.4); transition:width .3s ease,background-color .3s ease; }
.slide-indicator.active { width:28px; background-color:white !important; }

.line-clamp-1 { display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden; }
.line-clamp-2 { display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden; }
.line-clamp-3 { display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden; }

.faq-panel { will-change:max-height,opacity; }
</style>
@endpush

@endsection