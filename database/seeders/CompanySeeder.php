<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyGames;
use App\Models\Games;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::create([
            'name' => 'BetHackX',
            'slug' => 'bethackx',
            'logo' => 'img/home_logo.png',
            'favicon' => 'img/favicon.png',
            'primary_color' => '#0c1624',
            'secondary_color' => '#2f3240',
            'tertiary_color' => '#423ed4',
            'buttons_color' => '#0d6efd',
            'notices_color' => '#6f42c1',
            'is_active' => 1,
            'is_default' => 1,
            'admin_id' => User::query()->where('is_admin', 1)->first()->id,
        ]);

        foreach (Games::query()->where('status', 1)->get() as $game) {
            CompanyGames::create(
                [
                    'company_id' => $company->id,
                    'game_id' => $game->id,
                    'iframe_link' => $game->iframe_link,
                ]);
        }
    }
}
