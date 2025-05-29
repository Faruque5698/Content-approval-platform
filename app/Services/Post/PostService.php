<?php

namespace App\Services\Post;

use App\Helpers\Classes\ImageHelper;
use App\Jobs\SendPostStatusEmail;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Traits\Post\PostTrait;
use Illuminate\Foundation\Http\FormRequest;


class PostService implements PostServiceInterface
{
    use PostTrait;

    protected $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPosts(array $data)
    {
        $data = $this->repository->all($data);
        return $data;
    }

    public function storePost(FormRequest $request)
    {
        $data = $this->processData($request);
        $data = $this->processImage($data);
        $post = $this->repository->create($data);
        if (count($request->categories) > 0) {
            $this->repository->categoryAdd($request->categories, $post->id);
        }

        if (count($request->tags) > 0) {
            $this->repository->tagAdd($request->tags, $post->id);
        }

        return $post;
    }

    public function getPostById($id)
    {
        return $this->repository->find($id);
    }

    public function updatePost(FormRequest $request, $id)
    {
        $data = $this->processData($request, 'update');
        $data = $this->processImage($data, $id);
        $post = $this->repository->update($data, $id);
        if (count($request->categories) > 0) {
            $this->repository->categoryAdd($request->categories, $post->id);
        }

        if (count($request->tags) > 0) {
            $this->repository->tagAdd($request->tags, $post->id);
        }
        return $post;
    }

    public function delete($id)
    {
        $post = $this->repository->find($id);
        if ($post) {
            $this->repository->delete($id);
            return true;
        }
        return false;
    }


    public function trashList(array $data = [])
    {
        return $this->repository->trashList($data);
    }

    public function trashRestore($id)
    {
        return $this->repository->trashRestore($id);

    }

    public function forceDelete($id)
    {
        $post = $this->repository->findOnlyTrashed($id);
        if ($post) {
            if ($post->image) {
                ImageHelper::deleteImage($post->image);
            }

            $post->categories()->detach();
            $post->tags()->detach();

            $this->repository->forceDelete($id);
            return true;
        }
        return false;
    }

    public function archivedList(array $data = [])
    {
        return $this->repository->archivedList($data);
    }

    public function archive($id)
    {
        return $this->repository->archive($id);
    }

    public function archiveRestore($id)
    {
        return $this->repository->archiveRestore($id);
    }

    public function updateStatus($id, $status)
    {
        $post = $this->repository->updateStatus($id, $status);
        if ($status != 'pending'){
            SendPostStatusEmail::dispatch($post->user, $post);
        }
        return $post;
    }

}
