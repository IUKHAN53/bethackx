@extends('layouts.superadmin-layout')

@section('content')
    <div class="container">
        <h1>Detalhes da Empresa</h1>
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">ID</th>
                <td>{{ $company->id }}</td>
            </tr>
            <tr>
                <th scope="row">Nome</th>
                <td>{{ $company->name }}</td>
            </tr>
            <tr>
                <th scope="row">Logo</th>
                <td>
                    @if($company->logo)
                        <img src="{{ Storage::url($company->logo) }}" alt="Logo" style="max-width: 100px;">
                    @else
                        Nenhum logo disponível.
                    @endif
                </td>
            </tr>
            <tr>
                <th scope="row">Favicon</th>
                <td>
                    @if($company->favicon)
                        <img src="{{ Storage::url($company->favicon) }}" alt="Favicon" style="max-width: 100px;">
                    @else
                        Nenhum favicon disponível.
                    @endif
                </td>
            </tr>
            <tr>
                <th scope="row">Cor Primária</th>
                <td><span style="color: {{ $company->primary_color }}">{{ $company->primary_color }}</span></td>
            </tr>
            <tr>
                <th scope="row">Cor Secundária</th>
                <td><span style="color: {{ $company->secondary_color }}">{{ $company->secondary_color }}</span></td>
            </tr>
            <tr>
                <th scope="row">Cor Terciária</th>
                <td><span style="color: {{ $company->tertiary_color }}">{{ $company->tertiary_color }}</span></td>
            </tr>
            <tr>
                <th scope="row">Ativa</th>
                <td>{{ $company->is_active ? 'Sim' : 'Não' }}</td>
            </tr>
            <tr>
                <th scope="row">Administrador</th>
                <td>{{ $company->admin->name }}</td>
            </tr>
            <tr>
                <th scope="row">Criado em</th>
                <td>{{ $company->created_at->format('d/m/Y H:i:s') }}</td>
            </tr>
            <tr>
                <th scope="row">Atualizado em</th>
                <td>{{ $company->updated_at->format('d/m/Y H:i:s') }}</td>
            </tr>
            </tbody>
        </table>
        <a href="{{ route('super-admin.companies.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
