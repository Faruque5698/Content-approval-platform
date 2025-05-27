<?php

namespace App\Observers;

use App\Helpers\Classes\CacheHelper;

class ModelCacheObserver
{
    public function created($model)
    {
        CacheHelper::incrementVersion(get_class($model));
    }

    public function updated($model)
    {
        CacheHelper::incrementVersion(get_class($model));
    }

    public function deleted($model)
    {
        CacheHelper::incrementVersion(get_class($model));
    }

}
