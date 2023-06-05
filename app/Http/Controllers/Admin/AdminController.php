<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Games;
use App\Models\GlobalSettings;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = (new \App\Models\GlobalSettings)->getSettings();
        $view_vars = [
            'users' => User::query()->where('id', '!=', auth()->id())->get(),
            'games' => Games::query()->where('status', '!=', 0)->get(),
            'g_settings' => $settings,
        ];
        return view('admin.home')->with($view_vars);
    }

    public function saveGames(Request $request)
    {
        if (isset($request->games)) {
            foreach ($request->games as $key => $link) {
                $game = Games::query()->find($key);
                $game->iframe_link = $link;
                $game->save();
            }
        }
        return redirect()->back();
    }

    public function saveExternalLinks(Request $request)
    {
        if (isset($request->settings)) {
            foreach ($request->settings as $key => $value) {
                $setting = GlobalSettings::query()->where('key', trim($key, "'"))->first();
                $setting->value = $value;
                $setting->save();
            }
        }
        return redirect()->back();
    }
    public function saveBanner(Request $request)
    {

        if (isset($request->settings)) {
            foreach ($request->settings as $key => $value) {
                $key = trim($key, "'");
                if ($key == 'home_banner') {
                    $name = 'home_banner-' . time() . '.' . $value->getClientOriginalExtension();
                    $banner = $value->storeAs('banners/', $name);
                    $value = $banner;
                }
                $setting = GlobalSettings::query()->where('key', $key)->first();
                $setting->value = $value;
                $setting->save();
            }
        }
        return redirect()->back();
    }

    public function addUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = strtolower($request->email);
        $user->password = bcrypt($request->password);
        $user->save();
        $users = User::query()->where('id', '!=', auth()->id())->get();
        $html = view('admin.partials.users-table', compact('users'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'Added User.',
        ]);
    }

    public function searchUser(Request $request)
    {
        $users = User::query()->where('id', '!=', auth()->id())->where('name', 'like', '%' . $request->keyword . '%')->get();
        $html = view('admin.partials.users-table', compact('users'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'searched Users.',
        ]);
    }
}
