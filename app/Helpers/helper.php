<?php

use App\Models\Company;

if (!function_exists('setEnvFromDatabase')) {
    function setEnvFromDatabase()
    {
        $currentUrl = url()->current();
        $urlComponents = parse_url($currentUrl);
        if (isset($urlComponents['path'])) {
            $pathParts = explode('/', $urlComponents['path']);
            $companySlug = $pathParts[1] ?? '';
            if ($companySlug) {
                $company = Company::where('slug', $companySlug)->first();
                if ($company) {
                    $company = Company::where('slug', $companySlug)->first();
                    if (!$company) {
                        return;
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
                        "ICON_URL=" . env('ICON_URL'),
                        "ICON_URL=$value",
                        file_get_contents(app()->environmentFilePath())
                    ));

                    // Store the updated value in the current request
                    $_ENV['ICON_URL'] = $value;
                    $_SERVER['ICON_URL'] = $value;

                    $value = $company->name;
                    file_put_contents(app()->environmentFilePath(), str_replace(
                        "APP_NAME=" . env('APP_NAME'),
                        "APP_NAME=$value",
                        file_get_contents(app()->environmentFilePath())
                    ));

                    // Store the updated value in the current request
                    $_ENV['APP_NAME'] = $value;
                    $_SERVER['APP_NAME'] = $value;
                } else {
                    return;
                }
            } else {
                return;
            }
        } else {
            return;
        }
    }
}
