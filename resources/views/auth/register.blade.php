@extends('layouts.app')

@section('title', 'Keirón | Creación de Cuenta')
@section('content')
<div class="container" style="height: 100vh;">
    <div class="row h-100 flex-column justify-content-center">
        <div class="col-auto py-4 py-md-5 mx-auto">
            <a href="{{route('welcome')}}">
                <img src="/assets/img/Imagotipo-fucsia.png">
            </a>
        </div>

        <div class="col py-4 py-md-5 text-light">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right"
                        style="font-family: Roboto-Bold; font-size: 1.5rem;">Nombre</label>
                    <div class="col-md-6">
                        <input id="name" type="text" style="font-family: OpenSans; font-size: 1.25rem;"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right"
                        style="font-family: Roboto-Bold; font-size: 1.5rem;">Correo Electrónico</label>
                    <div class="col-md-6">
                        <input id="email" type="email" style="font-family: OpenSans; font-size: 1.25rem;"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right"
                        style="font-family: Roboto-Bold; font-size: 1.5rem;">Contraseña</label>

                    <div class="col-md-6">
                        <input id="password" type="password" style="font-family: OpenSans; font-size: 1.25rem;"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right"
                        style="font-family: Roboto-Bold; font-size: 1.5rem;">Confirmar Contraseña</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" style="font-family: OpenSans; font-size: 1.25rem;"
                            class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4 d-flex justify-content-between">
                        <button type="submit" class="btn btn-super" style="font-family: Roboto-Bold; font-size: 1.5rem;">
                            <i class="fas fa-plus"></i>
                            Crear Cuenta
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
{{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"
                    style="font-family: Roboto-Bold; font-size: 1.5rem;">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" style="font-family: OpenSans; font-size: 1.25rem;"
                        class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                        required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right"
                    style="font-family: Roboto-Bold; font-size: 1.5rem;">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" style="font-family: OpenSans; font-size: 1.25rem;"
                        class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                        required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right"
                    style="font-family: Roboto-Bold; font-size: 1.5rem;">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" style="font-family: OpenSans; font-size: 1.25rem;"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right"
                    style="font-family: Roboto-Bold; font-size: 1.5rem;">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" style="font-family: OpenSans; font-size: 1.25rem;"
                        class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
        </div>
        </div>
        </div>
</div> --}}
@endsection