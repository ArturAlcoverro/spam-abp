<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('css/libraries/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu-mobil.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>    <script src="{{ asset('js/libraries/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/libraries/popper.min.js') }}"></script>
    <script src="{{ asset('js/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/eventsMasterPrivat.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    @yield('css')
</head>

<body class="d-none">
    <div class="menu-btn">
        <div class="menu-btn-animation"></div>
        <div class="menu-btn-animation"></div>
        <div class="menu-btn-animation"></div>
    </div>
    <nav id="menuSuperior">
        <img height="70%" src="{{ asset('media/img/logo_spam_full.png') }}" alt="">

        <div class="dropdown mr-2">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">
                    language
                </i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="locale/cat">Català</a>
              <a class="dropdown-item" href="locale/es">Castellano</a>

            </div>
          </div>



    </nav>
    <div id="logo">
        <img height="70%" src="{{ asset('media/img/artio.png') }}" alt="">
    </div>
    <div class="menu">
        <div class="menu-list">
            <ul>
                <li>
                    <a href="{{ route('donations') }}">
                        <p>@lang('master.donacions_nav')</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('donants') }}">
                        <p>@lang('master.donants_nav')</p>
                    </a>
                </li>
                <li>
                    <a href="{{ action('UsuarioController@index') }}">
                        <p>@lang('master.usuaris_nav')</p>
                    </a>
                </li>
                <li class="mt-5">
                    <a href="{{ url('/logout') }}">
                        @lang('master.sortir_nav')
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
                <a href="{{ route('donations') }}">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/donacio.png') }}" alt="">
                    @lang('master.donacions_nav')
                </a>
            </li>
            <li id="donantsTab">
                <a href="{{ route('donants') }}">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/donant.png') }}" alt="">
                    @lang('master.donants_nav')
                </a>
            </li>
            <li id="usuarisTab">
                <a href="{{ action('UsuarioController@index') }}">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/usuari.png') }}" alt="">
                    @lang('master.usuaris_nav')
                </a>
            </li>
            <li>
                <a href="{{ url('/logout') }}">
                    <img class="mb-1" width="40px" src="{{ asset('media/img/exit.png') }}" alt="">
                    @lang('master.sortir_nav')
                </a>
            </li>

        </ul>
    </nav>

    <div class="body">
        @yield('body')
    </div>

</body>

</html>
