<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="full_absolute" style="background-color: transparent;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #395761;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                        </li> -->
                        @endif

                        @if (Route::has('register'))
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li> -->
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} 
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
        <main class="py-4 h-100 bg-gra-main">
            <div class="container h-100">
                <div class="row h-100">
                    @auth
                    <div class="col-2">
                        <div class="card bg-main">
                        <div class="card-body px-0">
                                <h5 class="card-title text-center text-white">Menu</h5>
                            <nav class="nav flex-column align-content-center mt-3">
                                <a class="nav-link btn btn-outline-light text-white mb-3" style="width: 80%;" href="/clientes">Clientes</a>
                                <a class="nav-link btn btn-outline-light text-white mb-3" style="width: 80%;" href="/peliculas">Peliculas</a>
                                @role('admin')
                                    <a class="nav-link btn btn-outline-light text-white mb-3" style="width: 80%;" href="/usuarios">Usuarios</a>
                                @else
                                    <a class="nav-link btn btn-outline-light text-white mb-3" style="width: 80%;" href="/alquiler">Alquiler</a>
                                @endrole
                            </nav>
                        </div>
                        </div>

                    </div>
                    <div class="col-10">
                        @else
                        <div class="col">
                            @endauth
                            @yield('content')
                        </div>
                    </div>
                </div>
        </main>

        <button id="launchNotication" type="button" class="btn btn-primary" style="display: none;" data-bs-toggle="modal" data-bs-target="#notifications">
            Launch demo modal
        </button>
        <!-- Modal -->
        <div class="modal fade" id="notifications" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog text-white">
                <div class="modal-content bg-main">
                    <div class="modal-header">
                        <h5 id="modal-title" class="modal-title" id="exampleModalLabel">Notificación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="modal-body" class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button id="modal-close" data-bs-dismiss="modal" type="button" class="btn btn-outline-light">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>