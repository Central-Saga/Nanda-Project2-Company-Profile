<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageUploader
{
    /**
     * Store and optimize an uploaded image.
     */
    public static function store(UploadedFile $file, string $folder, int $maxDim, int $quality): string
    {
        $folder = trim($folder, '/');

        if (extension_loaded('gd')) {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file->getRealPath());
            $image->scaleDown(width: $maxDim, height: $maxDim);
            $encoded = $image->toWebp(quality: $quality);

            $filename = Str::random(40) . '.webp';
            $path = $folder . '/' . $filename;

            Storage::disk('public')->put($path, (string) $encoded);

            return $path;
        }

        // Fallback if GD extension is not loaded in current PHP environment
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = Str::random(40) . ($extension ? '.' . $extension : '');
        $path = $folder . '/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($file->getRealPath()));

        return $path;
    }

    /**
     * Delete an image from public storage if it exists.
     */
    public static function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}

