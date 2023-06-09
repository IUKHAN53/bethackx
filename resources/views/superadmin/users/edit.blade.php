@extends('layouts.superadmin-layout')

@section('content')
    <h2>Editar usuário</h2>
    <form action="{{ route('super-admin.users.update', ['user'=>$user->id]) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
            @error('name')<span style="color: darkred">{{$message}}</span>@enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
            @error('email')<span style="color: darkred">{{$message}}</span>@enderror
        </div>

        <div class="form-group">
            <label for="company_id">Empresa</label>
            <select name="company_id" id="company_id" class="form-control">
                @foreach($companies as $key=>$name)
                    <option value="{{ $key }}" {{($key == $user->company_id ? 'selected' : '')}}>{{ $name }}</option>
                @endforeach
            </select>
            @error('company_id')<span style="color: darkred">{{$message}}</span>@enderror
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')<span style="color: darkred">{{$message}}</span>@enderror
        </div>
        <div class="form-check mt-3">
            <input class="form-check-input" name="is_company_admin" type="checkbox" id="is_company_admin">
            <label class="form-check-label" for="is_company_admin">
                É administrador da empresa
            </label>
        </div>
        <button type="submit" class="btn btn-primary float-end mt-2">Atualizar</button>
    </form>
@endsection
