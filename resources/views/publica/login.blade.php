<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Iniciar sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/login.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/libraries/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">
    <script src="{{ asset('js/libraries/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/libraries/popper.min.js') }}"></script>
    <script src="{{ asset('js/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/eventsLogin.js') }}"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>
    <div class="loginBox">
        <h2>Iniciar sesión</h2>
        <form action="{{ action('Auth\LoginController@login') }}" method="POST">
            @csrf
            <div class="form-group">
                <p id="EmailLabel">Correo electrónico</p>
                @if(Session::has('error'))
                    <input type="text" class="fill invalid" id="Email" name="Email" value="{{ old('Email') }}">
                    <div class="feedback ml-2">*Correo incorrecto</div>
                @else
                    <input type="text" class="fill" id="Email" name="Email">
                @endif
            </div>

                @if(Session::has('error'))
                <div class="form-group m-0">
                    <p id="PasswordLabel">Contraseña</p>
                    <input type="password" class="fill invalid" id="Password" name="Password" value="{{ old('Password') }}">
                    <div id="hideShow">visibility_off</div>
                </div>
                <div class="feedback ml-2">*Password incorrecto</div>

                @else
                <div class="form-group">
                    <p id="PasswordLabel">Contraseña</p>
                    <input type="password" class="fill" id="Password" name="Password">
                    <div id="hideShow">visibility_off</div>
                </div>

                @endif
            <div class="form-group d-flex" style="justify-content:flex-end">
                <button type="submit" class="btn-primary button">Entrar</button>
            </div>
        </form>
    </div>
</body>

</html>

