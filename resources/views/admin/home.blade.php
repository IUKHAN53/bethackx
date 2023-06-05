@extends('layouts.app')

@section('content')
    <div class="header-large-title bg-primary text-center">
        <h4 class="subtitle">altere as informações e depois clique em salvar!</h4>
    </div>

    <div class="section full mt-3">

        <div class="wide-block pt-2 pb-2">
            <ul class="nav nav-tabs capsuled" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="true">
                        <ion-icon name="home" role="img" class="md hydrated" aria-label="home"></ion-icon>
                        ESTRUTURA
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#users" role="tab" aria-selected="false">
                        <ion-icon name="person-circle" role="img" class="md hydrated"
                                  aria-label="person circle"></ion-icon>
                        USUÁRIOS
                    </a>
                </li>
            </ul>
            <div class="tab-content mt-2">
                <div class="tab-pane fade active show" id="home" role="tabpanel">
                    <div class="border p-2 custom-card">
                        <form action="{{route('admin.save-games')}}" method="POST">
                            @csrf
                            <div class="d-flex flex-column gap-2 w-100">
                                @foreach($games as $game)
                                    <label for="game"
                                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                                        <span class="w-100">{{$game->name}}:</span>
                                        <input type="text" name="games[{{$game->id}}]" id="mines"
                                               class="form-control form-control-custom w-100"
                                               value="{{$game->iframe_link}}">
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
                            <form action="{{route('admin.save-external-links')}}" method="post">
                                @csrf
                                <div class="d-flex flex-column gap-2 w-100">
                                    <label for=""
                                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                                        <span class="w-100">Solicitar acesso:</span>
                                        <input type="text" name="settings['request_access_link']" id="" value="{{$g_settings['request_access_link']}}"
                                               class="form-control form-control-custom w-100">
                                    </label>
                                    <label for=""
                                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                                        <span class="w-100">Preciso de Ajuda:</span>
                                        <input type="text" name="settings['help_link']" id="" value="{{$g_settings['help_link']}}"
                                               class="form-control form-control-custom w-100">
                                    </label>
                                    <label for="" class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                                        <span class="w-100">Link do Tutorial:</span>
                                        <input type="text" name="settings['admin_tutorial_link']" id="" value="{{$g_settings['admin_tutorial_link']}}"
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
                            <form action="{{route('admin.save-banner')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex flex-column gap-2 w-100">
                                    <label for=""
                                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                                        <span class="w-100">imagem:</span>
                                        <input type="text" id="fileNamePreview"
                                               class="form-control-custom w-100" readonly>
                                        <input type="file" name="settings['home_banner']" id="upload"
                                               class="custom-file-input form-control-custom w-100" hidden>
                                        <button class="btn btn-primary btn-sm me-1" type="button" id="btnUpload">UPLOAD</button>
                                    </label>
                                    @error('settings.home_banner')<span style="color: darkred">{{$message}}</span>@enderror
                                    <label for=""
                                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                                        <span class="w-100">link da imagem:</span>
                                        <input type="text" name="settings['home_banner_ref_link']" id="" class="form-control form-control-custom w-100">
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
                                    <a href="{{$g_settings['admin_tutorial_link']}}"
                                       class="btn btn-primary text-uppercase fw-bolder">Assista Agora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mb-5" id="users" role="tabpanel">
                    <div class="">
                        <label for="keyword"
                               class="form-label-custom d-flex justify-content-start align-items-center ps-2 mb-3 rounded">
                            <input type="text" name="" id="keyword" class="form-control form-control-custom w-100"
                                   placeholder="digite para buscar">
                            <ion-icon name="search" role="img" class="md hydrated" aria-label="search"></ion-icon>
                        </label>
                        <button class="btn btn-secondary btn-sm mb-2" data-bs-toggle="modal"
                                data-bs-target="#create_edit_user_modal">Adicionar usuário
                        </button>
                        @foreach($users as $user)
                            <div class="p-2 d-flex flex-column gap-3" style="color: #b2b2b2">
                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <div style="line-height: 18px">
                                        <span>{{$user->name}}</span><br>
                                        <span>{{$user->email}}</span>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center gap-3">
                                        <a href="">
                                            <ion-icon name="person-sharp" role="img" class="md hydrated"
                                                      style="color: #b2b2b2"
                                                      aria-label="user"></ion-icon>
                                        </a>
                                        <a href="">
                                            <ion-icon name="trash" role="img" class="md hydrated" style="color: #b2b2b2"
                                                      aria-label="trash"></ion-icon>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <nav>
                        <ul class="pagination pagination-rounded">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Dialog Form -->
            <div class="modal fade dialogbox" id="create_edit_user_modal" data-bs-backdrop="static" tabindex="-1"
                 role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cadastrar / Editar usuário</h5>
                        </div>
                        <form action="#">
                            <div class="modal-body text-start mb-2">
                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <input type="email" class="form-control login-input-control" id="email1"
                                               placeholder="E-mail">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>

                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <input type="email" class="form-control login-input-control" id="email1"
                                               placeholder="E-mail">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="btn-inline">
                                    <button type="button" class="btn btn-text-secondary" data-bs-dismiss="modal">CLOSE
                                    </button>
                                    <button type="button" class="btn btn-text-primary" data-bs-dismiss="modal">Salvar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- * Dialog Form -->
        </div>
    </div>

@endsection
