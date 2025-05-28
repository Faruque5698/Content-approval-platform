<?php

namespace App\Traits\Post;

use App\Helpers\Classes\ImageHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

trait PostTrait
{
    private function processData(FormRequest $request, $method = 'create')
    {
        $data = $request->validated();

        if (isset($data['image'])) {
            $data['image_path'] = ImageHelper::uploadOriginal($request->image);
            $data['thumbnail_path'] = ImageHelper::uploadThumbnail($request->image);
        }

        if ($method === 'create') {
            $data['user_id'] = auth()->id();
            $data['slug'] = Str::slug($data['title']);
            $data['created_at'] = now();
        }else{
            $data['updated_at'] = now();
        }

        unset($data['categories'],$data['tags']);

        return $data;
    }
}
