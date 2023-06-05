@extends('layouts.app')

@section('content')
    <div class="header-large-title bg-primary text-center">
        <h4 class="subtitle">altere as informações e depois clique em salvar!</h4>
    </div>
    <div class="section full mt-3">
        <div class=" mx-3 pt-2 pb-2">
            <div>
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <img src="{{asset('img/icon/'.$game->game_type.'.png')}}" class="bg-primary p-1 shadow rounded" alt="">
                    <h4 class="fw-bold ms-1 text-uppercase mt-1">Slots</h4>
                </div>
                <div class="text-center">
                    <img src="{{asset('img/sampe_game_detail.png')}}" alt="">
                </div>

            </div>

            <div class="mt-3">
                <div class="border p-2 custom-card">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <div class="d-flex flex-column justify-content-start">
                            <h5 class="text-start fw-bolder m-0">Hackear Mines</h5>
                            <span class="text-small">Clique em no botão ao lado para gerar uma nova probabilidade de
                                entrada.</span>
                        </div>
                        <div>
                            <button class="btn btn-primary text-uppercase fw-bolder">Hackear</button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2 gap-2">
                        <div class="d-flex flex-column justify-content-start p-2 text-center w-100"
                             style="background-color: #0c1624 !important; border-radius: 10px">
                            <span class="text-white">Número de Minas</span>
                            <span class="text-small fw-bolder text-warning">3 MINAS</span>
                        </div>
                        <div class="d-flex flex-column justify-content-start p-2 text-center w-100"
                             style="background-color: #0c1624 !important; border-radius: 10px">
                            <span class="text-white">Válido até</span>
                            <span class="text-small fw-bolder text-success">17:20</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-3">
                <div class="text-end text-primary text-decoration-underline">
                    <a href="" class="">
                        <ion-icon name="refresh" role="img" class="md hydrated" aria-label="close"></ion-icon>
                        recarregar página
                    </a>
                </div>
                <div>
                    <img src="{{asset('img/game_play.png')}}" style="width: 100%; border-radius: 10px" alt="">
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
