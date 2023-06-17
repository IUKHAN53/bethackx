@extends('layouts.app')
@push('styles')
    <style>
        .disabled-lock {
            position: relative;
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        .disabled-lock::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            background-image: url('{{asset('img/lock.png')}}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        /*.notification-container {*/
        /*    overflow: hidden;*/
        /*}*/

        .notification {
            display: inline-block;
            /*padding: 10px 20px;*/
            margin-right: 20px;
            white-space: nowrap;
            background-color: black;
            border-radius: 50px;
            height: 22px;
        }

        .all-notifications {
            animation: moveNotifications 15s linear infinite;
            /*overflow: hidden;*/
        }

        @keyframes moveNotifications {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(calc(-100% - 20px));
            }
        }

    </style>
@endpush

@section('content')
    <div class="text-center my-2">
        <div style="overflow: hidden">
            <div class="d-flex gap-3 justify-content-center align-items-center all-notifications">

            </div>
        </div>
    </div>

    <div class="text-center my-2">
        <img
            src="{{$current_company->home_banner != '' ? Storage::url($current_company->home_banner) : asset('img/banners/banner_topo.png')}}"
            alt="" class="img-fluid">
    </div>

    <div class="header-large-title bg-primary text-center" style="background-color: #423ed4">
        <h4 class="subtitle" style="font-size: 14px;">Clique abaixo no jogo preferido para abrir os sinais</h4>
    </div>
    <div class="section full mt-3">
        <div class=" mx-3 pt-2 pb-2">

            @foreach($types as $type => $games)
                <div id="type_{{$type}}">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-start align-items-center mb-2 mt-2 ms-3">
                            <img src="{{asset('img/icon/'.$type)}}.png" class="bg-primary p-1 shadow rounded" alt="">
                            <h4 class="fw-bold ms-1 text-uppercase mt-1">{{$type}}</h4>
                        </div>
                        @if($loop->first and !auth()->user()->hasPremium())
                            <a href="{{$current_company->plan_checkout_link}}" class="btn btn-sm" style="height: 25px;background-color: #fbd92e">
                                <img src="{{asset("img/icon/badge.png")}}" alt="" style="max-width: 14px">
                                <span class="ms-1 fw-bold">Quero ser VIP!</span>
                            </a>
                        @endif
                    </div>

                    <div class="border p-2 custom-card ">
                        <div class="row">
                            @foreach($games as $game)
                                @php
                                    $locked = false;
                                    if(!auth()->user()->hasPremiumForGame($game->id) && $game->isPremium()){
                                        $locked = true;
                                    }
                                @endphp
                                <div class="col-4 mb-2 d-flex justify-content-center {{$locked ?'disabled-lock':''}}"
                                     onclick="location.href='{{route('user.view-game',['company' => $current_company,'id' => $game->id])}}'">
                                    <img src="{{ $game->is_default ? asset($game->image) : Storage::url($game->image)}}"
                                         class="rounded" alt="" style="max-width: 100px; max-height: 100px">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="mt-3 mb-4">
                <div class="border p-2 custom-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-start">
                            <h4 class="text-start fw-bolder m-0">Vídeo Aulas</h4>
                            <span class="text-small">Está com dúvidas? Aprenda a operar o Bot!</span>
                        </div>
                        <div class="w-100">
                            <button class="btn btn-primary text-uppercase fw-bolder float-end">Assista Agora</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            var fullNames = [
                "Ana Silva", "Beatriz Santos", "Carlos Oliveira", "Daniel Almeida", "Eduardo Costa",
                "Fernanda Pereira", "Gustavo Rodrigues", "Helena Lima", "Isabela Gomes", "João Cardoso",
                "Karina Fernandes", "Lucas Souza", "Maria Carvalho", "Nathan Santos", "Olivia Castro",
                "Pedro Costa", "Raquel Alves", "Samuel Ferreira", "Tatiana Ribeiro", "Vitor Andrade",
                "Antonio Pereira", "Carolina Cunha", "Diego Barbosa", "Fabiana Gonçalves", "Giovanna Marques",
                "Hugo Rodrigues", "Isadora Castro", "Jorge Oliveira", "Larissa Sousa", "Mariano Costa"
            ];

            var gameNames = @json($game_names);

            var containerWidth = $('.all-notifications').width();
            var notificationsWidth = 0;

            for (var i = 0; i < 30; i++) {
                var randomFullName = fullNames[Math.floor(Math.random() * fullNames.length)];
                var randomGameName = gameNames[Math.floor(Math.random() * gameNames.length)];
                var randomReward = (Math.random() * (1000 - 1) + 1).toFixed(2);
                var notification = `<div class="notification d-flex justify-content-center align-items-center px-2 gap-2">
                    <img src="{{asset('img/icon/notification-icon.webp')}}" alt="" style="width: 10px">
                    <span class="text-small text-white" style="font-size: 10px">${randomFullName} - ${randomGameName} - <span
                            class="text-success">R$ ${randomReward}</span></span>
                </div>`
                $('.all-notifications').append(notification);
                notificationsWidth += notification[0].offsetWidth;
            }
            var cloneCount = Math.ceil(containerWidth / notificationsWidth);
            for (var j = 0; j < cloneCount; j++) {
                $('.all-notifications').append($('.notification').clone());
            }

        });

    </script>
@endpush
