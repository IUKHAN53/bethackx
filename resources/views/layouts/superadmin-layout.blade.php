<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Panel</title>
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
            text-align: center;
        }

        .table td {
            text-align: center;
        }

        .active {
            background-color: #6c757d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-pagination{
            margin: 15px;
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        .admin-pagination .page-item {
            margin: 0 2px;
        }

        .admin-pagination .page-link {
            color: #000;
            text-decoration: none;
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
        }

        .admin-pagination .page-item.active .page-link {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .admin-pagination .page-item.disabled .page-link {
            color: #999;
            pointer-events: none;
            cursor: not-allowed;
        }
        .admin-pagination .page-item:first-child .page-link {
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .admin-pagination .page-item:last-child .page-link {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
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
        <li class="nav-item {{ request()->routeIs('super-admin.users.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('super-admin.users.index')}}">👤 Usuários</a>
        </li>
        <li class="nav-item {{ request()->routeIs('super-admin.companies.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('super-admin.companies.index')}}">📱 Apps</a>
        </li>
        <li class="nav-item {{ request()->routeIs('super-admin.games.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('super-admin.games.index')}}">🎮 Jogos</a>
        </li>
        <li class="nav-item {{ request()->routeIs('super-admin.plans.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('super-admin.plans.index')}}">🚫 Planos</a>
        </li>
        <li class="nav-item {{ request()->routeIs('super-admin.subscriptions.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('super-admin.subscriptions.index')}}">🚫 Assinaturas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="$('#logout_form').submit()">🏃 ️Sair</a>
        </li>
    </ul>
</div>
<form action="{{route('super-admin.logout')}}" method="POST" id="logout_form">
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
