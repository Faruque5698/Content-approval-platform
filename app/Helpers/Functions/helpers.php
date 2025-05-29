<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('createFolder')) {
    function createFolder($path)
    {
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path, 0777, true);
        }

        // Force chmod (for extra safety on some systems)
        $fullPath = storage_path('app/public/' . $path);
        if (file_exists($fullPath)) {
            chmod($fullPath, 0777);
        }
    }
}


