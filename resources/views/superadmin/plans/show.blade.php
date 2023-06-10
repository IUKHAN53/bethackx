@extends('layouts.superadmin-layout')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Detalhes do Plano</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nome:</label>
                        <p>{{ $plan->name }}</p>
                    </div>
                    <div class="form-group">
                        <label>Descrição:</label>
                        <p>{{ $plan->description }}</p>
                    </div>
                    <div class="form-group">
                        <label>Preço:</label>
                        <p>{{ number_format($plan->price, 2, ',', '.') }}</p>
                    </div>
                    <div class="form-group">
                        <label>Nome da Empresa:</label>
                        <p>{{ $plan->company->name ?? ''}}</p>
                    </div>
                    <div class="form-group">
                        <label>Data de Criação:</label>
                        <p>{{ $plan->created_at }}</p>
                    </div>
                    <div class="form-group">
                        <label>Data de Atualização:</label>
                        <p>{{ $plan->updated_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
