<?php

namespace App\Services\Tag;

use App\Repositories\Contracts\TagRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class TagService implements TagServiceInterface
{
    protected $repository;

    public function __construct(TagRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTags(array $data)
    {
        $data = $this->repository->all($data);
        return $data;
    }

    public function storeTag(FormRequest $request)
    {
        return $this->repository->create($request->validated());
    }

    public function getTagById($id)
    {
        return $this->repository->find($id);
    }

    public function updateTag(FormRequest $request, $id)
    {
        return $this->repository->update($request->validated(), $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function getTagDropdownData()
    {
        return $this->repository->getTagDropdownData();
    }
}
