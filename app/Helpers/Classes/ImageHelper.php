<?php

namespace App\Helpers\Classes;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class ImageHelper
{
    protected static function ensureStorageSymlink()
    {
        $publicStorage = public_path('storage');
        $target = storage_path('app/public');

        if (!File::exists($publicStorage)) {
            File::link($target, $publicStorage);
        }
    }

    /**
     * Upload original image as-is
     *
     * @param UploadedFile $file
     * @param string $folder
     * @return string
     */
    public static function uploadOriginal(UploadedFile $file, string $folder = 'uploads')
    {
        self::ensureStorageSymlink();

        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $folder . '/' . $fileName;

        Storage::disk('public')->put($path, file_get_contents($file));

        return 'storage/' . $path;
    }

    /**
     * Upload thumbnail image (300x200)
     *
     * @param UploadedFile $file
     * @param string $folder
     * @return string
     */
    public static function uploadThumbnail(UploadedFile $file, string $folder = 'uploads')
    {
        self::ensureStorageSymlink();

        $fileName = 'thumb_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $folder . '/' . $fileName;

        // Create ImageManager instance with Imagick driver (use GDDriver::class for GD)
        $manager = new ImageManager('imagick'); // driver as string

        $image = $manager->make($file)->fit(300, 200);

        Storage::disk('public')->put($path, (string) $image->encode());

        return 'storage/' . $path;
    }
}
