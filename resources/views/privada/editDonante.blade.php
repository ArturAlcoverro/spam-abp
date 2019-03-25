@extends('privada.templates.master')

@section('css')

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
                    <input type="text" name="cif" id="cif" class="form-control" placeholder="CIF" value="{{ $donante->cif }}">
                </div>
            </div>
            <div class="form-group row" id="row-sexo">
                <label for="sexos" class="col-2 col-form-label">Sexo</label>
                <div class="col-10">
                    <select name="sexos" id="sexos" class="form-control">
                        @foreach ($sexos as $sexo)
                            @if($sexo->id == $donante->sexo->id)
                                <option value="{{ $sexo->id }}" selected>{{ $sexo->tipo }}</option>
                            @else
                                <option value="{{ $sexo->id }}">{{ $sexo->tipo }}</option>
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
                <label for="poblacion" class="col-2 col-form-label">Poblacion</label>
                <div class="col-10">
                    <input type="text" name="poblacion" id="poblacion" class="form-control" placeholder="Poblacion" value="{{ $donante->poblacion }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="pais" class="col-2 col-form-label">Pais</label>
                <div class="col-10">
                    <input type="text" name="pais" id="pais" class="form-control" placeholder="Pais" value="{{ $donante->pais }}">
                </div>
            </div>
            <div class="form-group row" id="row-sexo">
                <label for="animales" class="col-2 col-form-label">Animales</label>
                <div class="col-10">
                    <select name="animales" id="animales" class="form-control">
                        <option value="si">Si</option>
                        <option value="no">No</option>
                    </select>
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
