<?php

namespace App\Models;

use App\Observers\ModelCacheObserver;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::observe(ModelCacheObserver::class);
    }
}
