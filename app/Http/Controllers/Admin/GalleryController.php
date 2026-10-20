<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Services\ImageUploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display gallery listing.
     */
    public function index(): View
    {
        $galleries = GalleryItem::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show form to add new gallery photo.
     */
    public function create(): View
    {
        return view('admin.gallery.create');
    }

    /**
     * Store new gallery item.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:150'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $imagePath = ImageUploader::store($request->file('image'), 'gallery', 1600, 82);

        GalleryItem::create([
            'title' => $validated['title'] ?? null,
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect('/admin/galeri')->with('success', 'Foto portofolio berhasil ditambahkan.');
    }

    /**
     * Delete gallery item.
     */
    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        ImageUploader::delete($gallery->image_path);
        $gallery->delete();

        return redirect('/admin/galeri')->with('success', 'Item galeri berhasil dihapus.');
    }
}

