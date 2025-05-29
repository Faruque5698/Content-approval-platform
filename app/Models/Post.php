<?php

namespace App\Models;

use App\Traits\Observer\ObserverTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $guarded = [];

    use SoftDeletes, ObserverTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_posts');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function scopeArchived($query)
    {
        return $query->whereNotNull('archived_at');
    }

    public function scopeNotArchived($query)
    {
        return $query->whereNull('archived_at');
    }

    public function scopeVisibleTo($query, User $user)
    {
        if ($user && $user->isAdmin()) {
            return $query;
        } elseif ($user) {
            return $query->where('user_id', $user->id);
        } else {
            return $query->where('status', 'published');
        }
    }
}
