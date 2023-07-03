@extends('layouts.superadmin-layout')

@section('content')
    <h2 style="padding: 10px; margin-bottom: 20px;color: #f8f9fa; background-color: #333;font-size: 15px;">🟢 Lista de Jogos ativos </h2>
    <div class="text-right mb-2 float-end">
        <a class="btn btn-primary" href="{{ route('super-admin.games.create') }}"><i class="fas fa-plus"></i> Crie um novo</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Texto do Jogo</th>
            <th>Tipo do Jogo</th>
            <th>Link do IFrame</th>
            <th>Imagem</th>
            <th>Banner</th>

            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($games as $game)
            <tr>
                <td>{{ $game->id }}</td>
                <td>{{ $game->name }}</td>
                <td>{{ $game->game_text }}</td>
                <td>{{ $game->game_type }}</td>
                <td>{{ $game->iframe_link }}</td>
                <td><img src="{{ $game->is_default ? asset($game->image) : Storage::url($game->image)}}" alt="image" width="50px" height="50px"></td>
                <td><img src="{{ $game->is_default ? asset($game->banner) : Storage::url($game->banner) }}" alt="banner" width="100px" height="50px"></td>
               
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('super-admin.games.show', $game->id) }}"
                           class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('super-admin.games.edit', $game->id) }}"
                           class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('super-admin.games.destroy', $game->id) }}" method="POST"
                              id="dlt_form_{{$game->id}}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" class="btn btn-sm btn-danger"
                                onclick="$('#dlt_form_'+{{$game->id}}).submit()">Delete
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
