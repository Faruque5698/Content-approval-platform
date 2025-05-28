<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;


class CategoryRepository implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $model)
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
        $category = $this->model->create($data);
        return $category;
    }

    public function update(array $data, $id)
    {
        $category = $this->model->findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->model->findOrFail($id);
        $category->delete();
        return true;
    }

    public function getCategoryDropdownData()
    {
        return $this->model->select('id', 'name')->orderBy('name','ASC')->get();

    }

}
