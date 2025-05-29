<?php

namespace App\Helpers\Classes;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageHelper
{
    public static function uploadFile($file, $path, $height = null, $width = null)
    {
        if (!str_ends_with($path, '/')) {
            $path .= '/';
        }

        createFolder($path);

        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $cleanName = preg_replace('/[^A-Za-z0-9\-.]/', '', str_replace(' ', '-', $originalName));
        $fileName = Str::random(6) . time() . Str::random(4) . $cleanName;

        $finalPath = $path . $fileName;

        if (
            in_array(strtolower($extension), ['jpeg', 'png', 'jpg', 'gif', 'bmp', 'tiff', 'tif', 'webp']) &&
            $height && $width
        ) {
            self::resizeImage(
                $file->getRealPath(),
                $fileName,
                $path,
                $height,
                $width
            );
        } else {
            Storage::disk('public')->putFileAs($path, $file, $fileName);
        }

        return 'storage/' . $finalPath;
    }


    public static function resizeImage($originalFilePath, $fileName, $savePath, $height, $width)
    {
        $manager = new ImageManager(new Driver());

        $resized = $manager->read($originalFilePath)
            ->cover($width, $height);

        $saveFullPath = Storage::disk('public')->path($savePath . $fileName);
        $resized->save($saveFullPath);
    }

    public static function deleteImage(string $path): bool
    {
        $relativePath = preg_replace('/^storage\//', '', $path);

        if (Storage::disk('public')->exists($relativePath)) {
            return Storage::disk('public')->delete($relativePath);
        }

        return false;
    }


}
