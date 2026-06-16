@extends('layouts.app')

@section('title', $page->title)

@section('meta')
    <meta name="description" content="{{ $page->meta_description }}">
    @if($page->focus_keyword)
        <meta name="keywords" content="{{ $page->focus_keyword }}">
    @endif
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description }}">
    <meta property="og:url" content="{{ url('/explore/'.$page->slug) }}">
    @if($page->featured_image)
        <meta property="og:image" content="{{ asset('storage/'.$page->featured_image) }}">
    @endif
    <link rel="canonical" href="{{ url('/explore/'.$page->slug) }}">
@endsection

@push('styles')
<style>
    /* ── Hero ── */
    .sp-hero {
        position: relative;
        width: 100%;
        min-height: 480px;
        display: flex;
        align-items: flex-end;
        overflow: hidden;
        background: #064e3b;
    }
    .sp-hero__img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 8s ease;
    }
    .sp-hero:hover .sp-hero__img { transform: scale(1.04); }
    .sp-hero__gradient {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(0,0,0,0.85) 0%,
            rgba(0,0,0,0.45) 45%,
            rgba(0,0,0,0.1)  100%
        );
    }
    .sp-hero__body {
        position: relative;
        z-index: 10;
        width: 100%;
        max-width: 72rem;
        margin: 0 auto;
        padding: 0 2rem 3rem;
    }
    .sp-hero__keyword {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #fff;
        background: rgba(16,185,129,0.85);
        border: 1px solid rgba(255,255,255,0.2);
        padding: 0.3rem 0.875rem;
        border-radius: 9999px;
        margin-bottom: 1rem;
        backdrop-filter: blur(4px);
    }
    .sp-hero__title {
        font-size: clamp(1.85rem, 4.5vw, 3.25rem);
        font-weight: 800;
        color: #fff;
        line-height: 1.12;
        letter-spacing: -0.025em;
        margin: 0 0 1rem;
        text-shadow: 0 2px 16px rgba(0,0,0,0.35);
        max-width: 52rem;
    }
    .sp-hero__desc {
        font-size: 1.05rem;
        color: rgba(255,255,255,0.82);
        max-width: 42rem;
        line-height: 1.7;
        margin: 0;
    }

    /* ── Breadcrumb ── */
    .sp-breadcrumb {
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        padding: 0.6rem 0;
    }
    .sp-breadcrumb__inner {
        max-width: 72rem;
        margin: 0 auto;
        padding: 0 2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.78rem;
        color: #6b7280;
    }
    .sp-breadcrumb a { color: #2563eb; text-decoration: none; }
    .sp-breadcrumb a:hover { text-decoration: underline; color: #1d4ed8; }
    .sp-breadcrumb__sep { color: #d1d5db; }

    /* ── Layout ── */
    .sp-wrap {
        max-width: 72rem;
        margin: 0 auto;
        padding: 3rem 2rem 5rem;
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 4rem;
        align-items: start;
    }
    @media (max-width: 900px) {
        .sp-wrap { grid-template-columns: 1fr; gap: 2.5rem; }
        .sp-sidebar { order: 2; }
    }
    @media (max-width: 640px) {
        .sp-wrap { padding: 2rem 1.25rem 4rem; }
    }

    /* ── Headings ── */
    .sp-h1 {
        font-size: 2rem;
        font-weight: 800;
        color: #064e3b;
        margin: 2.5rem 0 1rem;
        letter-spacing: -0.02em;
        line-height: 1.2;
    }
    .sp-h2 {
        font-size: 1.55rem;
        font-weight: 700;
        color: #111827;
        margin: 2.75rem 0 1rem;
        line-height: 1.25;
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }
    .sp-h2::before {
        content: '';
        display: block;
        flex-shrink: 0;
        width: 4px;
        height: 1.4em;
        background: #10b981;
        border-radius: 2px;
    }
    .sp-h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1f2937;
        margin: 2rem 0 0.75rem;
        padding-left: 0.75rem;
        border-left: 3px solid #d1fae5;
        line-height: 1.35;
    }
    .sp-h4 {
        font-size: 1.05rem;
        font-weight: 600;
        color: #374151;
        margin: 1.5rem 0 0.5rem;
    }
    .sp-h5 {
        font-size: 0.875rem;
        font-weight: 700;
        color: #059669;
        margin: 1.25rem 0 0.4rem;
        text-transform: uppercase;
        letter-spacing: 0.07em;
    }
    .sp-h6 {
        font-size: 0.75rem;
        font-weight: 700;
        color: #6b7280;
        margin: 1rem 0 0.35rem;
        text-transform: uppercase;
        letter-spacing: 0.12em;
    }

    /* ── Text / Prose Links (BLUE) ── */
    .sp-text {
        font-size: 1.0125rem;
        color: #374151;
        line-height: 1.9;
        margin-bottom: 1.25rem;
    }
    /* This makes ALL links inside text blocks BLUE */
    .sp-text a {
        color: #2563eb;
        text-decoration: underline;
        text-underline-offset: 2px;
        font-weight: 500;
        transition: color 0.15s ease;
    }
    .sp-text a:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    /* ── Images ── */
    .sp-img-single figure {
        margin: 2rem 0;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,0.1);
        background: #f3f4f6;
    }
    .sp-img-single img {
        width: 100%;
        max-height: 28rem;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }
    .sp-img-single figure:hover img { transform: scale(1.03); }
    .sp-img-single figcaption {
        font-size: 0.8rem;
        color: #6b7280;
        text-align: center;
        padding: 0.6rem 1rem 0.75rem;
        font-style: italic;
        border-top: 1px solid #f3f4f6;
    }
    .sp-img-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin: 2rem 0;
    }
    @media (min-width: 640px) {
        .sp-img-grid { grid-template-columns: repeat(3, 1fr); }
    }
    .sp-img-grid figure {
        margin: 0;
        border-radius: 0.875rem;
        overflow: hidden;
        background: #f3f4f6;
    }
    .sp-img-grid img {
        width: 100%;
        height: 11rem;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .sp-img-grid figure:hover img { transform: scale(1.06); }

    /* ── Inline links block (BLUE) ── */
    .sp-inline-links {
        margin: 0.5rem 0 1.25rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem 0.75rem;
        align-items: center;
    }
    .sp-inline-link {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        color: #2563eb;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        border-bottom: 1.5px solid #bfdbfe;
        padding-bottom: 1px;
        transition: color 0.15s, border-color 0.15s;
        line-height: 1.6;
    }
    .sp-inline-link:hover {
        color: #1d4ed8;
        border-bottom-color: #2563eb;
    }
    .sp-inline-link svg {
        flex-shrink: 0;
        opacity: 0.7;
        transition: transform 0.15s, opacity 0.15s;
    }
    .sp-inline-link:hover svg {
        transform: translateX(2px);
        opacity: 1;
    }

    /* ── CTA ── */
    .sp-cta {
        margin-top: 3.5rem;
        background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);
        border-radius: 1.5rem;
        padding: 2.5rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .sp-cta::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 160px; height: 160px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }
    .sp-cta::after {
        content: '';
        position: absolute;
        bottom: -60px; left: -20px;
        width: 220px; height: 220px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
    }
    .sp-cta__eyebrow {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: #6ee7b7;
        margin: 0 0 0.75rem;
    }
    .sp-cta__title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #fff;
        margin: 0 0 0.625rem;
        line-height: 1.2;
    }
    .sp-cta__desc {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.7);
        margin: 0 auto 1.5rem;
        max-width: 28rem;
        line-height: 1.6;
    }
    .sp-cta__btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #10b981;
        color: #fff;
        font-size: 0.9rem;
        font-weight: 700;
        padding: 0.75rem 1.75rem;
        border-radius: 0.75rem;
        text-decoration: none;
        transition: background 0.15s, transform 0.15s;
        position: relative;
        z-index: 1;
    }
    .sp-cta__btn:hover { background: #059669; transform: translateY(-1px); color: #fff; }

    /* ── Sidebar ── */
    .sp-sidebar { position: sticky; top: 1.5rem; }
    .sp-toc {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }
    .sp-toc__title {
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #6b7280;
        margin: 0 0 0.875rem;
    }
    .sp-toc__list { list-style: none; margin: 0; padding: 0; }
    .sp-toc__list li { border-top: 1px solid #f3f4f6; }
    .sp-toc__list li:first-child { border-top: none; }
    .sp-toc__list a {
        display: block;
        padding: 0.45rem 0;
        font-size: 0.85rem;
        color: #374151;
        text-decoration: none;
        transition: color 0.15s, padding-left 0.15s;
    }
    .sp-toc__list a:hover { color: #2563eb; padding-left: 0.375rem; }
    .sp-toc__list a.sp-toc--h3 {
        padding-left: 0.875rem;
        font-size: 0.8rem;
        color: #6b7280;
    }
    .sp-toc__list a.sp-toc--h3:hover { padding-left: 1.125rem; color: #2563eb; }

    /* ── Sidebar contact card link (BLUE) ── */
    .sp-sidebar a {
        color: #2563eb;
        text-decoration: none;
    }
    .sp-sidebar a:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="bg-white">

    {{-- ── HERO ── --}}
    <div class="sp-hero">
        @if($page->featured_image)
            <img src="{{ asset('storage/'.$page->featured_image) }}"
                 alt="{{ $page->title }}"
                 class="sp-hero__img">
        @endif
        <div class="sp-hero__gradient"></div>
        <div class="sp-hero__body">
            @if($page->focus_keyword)
                <div>
                    <span class="sp-hero__keyword">
                        <svg style="width:0.7rem;height:0.7rem" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $page->focus_keyword }}
                    </span>
                </div>
            @endif
            <h1 class="sp-hero__title">{{ $page->title }}</h1>
            @if($page->meta_description)
                <p class="sp-hero__desc">{{ $page->meta_description }}</p>
            @endif
        </div>
    </div>

    {{-- ── BREADCRUMB ── --}}
    <div class="sp-breadcrumb">
        <div class="sp-breadcrumb__inner">
            <a href="{{ url('/') }}">Home</a>
            <span class="sp-breadcrumb__sep">›</span>
            <span>{{ $page->title }}</span>
        </div>
    </div>

    {{-- ── MAIN + SIDEBAR ── --}}
    <div class="sp-wrap">

        {{-- Main content --}}
        <div class="sp-main">

            @php
                $headings = $page->blocks->where('block_type', 'heading')
                    ->whereIn('heading_level', ['h2','h3'])
                    ->values();
            @endphp

            @foreach($page->blocks as $block)

                {{-- HEADING --}}
                @if($block->block_type === 'heading')
                    @php $level = $block->heading_level ?? 'h2'; @endphp
                    @php $slug  = \Illuminate\Support\Str::slug($block->content); @endphp
                    @if($level === 'h1')
                        <h1 id="{{ $slug }}" class="sp-h1">{{ $block->content }}</h1>
                    @elseif($level === 'h2')
                        <h2 id="{{ $slug }}" class="sp-h2">{{ $block->content }}</h2>
                    @elseif($level === 'h3')
                        <h3 id="{{ $slug }}" class="sp-h3">{{ $block->content }}</h3>
                    @elseif($level === 'h4')
                        <h4 class="sp-h4">{{ $block->content }}</h4>
                    @elseif($level === 'h5')
                        <h5 class="sp-h5">{{ $block->content }}</h5>
                    @else
                        <h6 class="sp-h6">{{ $block->content }}</h6>
                    @endif

                {{-- TEXT (with BLUE links automatically) --}}
                @elseif($block->block_type === 'text')
                    <div class="sp-text">{!! $block->content !!}</div>

                {{-- IMAGES --}}
                @elseif($block->block_type === 'image' && $block->images->count() > 0)
                    @if($block->images->count() === 1)
                        <div class="sp-img-single">
                            <figure>
                                <img src="{{ asset('storage/'.$block->images->first()->image_path) }}"
                                     alt="{{ $block->images->first()->alt_text ?? $page->title }}"
                                     loading="lazy">
                                @if($block->images->first()->alt_text)
                                    <figcaption>{{ $block->images->first()->alt_text }}</figcaption>
                                @endif
                            </figure>
                        </div>
                    @else
                        <div class="sp-img-grid">
                            @foreach($block->images as $image)
                                <figure>
                                    <img src="{{ asset('storage/'.$image->image_path) }}"
                                         alt="{{ $image->alt_text ?? $page->title }}"
                                         loading="lazy">
                                </figure>
                            @endforeach
                        </div>
                    @endif

                {{-- LINKS — inline, exactly where placed, BLUE like normal prose links --}}
                @elseif($block->block_type === 'links' && $block->links->count() > 0)
                    <div class="sp-inline-links">
                        @foreach($block->links as $link)
                            <a href="{{ $link->linked_page_url }}" class="sp-inline-link">
                                {{ $link->linked_page_title }}
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>

                @endif
            @endforeach

            {{-- ── CTA ── --}}
            <div class="sp-cta">
                <p class="sp-cta__eyebrow">Plan your trip</p>
                <h3 class="sp-cta__title">Ready to experience it yourself?</h3>
                <p class="sp-cta__desc">Talk to our safari specialists and get a tailor-made itinerary built around your dream Africa adventure.</p>
                <a href="{{ route('contact') }}" class="sp-cta__btn">
                    Get a Free Quote
                    <svg style="width:1rem;height:1rem" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

        </div>

        {{-- ── SIDEBAR ── --}}
        <aside class="sp-sidebar">
            @if($headings->count() > 1)
                <div class="sp-toc">
                    <p class="sp-toc__title">On this page</p>
                    <ul class="sp-toc__list">
                        @foreach($headings as $h)
                            <li>
                                <a href="#{{ \Illuminate\Support\Str::slug($h->content) }}"
                                   class="{{ $h->heading_level === 'h3' ? 'sp-toc--h3' : '' }}">
                                    {{ $h->content }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Quick contact card --}}
            <div style="background:#f0fdf4;border:1px solid #a7f3d0;border-radius:1rem;padding:1.25rem;text-align:center;">
                <div style="font-size:1.75rem;margin-bottom:0.5rem;">🦁</div>
                <p style="font-size:0.85rem;font-weight:700;color:#065f46;margin:0 0 0.375rem;">Talk to a Specialist</p>
                <p style="font-size:0.78rem;color:#6b7280;margin:0 0 1rem;line-height:1.5;">We plan custom safaris tailored to your budget and dates.</p>
                <a href="{{ route('contact') }}"
                   style="display:block;background:#059669;color:#fff;font-size:0.82rem;font-weight:700;padding:0.6rem 1rem;border-radius:0.625rem;text-decoration:none;transition:background 0.15s;"
                   onmouseover="this.style.background='#047857'"
                   onmouseout="this.style.background='#059669'">
                    Contact Us
                </a>
            </div>
        </aside>

    </div>
</div>
@endsection