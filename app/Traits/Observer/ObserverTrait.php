<?php

namespace App\Traits\Observer;

use App\Observers\ModelCacheObserver;

trait ObserverTrait
{
    public static function bootObserverTrait()
    {
        static::observe(ModelCacheObserver::class);
    }
}
