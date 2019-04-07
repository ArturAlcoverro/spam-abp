@extends('privada.templates.master')

@section('css')
    <script src="{{ asset('js/eventsIndexPrivat.js') }}"></script>
    <script src="{{ asset('js/eventsDonacion.js') }}"></script>
@endsection

@section('body')

<script>
    $(document).ready(function(){
        $('.buttons-copy').attr('title',"{{ __('master.copy_crud') }}");
        $('.buttons-excel').attr('title',"{{ __('master.xls_crud') }}");
        $('.buttons-pdf').attr('title',"{{ __('master.pdf_crud') }}");
        $('.buttons-print').attr('title',"{{ __('master.print_crud') }}");
    });
</script>
<div class="p-5">

    <h1>Donacions</h1>

    <div class="toolbar mt-3">
        <a href="{{ action('DonativoController@create') }}" title="@lang('master.add_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/add.png') }}" alt="">
        </a>
        <button onclick="" title="@lang('master.edit_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/edit.png') }}" alt="">
        </button>
        <button title="@lang('master.delete_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/delete.png') }}" alt="">
        </button>
        <button title="@lang('master.filter_crud')" class="btn btn-secondary buttons-html5" data-toggle="modal" data-target="#filter-modal">
            <img height="0px" src="{{ asset('media/img/filter.png') }}" alt="">
        </button>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="filter-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="container pt-2" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="tipos" class="col-form-label">Tipo</label>
                                <div class="">
                                    <select name="tipos" id="tipos" class="form-control">
                                        <option value=""></option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="subtipos" class="col-form-label">Subtipo</label>
                                <div class="">
                                    <select name="subtipos" id="subtipos" class="form-control">
                                        <option value=""></option>
                                        @foreach ($subtipos as $subtipo)
                                            <option value="{{ $subtipo->id }}">{{ $subtipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="dni" class="col-form-label">DNI/CIF del donante</label>
                                <div class="">
                                    <input type="text" name="dni" id="dni" class="form-control" placeholder="DNI/CIF">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="fecha" class="col-form-label">Fecha</label>
                                <div class="">
                                    <input type="date" name="fecha" id="fecha" class="form-control" placeholder="Fecha">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="centrosRecepores" class="col-form-label">Centro receptor</label>
                                <div class="">
                                    <select name="centrosRecepores" id="centrosRecepores" class="form-control">
                                        <option value=""></option>
                                        @foreach ($centros as $centro)
                                            <option value="{{ $centro->id }}">{{ $centro->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="centrosDestino" class="col-form-label">Centro destino</label>
                                <div class="">
                                    <select name="centrosDestino" id="centrosDestino" class="form-control">
                                        <option value=""></option>
                                        @foreach ($centros as $centro)
                                            <option value="{{ $centro->id }}">{{ $centro->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="filtrar()" data-dismiss="modal">Filtrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="toolbar-append">

    </div>

    <table id="table" class="table table-hover table-striped display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tipo</th>
                    <th>Subtipo</th>
                    <th>Centro Receptor</th>
                    <th>Centro Destino</th>
                    <th>Donante</th>
                    <th>Coste</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection
