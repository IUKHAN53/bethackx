@extends('layouts.app')

@section('content')
    <div class="text-center my-2">
        <img src="{{$settings['home_banner'] != '' ? storage_path($settings['home_banner']) : asset('img/sample_banner.png')}}" alt="">
    </div>

    <div class="header-large-title bg-primary text-center">

        <h4 class="subtitle">altere as informações e depois clique em salvar!</h4>
    </div>

    <div class="section full mt-3">
        <div class=" mx-3 pt-2 pb-2">
                <div>
                    @foreach($types as $type => $games)
                    <div class="d-flex justify-content-start align-items-center mb-2 mt-2 ms-3">
                        <img src="{{asset('img/icon/'.$type)}}.png" class="bg-primary p-1 shadow rounded" alt="">
                        <h4 class="fw-bold ms-1 text-uppercase mt-1">{{$type}}</h4>
                    </div>
                    <div class="border p-2 custom-card">
                        <div class="row">
                            @foreach($games as $game)
                                <div class="col-4 mb-2" onclick="location.href='{{route('game/'),['id' => $game->id]}}'">
                                    <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130"
                                         height="130">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            <div class="mt-3 mb-4">
                <div class="border p-2 custom-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-start">
                            <h4 class="text-start fw-bolder m-0">Vídeo Aulas</h4>
                            <span class="text-small">Está com dúvidas? Aprenda a operar o Bot!</span>
                        </div>
                        <div class="w-100">
                            <button class="btn btn-primary text-uppercase fw-bolder">Assista Agora</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection