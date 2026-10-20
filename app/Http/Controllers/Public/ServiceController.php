<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display all active services.
     */
    public function index(): View
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('public.services.index', compact('services'));
    }

    /**
     * Display service detail.
     */
    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedProjects = Project::published()
            ->where(function ($query) use ($service) {
                $query->where('category', 'like', "%{$service->name}%")
                    ->orWhere('description', 'like', "%{$service->name}%");
            })
            ->limit(3)
            ->get();

        if ($relatedProjects->isEmpty()) {
            $relatedProjects = Project::published()->limit(3)->get();
        }

        $otherServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        return view('public.services.show', compact('service', 'relatedProjects', 'otherServices'));
    }
}
