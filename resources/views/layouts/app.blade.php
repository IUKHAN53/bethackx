<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BetHackX') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/icon/192x192.png')}}">
    @vite(['resources/sass/app.scss','resources/css/splide.min.css','resources/css/style.css', 'resources/js/app.js'])
    @laravelPWA
</head>
<body class="bg-white dark-mode-active">
<div class="appHeader bg-primary scrolled">
    <div class="left">
        <a href="#" class="headerButton toggle-searchbox gap-2">
            <img src="{{asset('img/home_logo.png')}}" alt="" style="max-width: 50px">
            <img src="{{asset('img/logo.png')}}" alt="" style="max-width: 120px">
        </a>
    </div>
    <div class="right">
        <a href="#" class="headerButton" data-bs-toggle="offcanvas" data-bs-target="#sidebarPanel">
            <ion-icon name="menu-outline" role="img" class="md hydrated" aria-label="menu outline"></ion-icon>
        </a>
    </div>
</div>
<div id="appCapsule" class="pt-0">
    @yield('content')
</div>
@include('layouts.nav')
</body>
</html>
