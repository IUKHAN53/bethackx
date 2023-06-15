@extends('layouts.superadmin-layout')

@section('content')
    <h2>Criar usuário</h2>
    <form action="{{ route('super-admin.users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
            @error('name')<span style="color: darkred">{{$message}}</span>@enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required>
            @error('email')<span style="color: darkred">{{$message}}</span>@enderror
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')<span style="color: darkred">{{$message}}</span>@enderror
        </div>
        <button type="submit" class="btn btn-primary float-end mt-2">Create</button>
    </form>
@endsection
