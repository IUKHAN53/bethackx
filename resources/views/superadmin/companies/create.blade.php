@extends('layouts.superadmin-layout')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Criar Empresa</div>
                <div class="card-body">
                    <form action="{{ route('super-admin.companies.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo:</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*"
                                   onchange="previewImage(this, 'logo-preview')">
                            <img id="logo-preview" src="#" alt="Prévia do Logo"
                                 style="max-width: 100px; margin-top: 10px; display: none;">
                        </div>

                        <div class="form-group">
                            <label for="favicon">Favicon:</label>
                            <input type="file" class="form-control" id="favicon" name="favicon" accept="image/*"
                                   onchange="previewImage(this, 'favicon-preview')">
                            <img id="favicon-preview" src="#" alt="Prévia do Favicon"
                                 style="max-width: 100px; margin-top: 10px; display: none;">
                        </div>

                        <div class="form-group">
                            <label for="primary_color">Cor Primária:</label>
                            <input type="color" class="form-control" id="primary_color" name="primary_color" required>
                        </div>

                        <div class="form-group">
                            <label for="secondary_color">Cor Secundária:</label>
                            <input type="color" class="form-control" id="secondary_color" name="secondary_color"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="tertiary_color">Cor Terciária:</label>
                            <input type="color" class="form-control" id="tertiary_color" name="tertiary_color" required>
                        </div>

                        <div class="form-group">
                            <label for="buttons_color">Cor dos botões:</label>
                            <input type="color" class="form-control" id="buttons_color" name="buttons_color"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="notices_color">Avisa a cor:</label>
                            <input type="color" class="form-control" id="notices_color" name="notices_color" required>
                        </div>

                        <div class="form-group">
                            <label for="is_active">Ativo:</label>
                            <select class="form-control" id="is_active" name="is_active" required>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="admin_id"> Administrador:</label>
                            <select name="admin_id" id="admin_id" class="form-control" required>
                                <option value="">Selecione um usuário existente</option>
                                @foreach($admins as $id => $name)
                                    <option value="{{$id}}">{{$name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="request_access_link">Link de Solicitação de Acesso:</label>
                            <input type="text" class="form-control" id="request_access_link" name="request_access_link"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="help_link">Link de Ajuda:</label>
                            <input type="text" class="form-control" id="help_link" name="help_link" required>
                        </div>

                        <div class="form-group">
                            <label for="home_banner">Banner da Página Inicial:</label>
                            <input type="file" class="form-control" id="home_banner" name="home_banner" accept="image/*"
                                   onchange="previewImage(this, 'home-banner-preview')">
                            <img id="home-banner-preview" src="#" alt="Prévia do Banner"
                                 style="max-width: 100px; margin-top: 10px; display: none;">
                        </div>

                        <div class="form-group">
                            <label for="home_banner_ref_link">Link de Referência do Banner:</label>
                            <input type="text" class="form-control" id="home_banner_ref_link"
                                   name="home_banner_ref_link" required>
                        </div>

                        <div class="form-group">
                            <label for="admin_tutorial_link">Link do Tutorial do Administrador:</label>
                            <input type="text" class="form-control" id="admin_tutorial_link" name="admin_tutorial_link"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="plan_checkout_link">Plano de link de checkout:</label>
                            <input type="text" class="form-control" id="plan_checkout_link" name="plan_checkout_link"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Criar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(input, previewId) {
            var preview = document.getElementById(previewId);
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
