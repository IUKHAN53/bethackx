<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyGames;
use App\Models\Games as Game;
use App\Models\GamesPlans;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();

        return view('superadmin.games.index', compact('games'));
    }

    public function create()
    {
        $companies = Company::all();

        return view('superadmin.games.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'game_text' => 'required',
            'game_type' => 'required',
            'description' => 'required',
            'iframe_link' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
            'company_id' => 'required|exists:companies,id',
        ]);

        $game = Game::create($validatedData);

        // Upload image
        $image = $request->file('image');
        $imagePath = $image->storeAs('public', 'game-'.$game->id.'-image-' . time() . '.' . $image->getClientOriginalExtension());

        // Upload banner
        $banner = $request->file('banner');
        $bannerPath = $banner->storeAs('public', 'game-'.$game->id.'-banner-' . time() . '.' . $banner->getClientOriginalExtension());

        $game->image = $imagePath;
        $game->banner = $bannerPath;

        if($game->save()){
            foreach (Company::query()->where('is_active', 1)->pluck('id')->toArray() as $company_id){
                CompanyGames::create([
                    'company_id' => $company_id,
                    'game_id' => $game->id,
                    'iframe_link' => $request->input('iframe_link'),
                ]);
            }
            foreach (Plan::query()->where('status', 1)->where('name', Plan::PREMIUM_PLAN_NAME)->pluck('id')->toArray() as $plan_id){
                GamesPlans::create([
                    'plan_id' => $plan_id,
                    'game_id' => $game->id,
                ]);
            }
        }

        return redirect()->route('super-admin.games.index')->with('success', 'Jogo criado com sucesso.');
    }

    public function show($id)
    {
        $game = Game::findOrFail($id);

        return view('superadmin.games.show', compact('game'));
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);
        $companies = Company::all();

        return view('superadmin.games.edit', compact('game', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'game_text' => 'required',
            'game_type' => 'required|in:slots,cartas,roletas,dados',
            'description' => 'required',
            'iframe_link' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $game->name = $request->input('name');
        $game->game_text = $request->input('game_text');
        $game->game_type = $request->input('game_type');
        $game->description = $request->input('description');
        $game->iframe_link = $request->input('iframe_link');
        $game->status = $request->input('status');
        $game->is_default = 0;

        if ($request->hasFile('image')) {
            if ($game->image) {
                Storage::delete($game->image);
            }
            $game->is_default = 0;
            $image = $request->file('image');
            $imagePath = $image->storeAs('public', 'game-'.$game->id.'-image-' . time() . '.' . $image->getClientOriginalExtension());

            $game->image = $imagePath;
        }

        if ($request->hasFile('banner')) {
            // Delete old banner if exists
            if ($game->banner) {
                Storage::delete($game->banner);
            }
            $game->is_default = 0;
            $banner = $request->file('banner');
            $bannerPath = $banner->storeAs('public', 'game-'.$game->id.'-banner-' . time() . '.' . $banner->getClientOriginalExtension());
            $game->banner = $bannerPath;
        }
        $game->save();

//        update game status in company games
        CompanyGames::query()->where('game_id', $game->id)->update(['is_active' => $game->status]);

        return redirect()->route('super-admin.games.index')->with('success', 'Jogo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('super-admin.games.index')->with('success', 'Jogo excluído com sucesso.');
    }
}
