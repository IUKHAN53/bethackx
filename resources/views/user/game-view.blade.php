@extends('layouts.app')

@section('content')
    <div class="header-large-title bg-primary text-center">
        <h4 class="subtitle">altere as informações e depois clique em salvar!</h4>
    </div>
    <div class="section full mt-3">
        <div class=" mx-3 pt-2 pb-2">
            <div>
                <input type="hidden" id="game_id" value="{{$game->id}}">
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <img src="{{asset('img/icon/'.$game->game_type.'.png')}}" class="bg-primary p-1 shadow rounded" alt="">
                    <h4 class="fw-bold ms-1 text-uppercase mt-1">{{$game->game_type}}</h4>
                </div>
                <div class="text-center">
                    <img src="{{asset('img/sampe_game_detail.png')}}" alt="" id="image_signal">
                    <span style="color: white;" id="server_text">Aguardando</span>
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
                            <button class="btn btn-primary text-uppercase fw-bolder" id="signal_btn">Hackear</button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2 gap-2">
                        <div class="d-flex flex-column justify-content-start p-2 text-center w-100"
                             style="background-color: #0c1624 !important; border-radius: 10px">
                            <span class="text-white">{{$game->game_text}}</span>
                            <span class="text-small fw-bolder text-warning"><span id="text_signal"></span></span>
                        </div>
                        <div class="d-flex flex-column justify-content-start p-2 text-center w-100"
                             style="background-color: #0c1624 !important; border-radius: 10px">
                            <span class="text-white">Válido até</span>
                            <span class="text-small fw-bolder text-success">{{\Carbon\Carbon::now()->addMinute(5)->format('H:i')}}</span>
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
                    <iframe src="{{$game->iframe_link}}" style="background-color: white" width="100%" height="100%"></iframe>
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
@push('scripts')
    <script type="module">
        const texts = ['Aguardando','Aguarde..','Criando serviços de backup', 'conectando a servidores', 'examinando fontes de dados','Aguarde..','sinal encontradol']
        $('#signal_btn').click(function (){
            let $i=1;
            let interval = setInterval(function (){
                changeText($i++)
                if($i===texts.length){
                    clearInterval(interval)
                    getSignal()
                }
            },1200)
        })
        function getSignal(){
            let id = $('#game_id').val()
            $('#image_signal').attr('src','{{asset('img/sampe_game_detail.gif')}}')
            $('#text_signal').text('Aguarde..')
            let url = '{{route('user.get-game-signal',':id')}}'
            url = url.replace(':id',id)
            $.ajax({
                url: url,
                method: 'GET',
                success: function (data){
                    if(data.type == 'image'){
                        $('#image_signal').attr('src',data.signal)
                        $('#text_signal').text('sinal encontradol')
                        $('#server_text').text('');
                    }else{
                        $('#image_signal').attr('src','{{asset('img/sampe_game_detail.png')}}')
                        $('#text_signal').text(data.signal)
                    }
                }
            })
        }
        function changeText($i){
            let server_text = $('#server_text');
            server_text.text(texts[$i])
        }
    </script>
@endpush