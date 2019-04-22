@extends('privada.templates.master')

@section('name')
    @lang('createDonante.new')
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/donantes.css') }}">
@endsection

@section('body')

    @include('partial.errores')

    <div class="p-4">
        <form class="container pt-2" action="{{ action('DonanteController@store') }}" method="POST" id="form-create">
        @csrf
            <h3>@lang('createDonante.new')</h3>
            <div class="form-group">
                <label for="lbltipos_donante" class=" col-form-label">@lang('createDonante.type')</label>
                <div class="">
                    <select name="tipos_donante" id="tipos_donante" class="form-control">
                        @foreach ($tipos_donante as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="nombre" class="col-form-label">@lang('createDonante.name')</label>
                <div class="">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="@lang('createDonante.name')">
                </div>
            </div>
            <div class="form-group" id="row-cif">
                <label for="lblcif" class="col-form-label">@lang('createDonante.cif')</label>
                <div class="">
                    <input type="text" name="cif" id="cif" class="form-control" placeholder="@lang('createDonante.cif')">
                </div>
            </div>
            <div class="form-group" id="row-vinculo">
                <label for="lblvinculo" class=" col-form-label">@lang('createDonante.vinculo')</label>
                <div class="">
                    <input type="text" name="vinculo" id="vinculo" class="form-control" placeholder="@lang('createDonante.vinculo')">
                </div>
            </div>
            <div class="form-group" id="row-sexo">
                <label for="sexos" class="col-form-label">@lang('createDonante.sex')</label>
                <div class="">
                    <select name="sexos" id="sexos" class="form-control">
                        @foreach ($sexos as $sexo)
                            <option value="{{ $sexo->id }}">{{ $sexo->sexo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="correo" class="col-form-label">@lang('createDonante.email')</label>
                <div class="">
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="@lang('createDonante.email')">
                </div>
            </div>
            <div class="form-group">
                <label for="telefono" class="col-form-label">@lang('createDonante.phone')</label>
                <div class="">
                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="@lang('createDonante.phone')">
                </div>
            </div>
            <div class="form-group">
                <label for="direccion" class="col-form-label">@lang('createDonante.address')</label>
                <div class="">
                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="@lang('createDonante.address')">
                </div>
            </div>
            <div class="form-group">
                <label for="pais" class=" col-form-label">@lang('createDonante.country')</label>
                <div class="">
                    <input list="paises" name="pais" class="form-control" placeholder="@lang('createDonante.country')">
                    <datalist id="paises">
                        @foreach ($paises as $pais)
                            <option value="{{ $pais }}">{{ $pais }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="form-group">
                <label for="poblacion" class=" col-form-label">@lang('createDonante.town')</label>
                <div class="">
                    <input list="poblaciones" name="poblacion" class="form-control" placeholder="@lang('createDonante.town')">
                    <datalist id="poblaciones">
                        @foreach ($poblaciones as $poblacion)
                            <option value="{{ $poblacion }}">{{ $poblacion }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="form-group">
                <label for="colaboraciones" class=" col-form-label">@lang('createDonante.collaboration')</label>
                <div class="">
                    <input list="colaboraciones" name="colaboracion" class="form-control" placeholder="@lang('createDonante.collaboration')">
                    <datalist id="colaboraciones">
                        @foreach ($colaboraciones as $colaboracion)
                            <option value="{{ $colaboracion }}">{{ $colaboracion }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="form-group">
                <label for="animales" class=" col-form-label">@lang('createDonante.animal')</label>
                <div class="">
                    <select name="animales[]" id="animales" size="5" multiple="multiple" class="custom-select">
                        @foreach($animales as $animal)
                            <option value="{{ $animal->id }}">{{ $animal->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-3"></div>
                <div class="col-3 custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="habitual" id="habitual">
                    <label class="custom-control-label" for="habitual">@lang('createDonante.habitual')</label>
                </div>
                <div class="col-3 custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="spam" id="spam">
                    <label class="custom-control-label" for="spam">@lang('createDonante.spam')</label>
                </div>
            </div>
            <div class="form-group float-right">
                <button type="button" name="altaAceptar" class="btn btn-primary boton-amplada mb-5" onclick="send()">@lang('createDonante.accept')</button>
            </div>
        </form>
    </div>

@endsection

@section('js')

    <script src="{{ asset('js/eventsEditDonant.js') }}"></script>

@endsection
