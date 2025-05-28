<?php

namespace App\Repositories\Eloquent;

use App\Models\Tag;
use App\Repositories\Contracts\TagRepositoryInterface;


class TagRepository implements TagRepositoryInterface
{
    protected $model;

    public function __construct(Tag $model)
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
        $tag = $this->model->create($data);
        return $tag;
    }

    public function update(array $data, $id)
    {
        $tag = $this->model->findOrFail($id);
        $tag->update($data);
        return $tag;
    }

    public function delete($id)
    {
        $tag = $this->model->findOrFail($id);
        $tag->delete();
        return true;
    }

}
