<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('name')</title>
    <link rel="shortcut icon" type="image/png" href=""/>
    <link rel="stylesheet" href="{{ asset('css/libraries/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="{{url('/')}}"><img class="" src="{{ asset('media/img/logo_spam.png') }}" alt="" style="width: 128px"></a>
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

    <section id="footer">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-3 col-md-3">
					<h5>La Protectora</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="https://www.protectoramataro.org/es/quienes-somos-que-hacemos"><i class="fa fa-angle-double-right"></i>Quiénes somos</a></li>
						<li><a href="https://www.protectoramataro.org/es/datos-cifras-vidas"><i class="fa fa-angle-double-right"></i>Datos, Cifras, Vidas</a></li>
						<li><a href="https://www.protectoramataro.org/es/gestion-centros-acogida"><i class="fa fa-angle-double-right"></i>Centros de Acogida</a></li>
						<li><a href="https://www.protectoramataro.org/es/veterinarios"><i class="fa fa-angle-double-right"></i>Los Veterinarios</a></li>
                        <li><a href="https://www.protectoramataro.org/es/fundacion-daina"><i class="fa fa-angle-double-right"></i>Fundación DAINA</a></li>
                        <li><a href="https://www.protectoramataro.org/es/donde-estamos-cuando-podeis-venir"><i class="fa fa-angle-double-right"></i>Donde estamos</a></li>
                        <li><a href="https://www.protectoramataro.org/es/formulario/contacto"><i class="fa fa-angle-double-right"></i>Contacto</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3">
					<h5>Los Animales</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="https://www.protectoramataro.org/es/cercador-animals"><i class="fa fa-angle-double-right"></i>Conoce a nuestros animales</a></li>
						<li><a href="https://www.protectoramataro.org/es/animales-invisibles"><i class="fa fa-angle-double-right"></i>Los invisibles</a></li>
						<li><a href="https://www.protectoramataro.org/es/carrousel/vincles"><i class="fa fa-angle-double-right"></i>Animales Vincles</a></li>
						<li><a href="https://www.protectoramataro.org/es/finals-felicos"><i class="fa fa-angle-double-right"></i>Finales Felices</a></li>
                        <li><a href="https://www.protectoramataro.org/es/galeria"><i class="fa fa-angle-double-right"></i>Imágenes</a></li>
                        <li><a href="https://www.protectoramataro.org/es/histories"><i class="fa fa-angle-double-right"></i>Historias</a></li>
                        <li><a href="https://www.protectoramataro.org/es/adopta-gpp"><i class="fa fa-angle-double-right"></i>Los PPP'S</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3">
					<h5>Comunicación</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="https://www.protectoramataro.org/es/informacion-para-socios"><i class="fa fa-angle-double-right"></i>Información Socios</a></li>
						<li><a href="https://www.protectoramataro.org/es/notes-premsa"><i class="fa fa-angle-double-right"></i>Notas de prensa</a></li>
						<li><a href="https://www.protectoramataro.org/es/radio"><i class="fa fa-angle-double-right"></i>Radio</a></li>
						<li><a href="https://www.protectoramataro.org/es/boletin"><i class="fa fa-angle-double-right"></i>Boletín</a></li>
						<li><a href="https://www.protectoramataro.org/es/canal-youtube" title="Design and developed by"><i class="fa fa-angle-double-right"></i>Videos en la Red</a></li>
					</ul>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
					<h5>Otros</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="{{route('showLogin')}}"><i class="fa fa-angle-double-right"></i>Espacio Trabajadores</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
					<ul class="list-unstyled list-inline social text-center">
						<li class="list-inline-item"><a href="https://www.facebook.com/protectoramataro/"><i class="fa fa-facebook"></i></a></li>
						<li class="list-inline-item"><a href="https://twitter.com/protemataro"><i class="fa fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="https://www.instagram.com/protectoramataro/"><i class="fa fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href=" mailto:info@protectoramataro.org?" target="_blank"><i class="fa fa-envelope"></i></a></li>
					</ul>
				</div>
				</hr>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
					<p>Fotografías de Antuà Blonde Photography para Sociedad Protectora de Animales de Mataró.
                        Las imágenes se distribuyen bajo una <u><a href="https://creativecommons.org/licenses/by-nc-nd/4.0/">Licencia Creative Commons.</a></u></p>
					<p class="h6"><a class="text-green ml-2" href="https://www.protectoramataro.org/es/politica-privacidad" target="_blank">Aviso Legal - Política de Privacidad</a></p>
				</div>
				</hr>
			</div>
		</div>
	</section>

    <script src="{{ asset('js/libraries/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/libraries/popper.min.js') }}"></script>
    <script src="{{ asset('js/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/changingNavBg.js') }}"></script>

    @yield('scripts')
</body>
</html>
