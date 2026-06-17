<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Barryvdh\DomPDF\Facade\Pdf;
// Models used by the dynamic sitemap
use App\Models\Tour;
use App\Models\Blog;
use App\Models\Destination;
use App\Models\Activity;
use App\Models\Country;
use App\Models\Gallery;


class PageController extends Controller
{
    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }

    public function touristInformation()
    {
        return view('pages.tourist-information');
    }

    public function termsOfService()
    {
        return view('pages.terms-of-service');
    }

    public function refundPolicy()
    {
        return view('pages.refund-policy');
    }

    public function cookiePolicy()
    {
        return view('pages.cookie-policy');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Dynamic XML sitemap
     */
    public function sitemap()
{
    // Get data from database - only active/published items
    $tours = \App\Models\Tour::where('status', 'active')->get();
    $blogs = \App\Models\Blog::where('status', 'published')->get();
    $destinations = \App\Models\Destination::where('is_active', true)->get();  // FIXED: is_active = true
    $activities = \App\Models\Activity::where('is_active', true)->get();
    $countries = \App\Models\Country::where('is_active', true)->get();
    $galleries = \App\Models\Gallery::where('is_visible', true)->get();
    $seoPages = \App\Models\SeoPage::where('status', 'published')->get();

    // Return XML view
    return response()->view('sitemap', compact(
        'tours', 'blogs', 'destinations', 'activities', 
        'countries', 'galleries', 'seoPages'
    ))->header('Content-Type', 'text/xml');
}

public function downloadTouristInfoPdf()
{
    $html = view('pages.tourist-information-pdf')->render();
    
    $pdf = Pdf::loadHTML($html);
    $pdf->setPaper('A4', 'portrait');
    
    return $pdf->download('Calm-Africa-Safaris-Uganda-Tourist-Guide.pdf');
}

public function viewTouristInfoPdf()
{
    $html = view('pages.tourist-information-pdf')->render();
    
    $pdf = Pdf::loadHTML($html);
    $pdf->setPaper('A4', 'portrait');
    
    return $pdf->stream('Calm-Africa-Safaris-Uganda-Tourist-Guide.pdf');
}

}