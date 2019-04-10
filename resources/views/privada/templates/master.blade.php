<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('name')</title>
    <link rel="stylesheet" href="{{ asset('css/libraries/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu-mobil.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>
    <script src="{{ asset('js/libraries/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/libraries/popper.min.js') }}"></script>
    <script src="{{ asset('js/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/eventsMasterPrivat.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    @yield('css')
</head>

<body class="">
    <div class="toast">
        <p>ERROR</p>
    </div>
    <div class="menu-btn">
        <div class="menu-btn-animation"></div>
        <div class="menu-btn-animation"></div>
        <div class="menu-btn-animation"></div>
    </div>
    <nav id="menuSuperior">
        <a href="{{ url('/') }}">
            <img id="logoSpam" height="100%" src="{{ asset('media/img/logo_spam_full.png') }}" alt="">
        </a>
        <div class="dropdown mr-2">
            <button class= "dropdown-toggle dropdown-lenguage" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">
                    language
                </i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="locale/cat">Català</a>
              <a class="dropdown-item" href="locale/es">Castellano</a>

            </div>
            <a href="{{ url('/logout') }}" class="btn-exit mr-4">
                <img src="{{ asset('media/img/exit.png') }}" alt="">
            </a>
        </div>
    </nav>

    <div id="logo">
        <a style="height: 70%" href="{{ url('/donations') }}">
            <img height="100%" src="{{ asset('media/img/artio.svg') }}" alt="">
        </a>
    </div>

    <div class="menu">
        <div class="menu-list">
            <ul>
                <li>
                    <a href="{{ action('DonativoController@index') }}">
                        <img  width="40px" src="{{ asset('media/img/donacio.png') }}" alt="">
                        <p>@lang('master.donacions_nav')</p>
                    </a>
                </li>
                <li>
                    <a href="{{ action('DonanteController@index') }}">
                        <img  width="40px" src="{{ asset('media/img/donant.png') }}" alt="">
                        <p>@lang('master.donants_nav')</p>
                    </a>
                </li>
                <li>
                    <a href="{{ action('UsuarioController@index') }}">
                        <img  width="40px" src="{{ asset('media/img/usuari.png') }}" alt="">
                        <p>@lang('master.usuaris_nav')</p>
                    </a>
                </li>
                <li class="">
                    <a href="{{ action('CentroController@index') }}">
                        <img class="" width="40px" src="{{ asset('media/img/house.png') }}" alt="">
                        @lang('master.centres_nav')
                    </a>
                </li>
                <li class="">
                    <a href="{{ url('/donations') }}">
                        <img class="" width="40px" src="{{ asset('media/img/charts.png') }}" alt="">
                        @lang('master.charts_nav')
                    </a>
                </li>
            </ul>
        </div>
        <div class="menu-close-space">

        </div>
    </div>
    <nav id="menuLateral">
        <ul id="opcionsMenuLateral">
            <li id="donacionsTab">
                <a href="{{ action('DonativoController@index') }}">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/donacio.png') }}" alt="">
                    @lang('master.donacions_nav')
                </a>
            </li>
            <li id="donantsTab">
                <a href="{{ url('/donants') }}">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/donant.png') }}" alt="">
                    @lang('master.donants_nav')
                </a>
            </li>
            <li id="usuarisTab">
                <a href="{{ url('/users') }}">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/usuari.png') }}" alt="">
                    @lang('master.usuaris_nav')
                </a>
            </li>
            <li id="centrosTab">
                <a href="{{ url('/centros') }}">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/house.png') }}" alt="">
                    @lang('master.centres_nav')
                </a>
            </li>
            <li>
                <a href="{{ url('/donations') }}">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/charts.png') }}" alt="">
                    @lang('master.charts_nav')
                </a>
            </li>

        </ul>
    </nav>
    <div id="body" class="d-none">
        <div class="body">
            @yield('body')
            @yield('js')
        </div>
    </div>
</body>

</html>
