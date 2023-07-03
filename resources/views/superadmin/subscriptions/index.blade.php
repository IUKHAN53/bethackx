@extends('layouts.superadmin-layout')

@section('content')
    <h2 style="padding: 10px; margin-bottom: 20px; color: #f8f9fa; background-color: #333;font-size: 15px;">🟢 Lista de assinaturas (Não alterar) </h2>
    <div class="text-right mb-2 float-end">
        <a class="btn btn-primary" href="{{ route('super-admin.subscriptions.create') }}"><i class="fas fa-plus"></i> Criar nova</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Plano</th>
            <th>Usuário</th>
            <th>Status</th>
{{--            <th>Data de Início</th>--}}
{{--            <th>Data de Término</th>--}}
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subscriptions as $subscription)
            <tr>
                <td>{{ $subscription->id }}</td>
                <td>{{ $subscription->plan->name }}</td>
                <td>{{ $subscription->user->name }}</td>
                <td>{{ $subscription->status ? 'Ativo' : 'Inativo' }}</td>
{{--                <td>{{ $subscription->start_date }}</td>--}}
{{--                <td>{{ $subscription->end_date }}</td>--}}
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('super-admin.subscriptions.show', $subscription->id) }}" class="btn btn-sm btn-primary">Ver</a>
                        <a href="{{ route('super-admin.subscriptions.edit', $subscription->id) }}" class="btn btn-sm btn-secondary">Editar</a>
                        <form action="{{ route('super-admin.subscriptions.destroy', $subscription->id) }}" method="POST" id="dlt_form_{{ $subscription->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" class="btn btn-sm btn-danger" onclick="$('#dlt_form_{{ $subscription->id }}').submit()">Excluir</button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
