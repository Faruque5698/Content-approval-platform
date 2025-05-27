<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class ModelCacheObserver
{
    public function created($model)
    {
        invalidateCache($model);
    }

    public function updated($model)
    {
        invalidateCache($model);
    }

    public function deleted($model)
    {
        invalidateCache($model);
    }

}
