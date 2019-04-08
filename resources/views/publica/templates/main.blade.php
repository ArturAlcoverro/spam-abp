<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('name')</title>
    <link rel="shortcut icon" type="image/png" href=""/>
    <link rel="stylesheet" href="{{ asset('css/libraries/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{url('/')}}">LOGO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/charts')}}">Estadísticas</a>
                </li>
            </ul>
        </div>
    </nav>

    @yield('body')

    <footer class="footer bg-dark py-5">
        <div class="container-fluid">
            <div class="">
                <a href="https://www.facebook.com/protectoramataro/" class="rrss_icon" style="">
                    <img class="rrss_icon" src="{{ asset('media/publica/icons/facebook.png') }}" alt="">
                </a>
                <a href="https://twitter.com/protemataro" class="rrss_icon" style="margin-left: 1rem;">
                    <img class="rrss_icon" src="{{ asset('media/publica/icons/twitter.png') }}" alt="">
                </a>
                <a href="https://www.instagram.com/protectoramataro/" class="rrss_icon" style="margin-left: 1rem;">
                    <img class="rrss_icon" src="{{ asset('media/publica/icons/instagram.png') }}" alt="">
                </a>
                <a href="https://www.protectoramataro.org" class="rrss_icon" style="margin-left: 1rem;">
                    <img class="rrss_icon" src="{{ asset('media/publica/icons/grid-world.png') }}" alt="">
                </a>
                <a href="{{route('showLogin')}}" class="text-white float-right mr-2">Espacio Trabajadores</a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/libraries/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/libraries/popper.min.js') }}"></script>
    <script src="{{ asset('js/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/changingNavBg.js') }}"></script>

    @yield('scripts')
</body>
</html>
