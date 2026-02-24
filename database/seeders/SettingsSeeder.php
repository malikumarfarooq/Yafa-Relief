<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $settings = [
            [
                'name' => 'Site Title',
                'key' => 'site_title',
                'value' => 'My Application',
            ],
            [
                'name' => 'Site Tagline',
                'key' => 'site_tagline',
                'value' => 'Manage everything in one place',
            ],
            [
                'name' => 'Primary Contact Email',
                'key' => 'primary_email',
                'value' => 'support@example.com',
            ],
            [
                'name' => 'Support Contact Number',
                'key' => 'support_phone',
                'value' => '+92 300 0000000',
            ],
            [
                'name' => 'Default Language',
                'key' => 'default_language',
                'value' => 'en',
            ],
            [
                'name' => 'Default Currency',
                'key' => 'default_currency',
                'value' => 'PKR',
            ],
            [
                'name' => 'Company Name',
                'key' => 'company_name',
                'value' => 'My Company Pvt Ltd',
            ],
            [
                'name' => 'Tax / VAT Number',
                'key' => 'tax_vat_number',
                'value' => null,
            ],
            [
                'name' => 'Website URL',
                'key' => 'website_url',
                'value' => 'https://example.com',
            ],
            [
                'name' => 'Business Address',
                'key' => 'business_address',
                'value' => 'Lahore, Pakistan',
            ],
            [
                'name' => 'System Logo',
                'key' => 'system_logo',
                'value' => null,
            ],
            [
                'name' => 'System Favicon',
                'key' => 'system_favicon',
                'value' => null,
            ],
            [
                'name' => 'System Icon',
                'key' => 'system_icon',
                'value' => null,
            ],
            [
                'name' => 'Timezone',
                'key' => 'timezone',
                'value' => 'UTC',
            ],
            [
                'name' => 'Date Format',
                'key' => 'date_format',
                'value' => 'Y-m-d',
            ],
            [
                'name' => 'Time Format',
                'key' => 'time_format',
                'value' => 'H:i:s',
            ],
            [
                'name' => 'website_description',
                'key' => 'website_description',
                'value' => 'A comprehensive dashboard management system.',
            ],
        ];

        foreach ($settings as &$setting) {
            $setting['created_at'] = $now;
            $setting['updated_at'] = $now;
        }

        DB::table('system_settings')->insertOrIgnore($settings);
    }
}
