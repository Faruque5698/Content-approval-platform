<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;


class PostRepository implements PostRepositoryInterface
{
    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function all(array $data = [])
    {
        $perPage = $data['per_page'] ?? 10;

        $query = $this->model->newQuery();

        if (!empty($data['search'])) {
            $query->where(function ($q) use ($data) {
                $q->where('name', 'like', '%' . $data['search'] . '%');
            });
        }

        return $query->orderBy('id', 'desc')->paginate($perPage);

    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        $post = $this->model->create($data);
        return $post;
    }

    public function update(array $data, $id)
    {
        $post = $this->model->findOrFail($id);
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->model->findOrFail($id);
        $post->delete();
        return true;
    }

    public function categoryAdd($data, $id)
    {
        $post = $this->model->findOrFail($id);
        return $post->categories()->sync($data);
    }

    public function tagAdd($data, $id)
    {
        $post = $this->model->findOrFail($id);
        return $post->tags()->sync($data);
    }



}
