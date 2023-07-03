<?php

namespace App\Http\Controllers\User;

use App\Models\Company;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['login', 'registerFree', 'registerPremium']);
    }

    public function index()
    {
        return view('user.home');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && Auth::user()->company_id && Auth::user()->company_id == $request->current_company->id) {
            return redirect()->route('home', $request->current_company->slug);
        }

        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials or company.',
        ]);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('user.login', request()->get('current_company')->slug);
    }

    public function registerFree(Request $request, $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $company = Company::where('slug', $company)->first();
        if ($company) {
            $company->users()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_admin' => 0,
            ]);
        }
        return redirect()->route('user.login', $company);

    }

    public function registerPremium(Request $request, $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $company = Company::where('slug', $company)->first();
        if ($company) {
            $user = $company->users()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_admin' => 0,
            ]);
            $premiumPlan = Plan::where('name', Plan::PREMIUM_PLAN_NAME)->where('company_id', $company->id)->first();
            if ($premiumPlan) {
                $user->subscribePlan($premiumPlan->id);
            }
        }
        return redirect()->route('user.login', $company);
    }
}
