<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\ImageUploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    /**
     * Display all testimonials.
     */
    public function index(): View
    {
        $testimonials = Testimonial::latest('created_at')->get();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show form to create testimonial.
     */
    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store newly created testimonial.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'role' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:10'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:pending,approved,hidden'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = ImageUploader::store($request->file('photo'), 'testimonials', 800, 85);
        }

        Testimonial::create([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'message' => $validated['message'],
            'rating' => $validated['rating'],
            'photo' => $photoPath,
            'status' => $validated['status'],
        ]);

        return redirect('/admin/testimoni')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Show form to edit testimonial.
     */
    public function edit(Testimonial $testimoni): View
    {
        return view('admin.testimonials.edit', ['testimonial' => $testimoni]);
    }

    /**
     * Update testimonial.
     */
    public function update(Request $request, Testimonial $testimoni): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'role' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:10'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:pending,approved,hidden'],
        ]);

        $photoPath = $testimoni->photo;
        if ($request->hasFile('photo')) {
            ImageUploader::delete($testimoni->photo);
            $photoPath = ImageUploader::store($request->file('photo'), 'testimonials', 800, 85);
        }

        $testimoni->update([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'message' => $validated['message'],
            'rating' => $validated['rating'],
            'photo' => $photoPath,
            'status' => $validated['status'],
        ]);

        return redirect('/admin/testimoni')->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Approve testimonial directly.
     */
    public function approve(Testimonial $testimoni): RedirectResponse
    {
        $testimoni->update(['status' => 'approved']);

        return back()->with('success', 'Testimoni berhasil disetujui untuk ditampilkan.');
    }

    /**
     * Hide testimonial directly.
     */
    public function hide(Testimonial $testimoni): RedirectResponse
    {
        $testimoni->update(['status' => 'hidden']);

        return back()->with('success', 'Testimoni berhasil disembunyikan.');
    }

    /**
     * Delete testimonial.
     */
    public function destroy(Testimonial $testimoni): RedirectResponse
    {
        ImageUploader::delete($testimoni->photo);
        $testimoni->delete();

        return redirect('/admin/testimoni')->with('success', 'Testimoni berhasil dihapus.');
    }
}

