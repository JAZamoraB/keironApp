@extends('layouts.app')

@section('content')

<div class="container" style="height: 100vh;">
    <div class="row h-100 flex-column justify-content-center">
        <div class="col-auto py-4 py-md-5 mx-auto">
            <a href="{{route('welcome')}}">
                <img src="/assets/img/Imagotipo-fucsia.png">
            </a>
        </div>
        <div class="col py-4 py-md-5 text-light">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right" style="font-family: Roboto-Bold; font-size: 1.5rem;">Dirección de Correo</label>
                    <div class="col-md-6">
                        <input id="email" type="email" style="font-family: OpenSans; font-size: 1.25;" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right" style="font-family: Roboto-Bold; font-size: 1.5rem;">Contraseña</label>

                    <div class="col-md-6">
                        <input id="password" type="password" style="font-family: OpenSans; font-size: 1.25;" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4 d-flex justify-content-between">
                        <button type="submit" class="btn btn-super" style="font-family: Roboto-Bold; font-size: 1.5rem;">
                            <i class="fas fa-sign-in-alt"></i>
                            Iniciar Sesión
                        </button>
                        <a href="{{route('welcome')}}" class="btn btn-outline-light border-0"
                            style="font-family: Roboto; font-size: 1.5rem;">
                            <small>
                                <i class="fas fa-times"></i>
                                Cancelar
                            </small>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
