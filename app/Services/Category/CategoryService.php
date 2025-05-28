<?php

namespace App\Services\Category;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class CategoryService
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCategories(array $data)
    {
        $data = $this->repository->all($data);
        return $data;
    }

    public function storeCategory(FormRequest $request)
    {
        return $this->repository->create($request->validated());
    }

    public function getCategoryById($id)
    {
        return $this->repository->find($id);
    }

    public function updateCategory(FormRequest $request, $id)
    {
        return $this->repository->update($request->validated(), $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
