<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index(Request $request): View
    {
        $query = Project::query();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('client', 'like', "%{$q}%");
            });
        }

        $projects = $query->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        $categories = Project::select('category')->distinct()->pluck('category');

        return view('admin.projects.index', compact('projects', 'categories'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:220', 'unique:projects,slug'],
            'category' => ['required', 'string', 'max:100'],
            'client' => ['nullable', 'string', 'max:150'],
            'completion_date' => ['nullable', 'string', 'max:50'],
            'external_url' => ['nullable', 'url', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $slug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('projects', 'public');
        }

        $techStackArray = [];
        if (!empty($validated['tech_stack'])) {
            $techStackArray = array_values(array_filter(array_map('trim', explode(',', $validated['tech_stack']))));
        }

        $project = Project::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'client' => $validated['client'] ?? null,
            'completion_date' => $validated['completion_date'] ?? null,
            'external_url' => $validated['external_url'] ?? null,
            'description' => $validated['description'],
            'content' => $validated['content'] ?? null,
            'thumbnail' => $thumbnailPath,
            'tech_stack' => $techStackArray,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published', true),
        ]);

        ActivityLog::log('Menambahkan proyek baru: ' . $project->title, 'project', $project->id);

        return redirect()->route('admin.proyek.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:220', 'unique:projects,slug,' . $project->id],
            'category' => ['required', 'string', 'max:100'],
            'client' => ['nullable', 'string', 'max:150'],
            'completion_date' => ['nullable', 'string', 'max:50'],
            'external_url' => ['nullable', 'url', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $slug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        if ($slug !== $project->slug) {
            $originalSlug = $slug;
            $counter = 1;
            while (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                $slug = "{$originalSlug}-{$counter}";
                $counter++;
            }
        }

        $thumbnailPath = $project->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($thumbnailPath && Storage::disk('public')->exists($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = $request->file('thumbnail')->store('projects', 'public');
        }

        $techStackArray = [];
        if (!empty($validated['tech_stack'])) {
            $techStackArray = array_values(array_filter(array_map('trim', explode(',', $validated['tech_stack']))));
        }

        $project->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'client' => $validated['client'] ?? null,
            'completion_date' => $validated['completion_date'] ?? null,
            'external_url' => $validated['external_url'] ?? null,
            'description' => $validated['description'],
            'content' => $validated['content'] ?? null,
            'thumbnail' => $thumbnailPath,
            'tech_stack' => $techStackArray,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published'),
        ]);

        ActivityLog::log('Memperbarui proyek: ' . $project->title, 'project', $project->id);

        return redirect()->route('admin.proyek.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        if ($project->thumbnail && Storage::disk('public')->exists($project->thumbnail)) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        $title = $project->title;
        $project->delete();

        ActivityLog::log('Menghapus proyek: ' . $title, 'project');

        return redirect()->route('admin.proyek.index')->with('success', 'Proyek berhasil dihapus.');
    }
}

