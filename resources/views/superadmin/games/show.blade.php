@extends('layouts.superadmin-layout')

@section('content')
    <div class="container">
        <h1>Detalhes do Jogo</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nome: {{ $game->name }}</h5>
                <p class="card-text">Texto do Jogo: {{ $game->game_text }}</p>
                <p class="card-text">Tipo de Jogo: {{ $game->game_type }}</p>
                <p class="card-text">Descrição: {{ $game->description }}</p>
                <p class="card-text">Link do Iframe: {{ $game->iframe_link }}</p>
                <p class="card-text">Status: {{ $game->status ? 'Ativo' : 'Inativo' }}</p>
                <p class="card-text">Empresa: {{ $game->company->name }}</p>
                <p class="card-text">Imagem:</p>
                @if ($game->image)
                    <img src="{{ $game->is_default ? asset($game->image) : Storage::url($game->image)}}" alt="Imagem do Jogo" style="max-width: 200px;">
                @else
                    Sem imagem
                @endif
                <p class="card-text">Banner:</p>
                @if ($game->banner)
                    <img src="{{ $game->is_default ? asset($game->banner) : Storage::url($game->banner)}}" alt="Banner do Jogo" style="max-width: 1000px;">
                @else
                    Sem banner
                @endif
            </div>
        </div>
    </div>
@endsection
