@extends('layouts.superadmin-layout')
@section('content')
    <div class="container">
        <h1>Criar Jogo</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('super-admin.games.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="game_text">Texto do Jogo</label>
                <input type="text" name="game_text" id="game_text" class="form-control">
            </div>

            <div class="form-group">
                <label for="game_type">Tipo do Jogo</label>
                <select name="game_type" id="game_type" class="form-control">
                    <option value="slots">Slots</option>
                    <option value="cartas">Cartas</option>
                    <option value="roletas">Roletas</option>
                    <option value="dados">Dados</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="iframe_link">Link do IFrame</label>
                <input type="text" name="iframe_link" id="iframe_link" class="form-control">
            </div>

            <div class="form-group">
                <label for="image">Imagem</label>
                <input type="file" name="image" id="image" class="form-control" onchange="previewImage(this, 'imagePreview')">
                <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 100px; margin-top: 10px;">
            </div>

            <div class="form-group">
                <label for="banner">Banner</label>
                <input type="file" name="banner" id="banner" class="form-control" onchange="previewImage(this, 'bannerPreview')">
                <img id="bannerPreview" src="#" alt="Preview" style="display: none; max-width: 100px; margin-top: 10px;">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="company_id">Empresa</label>
                <select name="company_id" id="company_id" class="form-control">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3 float-end">Criar</button>
        </form>
    </div>

    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + previewId).attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $('#' + previewId).hide();
            }
        }
    </script>
@endsection
