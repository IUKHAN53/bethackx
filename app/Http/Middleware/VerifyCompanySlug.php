<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\Company;

class VerifyCompanySlug
{
    public function handle($request, Closure $next)
    {
        $companySlug = $request->route('company');
        $company = Company::where('slug', $companySlug)->first();
        if (!$company) {
            abort(404);
        }

        // Store the company in the request for easy access
        $request->merge(['current_company' => $company]);

        return $next($request);
    }
}
