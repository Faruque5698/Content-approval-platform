<?php

namespace App\Services\User;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    protected $repository;
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllUsers(array $data)
    {
        return $this->repository->all($data);
    }
}
