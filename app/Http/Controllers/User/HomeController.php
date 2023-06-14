<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Signal;
use App\Models\Games;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $types = [];

        foreach (Games::GAME_TYPES as $type) {
            $types[$type] = Games::query()->where('status', '!=', 0)->where('game_type', $type)->get();
        }
        $view_vars = [
            'types' => $types,
        ];
        return view('user.home')->with($view_vars);
    }

    public function viewGame(Request $request,$company, $id){
        $game = Games::query()->find($id);
        return view('user.game-view')->with(['game' => $game, 'settings' => (new \App\Models\GlobalSettings)->getSettings()]);

    }

    public function getGameSignal(Request $request,$company, $id){
        $game_signal = Signal::query()->where('game_id',$id)->inRandomOrder()->first();
        $game = Games::query()->find($id);
        $signal = '';
        if ($game_signal){
            if ($game_signal->signal_type == 'image'){
                $signal = asset('img/signals/'. $game->name .'/'. $game_signal->signal);
            }else{
                $signal = $game_signal->signal;
            }
        }
        return response()->json([
            'type' => $game_signal->signal_type,
            'signal' => $signal,
        ]);
    }
}
