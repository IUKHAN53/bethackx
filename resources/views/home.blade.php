@extends('layouts.app')

@section('content')
    <div class="text-center my-2">
        <img src="{{asset('img/sample_banner.png')}}" alt="">
    </div>

    <div class="header-large-title bg-primary text-center">

        <h4 class="subtitle">altere as informações e depois clique em salvar!</h4>
    </div>

    <div class="section full mt-3">
        <div class=" mx-3 pt-2 pb-2">
            <div>
                <div class="d-flex justify-content-start align-items-center mb-2 ms-3">
                    <img src="{{asset('img/icon/slots')}}.png" class="bg-primary p-1 shadow rounded" alt="">
                    <h4 class="fw-bold ms-1 text-uppercase mt-1">Slots</h4>
                </div>
                <div class="border p-2 custom-card">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130" height="130">
                        </div>
                        <div class="col-6 mb-2">
                            <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130" height="130">
                        </div>
                        <div class="col-6 mb-2">
                            <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130" height="130">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <div class="d-flex justify-content-start align-items-center mb-2 ms-3">
                    <img src="{{asset('img/icon/cards')}}.png" class="bg-primary p-1 shadow rounded" alt="">
                    <h4 class="fw-bold ms-1 text-uppercase mt-1">Cartas</h4>
                </div>
                <div class="border p-2 custom-card">
                    <div class="row">
                        <div class="col-4 mb-2">
                            <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130" height="130">
                        </div>
                        <div class="col-4 mb-2">
                            <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130" height="130">
                        </div>
                        <div class="col-4 mb-2">
                            <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130" height="130">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <div class="d-flex justify-content-start align-items-center mb-2 ms-3">
                    <img src="{{asset('img/icon/releta.png')}}" class="bg-primary p-1 shadow rounded" alt="">
                    <h4 class="fw-bold ms-1 text-uppercase mt-1">Roletas</h4>
                </div>
                <div class="border p-2 custom-card">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130" height="130">
                        </div>
                        <div class="col-6 mb-2">
                            <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130" height="130">
                        </div>
                        <div class="col-6 mb-2">
                            <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130" height="130">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <div class="d-flex justify-content-start align-items-center mb-2 ms-3">
                    <img src="{{asset('img/icon/dados')}}.png" class="bg-primary p-1 shadow rounded" alt="">
                    <h4 class="fw-bold ms-1 text-uppercase mt-1">Dados</h4>
                </div>
                <div class="border p-2 custom-card">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130" height="130">
                        </div>
                        <div class="col-6 mb-2">
                            <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130" height="130">
                        </div>
                        <div class="col-6 mb-2">
                            <img src="{{asset('img/sample_game.png')}}" class="rounded" alt="" width="130" height="130">
                        </div>
                    </div>
                </div>
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
