<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
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
        <!--Adicionando icone-->
        <link rel="shortcut icon" href="{{ asset('imagens/icon.png') }}">
        <script type="text/javascript">
            var loader;
            function preloader(value) {
                if (value <= 0) {
                    displayContent()
                } else {
                    window.setTimeout(() => {
                        preloader(value - 0.10)
                    }, 100)
                }
            }
            function  displayContent() {
                loader.style.display = 'none';
            }
            document.addEventListener('DOMContentLoaded', function () {
                loader = document.getElementById('preloader');
                preloader(1)
            })

        </script>

        <script src="{{ asset('assets/bootstrap-5/js/bootstrap.bundle.min.js') }}" defer></script>
    </head>
    <body>
        <div id="preloader"></div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('imagens/icon.png')}}" alt="" width="30" height="24" class="d-inline-block align-text-top">                    
                    Marvel 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav d-flex mr-3 mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Opções
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <li><button type="submit" class="dropdown-item" href="#">Sair</button></li>
                                </form>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="wrapper">
                <div class="content-wrapper">
                    @yield('conteudo')
                </div>
            </div>
        </div>
    </body>
</html>
