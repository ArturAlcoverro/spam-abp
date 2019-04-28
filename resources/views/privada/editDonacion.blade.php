@extends('privada.templates.master')

@section('name')
    @lang('editDonacion.edit')
@endsection

@section('css')
    <script src="{{asset('js/eventsEditDonacio.js')}}"></script>
    <script>
        var donativo = {!! json_encode($donativo) !!};
        var subtipo = {!! json_encode($subtipo) !!};
        var subtipos = {!! json_encode($subtipos->toArray()) !!};
        var centros = {!! json_encode($centros->toArray()) !!};
    </script>
@endsection

@section('body')

    @include('partial.errores')

    <div class="p-4">
        <form action="{{action('DonativoController@update', [$donativo->id])}}" class="container" id="formMaterial" method="POST">
            @method('put')
            @csrf
            <h3>@lang('editDonacion.edit')</h3>
            <div class="form-group">
                <label for="lbltipo_donacion" class=" col-form-label">@lang('editDonacion.type')</label>
                <div class="">
                    <select name="tipo_donacion" id="tipo_donacion" class="form-control">
                        @foreach ($tipos as $tipo)
                            @if ($tipo->id == $donativo->tipos_id)
                                <option value="{{$tipo->id}}" selected>{{$tipo->nombre}}</option>
                            @else
                                <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="lblsubtipo_donacion" class="col-form-label">@lang('editDonacion.subtype')</label>
                <div class="">
                    <select required name="subtipo_donacion" id="subtipo_donacion" class="form-control">

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="lblcentro_receptor" class=" col-form-label">@lang('editDonacion.centre_rec')</label>
                <div class="">
                    <select name="centro_receptor" id="centro_receptor" class="form-control">
                        @foreach ($centros as $centro)
                            @if ($centro->id == $donativo->centros_receptor_id)
                                <option selected value="{{$centro->id}}">{{$centro->nombre}}</option>
                            @else
                                <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="lblcentro_destino" class=" col-form-label">@lang('editDonacion.centre_dest')</label>
                <div class="">
                    <select name="centro_destino" id="centro_destino" class="form-control">
                        @foreach ($centros as $centro)
                            @if ($centro->id == $donativo->centros_desti_id)
                                <option selected value="{{$centro->id}}">{{$centro->nombre}}</option>
                            @else
                                <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="unidades" class="col-form-label">@lang('editDonacion.units')</label>
                <div class="">
                    <input value="{{$donativo->cantidad}}" type="number" name="unidades" id="unidades" class="form-control" placeholder="@lang('editDonacion.units')">
                </div>
            </div>
            <div class="form-group">
                <label for="cantidad" class="col-form-label">@lang('editDonacion.quantity') <span id="unidadMedida"></span></label>
                <div class="">
                    <input value="{{$donativo->peso}}" type="number" name="cantidad" id="cantidad" class="form-control" placeholder="@lang('editDonacion.quantity')">
                </div>
            </div>
            <div class="form-group">
                <label for="coste" class="col-form-label">@lang('editDonacion.value')</label>
                <div class="">
                    <input value="{{$donativo->coste}}" type="number" step="0.01" name="coste" id="coste" class="form-control" placeholder="@lang('editDonacion.value')">
                </div>
            </div>
            <div class="form-group">
                <label for="animales" class=" col-form-label">@lang('editDonacion.animal')</label>
                <div class="">
                    <select name="animales[]" id="animales" size="5" multiple="multiple" class="custom-select p-0">
                        @foreach ($animales as $animal)
                            @if (in_array($animal->id, $animales_donativo))
                                <option selected value="{{$animal->id}}">{{$animal->nombre}}</option>
                            @else
                                <option value="{{$animal->id}}">{{$animal->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-3 custom-control custom-checkbox">
                    @if ($donativo->es_coordinada == 1)
                        <input checked type="checkbox" class="custom-control-input" name="coordinada" id="coordinada">
                    @else
                        <input type="checkbox" class="custom-control-input" name="coordinada" id="coordinada">
                    @endif
                    <label class="custom-control-label" for="coordinada">@lang('editDonacion.coordination')</label>
                </div>
            </div>
            <div class="form-group float-right">
                <button type="button" class="btn btn-secondary boton-amplada mr-1" data-dismiss="modal">@lang('editDonacion.cancel')</button>
                <button type="submit" name="altaAceptar" class="btn btn-primary boton-amplada">@lang('editDonacion.accept')</button>
            </div>
        </form>
    </div>

@endsection
