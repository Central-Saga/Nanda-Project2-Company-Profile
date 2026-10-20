<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\SiteProfile;
use App\Services\ImageUploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show form to edit site profile.
     */
    public function edit(): View
    {
        $profile = SiteProfile::first() ?? new SiteProfile();

        return view('admin.profile.edit', compact('profile'));
    }

    /**
     * Update or create site profile.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:150'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:500'],
            'about_story' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'mission' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'operating_hours' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'whatsapp_number' => ['nullable', 'string', 'max:30'],
            'whatsapp_template' => ['nullable', 'string', 'max:500'],
            'email' => ['nullable', 'email', 'max:150'],
            'address' => ['nullable', 'string'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'maps_url' => ['nullable', 'url', 'max:255'],
            'seo_keywords' => ['nullable', 'string', 'max:255'],
        ]);

        $profile = SiteProfile::first();

        $heroImagePath = $profile?->hero_image;
        if ($request->hasFile('hero_image')) {
            if ($profile && $profile->hero_image) {
                ImageUploader::delete($profile->hero_image);
            }
            $heroImagePath = ImageUploader::store($request->file('hero_image'), 'profile', 2000, 85);
        }

        $data = [
            'company_name' => $validated['company_name'],
            'tagline' => $validated['tagline'] ?? '',
            'hero_title' => $validated['hero_title'],
            'hero_subtitle' => $validated['hero_subtitle'] ?? null,
            'about_story' => $validated['about_story'] ?? null,
            'vision' => $validated['vision'] ?? null,
            'mission' => $validated['mission'] ?? null,
            'hero_image' => $heroImagePath,
            'operating_hours' => $validated['operating_hours'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'whatsapp_number' => $validated['whatsapp_number'] ?? null,
            'whatsapp_template' => $validated['whatsapp_template'] ?? null,
            'email' => $validated['email'] ?? null,
            'address' => $validated['address'] ?? null,
            'facebook_url' => $validated['facebook_url'] ?? null,
            'instagram_url' => $validated['instagram_url'] ?? null,
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'maps_url' => $validated['maps_url'] ?? null,
            'seo_keywords' => $validated['seo_keywords'] ?? null,
        ];

        if ($profile) {
            $profile->update($data);
        } else {
            SiteProfile::create($data);
        }

        ActivityLog::log('Memperbarui profil perusahaan & kontak', 'settings');

        return redirect('/admin/profil')->with('success', 'Profil usaha berhasil diperbarui.');
    }
}
