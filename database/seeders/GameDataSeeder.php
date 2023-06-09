<?php

namespace Database\Seeders;

use App\Models\Signal;
use App\Models\Games;
use Illuminate\Database\Seeder;

class GameDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Games::all() as $game) {
            if($game->name == 'Mines' || $game->name == 'Penalty'){
                Signal::create([
                    'game_id' => $game->id,
                    'game_name' => $game->name,
                    'signal_type' => 'image',
                    'signal' => '1.png',
                ]);
                Signal::create([
                    'game_id' => $game->id,
                    'game_name' => $game->name,
                    'signal_type' => 'image',
                    'signal' => '2.png',
                ]);
                Signal::create([
                    'game_id' => $game->id,
                    'game_name' => $game->name,
                    'signal_type' => 'image',
                    'signal' => '3.png',
                ]);
            }
            Signal::create([
                'game_id' => $game->id,
                'game_name' => $game->name,
                'signal_type' => 'text',
                'signal' => $game->name . 'test_1',
            ]);
            Signal::create([
                'game_id' => $game->id,
                'game_name' => $game->name,
                'signal_type' => 'text',
                'signal' => $game->name . 'test_2',
            ]);
            Signal::create([
                'game_id' => $game->id,
                'game_name' => $game->name,
                'signal_type' => 'text',
                'signal' => $game->name . 'test_3',
            ]);
        }
    }
}
