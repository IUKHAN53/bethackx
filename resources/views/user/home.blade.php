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
    </style>
@endpush

@section('content')
    <div class="text-center my-2">
        <img
            src="{{$current_company->home_banner != '' ? Storage::url($current_company->home_banner) : asset('img/banners/banner_topo.png')}}"
            alt="" class="img-fluid" >
    </div>

    <div class="header-large-title bg-primary text-center" style="background-color: #423ed4">
        <h4 class="subtitle" style="font-size: 14px;">Clique abaixo no jogo preferido para abrir os sinais</h4>
    </div>
    <div class="section full mt-3">
        <div class=" mx-3 pt-2 pb-2">
            @if(!auth()->user()->hasPremium())
                <div class="header-large-title text-center" style="background-color: #423ed4">
                    <h4 class="subtitle" style="font-size: 14px;"><a style="color: white"
                                                                     href="{{$current_company->plan_checkout_link}}">Você
                            não é assinante de nenhum plano clique aqui para Assinar</a></h4>
                </div>
            @endif
            @foreach($types as $type => $games)
                <div id="type_{{$type}}">
                    <div class="d-flex justify-content-start align-items-center mb-2 mt-2 ms-3">
                        <img src="{{asset('img/icon/'.$type)}}.png" class="bg-primary p-1 shadow rounded" alt="">
                        <h4 class="fw-bold ms-1 text-uppercase mt-1">{{$type}}</h4>
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
