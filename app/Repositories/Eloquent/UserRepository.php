<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface
{
    protected $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all(array $data = [])
    {
        $perPage = $data['per_page'] ?? 10;
        $cacheKey = generateUniqueCacheKey($data, $perPage);

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($data, $perPage, $cacheKey) {
            Log::info('DB query executed for cache key: ' . $cacheKey);

            $query = $this->model->newQuery();

            if (!empty($data['role'])) {
                $query->where('role', $data['role']);
            }

            if (!empty($data['search'])) {
                $query->where(function ($q) use ($data) {
                    $q->where('name', 'like', '%' . $data['search'] . '%')
                        ->orWhere('email', 'like', '%' . $data['search'] . '%');
                });
            }

            return $query->orderBy('id', 'desc')->paginate($perPage);
        });
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
