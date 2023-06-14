@extends('layouts.app')

@section('content')
    <div class="section full mt-3">
        <div class=" mx-3 pt-2 pb-2">
            <div>
                <input type="hidden" id="game_id" value="{{$game->id}}">
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <img src="{{asset('img/icon/'.$game->game_type.'.png')}}" class="bg-primary p-1 shadow rounded"
                         alt="">
                    <h4 class="fw-bold ms-1 text-uppercase mt-1">{{$game->name}}</h4>
                </div>
                <div class="text-center d-flex justify-content-center game-banner align-items-center" id="image_signal"
                     style="background-image: url('{{asset($game->banner)}}');">
                    <span style="color: white" id="server_text" class="text-center fw-bolder">Aguardando</span>
                </div>
            </div>
            <div class="mt-3">
                <div class="border p-2 custom-card">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <div class="d-flex flex-column justify-content-start">
                            <h5 class="text-start fw-bolder m-0">Hackear Mines</h5>
                            <span style="font-size: 10px">Clique em no botão ao lado para gerar uma nova probabilidade de
                                entrada.</span>
                        </div>
                        <div>
                            <button class="btn btn-primary text-uppercase fw-bolder" id="signal_btn" style="min-width: 105px">Hackear</button>
                        </div>
                    </div>
                    <div class="flex-container justify-content-between align-items-center mt-2 gap-2">
                        <div class="flex-item flex-item-75  flex-row justify-content-start p-2 text-center"
                             style="background-color: #0c1624 !important; border-radius: 10px; font-size: 12px">
                            <span class="text-white">{{$game->game_text}}</span>
                            <br>
                            <span class="text-small fw-bolder text-warning" style="font-size: 12px"><span
                                    id="text_signal">--:--</span></span>
                        </div>
                        <div class="flex-item flex-item-25  flex-row justify-content-start p-2 text-center"
                             style="background-color: #0c1624 !important; border-radius: 10px; font-size: 12px">
                            <span class="text-white" style="font-size: 12px">Válido até</span>
                            <span class="text-small fw-bolder text-success" id="timer" style="font-size: 12px">--:--</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-end text-primary text-decoration-underline">
                    <a href="javascript:void(0)" class="" id="reloadIframe">
                        <ion-icon name="refresh" role="img" class="md hydrated" aria-label="close"></ion-icon>
                        recarregar página
                    </a>
                </div>
                <div class="iframe-container" id="iframe-container">
                    <iframe id="game_iframe" src="{{$game->iframe_link}}" style="background-color: rgba(255,255,255,0.09)" width="100%"
                            height="730px"></iframe>
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
                            <a class="btn btn-primary text-uppercase fw-bolder  float-end" href="{{$settings['help_link']}}"
                               target="_blank">Assista Agora</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module">
        const button = document.getElementById('signal_btn');
        let remainingTime = 5 * 60;

        $('#reloadIframe').on('click', function () {
            var iframeContainer = document.getElementById('iframe-container');

            // Create a new iframe element
            var newIframe = document.createElement('iframe');
            newIframe.src = '{{$game->iframe_link}}';
            newIframe.style.width = '100%';
            newIframe.style.height = '730px';
            newIframe.style.backgroundColor = 'rgba(255,255,255,0.09)';

            // Remove the existing iframe (if any)
            while (iframeContainer.firstChild) {
                iframeContainer.firstChild.remove();
            }

            // Append the new iframe to the container
            iframeContainer.appendChild(newIframe);
            console.log(newIframe)
        });

        const texts = ['Aguardando', 'Aguarde..', 'Criando serviços de backup', 'conectando a servidores', 'examinando fontes de dados', 'Aguarde..', 'sinal encontradol']
        $('#signal_btn').click(function () {
            const button = document.getElementById('signal_btn');
            button.disabled = true;
            let $i = 1;
            let interval = setInterval(function () {
                changeText($i++)
                if ($i === texts.length) {
                    clearInterval(interval)
                    getSignal()
                }
            }, 1200)
        })

        function getSignal() {
            let id = $('#game_id').val()
            $('#image_signal').css('background', 'url({{asset($game->banner)}})')
            $('#text_signal').text('Aguarde..')
            let url = '{{route('user.get-game-signal',[$current_company,':id'])}}'
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                method: 'GET',
                success: function (data) {
                    $('#timer').text('{{\Carbon\Carbon::now()->setTimezone('America/Recife')->addMinutes(5)->format('H:i')}}')
                    if (data.type == 'image') {
                        $('#image_signal').css('background', `url(${data.signal})`)
                        $('#text_signal').text('sinal encontradol')
                        $('#server_text').text('');
                    } else {
                        $('#text_signal').text(data.signal)
                    }
                }
            })
            updateRemainingTime();
        }
        function updateButtonText() {
            const formattedTime = formatTime(remainingTime);
            button.innerText = formattedTime;
        }
        function updateRemainingTime() {
            remainingTime--;
            if (remainingTime > 0) {
                updateButtonText();
                setTimeout(updateRemainingTime, 1000); // Update every second
            } else {
                button.disabled = false;
                button.innerText = 'Hackear';
            }
        }
        function formatTime(timeInSeconds) {
            const minutes = Math.floor(timeInSeconds / 60);
            const seconds = timeInSeconds % 60;
            return `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        function changeText($i) {
            let server_text = $('#server_text');
            server_text.text(texts[$i])
        }

        window.addEventListener('load', function () {
            var container = document.getElementById('image_signal');
            var img = new Image();
            img.src = getComputedStyle(container).backgroundImage.slice(4, -1).replace(/"/g, "");
            img.addEventListener('load', function () {
                container.style.height = img.height + 'px';
            });
        });
    </script>
@endpush
