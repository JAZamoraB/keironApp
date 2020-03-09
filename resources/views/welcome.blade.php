<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/app.css" rel="stylesheet">
        <title>Keiron | Bienvenida</title>
    </head>
    <body class="bg-dark text-white position-relative">
        <!-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div> -->
        <img src="/assets/img/Imagotipo-fucsia.png" class="position-absolute" style="top: 2rem; left: 50%; transform: translateX(-50%);">
        <div class="container" style="height: 100vh; font-family: Roboto; font-size: 2rem;">
            <div class="row h-100 d-flex justify-content-center align-items-center">
                <a href="/login" class="btn btn-dark border-0 col-3 p-5 mx-4">
                    <div class="row flex-column align-items-center">
                        <i class="fas fa-user-cog fa-3x my-4"></i>
                        <span style="font-size: 1.75rem; font-family: Roboto-BoldItalic;">
                            Iniciar Sesión
                        </span>
                    </div>
                </a>
                <a href="/register" class="btn btn-dark border-0 col-3 p-5 mx-4">
                    <div class="row flex-column align-items-center">
                        <i class="fas fa-user-plus fa-3x my-4"></i>
                        <span style="font-size: 1.75rem; font-family: Roboto-BoldItalic;">
                            Crear Cuenta
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </body>
</html>
