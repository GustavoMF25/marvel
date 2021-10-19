<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">


        <!--Bootstrap-->
        <link href="{{asset('assets/bootstrap-5/css/bootstrap.min.css')}}" rel="stylesheet" />
        <!-- Estilo padrão criado para o welcome -->
        <link href="{{asset('css/default.css')}}" rel="stylesheet" />
        <!--Normalize para tirar o estilo padrão do navegador-->
        <link href="{{asset('css/normalize.min.css')}}" rel="stylesheet" />
        <style>

        </style>
    </head>
    <body>
        <div class="container">
            <div>
                @if (Route::has('login'))
                <div>
                    @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                    @endif
                    @endauth
                </div>
                @endif          
            </div>
        </div>

        <script src="{{ asset('assets/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
