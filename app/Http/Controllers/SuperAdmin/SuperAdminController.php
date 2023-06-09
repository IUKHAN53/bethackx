<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
class SuperAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect()->route('super-admin.users.index');
//        $view_vars = [
//
//        ];
//        return view('super-admin.home')->with($view_vars);
    }

}
