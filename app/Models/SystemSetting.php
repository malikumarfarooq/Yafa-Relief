<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = [
        'name',
        'key',
        'value',
    ];

    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    public static function setValue($key, $value)
    {
        return self::updateOrCreate(
            ['name' => ucfirst(str_replace('_', ' ', $key)), 'key' => $key],
            ['key' => $key],
            ['value' => $value]
        );
    }
}
