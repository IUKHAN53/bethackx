<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetHackX - Super Admin Panel</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding: 20px;
        }

        .sidebar h3 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #fff;
        }

        .sidebar-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar-logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }

        .nav-link {
            color: #fff !important;
            padding: 8px;
        }

        .nav-link:hover {
            background-color: #6c757d;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .content h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        .table th {
            font-weight: bold;
        }

        .table td:last-child {
            white-space: nowrap;
        }
        .active {
            background-color: #6c757d;
        }
    </style>
    @vite(['resources/sass/app.scss','resources/css/splide.min.css','resources/css/style.css', 'resources/js/app.js'])
</head>

<body>
<div class="sidebar">
    <div class="sidebar-logo">
        <img src="{{asset('img/home_logo.png')}}" alt="Logo">
    </div>
    <h3>&nbsp;&nbsp;&nbsp;Super Admin Panel</h3>
    <ul class="nav flex-column">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('super-admin.users.index')}}">Usuárias</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('super-admin.companies.index')}}">Empresas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('super-admin.plans.index')}}">Planas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="$('#logout_form').submit()">Sair</a>
        </li>
    </ul>
</div>
<form action="{{route('logout')}}" method="POST" id="logout_form">
    @csrf
</form>
<div class="content">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @yield('content')
</div>
</body>
</html>
