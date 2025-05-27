<?php

if ( !function_exists('generateUniqueCacheKey') ){
    function generateUniqueCacheKey(array $data, $perPage)
    {
        ksort($data);
        return 'users:' . md5(json_encode($data) . "_perPage_$perPage");
    }
}
