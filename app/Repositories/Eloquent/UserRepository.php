<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $model;
    public function __construct()
    {
        $this->model = app('App\Models\User');
    }

    public function all()
    {

    }

    public function find($id)
    {

    }

    public function create(array $data)
    {

    }

    public function update($id, array $data)
    {

    }

    public function delete($id)
    {

    }

    public function getByRole($role)
    {

    }
}
