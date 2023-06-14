@extends('layouts.superadmin-layout')

@section('content')
    <h2 style="padding: 10px; margin-bottom: 20px;color: #f8f9fa; background-color: #333;">Lista de empresas</h2>
    <div class="text-right mb-2 float-end">
        <a class="btn btn-primary" href="{{ route('super-admin.companies.create') }}"><i class="fas fa-plus"></i> Crie
            um novo</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Nome</th>
            <th>URL</th>
            <th>Logo</th>
            <th>Favicon</th>
            <th>Home Banner</th>
            <th>Cor Primária</th>
            <th>Cor Secundária</th>
            <th>Cor Terciária</th>
            <th>Ativo</th>
            <th>Administrador</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ url('/'.$company->slug) }}</td>
                <td>
                    <img src="{{ Storage::url($company->logo) }}" alt="Logo" width="30" height="30">
                </td>
                <td>
                    <img src="{{ Storage::url($company->favicon) }}" alt="Favicon" width="30" height="30">
                </td>
                <td>
                    <img src="{{ Storage::url($company->home_banner) }}" alt="Favicon" width="30" height="30">
                </td>
                <td><span style="color: {{ $company->primary_color }}">{{ $company->primary_color }}</span></td>
                <td><span style="color: {{ $company->secondary_color }}">{{ $company->secondary_color }}</span></td>
                <td><span style="color: {{ $company->tertiary_color }}">{{ $company->tertiary_color }}</span></td>
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
@endsection
