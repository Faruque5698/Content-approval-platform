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

    public function trashList(array $data = []);

    public function trashRestore($id);

    public function forceDelete($id);

    public function archivedList(array $data = []);
    public function archive($id);
    public function archiveRestore($id);
    public function updateStatus($id, $status);
    public function getAllApprovedPosts($data);
    public function getPostBySlug($slug);

}
