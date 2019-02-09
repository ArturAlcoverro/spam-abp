<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Iniciar sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/login.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/libraries/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <script src="{{ asset('js/libraries/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/libraries/popper.min.js') }}"></script>
    <script src="{{ asset('js/libraries/bootstrap.min.js') }}"></script>
</head>
<body>
    <div class="loginBox">
        <h4>Inicia sesión</h4>
        <form>
                <div class="form-group">
                    <label id="EmailLabel" for="Email">Correo electronico</label>
                    <input type="email" class="fill" id="Email">
                </div>
                <div class="form-group">
                    <label id="PasswordLabel" for="Password">Contraseña</label>
                    <input type="password" class="fill" id="Password" >
                </div>
                <div class="form-group d-flex" style="justify-content:flex-end">
                    <button type="submit" class="btn-primary button">Entrar</button>
                </div>
              </form>
    </div>
</body>

<script>
    $(".fill").on('focus',function(){
        $("#" + $(this).attr("id") + "Label").css("color","var(--primary-color-dark)");
    });
    $(".fill").on('blur',function(){
        $("#" + $(this).attr("id") + "Label").css("color","#8b8b8b");
    });
</script>
</html>

