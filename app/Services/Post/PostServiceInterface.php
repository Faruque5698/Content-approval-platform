<?php

namespace App\Services\Post;

use Illuminate\Foundation\Http\FormRequest;

interface PostServiceInterface
{
    public function getAllPosts(array $data);

    public function storePost(FormRequest $request);

    public function getPostById($id);

    public function updatePost(FormRequest $request, $id);

    public function delete($id);

}
