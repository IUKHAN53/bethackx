@extends('layouts.superadmin-layout')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Detalhes do Usuário</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nome:</label>
                        <p>{{ $user->name }}</p>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div class="form-group">
                        <label>Nome da Empresa:</label>
                        <p>{{ $user->company->name ?? ''}}</p>
                    </div>
                    <div class="form-group">
                        <label>Data de Criação:</label>
                        <p>{{ $user->created_at }}</p>
                    </div>
                    <div class="form-group">
                        <label>Data de Atualização:</label>
                        <p>{{ $user->updated_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
