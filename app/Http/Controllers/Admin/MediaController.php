<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\MediaFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MediaController extends Controller
{
    /**
     * Display media files library.
     */
    public function index(Request $request): View
    {
        $query = MediaFile::with('user');

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('mime_type', 'like', $request->type . '/%');
        }

        if ($request->filled('q')) {
            $query->where('original_name', 'like', '%' . $request->q . '%');
        }

        $files = $query->latest('id')->paginate(18)->withQueryString();

        $totalSize = MediaFile::sum('file_size');

        return view('admin.media.index', compact('files', 'totalSize'));
    }

    /**
     * Store newly uploaded media file.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'max:10240', 'mimes:jpeg,png,jpg,webp,svg,pdf,zip,mp4'],
        ]);

        $uploaded = $request->file('file');
        $originalName = $uploaded->getClientOriginalName();
        $mime = $uploaded->getMimeType();
        $size = $uploaded->getSize();
        $path = $uploaded->store('media', 'public');
        $filename = basename($path);

        $media = MediaFile::create([
            'filename' => $filename,
            'original_name' => $originalName,
            'file_path' => $path,
            'mime_type' => $mime,
            'file_size' => $size,
            'user_id' => auth()->id(),
        ]);

        ActivityLog::log('Mengunggah berkas media: ' . $originalName, 'media', $media);

        return redirect()->route('admin.media.index')->with('success', 'Berkas berhasil diunggah ke Media Library.');
    }

    /**
     * Remove the specified media file from storage.
     */
    public function destroy(MediaFile $medium): RedirectResponse
    {
        if (Storage::disk('public')->exists($medium->file_path)) {
            Storage::disk('public')->delete($medium->file_path);
        }

        $name = $medium->original_name;
        $medium->delete();

        ActivityLog::log('Menghapus berkas media: ' . $name, 'media');

        return redirect()->route('admin.media.index')->with('success', 'Berkas media berhasil dihapus.');
    }
}

