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
            <th style="text-align: center">Nome</th>
            <th style="text-align: center">Logo</th>
            <th style="text-align: center">Favicon</th>
            <th style="text-align: center">Cor Primária</th>
            <th style="text-align: center">Cor Secundária</th>
            <th style="text-align: center">Cor Terciária</th>
            <th style="text-align: center">Ativo</th>
            <th style="text-align: center">ID do Administrador</th>
            <th style="text-align: center">Ação</th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <td style="text-align: center">{{ $company->name }}</td>
                <td style="text-align: center">
                    <img src="{{ Storage::url($company->logo) }}" alt="Logo" width="50" height="50">
                </td>
                <td style="text-align: center">
                    <img src="{{ Storage::url($company->favicon) }}" alt="Favicon" width="30" height="30">
                </td>
                <td style="text-align: center"><span style="color: {{ $company->primary_color }}">{{ $company->primary_color }}</span></td>
                <td style="text-align: center"><span style="color: {{ $company->secondary_color }}">{{ $company->secondary_color }}</span></td>
                <td style="text-align: center"><span style="color: {{ $company->tertiary_color }}">{{ $company->tertiary_color }}</span></td>
                <td style="text-align: center">{{ $company->is_active ? 'Sim' : 'Não' }}</td>
                <td style="text-align: center">{{ $company->admin->name ?? '' }}</td>
                <td style="text-align: center">
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
