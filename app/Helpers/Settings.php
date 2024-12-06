<?php
namespace App\Helpers;

use App\Models\Setting;

class Settings
{
    public static function get($key, $default = null)
    {
        return Setting::where('key', $key)->value('value') ?? $default;
    }
}