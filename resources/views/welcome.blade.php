<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Welcome To {{config('app.name')}}</title>
    <meta name="description" content="Irfan's PWA design">
    <meta name="keywords" content="bootstrap 5, mobile pwa">
    @if ($current_company)
        @if ($current_company->favicon)
            <link rel="icon" type="image/png" href="{{Storage::url($current_company->favicon)}}" sizes="32x32">
        @endif
    @else
        <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}" sizes="32x32">
    @endif
    <style>
        :root {
            --primary-color: {{ $current_company->primary_color }}   !important;
            --secondary-color: {{ $current_company->secondary_color }}   !important;
            --tertiary-color: {{ $current_company->tertiary_color }}   !important;
            --button-color: {{ $current_company->buttons_color }}   !important;
        }
    </style>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/icon/192x192.png')}}">
    @vite(['resources/sass/app.scss','resources/css/splide.min.css','resources/css/style.css', 'resources/js/app.js'])
    @laravelPWA
</head>

<body class="bg-white dark-mode-active">
<div class="container">
    <div id="appCapsule" class="pt-0">
        <div class="login-form mt-1 d-flex justify-content-center gap-5 flex-column" style="height: 90vh">
            <div class="section mt-1">
                @if ($current_company)
                    @if ($current_company->logo)
                        <img src="{{Storage::url($current_company->logo)}}" alt="image" class="form-image">
                    @endif
                @else
                    <img src="{{asset('img/logo.png')}}" alt="image" class="form-image">
                @endif
            </div>
            <div class="section mt-1 text-center">
                <h4 class="text-white fw-bolder">Bem-Vindo a revolução <br> do hack de sinais.</h4>
                <h4 class="fw-bolder" style="color: #685fc6">Inimigo nº 1 dos Cassinos!</h4>
            </div>
            <div class="section mt-1 mb-5 d-flex justify-content-center align-items-center">
                <form class="w-100">
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <span style="float: left">Já tem usuário?</span>
                            <a href="{{route('user.login', $current_company->slug)}}"
                               class="btn btn-primary btn-block w-100">Realizar Login</a>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <span style="float: left">É novo por aqui?</span>
                            <a href="{{$current_company->request_access_link}}" class="btn btn-primary btn-block w-100">Solicitar
                                acesso</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
