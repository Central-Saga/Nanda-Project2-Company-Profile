<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\SiteProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display the dedicated contact & project inquiry page.
     */
    public function index(): View
    {
        $siteProfile = SiteProfile::current();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();

        return view('public.contact', compact('siteProfile', 'services'));
    }

    /**
     * Store incoming contact message / project inquiry.
     */
    public function store(Request $request): RedirectResponse
    {
        // Honeypot check: website field must be empty
        if (!empty($request->input('website'))) {
            // Silently redirect if spambot filled honeypot
            return redirect('/#kontak')->with('success', 'Pesan Anda telah diterima.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'min:5', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
            'company_name' => ['nullable', 'string', 'max:150'],
            'service_type' => ['nullable', 'string', 'max:100'],
            'budget_range' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'max:0'],
        ]);

        $message = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'company_name' => $validated['company_name'] ?? null,
            'service_type' => $validated['service_type'] ?? null,
            'budget_range' => $validated['budget_range'] ?? null,
            'status' => 'unread',
            'crm_status' => 'new',
        ]);

        // Send internal notification to admin
        AdminNotification::send(
            'Inquiry Baru: ' . $validated['name'] . (!empty($validated['service_type']) ? ' (' . $validated['service_type'] . ')' : ''),
            route('admin.pesan.show', $message->id),
            'inquiry'
        );

        return redirect('/#kontak')->with('success', 'Terima kasih, pesan Anda telah berhasil dikirim. Tim kami akan segera menindaklanjuti pesan Anda.');
    }
}
