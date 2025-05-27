<?php

use Illuminate\Support\Facades\Cache;

if ( !function_exists('generateUniqueCacheKey') ){
    function generateUniqueCacheKey(array $data, $perPage)
    {
        ksort($data);
        return 'users:' . md5(json_encode($data) . "_perPage_$perPage");
    }
}


if ( !function_exists('invalidateCache') ){
    function invalidateCache($model)
    {
        $modelClass = is_string($model) ? $model : get_class($model);

        $baseName = strtolower(class_basename($modelClass));

        $cacheKey = $baseName . '_cache_version';

        Cache::increment($cacheKey);
    }
}
