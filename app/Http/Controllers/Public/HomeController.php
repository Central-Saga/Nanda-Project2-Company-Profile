<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\GalleryItem;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteProfile;
use App\Models\Testimonial;
use Illuminate\Http\Response;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the public landing page.
     */
    public function index(): View
    {
        $siteProfile = SiteProfile::current();

        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $featuredProjects = Project::published()
            ->featured()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->limit(4)
            ->get();

        if ($featuredProjects->isEmpty()) {
            $featuredProjects = Project::published()
                ->orderBy('sort_order')
                ->limit(4)
                ->get();
        }

        $galleries = GalleryItem::orderBy('sort_order')
            ->orderBy('id')
            ->limit(6)
            ->get();

        $testimonials = Testimonial::where('status', 'approved')
            ->latest('created_at')
            ->limit(3)
            ->get();

        $articles = Article::where('status', 'published')
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('public.home', compact('services', 'featuredProjects', 'galleries', 'testimonials', 'articles', 'siteProfile'));
    }

    /**
     * Generate dynamic sitemap.xml
     */
    public function sitemap(): Response
    {
        $projects = Project::published()->select('slug', 'updated_at')->get();
        $services = Service::where('is_active', true)->select('slug', 'updated_at')->get();
        $articles = Article::where('status', 'published')->select('slug', 'updated_at')->get();

        $xml = view('public.sitemap', compact('projects', 'services', 'articles'))->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }

    /**
     * Generate dynamic robots.txt
     */
    public function robots(): Response
    {
        $content = "User-agent: *\nDisallow: /admin/\nDisallow: /login\n\nSitemap: " . url('/sitemap.xml') . "\n";

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
