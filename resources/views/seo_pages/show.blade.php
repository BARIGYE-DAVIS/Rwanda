@extends('layouts.app')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->focus_keyword)

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Hero Section with Featured Image as Background --}}
    <section class="relative py-16 md:py-24 bg-cover bg-center bg-no-repeat"
             style="background-image: url('{{ $page->featured_image ? asset('storage/' . $page->featured_image) : '' }}');">
        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black opacity-50"></div>
        
        <div class="relative z-10 container mx-auto px-4 text-center text-white">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold">{{ $page->title }}</h1>

                {{-- Breadcrumb --}}
                <nav class="mt-8 text-sm">
                    <ol class="flex justify-center space-x-2 text-green-200">
                        <li><a href="{{ route('index') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li class="mx-2">/</li>
                        <li class="text-white">{{ $page->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    {{-- Content Section --}}
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                {{-- Content - Full Width --}}
                <div class="p-6 md:p-12">
                    @forelse($page->blocks->sortBy('sort_order') as $block)
                        @if($block->block_type === 'heading')
                            {{-- Heading Block --}}
                            @php
                                $headingClasses = [
                                    'h1' => 'text-4xl md:text-5xl font-bold text-gray-900 mb-6',
                                    'h2' => 'text-3xl md:text-4xl font-bold text-gray-800 mb-4 mt-8',
                                    'h3' => 'text-2xl md:text-3xl font-semibold text-gray-800 mb-3 mt-6',
                                    'h4' => 'text-xl md:text-2xl font-semibold text-gray-700 mb-3 mt-5',
                                    'h5' => 'text-lg md:text-xl font-semibold text-gray-700 mb-2 mt-4',
                                    'h6' => 'text-base md:text-lg font-semibold text-gray-600 mb-2 mt-3',
                                ];
                            @endphp
                            <{{ $block->heading_level ?? 'h2' }} class="{{ $headingClasses[$block->heading_level ?? 'h2'] }}">
                                {{ $block->content }}
                            </{{ $block->heading_level ?? 'h2' }}>

                        @elseif($block->block_type === 'text')
                            {{-- Text Block --}}
                            <div class="text-gray-700 leading-relaxed mb-6 prose prose-green max-w-none text-lg">
                                {!! $block->content !!}
                            </div>

                        @elseif($block->block_type === 'list')
                            {{-- List Block --}}
                            @php
                                $listType = $block->list_type ?? 'ul';
                                $listClasses = 'mb-6 space-y-2 text-gray-700 text-lg';
                            @endphp
                            @if($listType === 'ul')
                                <ul class="list-disc list-inside {{ $listClasses }} prose prose-green max-w-none">
                                    {!! $block->content !!}
                                </ul>
                            @else
                                <ol class="list-decimal list-inside {{ $listClasses }} prose prose-green max-w-none">
                                    {!! $block->content !!}
                                </ol>
                            @endif

                        @elseif($block->block_type === 'image')
                            {{-- Image Block --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                                @foreach($block->images->sortBy('sort_order') as $image)
                                    <div class="relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 group">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                                             alt="{{ $image->alt_text ?? $page->title }}" 
                                             class="w-full h-56 md:h-64 object-cover transition-transform duration-300 group-hover:scale-105">
                                        @if($image->alt_text)
                                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-sm p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                {{ $image->alt_text }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                        @elseif($block->block_type === 'links')
                            {{-- Links Block --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                @foreach($block->links as $link)
                                    <a href="{{ $link->linked_page_url }}" 
                                       target="_blank" 
                                       rel="noopener noreferrer"
                                       class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-green-50 hover:border-green-300 transition-all duration-300 group">
                                        <div class="flex-1">
                                            <h4 class="text-base font-semibold text-gray-800 group-hover:text-green-700 transition-colors">
                                                {{ $link->linked_page_title }}
                                            </h4>
                                            <p class="text-sm text-gray-500 truncate">{{ $link->linked_page_url }}</p>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600 transition-colors ml-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    @empty
                        <div class="text-center py-12 text-gray-500">
                            <p>No content available for this page.</p>
                        </div>
                    @endforelse

                    {{-- Request Quote Button --}}
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-small p-8 md:p-10 text-center">
                            <h3 class="text-2xl font-bold text-gray-800 mb-3">Ready to Book Your Safari?</h3>
                            <p class="text-gray-600 text-lg mb-6">Contact us today and let our expert team help you plan the perfect African adventure.</p>
                            <a href="{{ route('contact') }}" 
                               class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-5 py-5 rounded font-semibold text-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                
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
.prose {
    max-width: none;
}
.prose p {
    margin-bottom: 1.25rem;
    font-size: 1.125rem;
    line-height: 1.8;
}
.prose ul, .prose ol {
    padding-left: 1.5rem;
    margin-bottom: 1.25rem;
}
.prose ul li, .prose ol li {
    margin-bottom: 0.5rem;
    font-size: 1.125rem;
    line-height: 1.8;
}
.prose a {
    color: #16a34a;
    text-decoration: underline;
}
.prose a:hover {
    color: #15803d;
    text-decoration: none;
}
.prose h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-top: 2.5rem;
    margin-bottom: 1.25rem;
    color: #1f2937;
}
.prose h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #1f2937;
}
.prose h4 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    color: #374151;
}
.prose blockquote {
    border-left: 4px solid #16a34a;
    padding-left: 1.25rem;
    margin: 1.5rem 0;
    color: #4b5563;
    font-size: 1.125rem;
}
.prose code {
    background: #f3f4f6;
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
    font-size: 0.875rem;
}
.prose pre {
    background: #1f2937;
    color: #f3f4f6;
    padding: 1.25rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.25rem 0;
}
</style>
@endpush