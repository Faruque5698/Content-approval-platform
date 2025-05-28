<?php

namespace App\Services\User;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\User\UserTrait;
use Illuminate\Foundation\Http\FormRequest;

class UserService
{
    use UserTrait;
    protected $repository;
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllUsers(array $data)
    {
        return $this->repository->all($data);
    }

    public function storeUser(FormRequest $request)
    {
        $data = $this->processData($request);

        $user = $this->repository->create($data);

        if (!$user) {
            throw new \Exception("User creation failed.");
        }
        return $user;
    }

    public function getUserById($id)
    {
        return $this->repository->find($id);
    }

    public function updateUser(FormRequest $request, $id)
    {
        $processData = $this->processData($request, 'update');
        return $this->repository->update($processData, $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

}
