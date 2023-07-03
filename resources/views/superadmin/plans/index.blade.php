@extends('layouts.superadmin-layout')

@section('content')
    <h2 style="padding: 10px; margin-bottom: 20px;color: #f8f9fa; background-color: #333;font-size: 15px;">🟢 Lista de Planos (Não Alterar)</h2>
    <div class="text-right mb-2 float-end">
        <a class="btn btn-primary" href="{{ route('super-admin.plans.create') }}"><i class="fas fa-plus"></i> Crie um novo</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Description</th>
            <th>Empresa</th>
            <th>Price</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        @foreach($plans as $plan)
            <tr>
                <td>{{ $plan->id }}</td>
                <td>{{ $plan->name }}</td>
                <td>{{ $plan->description }}</td>
                <td>{{ $plan->company->name ?? '' }}</td>
                <td>{{ $plan->price }}</td>
                <td>{{ $plan->status ? 'Ativo' : 'Inativo' }}</td>
                <td>{{ $plan->created_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('super-admin.plans.show', $plan->id) }}" class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('super-admin.plans.edit', $plan->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('super-admin.plans.destroy', $plan->id) }}" method="POST" id="dlt_form_{{$plan->id}}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" class="btn btn-sm btn-danger" onclick="$('#dlt_form_'+{{$plan->id}}).submit()">Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
