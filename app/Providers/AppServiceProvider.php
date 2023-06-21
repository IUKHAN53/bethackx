<?php

namespace App\Providers;

use Dotenv\Dotenv;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $request = Request::capture();
        $companySlug = $request->segment(1);
        $environmentFile = 'envs/.env.' . $companySlug;
        $dotenv = Dotenv::createImmutable(base_path(), $environmentFile);
        $dotenv->safeLoad();
        $company = DB::table('companies')->where('slug', $companySlug)->first();
        if ($company) {
            $configData = [
                'name' => $company->name ?? 'bethackx',
                'manifest' => [
                    'name' => $company->name ?? 'bethackx',
                    'short_name' => $company->slug ?? 'bethackx',
                    'start_url' => $company->slug ? url('/' . $company->slug) : url('/' . 'bethackx'),
                    'background_color' => '#0C1624FF',
                    'theme_color' => '#282834FF',
                    'display' => 'standalone',
                    'orientation' => 'any',
                    'status_bar' => 'black',
                    'icons' => [
                        '72x72' => [
                            'path' => Storage::url($company->favicon),
                            'purpose' => 'any'
                        ],
                        '96x96' => [
                            'path' => Storage::url($company->favicon),
                            'purpose' => 'any'
                        ],
                        '128x128' => [
                            'path' => Storage::url($company->favicon),
                            'purpose' => 'any'
                        ],
                        '144x144' => [
                            'path' => Storage::url($company->favicon),
                            'purpose' => 'any'
                        ],
                        '152x152' => [
                            'path' => Storage::url($company->favicon),
                            'purpose' => 'any'
                        ],
                        '192x192' => [
                            'path' => Storage::url($company->favicon),
                            'purpose' => 'any'
                        ],
                        '384x384' => [
                            'path' => Storage::url($company->favicon),
                            'purpose' => 'any'
                        ],
                        '512x512' => [
                            'path' => Storage::url($company->favicon),
                            'purpose' => 'any'
                        ],
                    ],
                    'splash' => [
                        '640x1136' => Storage::url($company->favicon),
                        '750x1334' => Storage::url($company->favicon),
                        '828x1792' => Storage::url($company->favicon),
                        '1125x2436' => Storage::url($company->favicon),
                        '1242x2208' => Storage::url($company->favicon),
                        '1242x2688' => Storage::url($company->favicon),
                        '1536x2048' => Storage::url($company->favicon),
                        '1668x2224' => Storage::url($company->favicon),
                        '1668x2388' => Storage::url($company->favicon),
                        '2048x2732' => Storage::url($company->favicon),
                    ],
                    'custom' => []
                ]
            ];
            $configContent = '<?php' . PHP_EOL . PHP_EOL . 'use Illuminate\Support\Str;' . PHP_EOL . PHP_EOL . 'return ' . var_export($configData, true) . ';' . PHP_EOL;

            $configPath = config_path('laravelpwa.php');
            File::put($configPath, $configContent);
            Artisan::call('config:clear');
        }
    }
}
