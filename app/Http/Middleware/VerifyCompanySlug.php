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
            $company_slug = Company::getDefaultOrFirst()->slug;
            return redirect()->route('welcome', ['company' => $company_slug]);
        }
        $request->merge(['current_company' => $company]);
        return $next($request);
    }
}
