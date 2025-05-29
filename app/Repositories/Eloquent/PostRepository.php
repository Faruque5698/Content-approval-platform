<?php

namespace App\Repositories\Eloquent;

use App\Helpers\Classes\CacheHelper;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PostRepository implements PostRepositoryInterface
{
    protected $model;
    protected $user;

    public function __construct(Post $model)
    {
        $this->model = $model;
        $this->user = auth()->user(); // global auth user
    }

    public function all(array $data = [])
    {
        $perPage = $data['per_page'] ?? 10;
        $cacheKey = CacheHelper::generateCacheKey($this->model, $data, $perPage);

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($data, $perPage, $cacheKey) {
            Log::info('DB query executed for cache key: ' . $cacheKey);

            $query = $this->model->notArchived()->visibleTo($this->user);

            if (!empty($data['search'])) {
                $query->where(function ($q) use ($data) {
                    $q->where('name', 'like', '%' . $data['search'] . '%');
                });
            }

            return $query->orderBy('id', 'desc')->paginate($perPage);
        });
    }

    public function find($id)
    {
        return $this->model->visibleTo($this->user)->with(['user','tags','categories'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $post = $this->model->visibleTo($this->user)->findOrFail($id);
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->model->visibleTo($this->user)->findOrFail($id);
        $post->delete();
        return true;
    }

    public function categoryAdd($data, $id)
    {
        $post = $this->model->visibleTo($this->user)->findOrFail($id);
        return $post->categories()->sync($data);
    }

    public function tagAdd($data, $id)
    {
        $post = $this->model->visibleTo($this->user)->findOrFail($id);
        return $post->tags()->sync($data);
    }

    public function trashList(array $data = [])
    {
        $perPage = $data['per_page'] ?? 10;

        $query = $this->model->visibleTo($this->user)->onlyTrashed();

        if (!empty($data['search'])) {
            $query->where(function ($q) use ($data) {
                $q->where('title', 'like', '%' . $data['search'] . '%');
            });
        }

        return $query->orderBy('id', 'desc')->paginate($perPage);
    }

    public function trashRestore($id)
    {
        $post = $this->findOnlyTrashed($id);
        return $post->restore();
    }

    public function forceDelete($id)
    {
        $post = $this->findOnlyTrashed($id);
        return $post->forceDelete();
    }

    public function archivedList(array $data = [])
    {
        $perPage = $data['per_page'] ?? 10;

        $query = $this->model->archived()->visibleTo($this->user);

        if (!empty($data['search'])) {
            $query->where(function ($q) use ($data) {
                $q->where('title', 'like', '%' . $data['search'] . '%');
            });
        }

        return $query->orderBy('id', 'desc')->paginate($perPage);
    }

    public function archive($id)
    {
        $post = $this->model->visibleTo($this->user)->findOrFail($id);
        $post->archived_at = now();
        $post->save();
        return $post;
    }

    public function archiveRestore($id)
    {
        $post = $this->model->archived()->visibleTo($this->user)->findOrFail($id);
        $post->archived_at = null;
        $post->save();
        return $post;
    }

    public function findOnlyTrashed($id)
    {
        return $this->model->onlyTrashed()->visibleTo($this->user)->findOrFail($id);
    }

    public function updateStatus($id, $status)
    {
        $post = $this->model->visibleTo($this->user)->findOrFail($id);
        $post->status = $status;
        $post->save();
        return $post;
    }
}
