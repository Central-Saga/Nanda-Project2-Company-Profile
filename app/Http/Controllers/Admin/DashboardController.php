<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\AdminNotification;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\GalleryItem;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the advanced admin summary dashboard.
     */
    public function index(): View
    {
        $counts = [
            'services' => Service::count(),
            'projects' => Project::count(),
            'projects_featured' => Project::where('is_featured', true)->count(),
            'gallery' => GalleryItem::count(),
            'testimonials_pending' => Testimonial::where('status', 'pending')->count(),
            'testimonials_total' => Testimonial::count(),
            'articles_draft' => Article::where('status', 'draft')->count(),
            'articles_total' => Article::count(),
            'messages_unread' => ContactMessage::where('status', 'unread')->count(),
            'leads_new' => ContactMessage::where('crm_status', 'new')->count(),
            'leads_in_discussion' => ContactMessage::where('crm_status', 'in_discussion')->count(),
            'leads_won' => ContactMessage::where('crm_status', 'won')->count(),
            'leads_total' => ContactMessage::count(),
        ];

        $recentMessages = ContactMessage::latest('created_at')
            ->limit(6)
            ->get();

        $recentProjects = Project::latest('id')
            ->limit(4)
            ->get();

        $recentActivities = ActivityLog::with('user')
            ->latest('id')
            ->limit(8)
            ->get();

        $notifications = AdminNotification::unread()
            ->latest('id')
            ->limit(5)
            ->get();

        // Chart data: Monthly inquiry count for the last 6 months
        $monthlyTrends = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthKey = $month->translatedFormat('M Y');
            $count = ContactMessage::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $monthlyTrends[] = [
                'month' => $monthKey,
                'count' => $count,
            ];
        }

        // Service category distribution
        $serviceCategories = Project::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'counts',
            'recentMessages',
            'recentProjects',
            'recentActivities',
            'notifications',
            'monthlyTrends',
            'serviceCategories'
        ));
    }

    /**
     * Mark a single notification as read.
     */
    public function markNotificationRead(AdminNotification $notification): RedirectResponse
    {
        $notification->update(['is_read' => true]);

        return redirect()->to($notification->link ?? route('admin.dashboard'));
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllNotificationsRead(): RedirectResponse
    {
        AdminNotification::where('is_read', false)->update(['is_read' => true]);

        return back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }
}
