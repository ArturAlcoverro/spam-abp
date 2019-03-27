@extends('privada.templates.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/donantes.css') }}">
@endsection

@section('body')

    @include('partial.errores')

    <div class="p-4">
        <form action="{{ action('DonanteController@store') }}" method="POST">
            @csrf
            <div class="form-group row">
                <label for="lbltipos_donante" class="col-2 col-form-label">Tipo de donante</label>
                <div class="col-10">
                    <select name="tipos_donante" id="tipos_donante" class="form-control">
                        @foreach ($tipos_donante as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="nombre" class="col-2 col-form-label">Nombre</label>
                <div class="col-10">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                </div>
            </div>
            <div class="form-group row" id="row-cif">
                <label for="lblcif" class="col-2 col-form-label">CIF/DNI</label>
                <div class="col-10">
                    <input type="text" name="cif" id="cif" class="form-control" placeholder="CIF/DNI">
                </div>
            </div>
            <div class="form-group row" id="row-vinculo">
                <label for="lblvinculo" class="col-2 col-form-label">Vinculo de entidad</label>
                <div class="col-10">
                    <input type="text" name="vinculo" id="vinculo" class="form-control" placeholder="Vinculo de entidad">
                </div>
            </div>
            <div class="form-group row" id="row-sexo">
                <label for="sexos" class="col-2 col-form-label">Sexo</label>
                <div class="col-10">
                    <select name="sexos" id="sexos" class="form-control">
                        @foreach ($sexos as $sexo)
                            <option value="{{ $sexo->id }}">{{ $sexo->sexo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="correo" class="col-2 col-form-label">Correo electronico</label>
                <div class="col-10">
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo electronico">
                </div>
            </div>
            <div class="form-group row">
                <label for="telefono" class="col-2 col-form-label">Telefono</label>
                <div class="col-10">
                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono">
                </div>
            </div>
            <div class="form-group row">
                <label for="direccion" class="col-2 col-form-label">Direccion</label>
                <div class="col-10">
                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Direccion">
                </div>
            </div>
            <div class="form-group row">
                <label for="pais" class="col-2 col-form-label">Pais</label>
                <div class="col-10">
                    <input list="paises" name="pais" class="form-control" placeholder="Pais">
                    <datalist id="paises">
                        @foreach ($paises as $pais)
                            <option value="{{ $pais }}">{{ $pais }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="form-group row">
                <label for="poblacion" class="col-2 col-form-label">Poblacion</label>
                <div class="col-10">
                    <input list="poblaciones" name="poblacion" class="form-control" placeholder="Poblacion">
                    <datalist id="poblaciones">
                        @foreach ($poblaciones as $poblacion)
                            <option value="{{ $poblacion }}">{{ $poblacion }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="form-group row">
                <label for="colaboraciones" class="col-2 col-form-label">Colaboracion</label>
                <div class="col-10">
                    <input list="colaboraciones" name="colaboracion" class="form-control" placeholder="Colaboracion">
                    <datalist id="colaboraciones">
                        @foreach ($colaboraciones as $colaboracion)
                            <option value="{{ $colaboracion }}">{{ $colaboracion }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="form-group row">
                <label for="animales" class="col-2 col-form-label">Animal</label>
                <div class="col-10">
                    <select name="animales[]" id="animales" size="5" multiple="multiple" class="custom-select">
                        @foreach($animales as $animal)
                            <option value="{{ $animal->id }}">{{ $animal->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3"></div>
                <div class="col-3">
                    <input type="checkbox" name="habitual" id="habitual" class="form-check-input">Es habitual</input>
                </div>
                <div class="col-3">
                    <input type="checkbox" name="spam" id="spam" class="form-check-input">Quiero recibir correos</input>
                </div>
            </div>
            <div class="form-group float-right">
                <button type="submit" name="altaAceptar" class="btn btn-primary boton-amplada">Aceptar</button>
            </div>
        </form>
    </div>

@endsection

@section('js')

    <script src="{{ asset('js/eventsDonants.js') }}"></script>

@endsection
