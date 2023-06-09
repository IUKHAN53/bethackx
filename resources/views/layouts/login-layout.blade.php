<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$current_company ? $current_company->name : config('app.name', 'BetHackX') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <style>
        /* Apply the colors dynamically */
        :root {
            --primary-color: {{ $current_company->primary_color }}      !important;
            --secondary-color: {{ $current_company->secondary_color }}      !important;
            --tertiary-color: {{ $current_company->tertiary_color }}      !important;
            --button-color: {{ $current_company->buttons_color }}      !important;
            --notices-color: {{ $current_company->notices_color }}      !important;
            /* Add other color variables as needed */
        }
    </style>
    <!-- Scripts -->
    @if ($current_company && $current_company->is_default==0 )
        @if ($current_company->favicon)
            <link rel="icon" type="image/png" href="{{Storage::url($current_company->favicon)}}" sizes="32x32">
            <link rel="apple-touch-icon" sizes="180x180" href="{{Storage::url($current_company->favicon)}}">
        @else
            <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}" sizes="32x32">
            <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/favicon.png')}}">
        @endif
    @else
        <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}" sizes="32x32">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/favicon.png')}}">
    @endif
    @vite(['resources/sass/app.scss','resources/css/splide.min.css','resources/css/style.css', 'resources/js/app.js'])
    @laravelPWA
</head>
<body>
<div id="app">
    <body class="bg-white dark-mode-active">
        <div id="appCapsule" class="pt-0">
            @yield('content')
        </div>
    </body>
</div>
</body>
</html>
