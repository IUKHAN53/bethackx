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
                    setEnvValue('FAVICON_URL', $value);

                    $value = $company->logo;
                    setEnvValue('ICON_URL', $value);

                    $value = $company->name ?? 'BetHackX';
                    setEnvValue('PWA_SHORTCUT_NAME', $value);

                    $value = url('/' . $company->slug);
                    setEnvValue('PWA_HOME_URL', $value);
                }
            }
        }
    }
}

if (!function_exists('setEnvValue')) {
    function setEnvValue($key, $value): void
    {

        file_put_contents(app()->environmentFilePath(), preg_replace(
            '/^' . $key . '=.*$/m',
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));

        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}
