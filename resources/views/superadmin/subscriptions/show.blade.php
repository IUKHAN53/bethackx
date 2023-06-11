@extends('layouts.superadmin-layout')

@section('content')
    <h2 style="padding: 10px; margin-bottom: 20px;color: #f8f9fa; background-color: #333;">Detalhes da Assinatura</h2>

    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $subscription->id }}</td>
                </tr>
                <tr>
                    <th>Plano</th>
                    <td>{{ $subscription->plan->name }}</td>
                </tr>
                <tr>
                    <th>Usuário</th>
                    <td>{{ $subscription->user->name }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $subscription->status ? 'Ativo' : 'Inativo' }}</td>
                </tr>
                <tr>
                    <th>Data de Início</th>
                    <td>{{ $subscription->start_date ? $subscription->start_date->format('Y-m-d H:i:s') : '-' }}</td>
                </tr>
                <tr>
                    <th>Data de Término</th>
                    <td>{{ $subscription->end_date ? $subscription->end_date->format('Y-m-d H:i:s') : '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <a href="{{ route('super-admin.subscriptions.edit', $subscription->id) }}" class="btn btn-primary mt-3">Editar</a>
    <a href="{{ route('super-admin.subscriptions.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection
