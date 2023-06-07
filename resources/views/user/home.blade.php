@extends('layouts.app')

@section('content')
    <div class="text-center my-2">
        <img src="{{$settings['home_banner'] != '' ? storage_path($settings['home_banner']) : asset('img/banners/banner_topo.png')}}" alt="">
    </div>

    <div class="header-large-title text-center" style="background-color: #423ed4">
        <h4 class="subtitle" style="font-size: 14px;">clique abaixo no jogo preferido para abrir os sinais</h4>
    </div>

    <div class="section full mt-3">
        <div class=" mx-3 pt-2 pb-2">
            @foreach($types as $type => $games)
            <div id="type_{{$type}}">
                    <div class="d-flex justify-content-start align-items-center mb-2 mt-2 ms-3">
                        <img src="{{asset('img/icon/'.$type)}}.png" class="bg-primary p-1 shadow rounded" alt="">
                        <h4 class="fw-bold ms-1 text-uppercase mt-1">{{$type}}</h4>
                    </div>
                    <div class="border p-2 custom-card ">
                        <div class="row">
                            @foreach($games as $game)
                                <div class="col-4 mb-2 d-flex justify-content-center" onclick="location.href='{{route('user.view-game',['id' => $game->id])}}'">
                                    <img src="{{asset($game->image)}}" class="rounded" alt="" style="max-width: 100px; max-height: 100px">
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
