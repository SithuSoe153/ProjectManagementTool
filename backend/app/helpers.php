<?php

if (!function_exists('secure_asset')) {
    function secure_asset($path, $secure = null)
    {
        return asset($path, true);
    }
}
