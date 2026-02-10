<?php

use App\Models\SystemSetting;

if (! function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        return cache()->rememberForever("setting_{$key}", function () use ($key, $default) {
            return SystemSetting::where('key', $key)->value('value') ?? $default;
        });
    }
}
