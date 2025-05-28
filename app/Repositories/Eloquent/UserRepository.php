<?php

namespace App\Repositories\Eloquent;

use App\Helpers\Classes\CacheHelper;
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
        $cacheKey = CacheHelper::generateCacheKey($this->model, $data, $perPage);

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
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        $user = $this->model->create($data);
        return $user;
    }

    public function update(array $data, $id)
    {
        $user = $this->model->findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->model->findOrFail($id);
        $user->delete();
        return true;
    }

}
