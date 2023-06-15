@extends('layouts.superadmin-layout')

@section('content')
    <h2 style="padding: 10px; margin-bottom: 20px;color: #f8f9fa; background-color: #333;">Editar Assinatura</h2>

    <form action="{{ route('super-admin.subscriptions.update', $subscription->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="plan_id">Plano</label>
            <select id="plan_id" name="plan_id" class="form-control @error('plan_id') is-invalid @enderror" required>
                <option value="">Selecione o Plano</option>
                @foreach ($plans as $plan)
                    <option value="{{ $plan->id }}" {{ $subscription->plan_id == $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
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
                    <option value="{{ $user->id }}" {{ $subscription->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="0" {{ $subscription->status == 0 ? 'selected' : '' }}>Inativo</option>
                <option value="1" {{ $subscription->status == 1 ? 'selected' : '' }}>Ativo</option>
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

{{--        <div class="form-group">--}}
{{--            <label for="start_date">Data de Início</label>--}}
{{--            <input type="datetime-local" id="start_date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ $subscription->start_date ? $subscription->start_date->format('Y-m-d\TH:i') : '' }}">--}}
{{--            @error('start_date')--}}
{{--            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--            @enderror--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label for="end_date">Data de Término</label>--}}
{{--            <input type="datetime-local" id="end_date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ $subscription->end_date ? $subscription->end_date->format('Y-m-d\TH:i') : '' }}">--}}
{{--            @error('end_date')--}}
{{--            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--            @enderror--}}
{{--        </div>--}}

        <button type="submit" class="btn btn-primary mt-3 float-end">Atualizar</button>
    </form>
@endsection
