<?php

use App\Models\Company;

if (!function_exists('setEnvFromDatabase')) {
    function setEnvFromDatabase()
    {
        $currentUrl = url()->current();
        $urlComponents = parse_url($currentUrl);
        if ($urlComponents['path'] == '/') {
            abort(404);
        } else {
            $pathParts = explode('/', $urlComponents['path']);
            $companySlug = $pathParts[1] ?? '';
            if ($companySlug) {
                $company = Company::where('slug', $companySlug)->first();
                if ($company) {
                    $company = Company::where('slug', $companySlug)->first();
                    if (!$company) {
                        abort(404);
                    }
                    $value = $company->favicon;
                    file_put_contents(app()->environmentFilePath(), str_replace(
                        "FAVICON_URL=" . env('FAVICON_URL'),
                        "FAVICON_URL=$value",
                        file_get_contents(app()->environmentFilePath())
                    ));

                    // Store the updated value in the current request
                    $_ENV['FAVICON_URL'] = $value;
                    $_SERVER['FAVICON_URL'] = $value;

                    $value = $company->logo;
                    file_put_contents(app()->environmentFilePath(), str_replace(
                        "ICON_URL=" . env('FAVICON_URL'),
                        "ICON_URL=$value",
                        file_get_contents(app()->environmentFilePath())
                    ));

                    // Store the updated value in the current request
                    $_ENV['ICON_URL'] = $value;
                    $_SERVER['ICON_URL'] = $value;
                } else {
                    abort(404);
                }
            } else {
                abort(404);
            }
        }
    }
}
