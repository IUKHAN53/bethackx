@extends('layouts.superadmin-layout')

@section('content')
    <h2 style="padding: 10px; margin-bottom: 20px;color: #f8f9fa; background-color: #333;">Lista de empresas</h2>
    <div class="d-flex justify-content-between m-2">
        <div>
            <form action="{{ route('super-admin.companies.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search"
                       value="{{ request()->input('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('super-admin.companies.create') }}"><i class="fas fa-plus"></i> Crie
                um novo</a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Nome</th>
            <th>URL</th>
            <th>Ativo</th>
            <th>Administrador</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td><a href="{{ url('/'.$company->slug) }}">{{ url('/'.$company->slug) }}</a></td>
                <td>{{ $company->is_active ? 'Sim' : 'Não' }}</td>
                <td>{{ $company->admin->name ?? '' }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('super-admin.companies.show', $company->id) }}"
                           class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('super-admin.companies.edit', $company->id) }}"
                           class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('super-admin.companies.destroy', $company->id) }}" method="POST"
                              id="dlt_form_{{$company->id}}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" class="btn btn-sm btn-danger"
                                onclick="$('#dlt_form_'+{{$company->id}}).submit()">Delete
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $companies->links('pagination::bootstrap-4') }}
    </div>
@endsection
