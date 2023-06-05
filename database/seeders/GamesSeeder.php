<?php

namespace Database\Seeders;

use App\Models\Games;
use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Games::truncate();
        $games = ['Aviator', 'Space Man', 'Gates of Bet7k', 'Penalty', 'Hotline', 'Roulette 2', 'Crazy Time', 'Fan Tan Live', 'Bac bo', 'Football Studio Dice', 'Football Studio Cartas', 'Dragon Tiger'];
        foreach ($games as $game) {
            Games::create([
                'name' => $game,
            ]);
        }
    }
}
