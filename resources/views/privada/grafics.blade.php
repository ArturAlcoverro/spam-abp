@extends('privada.templates.master')

@section('css')
<script src="{{ asset('js/eventsIndexGrafic.js') }}"></script>
@endsection

@section('body')

<script>

    var centros = {!! json_encode($centros->toArray()) !!};
    var animales = {!! json_encode($animales->toArray()) !!};

    $(document).ready(function(){
        $('.buttons-copy').attr('title',"{{ __('master.copy_crud') }}");
        $('.buttons-excel').attr('title',"{{ __('master.xls_crud') }}");
        $('.buttons-pdf').attr('title',"{{ __('master.pdf_crud') }}");
        $('.buttons-print').attr('title',"{{ __('master.print_crud') }}");
    });
</script>
<div class="p-5">

    <h1>Gráficos</h1>

    <div class="toolbar mt-3">
        <a href="{{ action('GraficoController@create') }}" title="@lang('master.add_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/add.png') }}" alt="">
        </a>
        <button onclick="" title="@lang('master.edit_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/edit.png') }}" alt="">
        </button>
        <button onclick="deleteGrafic()" title="@lang('master.delete_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/delete.png') }}" alt="">
        </button>
        <button title="@lang('master.chart_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/pie.png') }}" alt="">
        </button>
    </div>

    <div class="toolbar-append">

    </div>

    <table id="table" class="table table-hover table-striped display responsive nowrap" style="width:100%">
            <thead>

                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Tema</th>
                    <th>Campos</th>
                    <th>Centro Origen</th>
                    <th>Centro Destino</th>
                    <th>Animales</th>
                    <th>Ordenar</th>
                    <th>Pública</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
</div>
@endsection
