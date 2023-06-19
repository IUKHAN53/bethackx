@extends('layouts.superadmin-layout')

@section('content')
    <div class="container">
        <h1>Editar Empresa</h1>
        <form action="{{ route('super-admin.companies.update', $company->id) }}" method="POST"
              enctype="multipart/form-data">
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
                <input type="file" name="logo" id="logo" class="form-control"
                       onchange="previewImage(this, 'logo-preview')">
                @if($company->logo)
                    <div>
                        <img id="logo-preview" src="{{ Storage::url($company->logo) }}" alt="Logo"
                             style="max-width: 100px;">
                    </div>
                @endif
                @error('logo')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="favicon" class="form-label">Favicon</label>
                <input type="file" name="favicon" id="favicon" class="form-control"
                       onchange="previewImage(this, 'favicon-preview')">
                @if($company->favicon)
                    <div>
                        <img id="favicon-preview" src="{{ Storage::url($company->favicon) }}" alt="Favicon"
                             style="max-width: 100px;">
                    </div>
                @endif
                @error('favicon')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="primary_color" class="form-label">Cor Primária</label>
                <input type="color" name="primary_color" id="primary_color" class="form-control"
                       value="{{ old('primary_color', $company->primary_color) }}">
                @error('primary_color')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="secondary_color" class="form-label">Cor Secundária</label>
                <input type="color" name="secondary_color" id="secondary_color" class="form-control"
                       value="{{ old('secondary_color', $company->secondary_color) }}">
                @error('secondary_color')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tertiary_color" class="form-label">Cor Terciária</label>
                <input type="color" name="tertiary_color" id="tertiary_color" class="form-control"
                       value="{{ old('tertiary_color', $company->tertiary_color) }}">
                @error('tertiary_color')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="buttons_color" class="form-label">Cor do botao</label>
                <input type="color" name="buttons_color" id="buttons_color" class="form-control"
                       value="{{ old('buttons_color', $company->buttons_color) }}">
                @error('buttons_color')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="notices_color" class="form-label">Aviso Cor</label>
                <input type="color" name="notices_color" id="notices_color" class="form-control"
                       value="{{ old('notices_color', $company->notices_color) }}">
                @error('notices_color')
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
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}" {{ old('admin_id', $company->admin_id) == $admin->id ? 'selected' : '' }}>
                            {{ $admin->name . ' ('. $admin->email .')' }}
                        </option>
                    @endforeach
                </select>
                @error('admin_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="request_access_link" class="form-label">Link de Solicitação de Acesso</label>
                <input type="text" name="request_access_link" id="request_access_link" class="form-control"
                       value="{{ old('request_access_link', $company->request_access_link) }}">
                @error('request_access_link')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="help_link" class="form-label">Link de Ajuda</label>
                <input type="text" name="help_link" id="help_link" class="form-control"
                       value="{{ old('help_link', $company->help_link) }}">
                @error('help_link')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="home_banner" class="form-label">Banner da Página Inicial</label>
                <input type="file" name="home_banner" id="home_banner" class="form-control"
                       onchange="previewImage(this, 'home-banner-preview')">
                @if($company->home_banner)
                    <div>
                        <img id="home-banner-preview" src="{{ Storage::url($company->home_banner) }}" alt="Banner"
                             style="max-width: 100px;">
                    </div>
                @endif
                @error('home_banner')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="home_banner_ref_link" class="form-label">Link de Referência do Banner</label>
                <input type="text" name="home_banner_ref_link" id="home_banner_ref_link" class="form-control"
                       value="{{ old('home_banner_ref_link', $company->home_banner_ref_link) }}">
                @error('home_banner_ref_link')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="admin_tutorial_link" class="form-label">Link do Tutorial do Administrador</label>
                <input type="text" name="admin_tutorial_link" id="admin_tutorial_link" class="form-control"
                       value="{{ old('admin_tutorial_link', $company->admin_tutorial_link) }}">
                @error('admin_tutorial_link')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="plan_checkout_link" class="form-label">Plano de link de checkout</label>
                <input type="text" name="plan_checkout_link" id="plan_checkout_link" class="form-control"
                       value="{{ old('plan_checkout_link', $company->plan_checkout_link) }}">
                @error('plan_checkout_link')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="plan_checkout_link" class="form-label">Plano de link de checkout:</label>
                <input type="text" name="plan_checkout_link" id="plan_checkout_link" class="form-control"
                       value="{{ old('plan_checkout_link', $company->plan_checkout_link) }}">
                @error('plan_checkout_link')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
    <script type="module">
        function previewImage(input, previewId) {
            var preview = document.getElementById(previewId);
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
            $('#admin_id').select2({
                placeholder: 'Selecione um usuário existente',
                allowClear: true,
                width: '100%'
            });
    </script>
@endsection
