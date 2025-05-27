<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all(array $data = [])
    {
        $user = $this->model->query();

        if (!empty($data['role'])) {
            $user->where('role', $data['role']);
        }

        if (!empty($data['search'])) {
            $user->where(function ($query) use ($data) {
                $query->where('name', 'like', '%' . $data['search'] . '%')
                    ->orWhere('email', 'like', '%' . $data['search'] . '%');
            });
        }

        return $user->orderBy('id', 'DESC')
            ->paginate($data['per_page'] ?? 10);
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
