<!DOCTYPE html>

<html lang="{{app()->getLocale()}}">

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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark p-0">
        <a class="navbar-brand logo" href="{{url('/')}}"><img class="" src="{{ asset('media/img/artio.svg') }}" alt="Ir al indice" style="width: 60px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link px-2" href="{{url('/charts')}}">@lang('home.graphics')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2" href="{{url('/video')}}">@lang('home.video')</a>
                </li>
            </ul>
            <div class="dropdown">
                <button class="dropdown-toggle dropdown-lenguage" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">
                        language
                    </i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="locale/cat">Català</a>
                    <a class="dropdown-item" href="locale/es">Castellano</a>
                    <a class="dropdown-item" href="locale/en">English</a>
                </div>
            </div>
        </div>
    </nav>

    @yield('body')

    <section id="footer">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-3 col-md-3">
					<h5>@lang('home.protectora')</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="https://www.protectoramataro.org/es/quienes-somos-que-hacemos"><i class="fa fa-angle-double-right"></i>@lang('home.whoWeAre')</a></li>
						<li><a href="https://www.protectoramataro.org/es/datos-cifras-vidas"><i class="fa fa-angle-double-right"></i>@lang('home.data')</a></li>
						<li><a href="https://www.protectoramataro.org/es/gestion-centros-acogida"><i class="fa fa-angle-double-right"></i>@lang('home.centers')</a></li>
						<li><a href="https://www.protectoramataro.org/es/veterinarios"><i class="fa fa-angle-double-right"></i>@lang('home.veter')</a></li>
                        <li><a href="https://www.protectoramataro.org/es/fundacion-daina"><i class="fa fa-angle-double-right"></i>@lang('home.daina')</a></li>
                        <li><a href="https://www.protectoramataro.org/es/donde-estamos-cuando-podeis-venir"><i class="fa fa-angle-double-right"></i>@lang('home.whereAreWe')</a></li>
                        <li><a href="https://www.protectoramataro.org/es/formulario/contacto"><i class="fa fa-angle-double-right"></i>@lang('home.contact')</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3">
					<h5>@lang('home.animals')</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="https://www.protectoramataro.org/es/cercador-animals"><i class="fa fa-angle-double-right"></i>@lang('home.meetAnimals')</a></li>
						<li><a href="https://www.protectoramataro.org/es/animales-invisibles"><i class="fa fa-angle-double-right"></i>@lang('home.images')</a></li>
						<li><a href="https://www.protectoramataro.org/es/carrousel/vincles"><i class="fa fa-angle-double-right"></i>@lang('home.vincles')</a></li>
						<li><a href="https://www.protectoramataro.org/es/finals-felicos"><i class="fa fa-angle-double-right"></i>@lang('home.niceEnd')</a></li>
                        <li><a href="https://www.protectoramataro.org/es/galeria"><i class="fa fa-angle-double-right"></i>@lang('home.images')</a></li>
                        <li><a href="https://www.protectoramataro.org/es/histories"><i class="fa fa-angle-double-right"></i>@lang('home.historys')</a></li>
                        <li><a href="https://www.protectoramataro.org/es/adopta-gpp"><i class="fa fa-angle-double-right"></i>@lang('home.ppp')</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3">
					<h5>@lang('home.comunication')</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="https://www.protectoramataro.org/es/informacion-para-socios"><i class="fa fa-angle-double-right"></i>@lang('home.infosoc')</a></li>
						<li><a href="https://www.protectoramataro.org/es/notes-premsa"><i class="fa fa-angle-double-right"></i>@lang('home.prensaNotes')</a></li>
						<li><a href="https://www.protectoramataro.org/es/radio"><i class="fa fa-angle-double-right"></i>@lang('home.radio')</a></li>
						<li><a href="https://www.protectoramataro.org/es/boletin"><i class="fa fa-angle-double-right"></i>@lang('home.boletin')</a></li>
						<li><a href="https://www.protectoramataro.org/es/canal-youtube" title="Design and developed by"><i class="fa fa-angle-double-right"></i>@lang('home.redVideos')</a></li>
					</ul>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
					<h5>@lang('home.others')</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="{{route('showLogin')}}"><i class="fa fa-angle-double-right"></i>@lang('home.workersSite')</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
					<ul class="list-unstyled list-inline social text-center">
                        <li class="list-inline-item"><a href="https://www.facebook.com/artio.abp.1
                            {{-- https://www.facebook.com/protectoramataro/ --}}
                            "><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="https://twitter.com/ARTIOABP
                            {{-- https://twitter.com/protemataro --}}
                            "><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="
                            {{-- https://www.instagram.com/protectoramataro/ --}}
                            https://www.instagram.com/artio_abp/
                            "><i class="fa fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="mailto:artioABP@gmail.com?" target="_blank"><i class="fa fa-envelope"></i></a></li>
					</ul>
				</div>
				</hr>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
					<p>@lang('home.license')
                        @lang('home.license2')<u><a href="https://creativecommons.org/licenses/by-nc-nd/4.0/">@lang('home.license3')</a></u></p>
					<p class="h6"><a class="text-green ml-2" href="https://www.protectoramataro.org/es/politica-privacidad" target="_blank">@lang('home.license4')</a></p>
				</div>
				</hr>
			</div>
		</div>
	</section>

    <script src="{{ asset('js/libraries/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/libraries/popper.min.js') }}"></script>
    <script src="{{ asset('js/libraries/bootstrap.min.js') }}"></script>

    @yield('scripts')
</body>
</html>
