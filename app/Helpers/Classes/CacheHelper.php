<?php

namespace App\Helpers\Classes;

use Illuminate\Support\Facades\Cache;

class CacheHelper
{
    /**
     * Increment cache version for a given model or key
     *
     * @param string|object $model
     * @return void
     */
    public static function incrementVersion($model): void
    {
        $modelClass = is_string($model) ? $model : get_class($model);
        $baseName = strtolower(class_basename($modelClass));
        $cacheVersionKey = $baseName . '_cache_version';

        if (!Cache::has($cacheVersionKey)) {
            Cache::put($cacheVersionKey, 1);
        } else {
            Cache::increment($cacheVersionKey);
        }
    }

    /**
     * Get cache version for a given model or key
     *
     * @param string|object $model
     * @return int
     */
    public static function getVersion($model): int
    {
        $modelClass = is_string($model) ? $model : get_class($model);
        $baseName = strtolower(class_basename($modelClass));
        $cacheVersionKey = $baseName . '_cache_version';

        return Cache::get($cacheVersionKey, 1);
    }

    /**
     * Generate a unique cache key with version for a given model and parameters
     *
     * @param string|object $model
     * @param array $params
     * @param int|null $perPage
     * @return string
     */
    public static function generateCacheKey($model, array $params = [], int $perPage = null): string
    {
        ksort($params);
        $baseName = strtolower(class_basename(is_string($model) ? $model : get_class($model)));
        $version = self::getVersion($model);
        $perPagePart = $perPage ? "_perPage_{$perPage}" : '';

        $user = auth()->user();
        $userKeyPart = $user ? "_user_{$user->id}" : '_guest';

        $datetime = now()->format('YmdHis');

        return "{$baseName}:" . md5(json_encode($params) . $perPagePart . $userKeyPart . $datetime) . "_v{$version}";
    }
}
