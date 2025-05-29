<?php

namespace App\Traits\Post;

use App\Helpers\Classes\ImageHelper;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

trait PostTrait
{
    private function processData(FormRequest $request, $method = 'create')
    {
        $data = $request->validated();

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

    private function processImage($data, $id = null){
        if (isset($data['image'])) {
            if ($id) {
                $post = Post::find($id);
                if ($post && $post->image_path) {
                    ImageHelper::deleteImage($post->image_path);
                }
                if ($post && $post->thumbnail_path) {
                    ImageHelper::deleteImage($post->thumbnail_path);
                }
            }
            $data['image_path'] = ImageHelper::uploadFile($data['image'], 'uploads');
            $data['thumbnail_path'] = ImageHelper::uploadFile($data['image'],'uploads/thumbnails', 200, 300);
        }
        unset($data['image']);
        return $data;

    }
}
