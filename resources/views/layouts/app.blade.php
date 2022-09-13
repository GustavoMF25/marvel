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
        <!--FontAwesome-->
        <link href="{{asset('assets/fontawesome/css/all.min.css')}}" rel="stylesheet" />
        <!-- Estilo padrão criado para o welcome -->
        <link href="{{asset('css/default.css')}}" rel="stylesheet" />
        <!--Normalize para tirar o estilo padrão do navegador-->
        <link href="{{asset('css/normalize.min.css')}}" rel="stylesheet" />
        <!--Adicionando icone-->
        <link rel="shortcut icon" href="{{ asset('imagens/icon.png') }}">
        <!--Select2-->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <script type="text/javascript">
            var loader;

            // Função para manter o load até o carregamento completo da página
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
        <!--JQUERY-->
        <script src="{{ asset('assets/jquery/jquery.min.js') }}" defer></script>
        <script src="{{ asset('assets/popper/popper.min.js') }}" defer></script>
        <!--FontAwesome-->
        <script src="{{ asset('assets/fontawesome/js/all.min.js') }}" defer></script>
        <!--Select 2 Via Web-->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    </head>
    <body>
        <div id="preloader"></div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('dashboard')}}">
                    <img src="{{asset('imagens/icon.png')}}" alt="" width="30" height="24" class="d-inline-block align-text-top">                    
                    Marvel 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}"><i class="fas fa-home"></i> Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('favoritos')}}"><i style="color: #E8D108" class="fas fa-star"></i> Favoritos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('comicsSemana')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" viewBox="0 0 500 200"><path fill="#f0141e" d="M0 0h500v200H0z"/><path d="M423.12 46.619V15.991h-85.706l-14.11 102.282-13.94-102.282h-30.908l3.454 27.312c-3.563-7-16.211-27.312-44.061-27.312-.185-.012-30.945 0-30.945 0l-.128 149.084-22.523-149.084-40.484-.012-23.304 154.467.013-154.455H81.726l-13.965 86.768-13.604-86.768H15.399v167.932h30.523v-80.944l13.886 80.944h16.224l13.69-80.944v80.944h58.838l3.558-25.83h23.688l3.558 25.83 57.771.037h.042v-.037H237.249v-54.504l7.074-1.024 14.661 55.565h29.883l-.012-.037H288.94l-19.238-65.11c9.741-7.179 20.752-25.379 17.822-42.798v-.006c.036.226 18.164 108.026 18.164 108.026l35.534-.11 24.279-152.203v152.203h57.617v-30.199h-27.344v-38.507h27.344v-30.66h-27.344v-37.94h27.346zM155.713 131.47l8.387-71.802 8.69 71.802h-17.077zm88.708-33.155c-2.344 1.123-4.784 1.685-7.172 1.691v-54.01c.037 0 .093-.006.153-.006 2.38-.018 20.203.714 20.203 26.709 0 13.598-6.06 22.174-13.184 25.616zm240.186 55.383v30.188h-56.214V15.967h30.272v137.731h25.942z" fill="#fff"/></svg>
                                Comics da semana</a>
                        </li>


                    </ul>
                    <ul class="navbar-nav d-flex mr-3 mb-2 mb-lg-0">
                        <li class="nav-item async">
                            <a class="nav-link" href="#" id="async" alt="Sincronizar" ><i class="fas fa-sync-alt "></i> Sincronizar semana 
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
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
                <div class="d-flex justify-content-end mt-2">
                    <div class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body mensagemRetorno">

                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    @yield('conteudo')
                </div>
            </div>
        </div>


        @yield('script')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                $('.async').click(function () {
                    $.ajax({
                        method: "get",
                        url: "{{route('ApiMarvelSemanal')}}",
                        success: function (dados) {
                            let text = "Comics salvas: " + dados.salvos + "<br> Comics repetidas: " + dados.repetidos;
                            $('.mensagemRetorno').html(text)
                            if (dados.repetidos > 0) {
                                $('.toast').addClass('bg-warning')
                            } else {
                                $('.toast').addClass('bg-primary')
                            }
                            $('.toast').addClass('show')
                            setTimeout(() => {
                                $('.toast').removeClass('show')
                            }, 20000)
                        },
                        error: function (error) {

                        }
                    })
                })
            })
        </script>
    </body>
</html>
