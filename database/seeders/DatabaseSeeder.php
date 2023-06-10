<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(GamesSeeder::class);
        $this->call(GlobalSettingsSeeder::class);
        $this->call(GameDataSeeder::class);
    }
}
