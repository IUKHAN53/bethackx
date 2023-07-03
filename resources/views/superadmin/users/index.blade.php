@extends('layouts.superadmin-layout')

@section('content')
    <h2 style="padding: 10px; margin-bottom: 20px;color: #f8f9fa; background-color: #333;font-size: 14px;">🟢 Lista  usuários</h2>
    <div class="d-flex justify-content-between  m-2">
        <div>
            <form action="{{ route('super-admin.users.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search"
                       value="{{ request()->input('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('super-admin.users.create') }}"><i class="fas fa-plus"></i> Crie
                um novo</a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Empresa</th>
            <th>Created At</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->company->name ?? '' }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('super-admin.users.show', $user->id) }}"
                           class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('super-admin.users.edit', $user->id) }}"
                           class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('super-admin.users.destroy', $user->id) }}" method="POST"
                              id="dlt_form_{{ $user->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" class="btn btn-sm btn-danger"
                                onclick="$('#dlt_form_{{ $user->id }}').submit()">Delete
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endsection
