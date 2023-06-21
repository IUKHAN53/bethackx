<?php

use App\Models\Company;
use Illuminate\Support\Facades\File;
use Symfony\Component\Dotenv\Dotenv;
use Illuminate\Support\Facades\Storage;

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
                    if ($company->favicon && $company->is_default == 0) {
                        $value = Storage::url($company->favicon);
                    } else {
                        $value = asset('img/favicon.png');
                    }
                    setEnvValue('FAVICON_URL', $value);
                    if ($company->logo && $company->is_default == 0) {
                        $value = Storage::url($company->logo);
                    } else {
                        $value = asset('img/home_logo.png');
                    }
                    setEnvValue('ICON_URL', $value);

                    $value = $company->slug ?? 'BetHackX';
                    setEnvValue('PWA_SHORTCUT_NAME', $value);

                    $value = url('/' . $company->slug);
                    setEnvValue('PWA_HOME_URL', $value);

                    $value = $company->primary_color ?? '#0C1624FF';
                    setEnvValue('PRIMARY_COLOR', $value);

                    $value = $company->secondary_color ?? '#282834FF';
                    setEnvValue('SECONDARY_COLOR', $value);
                }
            }
        }
    }
}

if (!function_exists('setEnvValue')) {
    function setEnvValue($key, $value): void
    {
        $envFile = app()->environmentFilePath();
        $dotenv = new Dotenv();
        $envValues = $dotenv->parse(file_get_contents($envFile));
        $envValues[$key] = $value;
        $envContent = '';
        foreach ($envValues as $envKey => $envValue) {
            $envContent .= $envKey . '=' . $envValue . PHP_EOL;
        }
        file_put_contents($envFile, $envContent);
        $dotenv->load($envFile);

        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

function createEnvFileFromDefault($company): bool
{
    $defaultEnvFile = base_path('.env.company');
    $targetEnvFile = base_path('envs/.env.' . $company->slug);

    if (File::exists($defaultEnvFile) && !File::exists($targetEnvFile)) {
        File::copy($defaultEnvFile, $targetEnvFile);
    }

    if (File::exists($targetEnvFile)) {
        $envContents = file_get_contents($targetEnvFile);

        $replacements = [
            'PWA_SHORTCUT_NAME' => $company->slug,
            'PWA_HOME_URL' => url('/' . $company->slug),
            'FAVICON_URL' => $company->favicon,
            'ICON_URL' => $company->logo,
            'PRIMARY_COLOR' => $company->primary_color,
            'SECONDARY_COLOR' => $company->secondary_color,
        ];

        foreach ($replacements as $key => $value) {
            $pattern = '/^' . preg_quote($key, '/') . '.*/m';
            $replacement = $key . '=' . $value;
            $envContents = preg_replace($pattern, $replacement, $envContents);
        }

        file_put_contents($targetEnvFile, $envContents);

        return true;
    }

    return false;
}
