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

        $view_vars = [

        ];
        return view('supersuper-admin.home')->with($view_vars);
    }

}
