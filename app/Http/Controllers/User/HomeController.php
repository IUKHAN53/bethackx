<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Games;
use App\Models\GlobalSettings;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = (new \App\Models\GlobalSettings)->getSettings();
        $types = [];
        foreach (Games::GAME_TYPES as $type) {
            $types[$type] = Games::query()->where('status', '!=', 0)->where('game_type', $type)->get();
        }
        $view_vars = [
            'types' => $types,
            'settings' => $settings,
        ];
        return view('user.home')->with($view_vars);
    }
}
