<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetHackX - Superadministrador</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }

        .form-group{
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn-login {
            width: 100%;
        }
        .error-message {
            color: #dc3545;
        }
    </style>
    @vite(['resources/sass/app.scss','resources/css/splide.min.css','resources/css/style.css', 'resources/js/app.js'])

</head>
<body>
<div class="container">
    <div class="logo">
        <img src="{{asset('img/home_logo.png')}}" alt="Logo">
    </div>
    <h2 class="text-center">Login de Superadministrador</h2>
    <form method="POST" action="{{route('login', $company->slug )}}">
        @csrf
        <div class="form-group">
            <label for="username">Usuário</label>
            <input type="email" id="email" name="email" placeholder="Digite seu e-mail">
            @error('email')<span class="error-message">{{$message}}</span>@enderror
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha">
            @error('password')<span class="error-message">{{$message}}</span>@enderror
        </div>
        <button class="btn btn-primary btn-login">Entrar</button>
    </form>
</div>
</body>

</html>
