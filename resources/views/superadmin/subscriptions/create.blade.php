@extends('layouts.superadmin-layout')

@section('content')
    <h2 style="padding: 10px; margin-bottom: 20px;color: #f8f9fa; background-color: #333;">Criar Assinatura</h2>

    <form action="{{ route('super-admin.subscriptions.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="plan_id">Plano</label>
            <select id="plan_id" name="plan_id" class="form-control @error('plan_id') is-invalid @enderror" required>
                <option value="">Selecione o Plano</option>
                @foreach ($plans as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                @endforeach
            </select>
            @error('plan_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="user_id">Usuário</label>
            <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                <option value="">Selecione o Usuário</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="0">Inativo</option>
                <option value="1">Ativo</option>
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

{{--        <div class="form-group">--}}
{{--            <label for="start_date">Data de Início</label>--}}
{{--            <input type="datetime-local" id="start_date" name="start_date" class="form-control @error('start_date') is-invalid @enderror">--}}
{{--            @error('start_date')--}}
{{--            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--            @enderror--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label for="end_date">Data de Término</label>--}}
{{--            <input type="datetime-local" id="end_date" name="end_date" class="form-control @error('end_date') is-invalid @enderror">--}}
{{--            @error('end_date')--}}
{{--            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--            @enderror--}}
{{--        </div>--}}

        <button type="submit" class="btn btn-primary mt-3 float-end">Criar</button>
    </form>
@endsection
