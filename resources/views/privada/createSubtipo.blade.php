@extends('privada.templates.master')

@section('css')

@endsection

@section('body')

    @include('partial.errores')

    <div class="p-4">
        <form class="container pt-2 m-0" action="{{ action('SubtipoController@store') }}" method="POST">
            @csrf
            <h3>@lang('createSubtipo.create')</h3>

            <div class="form-group">
                <label for="nombre" class="col-form-label">@lang('createSubtipo.name')</label>
                <div class="">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="@lang('createSubtipo.name')" value="{{ old('nombre') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="tipos" class="col-form-label">@lang('createSubtipo.type')</label>
                <div class="">
                    <select name="tipos" id="tipos" class="form-control">
                        @foreach ($tipos as $tipo)
                            @if($tipo->id == old('tipos'))
                                <option value="{{ $tipo->id }}" selected>{{ $tipo->nombre }}</option>
                            @else
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-12 col-sm">
                    <label for="gama_alta" class="col-form-label">@lang('createSubtipo.high')</label>
                    <div class="">
                        <input type="number" name="gama_alta" id="gama_alta" class="form-control" value="{{ old('gama_alta') }}" placeholder="@lang('createSubtipo.high')">
                    </div>
                </div>

                <div class="form-group col-12 col-sm">
                    <label for="gama_media" class="col-form-label">@lang('createSubtipo.medium')</label>
                    <div class="">
                        <input type="number" name="gama_media" id="gama_media" class="form-control" value="{{ old('gama_media') }}" placeholder="@lang('createSubtipo.medium')">
                    </div>
                </div>

                <div class="form-group col-12 col-sm">
                    <label for="gama_baja" class="col-form-label">@lang('createSubtipo.low')</label>
                    <div class="">
                        <input type="number" name="gama_baja" id="gama_baja" class="form-control" value="{{ old('gama_baja') }}" placeholder="@lang('createSubtipo.low')">
                    </div>
                </div>
            </div>

            <div class="form-group ">
                <label for="unidad" class="col-form-label">@lang('createSubtipo.unit')</label>
                <div class="">
                    <input list="unidades" name="unidad" class="form-control" placeholder="@lang('createSubtipo.unit')" value="{{ old('unidad') }}">
                    <datalist id="unidades">
                        @foreach ($unidades as $unidad)
                            <option value="{{ $unidad }}">{{ $unidad }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="form-group float-right mt-2">
                <a href="{{ url('/subtipos') }}" class="btn btn-secondary boton-amplada mr-1">@lang('createSubtipo.cancel')</a>
                <button type="submit" name="editAceptar" class="btn btn-primary boton-amplada">@lang('createSubtipo.accept')</button>
            </div>
        </form>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/eventsEditDonant.js') }}"></script>
@endsection
