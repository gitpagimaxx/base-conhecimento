<?php
setlocale(LC_MONETARY, 'pt_BR');

?>

<!doctype html>
<html lang="pt-br" translate="no">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{ url(ENV('APP_URL')) }}/">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titulo')</title>

    <!-- Scripts -->
    <script src="{{ url(ENV('APP_URL')) }}/js/app.js" defer></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://kit.fontawesome.com/60279106a5.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ url(ENV('APP_URL')) }}/css/app.css" rel="stylesheet">
    <link href="{{ url(ENV('APP_URL')) }}/css/custom.css" rel="stylesheet">

    <link rel="icon" href="{{ url(ENV('APP_URL')) }}/images/picone.png" />
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/dashboard') }}">
                    <img src="{{ url(ENV('APP_URL')) }}/images/logotipo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav mr-auto">
                        <!-- <li><a href="/company" class="btn">Empresa</a></li> -->
                        <li><a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento" class="btn">Meu Conhecimento</a></li>
                        <li><a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias" class="btn">Memórias</a></li>
                        <li><a href="{{ url(ENV('APP_URL')) }}/dashboard/midias" class="btn">O que eu vi</a></li>
                        <li><a href="{{ url(ENV('APP_URL')) }}/dashboard/tag" class="btn">Tags</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/profile/{{ Str::slug(Auth::user()->name) }}/{{ Auth::user()->id }}" class="dropdown-item">
                                        {{ __('Perfil') }}
                                    </a>
                                    <a href="{{ url(ENV('APP_URL')) }}/quota" class="dropdown-item">
                                        {{ __('Cota de Uso') }}
                                    </a>
                                    <a href="{{ url(ENV('APP_URL')) }}/about" class="dropdown-item">
                                        {{ __('Sobre') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- <div id="timer"></div> -->

        <main class="py-4 mb-4">
            @yield('content')
        </main>

        <footer class="container mt-4 mb-4">
            <div class="row text-white">
                <div class="col text-left" style="letter-spacing: 3px;"><b>BASE DE CONHECIMENTO</b></div>
                <div class="col text-right">Feito pela <a href="https://pagimaxx.com" class="text-white" target="_blank">PAGIMAXX</a> -  Versão {{ ENV('APP_VERSION') }}.{{ date('Y') }}</div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

    <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    </script>

</body>
</html>
