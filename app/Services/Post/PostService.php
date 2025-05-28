<?php

namespace App\Services\Post;

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
        $data= $this->processData($request);
        $post =  $this->repository->create($data);
        if (count($request->categories) > 0){
            $this->repository->categoryAdd($request->categories, $post->id);
        }

        if (count($request->tags) > 0){
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
        return $this->repository->update($request->validated(), $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

}
