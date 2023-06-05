<?php

return [
    'name' => 'Bet HackX',
    'manifest' => [
        'name' => env('APP_NAME', 'Bet HackX'),
        'short_name' => 'BetHackX',
        'start_url' => '/',
        'background_color' => '#1b2226',
        'theme_color' => '#2f3240',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/img/logo.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/img/logo.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/img/logo.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/img/logo.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/img/home_logo.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/img/home_logo.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/img/home_logo.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/img/home_logo.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/img/home_logo.png',
            '750x1334' => '/img/home_logo.png',
            '828x1792' => '/img/home_logo.png',
            '1125x2436' => '/img/home_logo.png',
            '1242x2208' => '/img/home_logo.png',
            '1242x2688' => '/img/home_logo.png',
            '1536x2048' => '/img/home_logo.png',
            '1668x2224' => '/img/home_logo.png',
            '1668x2388' => '/img/home_logo.png',
            '2048x2732' => '/img/home_logo.png',
        ],
        'shortcuts' => [
            [
                'name' => 'BetHackX',
                'description' => 'A shortcut that opens the app',
                'url' => '/home',
                'icons' => [
                    "src" => "/img/home_logo.png",
                    "purpose" => "any"
                ]
            ]
        ],
        'custom' => []
    ]
];
