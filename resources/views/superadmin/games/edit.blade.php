@extends('layouts.superadmin-layout')

@section('content')
    <div class="container">
        <h1>Editar Jogo</h1>
        <form method="POST" action="{{ route('super-admin.games.update', $game->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $game->name }}" required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="game_text">Texto do Jogo</label>
                <input type="text" class="form-control" id="game_text" name="game_text" value="{{ $game->game_text }}"
                       required>
                @error('game_text')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="game_type">Tipo de Jogo</label>
                <select class="form-control" id="game_type" name="game_type" required>
                    <option value="slots" {{ $game->game_type === 'slots' ? 'selected' : '' }}>Slots</option>
                    <option value="cartas" {{ $game->game_type === 'cartas' ? 'selected' : '' }}>Cartas</option>
                    <option value="roletas" {{ $game->game_type === 'roletas' ? 'selected' : '' }}>Roletas</option>
                    <option value="dados" {{ $game->game_type === 'dados' ? 'selected' : '' }}>Dados</option>
                </select>
                @error('game_type')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea class="form-control" id="description" name="description" rows="4"
                          required>{{ $game->description }}</textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="iframe_link">Link do IFrame</label>
                <input type="text" class="form-control" id="iframe_link" name="iframe_link"
                       value="{{ $game->iframe_link }}" required>
                @error('iframe_link')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Imagem</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*"
                       onchange="previewImage(event)">
                <img id="image-preview" src="{{ $game->is_default ? asset($game->image) : Storage::url($game->image)}}"
                     alt="Pré-visualização da Imagem"
                     style="max-width: 100px; margin-top: 10px; display: {{ $game->image ? 'block' : 'none' }}">
                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="banner">Banner</label>
                <input type="file" class="form-control" id="banner" name="banner" accept="image/*"
                       onchange="previewBanner(event)">
                <img id="banner-preview"
                     src="{{ $game->is_default ? asset($game->banner) : Storage::url($game->banner) }}"
                     alt="Pré-visualização do Banner"
                     style="max-width: 400px; margin-top: 10px; display: {{ $game->banner ? 'block' : 'none' }}">
                @error('banner')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="0" {{ $game->status === 0 ? 'selected' : '' }}>Inativo</option>
                    <option value="1" {{ $game->status === 1 ? 'selected' : '' }}>Ativo</option>
                </select>
                @error('status')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary float-end mt-3">Atualizar</button>
        </form>
    </div>
    <script>
        function previewImage(event) {
            var imageElement = document.getElementById('image-preview');
            imageElement.style.display = 'block';
            imageElement.src = URL.createObjectURL(event.target.files[0]);
        }

        function previewBanner(event) {
            var bannerElement = document.getElementById('banner-preview');
            bannerElement.style.display = 'block';
            bannerElement.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
