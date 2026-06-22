@extends('layouts.app')

@section('title', $destination->seo_title )
@section('meta_description', $destination->meta_description ?? \Illuminate\Support\Str::limit($destination->description ?? '', 160))
@section('meta_keywords', $destination->meta_keywords ?? $destination->focus_keyword ?? '')

@section('content')
<div class="bg-gray-50">
    {{-- Hero Section with Featured Image as Background --}}
    <section class="relative w-full min-h-screen flex items-center justify-center bg-no-repeat bg-center bg-fixed"
             style="background-image: url('{{ $destination->featured_image ? asset('storage/' . $destination->featured_image) : ($destination->image ? asset('storage/' . $destination->image) : '') }}'); background-size: cover; background-color: #1a3c34; will-change: transform;">
        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/60"></div>
        
        <div class="relative z-10 container mx-auto px-4 text-center text-white py-20">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight animate-fade-in">{{ $destination->name }}</h1>

                {{-- Type & Region Badges --}}
                <div class="flex flex-wrap justify-center gap-3 mt-4 animate-fade-in-up">
                    @if($destination->type)
                        <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold text-white border border-white/30">
                            {{ $destination->type }}
                        </span>
                    @endif
                    @if($destination->region)
                        <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold text-white border border-white/30">
                            {{ $destination->region }}
                        </span>
                    @endif
                    @if($destination->country)
                        <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold text-white border border-white/30">
                            {{ $destination->country->name }}
                        </span>
                    @endif
                </div>

                {{-- Breadcrumb --}}
                <nav class="mt-6 text-base md:text-lg animate-fade-in-up">
                    <ol class="flex justify-center space-x-3 text-green-200">
                        <li><a href="{{ route('index') }}" class="hover:text-white transition-colors duration-300 text-green-300">Home</a></li>
                        <li class="mx-2">/</li>
                        <li><a href="{{ route('destinations.index') }}" class="hover:text-white transition-colors duration-300 text-green-300">Destinations</a></li>
                        <li class="mx-2">/</li>
                        <li class="text-white font-medium">{{ $destination->name }}</li>
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
                    
                    {{-- Description / Intro --}}
                    @if($destination->description)
                        <div class="text-gray-700 leading-relaxed mb-10 text-lg md:text-xl lg:text-2xl scroll-fade">
                            <p class="text-xl md:text-2xl font-light text-gray-600 leading-relaxed">{{ $destination->description }}</p>
                        </div>
                    @endif

                    {{-- Render Content Blocks --}}
                    @php
                        // ✅ FIX: Ensure blocks is always an array
                        $blocks = $destination->content_blocks ?? [];
                        
                        if (is_string($blocks)) {
                            $blocks = json_decode($blocks, true);
                        }
                        
                        if (!is_array($blocks)) {
                            $blocks = [];
                        }
                        
                        $images = $destination->destinationImages ?? collect();
                        $imagesById = $images->keyBy('id');
                        $imagesByBlockId = $images->filter(function($i) { return !empty($i->block_id); })->keyBy('block_id');
                    @endphp

                    @forelse($blocks as $block)
                        @php
                            $type = $block['type'] ?? 'text';
                        @endphp

                        @if($type === 'heading')
                            @php
                                $level = $block['heading_level'] ?? 'h2';
                                $headingClasses = [
                                    'h1' => 'text-4xl md:text-6xl lg:text-7xl font-extrabold text-gray-900 mb-8',
                                    'h2' => 'text-3xl md:text-5xl lg:text-6xl font-bold text-gray-800 mb-6 mt-10',
                                    'h3' => 'text-2xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-5 mt-8',
                                    'h4' => 'text-xl md:text-3xl lg:text-4xl font-semibold text-gray-700 mb-4 mt-6',
                                    'h5' => 'text-lg md:text-xl lg:text-2xl font-semibold text-gray-700 mb-3 mt-5',
                                    'h6' => 'text-base md:text-lg lg:text-xl font-semibold text-gray-600 mb-3 mt-4',
                                ];
                            @endphp
                            <{{ $level }} class="{{ $headingClasses[$level] ?? $headingClasses['h2'] }} scroll-fade">
                                {{ $block['content'] ?? '' }}
                            </{{ $level }}>

                        @elseif($type === 'text')
                            <div class="text-gray-700 leading-relaxed mb-8 text-lg md:text-xl lg:text-2xl space-y-6 scroll-fade">
                                {!! $block['content'] ?? '' !!}
                            </div>

                        @elseif($type === 'list')
                            @php
                                $listType = $block['list_type'] ?? 'ul';
                                $listClasses = 'mb-8 space-y-3 text-gray-700 text-lg md:text-xl lg:text-2xl scroll-fade';
                            @endphp
                            @if($listType === 'ul')
                                <ul class="list-disc list-inside {{ $listClasses }}">
                                    {!! $block['content'] ?? '' !!}
                                </ul>
                            @else
                                <ol class="list-decimal list-inside {{ $listClasses }}">
                                    {!! $block['content'] ?? '' !!}
                                </ol>
                            @endif

                        @elseif($type === 'image')
                            @php
                                // Get images for this block
                                $blockImages = collect();
                                
                                // Check if block has media_id
                                if (!empty($block['media_id']) && isset($imagesById[$block['media_id']])) {
                                    $blockImages->push($imagesById[$block['media_id']]);
                                }
                                
                                // Check if block has block_id
                                if (!empty($block['block_id']) && isset($imagesByBlockId[$block['block_id']])) {
                                    $blockImages->push($imagesByBlockId[$block['block_id']]);
                                }
                                
                                // Check if there are any images with this block_id in the database
                                if ($blockImages->isEmpty() && !empty($block['id'])) {
                                    $dbImages = $images->filter(function($img) use ($block) {
                                        return $img->block_id === $block['id'];
                                    });
                                    $blockImages = $blockImages->merge($dbImages);
                                }
                                
                                // If still empty, try using the block's ID as block_id
                                if ($blockImages->isEmpty() && !empty($block['id'])) {
                                    $dbImages = $images->filter(function($img) use ($block) {
                                        return $img->block_id === $block['id'];
                                    });
                                    $blockImages = $blockImages->merge($dbImages);
                                }
                                
                                $count = $blockImages->count();
                                
                                if ($count === 0) {
                                    // Try to find any image with matching block_id
                                    $blockImages = $images->filter(function($img) use ($block) {
                                        return $img->block_id === ($block['id'] ?? $block['block_id'] ?? null);
                                    });
                                    $count = $blockImages->count();
                                }
                                
                                if ($count === 1) {
                                    $gridClass = 'grid grid-cols-1';
                                    $imgHeight = 'h-[70vh]';
                                } elseif ($count === 2) {
                                    $gridClass = 'grid grid-cols-1 md:grid-cols-2';
                                    $imgHeight = 'h-[50vh]';
                                } elseif ($count >= 3) {
                                    $gridClass = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3';
                                    $imgHeight = 'h-64 md:h-72 lg:h-80';
                                } else {
                                    $gridClass = 'grid grid-cols-1';
                                    $imgHeight = 'h-64';
                                }
                            @endphp
                            
                            @if($blockImages->isNotEmpty())
                                <div class="{{ $gridClass }} gap-8 mb-10">
                                    @foreach($blockImages as $image)
                                        <div class="relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 group scroll-fade">
                                            <img src="{{ asset('storage/' . ltrim($image->storage_path, '/')) }}" 
                                                 alt="{{ $image->alt_text ?? $block['caption'] ?? $destination->name }}" 
                                                 class="w-full {{ $imgHeight }} object-cover transition-transform duration-700 group-hover:scale-110">
                                            @if($image->alt_text || $image->caption)
                                                <div class="absolute bottom-0 left-0 right-0 bg-black/70 text-white text-sm md:text-base p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-sm">
                                                    {{ $image->caption ?? $image->alt_text }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    @empty
                        <div class="text-center py-16 text-gray-500 text-xl">
                            <p>No content available for this destination.</p>
                        </div>
                    @endforelse

                    {{-- Request Quote Button --}}
                    <div class="mt-16 pt-10 border-t-2 border-gray-200 scroll-fade">
                        <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-10 md:p-14 text-center shadow-inner hover:shadow-xl transition-shadow duration-500">
                            <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Ready to Visit {{ $destination->name }}?</h3>
                            <p class="text-gray-600 text-xl md:text-2xl mb-8 max-w-2xl mx-auto">Contact us today and let our expert team help you plan the perfect safari adventure.</p>
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
    
    /* Green link styles - for normal links inside text */
    .text-gray-700 a {
        color: #16a34a;
        text-decoration: underline;
        transition: color 0.3s ease;
    }
    
    .text-gray-700 a:hover {
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