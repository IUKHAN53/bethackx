<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Admin Login</title>
    <meta name="description" content="Irfan's PWA design">
    <meta name="keywords" content="bootstrap 5, mobile pwa">
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/favicon.png')}}">
    @vite(['resources/sass/app.scss','resources/css/splide.min.css','resources/css/style.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark-mode-active">
<!-- App Capsule -->
<div id="appCapsule" class="pt-0">

    <div class="login-form mt-1 d-flex justify-content-center gap-5 flex-column" style="height: 90vh">
        <div class="section mt-1">
            <h2 style="color: #747474">ADMINISTRAÇÃO</h2>
            <img src="{{asset('img/logo.png')}}" alt="image" class="form-image">
        </div>
        <div class="section mt-1 mb-5 d-flex justify-content-center align-items-center">
            <form action="#" class="w-100 mt-5">
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="email" class="form-control login-input-control" id="email1" placeholder="E-mail">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="password" class="form-control login-input-control" id="password1"
                               placeholder="Senha"
                               autocomplete="off">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary btn-block btn-lg login-btn">Acessar</button>
                </div>

            </form>
        </div>
    </div>
</div>
</body>

</html>
