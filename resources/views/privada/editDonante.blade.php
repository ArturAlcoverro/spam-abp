@extends('privada.templates.master')

@section('name')
    Ediit donante
@endsection

@section('css')

@endsection

@section('body')

    @include('partial.errores')

    <div class="p-4">
        <form class="container pt-2" action="{{ action('DonanteController@update', [$donante->id]) }}" method="POST">
            @method('put')
            @csrf
            <h3>Editar donante</h3>
            <div class="form-group">
                <label for="lbltipos_donante" class="col-form-label">Tipo de donante</label>
                <div class="">
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
            <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre</label>
                <div class="">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="{{ $donante->nombre }}">
                </div>
            </div>
            <div class="form-group" id="row-cif">
                <label for="lblcif" class="col-form-label">CIF/DNI</label>
                <div class="">
                    <input type="text" name="cif" id="cif" class="form-control" placeholder="CIF/DNI" value="{{ $donante->cif }}">
                </div>
            </div>
            <div class="form-group" id="row-vinculo">
                <label for="lblvinculo" class="col-form-label">Vinculo de entidad</label>
                <div class="">
                    <input type="text" name="vinculo" id="vinculo" class="form-control" placeholder="Vinculo de entidad" value="{{ $donante->vinculo_entidad }}">
                </div>
            </div>
            <div class="form-group" id="row-sexo">
                <label for="sexos" class="col-form-label">Sexo</label>
                <div class="">
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
            <div class="form-group">
                <label for="correo" class="col-form-label">Correo electronico</label>
                <div class="">
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo electronico" value="{{ $donante->correo }}">
                </div>
            </div>
            <div class="form-group">
                <label for="telefono" class="col-form-label">Telefono</label>
                <div class="">
                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono" value="{{ $donante->telefono }}">
                </div>
            </div>
            <div class="form-group">
                <label for="direccion" class="col-form-label">Direccion</label>
                <div class="">
                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Direccion" value="{{ $donante->direccion }}">
                </div>
            </div>
            <div class="form-group ">
                <label for="pais" class="col-form-label">Pais</label>
                <div class="">
                    <input list="paises" name="pais" class="form-control" placeholder="Pais" value="{{ $donante->pais }}">
                    <datalist id="paises">
                        @foreach ($paises as $pais)
                            <option value="{{ $pais }}">{{ $pais }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="form-group">
                <label for="poblacion" class="col-form-label">Poblacion</label>
                <div class="">
                    <input list="poblaciones" name="poblacion" class="form-control" placeholder="Poblacion" value="{{ $donante->poblacion }}">
                    <datalist id="poblaciones">
                        @foreach ($poblaciones as $poblacion)
                            <option value="{{ $poblacion }}">{{ $poblacion }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="form-group">
                <label for="colaboraciones" class="col-form-label">Colaboracion</label>
                <div class="">
                <input list="colaboraciones" name="colaboracion" class="form-control" placeholder="Colaboracion" value="{{ $donante->tipo_colaboracion }}">
                    <datalist id="colaboraciones">
                        @foreach ($colaboraciones as $colaboracion)
                            <option value="{{ $colaboracion }}">{{ $colaboracion }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="form-group">
                <label for="animales" class="col-form-label">Animal</label>
                <div class="">
                    <select name="animales[]" id="animales" size="5" multiple="multiple" class="custom-select">
                        @foreach($animales as $animal)

                            @if(in_array($animal->id, $animales_donante))
                                <option value="{{ $animal->id }}" selected>{{ $animal->nombre }}</option>
                            @else
                                <option value="{{ $animal->id }}">{{ $animal->nombre }}</option>
                            @endif

                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-3"></div>
                <div class="col-3 custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="habitual" id="habitual" @if($donante->es_habitual == 1) checked @endif>
                    <label class="custom-control-label" for="habitual">Es habitual</label>
                </div>
                <div class="col-3 custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="spam" id="spam" @if($donante->spam == 1) checked @endif>
                    <label class="custom-control-label" for="spam">Quiero recibir correos</label>
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
