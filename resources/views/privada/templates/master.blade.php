<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('css/libraries/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu-mobil.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="{{ asset('js/libraries/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/libraries/popper.min.js') }}"></script>
    <script src="{{ asset('js/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/eventsMasterPrivada.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
</head>

<body>
    <div class="menu-btn">
        <div class="menu-btn-animation"></div>
        <div class="menu-btn-animation"></div>
        <div class="menu-btn-animation"></div>
    </div>
    <nav id="menuSuperior">
        <img height="70%" src="{{ asset('media/img/logo_spam_full.png') }}" alt="">
    </nav>
    <div id="logo">
        <img height="70%" src="{{ asset('media/img/artio.png') }}" alt="">
    </div>
    <div class="menu">
        <div class="menu-list">
            <ul>
                <li>
                    <a href="">
                        <p>Donacions</p>
                    </a>
                </li>
                <li>
                    <a href="">
                        <p>Donants</p>
                    </a>
                </li>
                <li>
                    <a href="">
                        <p>Usuaris</p>
                    </a>
                </li>
                <li class="mt-5">
                    <a href="">
                        <p>Sortir</p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="menu-close-space">

        </div>
    </div>
    <nav id="menuLateral">
        <ul id="opcionsMenuLateral">
            <li class="active">
                <a href="">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/donacio.png') }}" alt="">
                    Donacions
                </a>
            </li>
            <li><a href="">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/donant.png') }}" alt="">
                    Donants
                </a>
            </li>
            <li><a href="">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/usuari.png') }}" alt="">
                    Usuaris
                </a>
            </li>
            <li><a href="">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/exit.png') }}" alt="">
                    Sortir
                </a>
            </li>
        </ul>
    </nav>

    <div class="body">
        @yield('body')
    </div>


</body>

</html>
