<?php

namespace App\Services;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Storage;

class SettingsService
{
    /**
     * Get all settings as a key => value pair array
     */
    public function getAllSettings(): array
    {
        return SystemSetting::pluck('value', 'key')->toArray();
    }

    /**
     * Update multiple settings
     */
    public function updateSettings(array $data): void
    {
        foreach ($data as $key => $value) {
            // Skip null values if you don't want to overwrite with empty
            if (is_null($value)) continue;

            // Use updateOrCreate on the model
            \App\Models\SystemSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => (string) $value, // Cast to string for the DB
                    'name'  => str_replace('_', ' ', ucfirst($key))
                ]
            );
        }
    }
}
