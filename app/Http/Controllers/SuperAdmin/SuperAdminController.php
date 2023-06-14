<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['login']);
    }

    public function index()
    {
        return redirect()->route('super-admin.users.index');
//        $view_vars = [
//
//        ];
//        return view('super-admin.home')->with($view_vars);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

            if ($user->isSuperAdmin()) {
                return redirect()->route('super-admin.view');
            }
        }

        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('super-admin.login');
    }

}
