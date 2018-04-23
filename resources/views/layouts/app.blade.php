<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/2Weekscss.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

@yield('css')
    <!-- Jquery -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}" ></script>
</head>
<body>

    {{--<nav id="nav">
        <div id="nav-account">
            @guest
            @else
                <div id="nav-account-icon" style="background: #070025  url('{{ asset(Auth::user()->load('accounts_image')->accounts_image->avatar_url) }}')no-repeat 50% 50% / cover;"></div>
            @endguest
            <div id="nav-account-name">
                @guest
                    <a href="{{ route('login') }}">Connexion <br/> Inscription</a>
                @else
                    <a href="{{ route('user-page',['usr_login' => Auth::user()->login]) }}">{{ Auth::user()->first_name }} <br/> {{Auth::user()->last_name}}</a>
                @endguest
            </div>
        </div>
        <button class=" sm-OrkneyLight hidden-lg hidden-md hidden-sm " type="button" data-toggle="collapse" data-target="#collapsemenu" aria-expanded="false" aria-controls="collapsemenu">
            Menu
        </button>
        <div class="collapse nav-items-links " id="collapsemenu">
            @guest
            @else
                <a id="nav-exit" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endguest
            <a href="{{ url('/simulation') }}">Simulation</a>
            <a href="{{ url('/selectTeam') }}">Equipes</a>
            <a href="#">Championnats</a>
            <a href="#">Home</a>
            <a id="nav-Logo" href="{{ url('/') }}" class="hidden-md hidden-sm hidden-xs ">STATS&CO<span>&#169;</span></a>
        </div>
    </nav>--}}
    <nav id="nav" class="navbar navbar-expand-lg navbar-light bg-light">
        <div id="nav-account">
            @guest
            @else
                <div id="nav-account-icon" style="background: #070025  url('{{ asset(Auth::user()->load('accounts_image')->accounts_image->avatar_url) }}')no-repeat 50% 50% / cover;"></div>
            @endguest
            <div id="nav-account-name">
                @guest
                    <a href="{{ route('login') }}">Connexion <br/> Inscription</a>
                @else
                    <a href="{{ route('user-page',['usr_login' => Auth::user()->login]) }}">{{ Auth::user()->first_name }} <br/> {{Auth::user()->last_name}}</a>
                @endguest
            </div>
        </div>
        <button id="sandwich" class="navbar-toggler hidden-lg hidden-md hidden-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse nav-items-links eclipsia" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/simulation') }}">Simulation <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/selectTeam') }}">Equipes</a>
                </li>
                <li class="nav-items-links">
                @guest
                @else
                    <a id="nav-exit" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endguest
                </li>
            </ul>

        </div>
    </nav>
    {{--content--}}
    <div id="container">
        @yield('container')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
