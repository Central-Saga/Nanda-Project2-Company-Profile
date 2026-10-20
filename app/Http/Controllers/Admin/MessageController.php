<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Display contact messages with filter.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $crmStatus = $request->query('crm_status');

        $query = ContactMessage::with('handler')->latest('created_at');

        if (in_array($status, ['unread', 'read'], true)) {
            $query->where('status', $status);
        }

        if ($crmStatus && in_array($crmStatus, ['new', 'contacted', 'in_discussion', 'proposal_sent', 'won', 'lost'], true)) {
            $query->where('crm_status', $crmStatus);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('company_name', 'like', "%{$q}%")
                    ->orWhere('subject', 'like', "%{$q}%");
            });
        }

        $messages = $query->paginate(15)->withQueryString();

        $crmCounts = [
            'total' => ContactMessage::count(),
            'new' => ContactMessage::where('crm_status', 'new')->count(),
            'in_discussion' => ContactMessage::where('crm_status', 'in_discussion')->count(),
            'proposal_sent' => ContactMessage::where('crm_status', 'proposal_sent')->count(),
            'won' => ContactMessage::where('crm_status', 'won')->count(),
        ];

        return view('admin.messages.index', compact('messages', 'status', 'crmStatus', 'crmCounts'));
    }

    /**
     * View message detail.
     */
    public function show(ContactMessage $pesan): View
    {
        $pesan->load('handler');

        return view('admin.messages.show', ['message' => $pesan]);
    }

    /**
     * Mark message as read.
     */
    public function markAsRead(ContactMessage $pesan): RedirectResponse
    {
        $pesan->update([
            'status' => 'read',
            'handled_by' => auth()->id(),
        ]);

        ActivityLog::log('Menandai pesan dari ' . $pesan->name . ' sebagai dibaca', 'message', $pesan->id);

        return back()->with('success', 'Pesan telah ditandai sebagai sudah dibaca.');
    }

    /**
     * Update CRM pipeline status.
     */
    public function updateStatus(Request $request, ContactMessage $pesan): RedirectResponse
    {
        $validated = $request->validate([
            'crm_status' => ['required', 'string', 'in:new,contacted,in_discussion,proposal_sent,won,lost'],
        ]);

        $pesan->update([
            'crm_status' => $validated['crm_status'],
            'status' => 'read',
            'handled_by' => auth()->id(),
        ]);

        ActivityLog::log('Mengubah status CRM lead ' . $pesan->name . ' menjadi: ' . $validated['crm_status'], 'message', $pesan->id);

        return back()->with('success', 'Status prospek berhasil diperbarui.');
    }

    /**
     * Update admin note on message.
     */
    public function updateNote(Request $request, ContactMessage $pesan): RedirectResponse
    {
        $validated = $request->validate([
            'admin_note' => ['nullable', 'string', 'max:2000'],
        ]);

        $pesan->update([
            'admin_note' => $validated['admin_note'] ?? null,
            'handled_by' => auth()->id(),
        ]);

        ActivityLog::log('Menyimpan catatan internal pada pesan ' . $pesan->name, 'message', $pesan->id);

        return back()->with('success', 'Catatan admin berhasil disimpan.');
    }

    /**
     * Delete message.
     */
    public function destroy(ContactMessage $pesan): RedirectResponse
    {
        $name = $pesan->name;
        $pesan->delete();

        ActivityLog::log('Menghapus pesan dari: ' . $name, 'message');

        return redirect('/admin/pesan')->with('success', 'Pesan berhasil dihapus.');
    }
}
