<?php

namespace Database\Seeders;

use App\Models\GlobalSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GlobalSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GlobalSettings::truncate();
        $settings = [
            [
                'key' => 'request_access_link',
                'value' => '',
            ],[
                'key' => 'help_link',
                'value' => '',
            ],[
                'key' => 'home_banner',
                'value' => '',
            ],[
                'key' => 'home_banner_ref_link',
                'value' => '',
            ],[
                'key' => 'admin_tutorial_link',
                'value' => '',
            ],
        ];
        foreach($settings as $setting)
        {
            GlobalSettings::create([
                'key' => $setting['key'],
                'value' => $setting['value'],
            ]);
        }
    }
}
