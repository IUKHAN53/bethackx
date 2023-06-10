@extends('layouts.superadmin-layout')

@section('content')
    <h1>Criar Plano</h1>

    <form action="{{ route('super-admin.plans.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" required></textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Preço</label>
            <input type="number" id="price" name="price" step="0.01" class="form-control @error('price') is-invalid @enderror" required>
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="company_id">Empresa</label>
            <select id="company_id" name="company_id" class="form-control @error('company_id') is-invalid @enderror" required>
                <option value="">Selecione a Empresa</option>
                @foreach ($companies as $key=>$company)
                    <option value="{{ $key }}">{{ $company }}</option>
                @endforeach
            </select>
            @error('company_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3 float-end">Criar</button>
    </form>

@endsection
