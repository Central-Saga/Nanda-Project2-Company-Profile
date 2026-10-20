<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $query = Project::published();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('client', 'like', "%{$q}%");
            });
        }

        $projects = $query->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        $categories = Project::published()
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('public.projects.index', compact('projects', 'categories'));
    }

    public function show(string $slug): View
    {
        $project = Project::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProjects = Project::published()
            ->where('id', '!=', $project->id)
            ->where('category', $project->category)
            ->limit(3)
            ->get();

        return view('public.projects.show', compact('project', 'relatedProjects'));
    }
}
