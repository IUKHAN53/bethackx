<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyGames;
use App\Models\Games;
use App\Models\GamesPlans;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['login']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && Auth::user()->isAdmin() && Auth::user()->company_id && Auth::user()->company_id == $request->current_company->id) {
            return redirect()->route('admin.view', $request->current_company->slug);
        }
        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials or company.',
        ]);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('admin.login', request()->get('current_company')->slug);
    }

    public function index()
    {
        $view_vars = [
            'users' => User::query()->companyScope()->where('id', '!=', auth()->id())->get(),
            'games' => Games::query()->where('status', '!=', 0)->get(),
            'plans' => Plan::query()->companyScope()->get(),
            'company' => request()->current_company,
        ];
        return view('admin.home')->with($view_vars);
    }

    public function saveGames(Request $request)
    {
        if (isset($request->games)) {
            foreach ($request->games as $key => $link) {
                $game = CompanyGames::query()->where('company_id', $request->current_company->id)->where('game_id', $key)->first();
                if ($game) {
                    $game->iframe_link = $link;
                    $game->save();
                }
            }
        }
        return redirect()->back();
    }

    public function saveExternalLinks(Request $request)
    {
        if (isset($request->settings)) {
            foreach ($request->settings as $key => $value) {
                $key = trim($key, "'");
                $request->current_company->{$key} = $value;
                $request->current_company->save();
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
                    $banner = $value->storeAs('public', $name);
                    $value = $banner;
                }
                $request->current_company->{$key} = $value;
                $request->current_company->save();
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
        $user->company_id = $request->current_company->id;
        $user->save();
        $users = User::query()->where('id', '!=', auth()->id())->where('company_id', $request->current_company->id)->get();
        $html = view('admin.partials.users-table', compact('users'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'Added User',
        ]);
    }

    public function deleteUser(Request $request)
    {
        $user = User::query()->find($request->id);
        $user->subscriptions()->delete();
        $user->delete();
        $users = User::query()->where('id', '!=', auth()->id())->where('company_id', $request->current_company->id)->get();
        $html = view('admin.partials.users-table', compact('users'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'Deleted User.',
        ]);
    }

    public function addPlan(Request $request)
    {
        $plan = new Plan();
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->company_id = $request->current_company->id;
        $plan->save();
        $plans = Plan::query()->where('company_id', $request->current_company->id)->get();
        $html = view('admin.partials.plans-table', compact('plans'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'Added Plan.',
        ]);
    }

    public function deletePlan(Request $request)
    {
        $plan = Plan::query()->find($request->id);
        $plan->delete();
        $plans = Plan::query()->where('company_id', $request->current_company->id)->get();
        $html = view('admin.partials.plans-table', compact('plans'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'Deleted Plan.',
        ]);
    }

    public function searchUser(Request $request)
    {
        $users = User::query()->where('id', '!=', auth()->id())
            ->where('name', 'like', '%' . $request->keyword . '%')
            ->where('company_id', $request->current_company->id)->get();
        $html = view('admin.partials.users-table', compact('users'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'searched Users.',
        ]);
    }

    public function updateCompany(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'company_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'image|mimes:jpeg,png,jpg,gif,ico|max:2048',
            'primary_color' => 'required',
            'secondary_color' => 'required',
            'tertiary_color' => 'required',
            'user_tutorial_link' => '',
        ]);

        $company = $request->current_company;

        $company->name = $request->input('company_name');

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->storeAs('public', 'company-' . $company->id . '-logo-' . time() . '.' . $logo->getClientOriginalExtension());
            $company->logo = $logoPath;
        }

        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $faviconPath = $favicon->storeAs('public', 'company-' . $company->id . '-favicon-' . time() . '.' . $favicon->getClientOriginalExtension());
            $company->favicon = $faviconPath;
        }

        $company->primary_color = $request->input('primary_color');
        $company->secondary_color = $request->input('secondary_color');
        $company->tertiary_color = $request->input('tertiary_color');
        $company->buttons_color = $request->input('buttons_color');
        $company->notices_color = $request->input('notices_color');
        $company->plan_checkout_link = $request->input('plan_checkout_link');
        $company->user_tutorial_link = $request->input('user_tutorial_link');

        $company->save();

        return redirect()->back()->with('success', 'Company details updated successfully.');
    }

    public function getPlanGames(Request $request)
    {
        $plan = Plan::query()->find($request->id);
        $all_games_id = CompanyGames::query()->where('company_id', $request->current_company->id)->pluck('game_id')->toArray();
        $all_games = Games::find($all_games_id);
        $games = $plan->gamesPlans->pluck('game_id')->toArray();

        $html = view('admin.partials.plan-games', compact('games', 'all_games', 'plan'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'searched Users.',
        ]);
    }

    public function addPlanGames(Request $request)
    {
        $gameIds = $request->game_status; // Get the selected game IDs from the request
        $plan = Plan::find($request->plan_id);
        $plan->gamesPlans->each->delete(); // Delete all the games from the plan

        foreach ($gameIds as $key => $value) {
            $plan->gamesPlans()->create([
                'game_id' => $value,
                'plan_id' => $plan->id,
            ]);
        }
        return back();
    }

    public function getUserPlans(Request $request)
    {
        $user = User::find($request->id);
        $all_plans = Plan::query()->where('company_id', $request->current_company->id)->get();
        $user_plans = $user->subscribedPlans();

        $html = view('admin.partials.user-plans', compact('user_plans', 'all_plans', 'user'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'searched Users.',
        ]);
    }

    public function addUserPlans(Request $request)
    {
        $planIds = $request->plan_status; // Get the selected game IDs from the request
        $user = User::find($request->user_id);
        foreach ($planIds as $key => $value) {
            $user->subscribePlan($value);
        }
        return back();
    }

    public function getUserData(Request $request)
    {
        $user = User::query()->find($request->id);
        $html = view('admin.partials.user-edit-modal-content', compact('user'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'user modal rendered',
        ]);
    }

    public function updateUserData(Request $request)
    {
        $user = User::find($request->id);
        $user->name = empty($request->name) ?: $request->name;
        $user->password = empty($request->password) ?: bcrypt($request->password);
        $user->save();
        $users = User::query()->where('id', '!=', auth()->id())
            ->where('company_id', $request->current_company->id)->get();
        $html = view('admin.partials.users-table', compact('users'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'user updated',
        ]);
    }

}
