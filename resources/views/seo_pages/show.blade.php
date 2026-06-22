@extends('layouts.app')

@section('title', $page->seo_title ?: $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->focus_keyword)

@section('content')
<div class="bg-gray-50">
    {{-- Hero Section with Featured Image as Background --}}
    <section class="relative w-full min-h-screen flex items-center justify-center bg-no-repeat bg-center bg-fixed"
             style="background-image: url('{{ $page->featured_image ? asset('storage/' . $page->featured_image) : '' }}'); background-size: cover; background-color: #1a3c34; will-change: transform;">
        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/60"></div>
        
        <div class="relative z-10 container mx-auto px-4 text-center text-white py-20">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight animate-fade-in">{{ $page->title }}</h1>

                {{-- Breadcrumb --}}
                <nav class="mt-6 text-base md:text-lg animate-fade-in-up">
                    <ol class="flex justify-center space-x-3 text-green-200">
                        <li><a href="{{ route('index') }}" class="hover:text-white transition-colors duration-300 text-green-300">Home</a></li>
                        <li class="mx-2">/</li>
                        <li class="text-white font-medium">{{ $page->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    {{-- Content Section with smooth scroll effect --}}
    <section class="relative py-16 md:py-20 bg-white/95 backdrop-blur-sm mt-[-2px] rounded-t-3xl shadow-2xl">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="p-8 md:p-14 lg:p-16">
                    @forelse($page->blocks->sortBy('sort_order') as $block)
                        @if($block->block_type === 'heading')
                            @php
                                $headingClasses = [
                                    'h1' => 'text-5xl md:text-6xl lg:text-7xl font-extrabold text-gray-900 mb-8',
                                    'h2' => 'text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 mb-6 mt-10',
                                    'h3' => 'text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-5 mt-8',
                                    'h4' => 'text-2xl md:text-3xl lg:text-4xl font-semibold text-gray-700 mb-4 mt-6',
                                    'h5' => 'text-xl md:text-2xl lg:text-3xl font-semibold text-gray-700 mb-3 mt-5',
                                    'h6' => 'text-lg md:text-xl lg:text-2xl font-semibold text-gray-600 mb-3 mt-4',
                                ];
                            @endphp
                            <{{ $block->heading_level ?? 'h2' }} class="{{ $headingClasses[$block->heading_level ?? 'h2'] }} scroll-fade">
                                {{ $block->content }}
                            </{{ $block->heading_level ?? 'h2' }}>

                        @elseif($block->block_type === 'text')
                            <div class="text-gray-700 leading-relaxed mb-8 text-lg md:text-xl lg:text-2xl space-y-6 scroll-fade">
                                {!! $block->content !!}
                            </div>

                        @elseif($block->block_type === 'list')
                            @php
                                $listType = $block->list_type ?? 'ul';
                                $listClasses = 'mb-8 space-y-3 text-gray-700 text-lg md:text-xl lg:text-2xl scroll-fade';
                            @endphp
                            @if($listType === 'ul')
                                <ul class="list-disc list-inside {{ $listClasses }} space-y-3">
                                    {!! $block->content !!}
                                </ul>
                            @else
                                <ol class="list-decimal list-inside {{ $listClasses }} space-y-3">
                                    {!! $block->content !!}
                                </ol>
                            @endif

                        @elseif($block->block_type === 'image')
                            @php
                                $images = $block->images->sortBy('sort_order');
                                $count = $images->count();

                                if ($count === 1) {
                                    $gridClass = 'grid grid-cols-1';
                                    $imgHeight = 'h-[70vh]';
                                } elseif ($count === 2) {
                                    $gridClass = 'grid grid-cols-1 md:grid-cols-2';
                                    $imgHeight = 'h-[50vh]';
                                } else {
                                    $gridClass = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3';
                                    $imgHeight = 'h-64 md:h-72 lg:h-80';
                                }
                            @endphp
                            <div class="{{ $gridClass }} gap-8 mb-10">
                                @foreach($images as $image)
                                    <div class="relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 group scroll-fade">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                                             alt="{{ $image->alt_text ?? $page->title }}" 
                                             class="w-full {{ $imgHeight }} object-cover transition-transform duration-700 group-hover:scale-110">
                                        @if($image->alt_text)
                                            <div class="absolute bottom-0 left-0 right-0 bg-black/70 text-white text-sm md:text-base p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-sm">
                                                {{ $image->alt_text }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                        @elseif($block->block_type === 'links')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                @foreach($block->links as $link)
                                    <a href="{{ $link->linked_page_url }}" 
                                       target="_blank" 
                                       rel="noopener noreferrer"
                                       class="flex items-center p-6 bg-gray-50 rounded-xl border-2 border-green-200 hover:border-green-500 transition-all duration-300 group shadow-sm hover:shadow-lg scroll-fade hover:bg-green-50">
                                        <div class="flex-1">
                                            <h4 class="text-lg md:text-xl font-semibold text-green-600 group-hover:text-green-800 transition-colors">
                                                {{ $link->linked_page_title }}
                                            </h4>
                                            <p class="text-sm md:text-base text-gray-500 truncate mt-1 group-hover:text-gray-700 transition-colors">{{ $link->linked_page_url }}</p>
                                        </div>
                                        <svg class="w-6 h-6 text-green-500 group-hover:text-green-700 transition-colors ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    @empty
                        <div class="text-center py-16 text-gray-500 text-xl">
                            <p>No content available for this page.</p>
                        </div>
                    @endforelse

                    {{-- Request Quote Button --}}
                    <div class="mt-16 pt-10 border-t-2 border-gray-200 scroll-fade">
                        <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-10 md:p-14 text-center shadow-inner hover:shadow-xl transition-shadow duration-500">
                            <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Ready to Book Your Safari?</h3>
                            <p class="text-gray-600 text-xl md:text-2xl mb-8 max-w-2xl mx-auto">Contact us today and let our expert team help you plan the perfect African adventure.</p>
                            <a href="{{ route('contact') }}" 
                               class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-5 py-5 rounded-xl font-bold text-xl md:text-2xl transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1">
                                Request a Quote
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
    /* Smooth scrolling for the entire page */
    html {
        scroll-behavior: smooth;
    }
    
    /* Parallax effect - background stays fixed while content scrolls over */
    .bg-fixed {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    
    /* Fade animations for content */
    .animate-fade-in {
        animation: fadeIn 1.2s ease-out forwards;
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 1.2s ease-out 0.3s forwards;
        opacity: 0;
    }
    
    .scroll-fade {
        opacity: 0;
        transform: translateY(30px);
        animation: scrollFadeIn 0.8s ease-out forwards;
    }
    
    /* Stagger animation for child elements */
    .scroll-fade:nth-child(1) { animation-delay: 0.1s; }
    .scroll-fade:nth-child(2) { animation-delay: 0.2s; }
    .scroll-fade:nth-child(3) { animation-delay: 0.3s; }
    .scroll-fade:nth-child(4) { animation-delay: 0.4s; }
    .scroll-fade:nth-child(5) { animation-delay: 0.5s; }
    .scroll-fade:nth-child(6) { animation-delay: 0.6s; }
    .scroll-fade:nth-child(7) { animation-delay: 0.7s; }
    .scroll-fade:nth-child(8) { animation-delay: 0.8s; }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes scrollFadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Smooth hover transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
    
    /* Parallax scroll effect - content overlay */
    .rounded-t-3xl {
        border-top-left-radius: 1.5rem;
        border-top-right-radius: 1.5rem;
    }
    
    /* Green link styles */
    a:not(.bg-green-600):not(.text-white) {
        color: #16a34a;
        transition: color 0.3s ease;
    }
    
    a:not(.bg-green-600):not(.text-white):hover {
        color: #15803d;
    }
    
    /* Reduce motion for users who prefer it */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
            scroll-behavior: auto !important;
        }
    }
</style>
@endpush