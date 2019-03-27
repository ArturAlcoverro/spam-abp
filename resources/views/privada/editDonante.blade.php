@extends('privada.templates.master')

@section('css')

@endsection

@section('body')

    @include('partial.errores')

    <div class="p-4">
        <form action="{{ action('DonanteController@update', [$donante->id]) }}" method="POST">
            @method('put')
            @csrf
            <div class="form-group row">
                <label for="lbltipos_donante" class="col-2 col-form-label">Tipo de donante</label>
                <div class="col-10">
                    <select name="tipos_donante" id="tipos_donante" class="form-control">
                        @foreach ($tipos_donante as $tipo)
                            @if($tipo->id == $donante->tipo_donante->id)
                                <option value="{{ $tipo->id }}" selected>{{ $tipo->tipo }}</option>
                            @else
                                <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="nombre" class="col-2 col-form-label">Nombre</label>
                <div class="col-10">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="{{ $donante->nombre }}">
                </div>
            </div>
            <div class="form-group row" id="row-cif">
                <label for="lblcif" class="col-2 col-form-label">CIF/DNI</label>
                <div class="col-10">
                    <input type="text" name="cif" id="cif" class="form-control" placeholder="CIF/DNI" value="{{ $donante->cif }}">
                </div>
            </div>
            <div class="form-group row" id="row-vinculo">
                <label for="lblvinculo" class="col-2 col-form-label">Vinculo de entidad</label>
                <div class="col-10">
                    <input type="text" name="vinculo" id="vinculo" class="form-control" placeholder="Vinculo de entidad" value="{{ $donante->vinculo_entidad }}">
                </div>
            </div>
            <div class="form-group row" id="row-sexo">
                <label for="sexos" class="col-2 col-form-label">Sexo</label>
                <div class="col-10">
                    <select name="sexos" id="sexos" class="form-control">
                        @foreach ($sexos as $sexo)
                            @if($donante->sexo != null)
                                @if($sexo->id == $donante->sexo->id)
                                    <option value="{{ $sexo->id }}" selected>{{ $sexo->sexo }}</option>
                                @else
                                    <option value="{{ $sexo->id }}">{{ $sexo->sexo }}</option>
                                @endif
                            @else
                                <option value="{{ $sexo->id }}">{{ $sexo->sexo }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="correo" class="col-2 col-form-label">Correo electronico</label>
                <div class="col-10">
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo electronico" value="{{ $donante->correo }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="telefono" class="col-2 col-form-label">Telefono</label>
                <div class="col-10">
                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono" value="{{ $donante->telefono }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="direccion" class="col-2 col-form-label">Direccion</label>
                <div class="col-10">
                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Direccion" value="{{ $donante->direccion }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="pais" class="col-2 col-form-label">Pais</label>
                <div class="col-10">
                    <input list="paises" name="pais" class="form-control" placeholder="Pais" value="{{ $donante->pais }}">
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
                    <input list="poblaciones" name="poblacion" class="form-control" placeholder="Poblacion" value="{{ $donante->poblacion }}">
                    <datalist id="poblaciones">
                        @foreach ($poblaciones as $poblacion)
                            <option value="{{ $poblacion }}">{{ $poblacion }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3"></div>
                <div class="col-3">
                    <input type="checkbox" name="habitual" id="habitual" class="form-check-input">Es habitual</input>
                </div>
                <div class="col-3">
                    <input type="checkbox" name="colaborador" id="colaborador" class="form-check-input">Es colaborador</input>
                </div>
                <div class="col-3">
                    <input type="checkbox" name="animales" id="animales" class="form-check-input">Tiene animales</input>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3"></div>
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

    <script src="{{ asset('js/eventsEditDonant.js') }}"></script>

@endsection
