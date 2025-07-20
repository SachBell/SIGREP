<?php

namespace App\Helpers;

use App\Models\GeneralSetting;

class SettingsHelper
{
    public static function get($key, $default = null)
    {
        return GeneralSetting::where('key', $key)->value('value') ?? $default;
    }

    public static function set($key, $value)
    {
        return GeneralSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
