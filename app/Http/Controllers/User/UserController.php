<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['login']);
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
}
