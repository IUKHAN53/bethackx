<?php

use Illuminate\Support\Str;

return [
    'name' => 'BetHackX',
    'manifest' => [
        'name' => Str::title(str_replace('-', ' ', env('PWA_SHORTCUT_NAME', 'BetHackX'))),
        'short_name' => Str::title(str_replace('-', ' ', env('PWA_SHORTCUT_NAME', 'BetHackX'))),
        'start_url' => env('PWA_HOME_URL', 'http://bethackx.test/bethackx'),
        'background_color' => '#0C1624FF',
        'theme_color' => '#282834FF',
        'display' => 'standalone',
        'orientation' => 'any',
        'status_bar' => 'black',
        'icons' => [
            '72x72' => [
                'path' => env('FAVICON_URL', '/img/favicon.png'),
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => env('FAVICON_URL', '/img/favicon.png'),
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => env('FAVICON_URL', '/img/favicon.png'),
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => env('FAVICON_URL', '/img/favicon.png'),
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => env('FAVICON_URL', '/img/favicon.png'),
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => env('FAVICON_URL', '/img/favicon.png'),
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => env('FAVICON_URL', '/img/favicon.png'),
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => env('FAVICON_URL', '/img/favicon.png'),
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => env('FAVICON_URL', '/img/favicon.png'),
            '750x1334' => env('FAVICON_URL', '/img/favicon.png'),
            '828x1792' => env('FAVICON_URL', '/img/favicon.png'),
            '1125x2436' => env('FAVICON_URL', '/img/favicon.png'),
            '1242x2208' => env('FAVICON_URL', '/img/favicon.png'),
            '1242x2688' => env('FAVICON_URL', '/img/favicon.png'),
            '1536x2048' => env('FAVICON_URL', '/img/favicon.png'),
            '1668x2224' => env('FAVICON_URL', '/img/favicon.png'),
            '1668x2388' => env('FAVICON_URL', '/img/favicon.png'),
            '2048x2732' => env('FAVICON_URL', '/img/favicon.png'),
        ],
        'custom' => []
    ]
];
