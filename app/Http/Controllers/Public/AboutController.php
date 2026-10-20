<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteProfile;
use App\Models\Testimonial;
use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Display the dedicated About page.
     */
    public function index(): View
    {
        $siteProfile = SiteProfile::current();
        $servicesCount = Service::where('is_active', true)->count();
        $projectsCount = Project::published()->count();
        $testimonials = Testimonial::where('status', 'approved')->latest()->limit(4)->get();
        $galleryHighlights = GalleryItem::orderBy('sort_order')->limit(4)->get();

        return view('public.about', compact('siteProfile', 'servicesCount', 'projectsCount', 'testimonials', 'galleryHighlights'));
    }
}

