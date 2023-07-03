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
    @if ($current_company && $current_company->is_default==0)
        @if ($current_company->favicon)
            <link rel="icon" type="image/png" href="{{Storage::url($current_company->favicon)}}" sizes="32x32">
            <link rel="apple-touch-icon" sizes="180x180" href="{{Storage::url($current_company->favicon)}}">
        @else
            <img src="{{asset('img/favicon.png')}}" alt="image" class="form-image">
            <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/favicon.png')}}">
        @endif
    @else
        <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}" sizes="32x32">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/favicon.png')}}">
    @endif
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
    @vite(['resources/sass/app.scss','resources/css/splide.min.css','resources/css/style.css', 'resources/js/app.js'])
    @laravelPWA
    @stack('styles')

</head>
<body class="bg-white dark-mode-active">
<div class="appHeader scrolled" style="max-width: 700px;margin-left: auto; margin-right: auto;">
    <div class="left">
        @if ($current_company && $current_company->is_default==0 )
            @if ($current_company->logo)
                <a href="#" class="headerButton toggle-searchbox gap-2">
                    <img src="{{Storage::url($current_company->logo)}}" alt=""
                         style="max-width: 150px; max-height: 50px">
                </a>
            @else
                <a href="#" class="headerButton toggle-searchbox gap-2">
                    <img src="{{asset('img/home_logo.png')}}" alt="image" class="form-image"
                         style="max-width: 120px; max-height: 50px">
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
        @if(!auth()->user()->hasPremium())
            <div class="btn btn-sm" style="height: 25px;background-color: #03DB7BFF">
                <img src="{{asset("img/icon/padlock.png")}}" alt="" style="max-width: 12px">
                <span class="ms-1 fw-bold">plano free</span>
            </div>
        @else
            <div class="btn btn-sm" style="height: 25px;background-color: #fbd92e">
                <img src="{{asset("img/icon/badge.png")}}" alt="" style="max-width: 12px">
                <span class="ms-1 fw-bold">membro VIP!</span>
            </div>
        @endif
        @if(auth()->user()->isAdmin())
            <div style="height: 25px; margin: 4px"
                 onclick="location.href = '{{route('admin.view', $current_company->slug)}}'">
                <img src="{{asset("img/icon/cog.png")}}" alt="" style="max-width: 25px">
            </div>
        @endif
        <div style="height: 25px; margin: 4px" onclick="$('#logout_form').submit()">
            <img src="{{asset("img/icon/logout.png")}}" alt="" style="max-width: 25px">
        </div>
        <form action="{{route('user.logout', $current_company->slug )}}" method="POST" id="logout_form">
            @csrf
        </form>
        {{--        <a href="#" class="headerButton" data-bs-toggle="offcanvas" data-bs-target="#sidebarPanel">--}}
        {{--            <ion-icon name="menu-outline" role="img" class="md hydrated" aria-label="menu outline"></ion-icon>--}}
        {{--        </a>--}}
    </div>
</div>
<div style="max-width: 700px;margin-left: auto; margin-right: auto;">
    <div id="appCapsule">
        @yield('content')
    </div>
    @include('layouts.nav')
</div>
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
