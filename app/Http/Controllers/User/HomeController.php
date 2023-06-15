<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Signal;
use App\Models\Games;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['createFreeUser']);
    }

    public function index()
    {
        $types = [];
        $games = request()->current_company->companyGames()->where('is_active', 1)->get();
        foreach (Games::GAME_TYPES as $type) {
            $g = [];
            foreach ($games as $game) {
                if ($game->game->game_type == $type)
                    $g[] = $game->game;
            }
            $types[$type] = $g;
        }
        $view_vars = [
            'types' => $types,
        ];
        return view('user.home')->with($view_vars);
    }

    public function viewGame(Request $request, $company, $id)
    {
        $game = Games::query()->find($id);
        return view('user.game-view')->with(['game' => $game]);

    }

    public function getGameSignal(Request $request, $company, $id)
    {
        $game_signal = Signal::query()->where('game_id', $id)->inRandomOrder()->first();
        $game = Games::query()->find($id);
        $signal = '';
        if ($game_signal) {
            if ($game_signal->signal_type == 'image') {
                $signal = asset('img/signals/' . $game->name . '/' . $game_signal->signal);
            } else {
                $signal = $game_signal->signal;
            }
        }
        return response()->json([
            'type' => $game_signal->signal_type,
            'signal' => $signal,
        ]);
    }

    public function createFreeUser(Request $request, $company, $email)
    {
        $request->current_company->users()->create([
            'name' => 'free user',
            'email' => $email,
            'password' => bcrypt('12345678'),
            'is_admin' => 0,
        ]);
        return redirect()->route('user.login', $company);
    }
}
