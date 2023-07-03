@extends('layouts.login-layout')

@section('content')
    <div class="login-form mt-1 d-flex justify-content-center gap-5 flex-column" style="height: 90vh">
        <div class="section mt-1">
            @if ($current_company && $current_company->is_default==0 )
                @if ($current_company->logo)
                    <img src="{{Storage::url($current_company->logo)}}" alt="image" class="form-image">
                @else
                    <img src="{{asset('img/home_logo.png')}}" alt="image" class="form-image">
                @endif
            @else
                <img src="{{asset('img/home_logo.png')}}" alt="image" class="form-image">
            @endif
            <h2 class="text-white mt-4">Cadastro Premium</h2>
        </div>
        <div class="section mt-1 mb-5 d-flex justify-content-center align-items-center">
            <form method="POST" action="{{route('register_premium', $current_company->slug )}}" class="w-100">
                @csrf
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="text"
                               class="form-control login-input-control @error('name') is-invalid @enderror" id="name"
                               name="name"
                               placeholder="Nome">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="email"
                               class="form-control login-input-control @error('email') is-invalid @enderror" id="email"
                               name="email"
                               placeholder="E-mail">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="password"
                               class="form-control login-input-control @error('password') is-invalid @enderror"
                               id="password1" name="password"
                               placeholder="Senha"
                               autocomplete="off">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="password"
                               class="form-control login-input-control @error('password_confirmation') is-invalid @enderror"
                               id="password_confirmation1" name="password_confirmation"
                               placeholder="Confirme sua senha"
                               autocomplete="off">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-primary btn-block btn-lg " style="height: 60px !important;">
                        Cadastro
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
