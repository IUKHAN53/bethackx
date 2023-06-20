<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() &&  Auth::user()->is_admin == 1 && request()->current_company->id == Auth::user()->company_id) {
            return $next($request);
        }
        return redirect('home');
    }
}
