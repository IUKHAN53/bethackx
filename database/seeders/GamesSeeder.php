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
        $games = [
            [
                'name' => 'Gates of Bet7k',
                'iframe_link' => 'https://bet7k.com/casino/vs20bet7kgate-gatesofbet7k',
                'image' => 'img/games/GATES.png',
                'game_type' => 'slots',
                'game_text' =>  'Ate 3 Tentivas!',
                'banner' => 'img/banners/gates-banner.png',
            ],
            [
                'name' => 'Mines',
                'iframe_link' => 'https://bet7k.com/casino/mines-mines',
                'image' => 'img/games/mines.png',
                'game_type' => 'slots',
                'game_text' =>  'Numero de Minas',
                'banner' => 'img/banners/mines-banner.png',
            ],
            [
                'name' => 'Space Man',
                'iframe_link' => 'https://bet7k.com/casino/1303-live-spaceman',
                'image' => 'img/games/spaceman.png',
                'game_type' => 'slots',
                'game_text' =>  'Ate 3 Tentivas!',
                'banner' => 'img/banners/spaceman-banner.png',
            ],
            [
                'name' => 'Hotline',
                'iframe_link' => 'https://bet7k.com/casino/hotline-hotline',
                'image' => 'img/games/hotline.png',
                'game_type' => 'slots',
                'game_text' =>  'Ate 3 Tentivas!',
                'banner' => 'img/banners/hotline-banner.png',
            ],
            [
                'name' => 'Penalty',
                'iframe_link' => 'https://bet7k.com/casino/9550-penaltyshootout',
                'image' => 'img/games/penalty.png',
                'game_type' => 'slots',
                'game_text' =>  'Escolha a Pais',
                'banner' => 'img/banners/penalty-banner.png',
            ],
            [
                'name' => 'Aviator',
                'iframe_link' => 'https://bet7k.com/casino/aviator-aviator',
                'image' => 'img/games/aviator.png',
                'game_type' => 'slots',
                'game_text' =>  'Ate 3 Tentivas!',
                'banner' => 'img/banners/aviator-banner.png',
            ],
            [
                'name' => 'Dragon Tiger',
                'iframe_link' => 'https://bet7k.com/casino/1001-live-dragontiger',
                'image' => 'img/games/dragontiger.png',
                'game_type' => 'cartas',
                'game_text' =>  'test',
                'banner' => 'img/banners/dragon-tiger.png',
            ],
            [
                'name' => 'Football Studio INglês Cards',
                'iframe_link' => 'https://bet7k.com/casino/13697-footballstudio',
                'image' => 'img/games/football.png',
                'game_type' => 'cartas',
                'game_text' =>  'Entrada recomendada',
                'banner' => 'img/banners/football-studio-banner.png',
            ],
            [
                'name' => 'Crazy Time',
                'iframe_link' => 'https://bet7k.com/casino/13509-crazytime',
                'image' => 'img/games/crazytime.png',
                'game_type' => '',
                'game_text' =>  'Ate 3 Tentivas!',
                'banner' => 'img/banners/crazy-time-banner.png',
            ],
            [
                'name' => 'Roulette 2',
                'iframe_link' => 'https://bet7k.com/casino/201-roulette2',
                'image' => 'img/games/roulette.png',
                'game_type' => 'roletas',
                'game_text' =>  'Ate 3 Tentivas!',
                'banner' => 'img/banners/roulette-banner.png',
            ],
            [
                'name' => 'Fan Tan Live',
                'iframe_link' => '',
                'image' => 'img/games/fantanlive.png',
                'game_type' => 'roletas',
                'game_text' =>  'Entrada recomendada',
                'banner' => 'img/banners/fan-tan-banner.png',
            ],
            [
                'name' => 'Bac bo',
                'iframe_link' => 'https://bet7k.com/casino/14529-bacbo',
                'image' => 'img/games/bacbo.png',
                'game_type' => 'dados',
                'game_text' =>  'Entrada recomendada',
                'banner' => 'img/banners/bac-bo-banner.png',
            ],
            [
                'name' => 'Football Studio Dice',
                'iframe_link' => 'https://bet7k.com/casino/29297-footballstudiodice',
                'image' => 'img/games/dice.png',
                'game_type' => 'dados',
                'game_text' =>  'Entrada recomendada',
                'banner' => 'img/banners/football-dice-banner.png',
            ],
        ];
        foreach ($games as $game) {
            Games::create([
                'name' => $game['name'],
                'iframe_link' => $game['iframe_link'],
                'image' => $game['image'],
                'game_type' => $game['game_type'],
                'game_text' => $game['game_text'],
                'banner' => $game['banner'],
            ]);
        }
    }
}
