<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::truncate();
        Company::create([
            'name' => 'BetHackX',
            'logo' => 'img/home_logo.png',
            'favicon' => 'img/favicon.png',
            'primary_color' => '#0c1624',
            'secondary_color' => '#2f3240',
            'tertiary_color' => '#423ed4',
            'is_active' => 1,
            'is_default' => 1,
            'admin_id' => User::query()->where('is_admin', 1)->first()->id,
        ]);
    }
}
