<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Service;
use App\Services\ImageUploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display service listing.
     */
    public function index(): View
    {
        $services = Service::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show form to create new service.
     */
    public function create(): View
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request): RedirectResponse
    {
        $slug = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('title'));
        $request->merge(['slug' => $slug]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'slug' => ['required', 'string', 'max:180', 'unique:services,slug'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
            'benefits' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = ImageUploader::store($request->file('image'), 'services', 1200, 85);
        }

        $benefitsArray = [];
        if (!empty($validated['benefits'])) {
            $benefitsArray = array_values(array_filter(array_map('trim', preg_split('/[\r\n,]+/', $validated['benefits']))));
        }

        $techStackArray = [];
        if (!empty($validated['tech_stack'])) {
            $techStackArray = array_values(array_filter(array_map('trim', explode(',', $validated['tech_stack']))));
        }

        $service = Service::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'description' => $validated['description'],
            'icon' => $validated['icon'] ?? null,
            'benefits' => $benefitsArray,
            'tech_stack' => $techStackArray,
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured', false),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        ActivityLog::log('Menambahkan layanan baru: ' . $service->title, 'service', $service->id);

        return redirect('/admin/layanan')->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * Show form to edit an existing service.
     */
    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update an existing service.
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $slug = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('title'));
        $request->merge(['slug' => $slug]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'slug' => ['required', 'string', 'max:180', Rule::unique('services', 'slug')->ignore($service->id)],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
            'benefits' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $imagePath = $service->image;
        if ($request->hasFile('image')) {
            ImageUploader::delete($service->image);
            $imagePath = ImageUploader::store($request->file('image'), 'services', 1200, 85);
        }

        $benefitsArray = [];
        if (!empty($validated['benefits'])) {
            $benefitsArray = array_values(array_filter(array_map('trim', preg_split('/[\r\n,]+/', $validated['benefits']))));
        }

        $techStackArray = [];
        if (!empty($validated['tech_stack'])) {
            $techStackArray = array_values(array_filter(array_map('trim', explode(',', $validated['tech_stack']))));
        }

        $service->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'description' => $validated['description'],
            'icon' => $validated['icon'] ?? $service->icon,
            'benefits' => $benefitsArray,
            'tech_stack' => $techStackArray,
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active'),
            'is_featured' => $request->boolean('is_featured'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        ActivityLog::log('Memperbarui layanan: ' . $service->title, 'service', $service->id);

        return redirect('/admin/layanan')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified service.
     */
    public function destroy(Service $service): RedirectResponse
    {
        $title = $service->title;
        ImageUploader::delete($service->image);
        $service->delete();

        ActivityLog::log('Menghapus layanan: ' . $title, 'service');

        return redirect('/admin/layanan')->with('success', 'Layanan berhasil dihapus.');
    }
}
