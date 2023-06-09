<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\Company;
use Dotenv\Dotenv;

class VerifyCompanySlug
{
    public function handle($request, Closure $next)
    {
        $companySlug = $request->route('company');
        $company = Company::where('slug', $companySlug)->first();

        if (!$company) {
            $companySlug = Company::getDefaultOrFirst()->slug;
            $request->route()->setParameter('company', $companySlug);
            $company = Company::where('slug', $companySlug)->first();
        }
        $request->merge(['current_company' => $company]);
        return $next($request);
    }

}
