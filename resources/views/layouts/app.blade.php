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

    <!-- Scripts -->
    @if ($current_company)
        @if ($current_company->favicon)
            <link rel="icon" type="image/png" href="{{Storage::url($current_company->favicon)}}" sizes="32x32">
        @endif
    @else
        <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}" sizes="32x32">
    @endif
    <style>
        /* Apply the colors dynamically */
        :root {
            --primary-color: {{ $current_company->primary_color }} !important;
            --secondary-color: {{ $current_company->secondary_color }} !important;
            --tertiary-color: {{ $current_company->tertiary_color }} !important;
            --button-color: {{ $current_company->buttons_color }} !important;
            --notices-color: {{ $current_company->notices_color }} !important;
            /* Add other color variables as needed */
        }
    </style>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/icon/192x192.png')}}">
    @vite(['resources/sass/app.scss','resources/css/splide.min.css','resources/css/style.css', 'resources/js/app.js'])
    @laravelPWA
    @stack('styles')
</head>
<body class="bg-white dark-mode-active">
<div class="appHeader scrolled">
    <div class="left">
        @if ($current_company)
            @if ($current_company->logo)
                <a href="#" class="headerButton toggle-searchbox gap-2">
                    <img src="{{Storage::url($current_company->logo)}}" alt="" style="max-width: 120px; max-height: 50px">
                </a>
            @endif
        @else
            <a href="#" class="headerButton toggle-searchbox gap-2">
                <img src="{{asset('img/home_logo.png')}}" alt="" style="max-width: 50px">
                <img src="{{asset('img/logo.png')}}" alt="" style="max-width: 120px">
            </a>
        @endif

    </div>
    <div class="right">
        <a href="#" class="headerButton" data-bs-toggle="offcanvas" data-bs-target="#sidebarPanel">
            <ion-icon name="menu-outline" role="img" class="md hydrated" aria-label="menu outline"></ion-icon>
        </a>
    </div>
</div>
<div class="container">
    <div id="appCapsule">
        @yield('content')
    </div>
    @include('layouts.nav')
</div>

<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    window.addEventListener('scroll', function () {
        if (window.scrollY > 0) {
            document.querySelector('.appHeader').style.backgroundColor = '#0F1C2F';
        } else {
            document.querySelector('.appHeader').style.backgroundColor = 'rgba(15,28,47,0)';
        }
    });
</script>
</body>

@stack('scripts')

</html>
