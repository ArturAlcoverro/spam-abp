@extends('privada.templates.master')

@section('css')

@endsection

@section('body')

    @include('partial.errores')

    <div class="p-4">
        <form class="container pt-2" action="{{ action('SubtipoController@update', [$subtipo->id]) }}" method="POST">
            @method('put')
            @csrf
            <h3>Editar subtipo</h3>

            <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre</label>
                <div class="">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="{{ $subtipo->nombre }}">
                </div>
            </div>

            <div class="form-group">
                <label for="tipos" class="col-form-label">Tipo</label>
                <div class="">
                    <select name="tipos" id="tipos" class="form-control">
                        @foreach ($tipos as $tipo)
                            @if($tipo->id == $subtipo->tipos_id)
                                <option value="{{ $tipo->id }}" selected>{{ $tipo->nombre }}</option>
                            @else
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group ">
                <label for="unidad" class="col-form-label">Unidad de medida</label>
                <div class="">
                    <input list="unidades" name="unidad" class="form-control" placeholder="Unidad" value="{{ $subtipo->tipo_unidad }}">
                    <datalist id="unidades">
                        @foreach ($unidades as $unidad)
                            <option value="{{ $unidad }}">{{ $unidad }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-12 col-sm">
                    <label for="gama_alta" class="col-form-label">Gama alta</label>
                    <div class="">
                        <input type="number" name="gama_alta" id="gama_alta" class="form-control" value="{{ $subtipo->gama_alta }}">
                    </div>
                </div>

                <div class="form-group col-12 col-sm">
                    <label for="gama_media" class="col-form-label">Gama media</label>
                    <div class="">
                        <input type="number" name="gama_media" id="gama_media" class="form-control" value="{{ $subtipo->gama_media }}">
                    </div>
                </div>

                <div class="form-group col-12 col-sm">
                    <label for="gama_baja" class="col-form-label">Gama baja</label>
                    <div class="">
                        <input type="number" name="gama_baja" id="gama_baja" class="form-control" value="{{ $subtipo->gama_baja }}">
                    </div>
                </div>
            </div>

            <div class="form-group float-right mt-2">
                <a href="{{ url('/subtipos') }}" class="btn btn-secondary boton-amplada mr-1">Cancelar</a>
                <button type="submit" name="editAceptar" class="btn btn-primary boton-amplada">Aceptar</button>
            </div>
        </form>
    </div>

@endsection

@section('js')

    <script src="{{ asset('js/eventsEditDonant.js') }}"></script>

@endsection
