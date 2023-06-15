<?php

return [
    'name' => 'BetHackX',
    'manifest' => [
        'name' => env('APP_NAME', 'BetHackX'),
        'short_name' => 'BetHackX',
        'start_url' => '/',
        'background_color' => '#1b2226',
        'theme_color' => '#2f3240',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
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
        'shortcuts' => [
            [
                'name' => 'BetHackX',
                'description' => 'A shortcut that opens the app',
                'url' => '/home',
                'icons' => [
                    "src" => env('FAVICON_URL', '/img/favicon.png'),
                    "purpose" => "any"
                ]
            ]
        ],
        'custom' => []
    ]
];
