<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('css/libraries/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">
    <script src="{{ asset('js/libraries/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/libraries/popper.min.js') }}"></script>
    <script src="{{ asset('js/libraries/bootstrap.min.js') }}"></script>    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
</head>

<body>
    <nav id="menuSuperior">
        <img height="70%" src="{{ asset('media/img/logo_spam_full.png') }}" alt="">
    </nav>
    <div id="logo">
        <img height="70%" src="{{ asset('media/img/artio.png') }}" alt="">
    </div>
    <nav id="menuLateral">
        <ul id="opcionsMenuLateral">
            <li>
                <img class="mb-1" width="40px" src="{{ asset('media/img/donacio.png') }}" alt="">Donacions</li>
            <li>
                <img class="mb-1" width="40px" src="{{ asset('media/img/donant.png') }}" alt="">Donants</li>
            <li>
                <img class="mb-1" width="40px" src="{{ asset('media/img/usuari.png') }}" alt="">Usuaris</li>
            <li>
                <img class="mb-1" width="40px" src="{{ asset('media/img/exit.png') }}" alt="">Sortir</li>
        </ul>
    </nav>
    @yield('body')
</body>

</html>
