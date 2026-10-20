<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of system activity logs.
     */
    public function index(Request $request): View
    {
        $query = ActivityLog::with('user');

        if ($request->filled('subject')) {
            $query->where('subject_type', $request->subject);
        }

        $logs = $query->latest('id')->paginate(25)->withQueryString();

        return view('admin.activity-logs.index', compact('logs'));
    }
}

