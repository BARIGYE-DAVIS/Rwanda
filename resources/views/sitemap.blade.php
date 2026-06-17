<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

    {{-- ======================================== 
         HOMEPAGE
         ======================================== --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- ======================================== 
         SEO PAGES (from database) - NO /public/ 
         ======================================== --}}
    @foreach($seoPages as $page)
    <url>
        <loc>{{ url('/explore/' . $page->slug) }}</loc>
        <lastmod>{{ $page->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach

    {{-- ======================================== 
         TOURS (from database) - NO /public/
         ======================================== --}}
    @foreach($tours as $tour)
    <url>
        <loc>{{ route('tours.show', $tour->slug) }}</loc>
        <lastmod>{{ $tour->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- ======================================== 
         BLOGS (from database) - NO /public/
         ======================================== --}}
    @foreach($blogs as $blog)
    <url>
        <loc>{{ route('blogs.show', $blog->slug) }}</loc>
        <lastmod>{{ $blog->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    {{-- ======================================== 
         DESTINATIONS (from database) - NO /public/
         ======================================== --}}
    @foreach($destinations as $destination)
    <url>
        <loc>{{ route('destinations.show', $destination->slug) }}</loc>
        <lastmod>{{ $destination->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- ======================================== 
         ACTIVITIES (from database) - NO /public/
         ======================================== --}}
    @foreach($activities as $activity)
    <url>
        <loc>{{ route('activities.show', $activity->slug) }}</loc>
        <lastmod>{{ $activity->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    {{-- ======================================== 
         COUNTRIES (from database) - NO /public/
         ======================================== --}}
    @foreach($countries as $country)
    <url>
        <loc>{{ route('countries.show', $country->code) }}</loc>
        <lastmod>{{ $country->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    {{-- ======================================== 
         GALLERY (from database) - NO /public/
         ======================================== --}}
    @foreach($galleries as $gallery)
    <url>
        <loc>{{ route('gallery.show', $gallery->slug) }}</loc>
        <lastmod>{{ $gallery->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    {{-- ======================================== 
         STATIC PAGES - NO /public/
         ======================================== --}}
    <url>
        <loc>{{ route('tours.index') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ route('blogs.index') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ route('gallery.index') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ route('countries.index') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ route('activities.index') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ route('destinations.index') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- CONTACT PAGE - INCLUDED --}}
    <url>
        <loc>{{ route('contact') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

</urlset>