@extends('layouts.superadmin-layout')

@section('content')
    <!-- resources/views/plans/edit.blade.php -->
    <h1>Editar Plano</h1>

    <form action="{{ route('super-admin.plans.update', $plan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $plan->name) }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $plan->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Preço</label>
            <input type="number" id="price" name="price" step="0.01" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $plan->price) }}" required>
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="1" {{ old('status', $plan->status) == 1 ? 'selected' : '' }}>Ativo</option>
                <option value="0" {{ old('status', $plan->status) == 0 ? 'selected' : '' }}>Inativo</option>
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
                    <option value="{{ $key }}" {{ old('company_id', $plan->company_id) == $key ? 'selected' : '' }}>{{ $company }}</option>
                @endforeach
            </select>
            @error('company_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary float-end mt-3">Salvar</button>
    </form>

@endsection
