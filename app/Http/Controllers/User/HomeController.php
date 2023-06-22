<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Plan;
use App\Models\Signal;
use App\Models\Games;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['createFreeUser', 'createPremiumUser', 'manifest']);
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
        $game_ids = request()->current_company->companyGames()->where('is_active', 1)->pluck('game_id')->toArray();
        $view_vars = [
            'types' => $types,
            'game_names' => Games::query()->whereIn('id', $game_ids)->pluck('name')->toArray(),
        ];
        return view('user.home')->with($view_vars);
    }

    public function viewGame(Request $request, $company, $id)
    {
        $game = Games::query()->find($id);
        $game_ids = request()->current_company->companyGames()->where('is_active', 1)->pluck('game_id')->toArray();
        $game_names = Games::query()->whereIn('id', $game_ids)->pluck('name')->toArray();

        return view('user.game-view')->with(['game' => $game, 'game_names' => $game_names]);

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
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email|unique:users,email',
        ], [
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.unique' => 'O endereço de e-mail já está sendo utilizado por outro usuário.',
        ]);
        if ($validator->fails()) {
            return redirect()->route('user.login', $company)->withErrors($validator)->withInput();
        }

        $company = Company::where('slug', $company)->first();
        if ($company) {
            $company->users()->create([
                'name' => 'free user',
                'email' => $email,
                'password' => bcrypt('12345678'),
                'is_admin' => 0,
            ]);
        }
        return redirect()->route('user.login', $company);
    }

    public function createPremiumUser(Request $request, $company, $email)
    {
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email|unique:users,email',
        ], [
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.unique' => 'O endereço de e-mail já está sendo utilizado por outro usuário.',
        ]);
        if ($validator->fails()) {
            return redirect()->route('user.login', $company)->withErrors($validator)->withInput();
        }

        $company = Company::where('slug', $company)->first();
        if ($company) {
            $user = $company->users()->create([
                'name' => 'premium user',
                'email' => $email,
                'password' => bcrypt('12345678'),
                'is_admin' => 0,
            ]);
            $premiumPlan = Plan::where('name', Plan::PREMIUM_PLAN_NAME)->where('company_id', $company->id)->first();
            if ($premiumPlan) {
                $user->subscribePlan($premiumPlan->id);
            }
        }
        return redirect()->route('user.login', $company);
    }

    public function getCompanyDetail($slug): \Illuminate\Http\JsonResponse
    {

        $company = Company::where('slug', $slug)->first();
        $data = [
            'name' => $company->name,
            'logo' => $company->logo,
            'slug' => $company->slug,
            'favicon' => $company->favicon,
            'start_url' => url('/' . $company->slug),
        ];
        return response()->json($data);
    }

    public function manifest($company)
    {
        $company = Company::query()->where('slug', $company)->first();
        $template = file_get_contents(base_path('manifest/manifest.json'));
        $manifest = str_replace(
            ['{{shortName}}','{{start_url}}', '{{logo}}'],
            [Str::title(str_replace('-', ' ', $company->slug)), url('/').'/'.$company->slug, Storage::url($company->favicon)],
            $template
        );
        return response($manifest)->header('Content-Type', 'application/json');
    }
}
