@extends('layouts.superadmin-layout')

@section('content')
    <div class="container">
        <h1>Editar Empresa</h1>
        <form action="{{ route('super-admin.companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $company->name) }}">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" name="logo" id="logo" class="form-control" onchange="previewImage(this, 'logo-preview')">
                @if($company->logo)
                    <div>
                        <img id="logo-preview" src="{{ Storage::url($company->logo) }}" alt="Logo" style="max-width: 100px;">
                    </div>
                @endif
                @error('logo')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="favicon" class="form-label">Favicon</label>
                <input type="file" name="favicon" id="favicon" class="form-control" onchange="previewImage(this, 'favicon-preview')">
                @if($company->favicon)
                    <div>
                        <img id="favicon-preview" src="{{ Storage::url($company->favicon) }}" alt="Favicon" style="max-width: 100px;">
                    </div>
                @endif
                @error('favicon')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="primary_color" class="form-label">Cor Primária</label>
                <input type="color" name="primary_color" id="primary_color" class="form-control" value="{{ old('primary_color', $company->primary_color) }}">
                @error('primary_color')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="secondary_color" class="form-label">Cor Secundária</label>
                <input type="color" name="secondary_color" id="secondary_color" class="form-control" value="{{ old('secondary_color', $company->secondary_color) }}">
                @error('secondary_color')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tertiary_color" class="form-label">Cor Terciária</label>
                <input type="color" name="tertiary_color" id="tertiary_color" class="form-control" value="{{ old('tertiary_color', $company->tertiary_color) }}">
                @error('tertiary_color')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="is_active" class="form-label">Ativa</label>
                <select name="is_active" id="is_active" class="form-control">
                    <option value="1" {{ old('is_active', $company->is_active) == 1 ? 'selected' : '' }}>Sim</option>
                    <option value="0" {{ old('is_active', $company->is_active) == 0 ? 'selected' : '' }}>Não</option>
                </select>
                @error('is_active')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="admin_id" class="form-label">Administrador</label>
                <select name="admin_id" id="admin_id" class="form-control" required>
                    <option value="">Selecione um usuário existente</option>
                    @foreach($admins as $id=>$name)
                        <option value="{{$id}}" {{ old('id', $company->admin_id) == $id ? 'selected' : '' }}>{{$name}}</option>
                    @endforeach
                </select>
                @error('admin_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
    <script>
        function previewImage(input, previewId) {
            var preview = document.getElementById(previewId);
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
