<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display public gallery list.
     */
    public function index(): View
    {
        $galleries = GalleryItem::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('public.galleries.index', compact('galleries'));
    }
}

