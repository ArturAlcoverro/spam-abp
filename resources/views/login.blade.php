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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>
    <div class="loginBox">
        <h3>Inicia sesión</h3>
        <form>
                <div class="form-group">
                    <p id="EmailLabel">Correo electronico</p>
                    <input type="email" class="fill" id="Email">
                </div>
                <div class="form-group">
                    <p id="PasswordLabel">Contraseña</p>
                    <input type="password" class="fill" id="Password" >
                    <div id="hideShow">visibility_off</div>
                </div>
                <div class="form-group d-flex" style="justify-content:flex-end">
                    <button type="submit" class="btn-primary button">Entrar</button>
                </div>
              </form>
    </div>
</body>

<script>
    var hide = true;
    $(".fill").on('focus',function(){
        var $label = $("#" + $(this).attr("id") + "Label");
        $label.css({color: "var(--primary-color-dark)"});
        $label.animate({"top":"4px",
                        "font-size":"13px",
                        "z-index":"0"}, 120);
    });
    $(".fill").on('blur',function(){
        var $label = $("#" + $(this).attr("id") + "Label");
        if(!$("#Password").is(":focus")){
        if($(this).val() == ""){
            $label.animate({"top":"15px",
                            "font-size":"17px",
                            "z-index":"-1"},120);
        }
        $label.css({color: "#8a8a8a"});
        }
    });

    $("#hideShow").click(function(e){
        var $this = $(this);
        var $input = $("#Password");

        if(hide){
            hide=false;
            $this.text("visibility");
            $this.css("color", "var(--primary-color-dark)")
            $input.attr("type", "text");
        }else{
            hide=true;
            $this.text("visibility_off");
            $this.css("color", "#8a8a8a6e")
            $input.attr("type", "password");
        }

    });
        </script>
</html>

