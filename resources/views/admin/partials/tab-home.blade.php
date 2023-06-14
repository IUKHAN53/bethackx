<div class="tab-pane fade active show" id="home" role="tabpanel">
    <div class="border p-2 custom-card">
        <form action="{{route('admin.save-games',$current_company->slug)}}" method="POST">
            @csrf
            <div class="d-flex flex-column gap-2 w-100">
                @foreach($games as $game)
                    <label for="game"
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">{{$game->name}}:</span>
                        <input type="text" name="games[{{$game->id}}]" id="mines"
                               class="form-control form-control-custom w-100"
                               value="{{$game->iframe_link()}}">
                    </label>
                @endforeach
            </div>
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary btn-sm">SALVAR</button>
            </div>
        </form>
    </div>
    <div class="mt-3">
        <div class="d-flex justify-content-start align-items-center mb-2 ms-3">
            <img src="{{asset('img/icon/slots.png')}}" class="bg-primary p-1 shadow rounded" alt="">
            <h4 class="fw-bold ms-1 text-uppercase mt-1">outros links</h4>
        </div>

        <div class="border p-2 custom-card">
            <form action="{{route('admin.save-external-links',$current_company->slug)}}" method="post">
                @csrf
                <div class="d-flex flex-column gap-2 w-100">
                    <label for=""
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">Solicitar acesso:</span>
                        <input type="text" name="settings['request_access_link']" id=""
                               value="{{$current_company->request_access_link}}"
                               class="form-control form-control-custom w-100">
                    </label>
                    <label for=""
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">Preciso de Ajuda:</span>
                        <input type="text" name="settings['help_link']" id=""
                               value="{{$current_company->help_link}}"
                               class="form-control form-control-custom w-100">
                    </label>
                    <label for=""
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">Link do Tutorial:</span>
                        <input type="text" name="settings['admin_tutorial_link']" id=""
                               value="{{$current_company->admin_tutorial_link}}"
                               class="form-control form-control-custom w-100">
                    </label>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary btn-sm">SALVAR</button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-3">
        <div class="d-flex justify-content-start align-items-center mb-2 ms-3">
            <img src="{{asset('img/icon/slots.png')}}" class="bg-primary p-1 shadow rounded" alt="">
            <h4 class="fw-bold ms-1 text-uppercase mt-1">Banner</h4>
        </div>

        <div class="border p-2 custom-card">
            <form action="{{route('admin.save-banner',$current_company->slug)}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="d-flex flex-column gap-2 w-100">
                    <label for=""
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">imagem:</span>
                        <input type="text" id="fileNamePreview"
                               class="form-control-custom w-100" readonly>
                        <input type="file" name="settings['home_banner']" id="upload"
                               class="custom-file-input form-control-custom w-100" hidden>
                        <button class="btn btn-primary btn-sm me-1" type="button" id="btnUpload">
                            UPLOAD
                        </button>
                    </label>
                    @error('settings.home_banner')<span
                        style="color: darkred">{{$message}}</span>@enderror
                    <label for=""
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">link da imagem:</span>
                        <input type="text" name="settings['home_banner_ref_link']" id=""
                               class="form-control form-control-custom w-100">
                    </label>

                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary btn-sm">SALVAR</button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-3 mb-4">
        <div class="border p-2 custom-card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column justify-content-start">
                    <h4 class="text-start fw-bolder m-0">Tutorial Admin</h4>
                    <span class="text-small">Está com dúvidas? Aprenda administrar o App.</span>
                </div>
                <div class="w-100">
                    <a href="{{$current_company->admin_tutorial_link}}"
                       class="btn btn-primary text-uppercase fw-bolder  float-end">Assista Agora</a>
                </div>
            </div>
        </div>
    </div>
</div>
