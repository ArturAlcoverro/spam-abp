@extends('privada.templates.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <script src="{{ asset('js/eventsIndexPrivat.js') }}"></script>
    <script src="{{ asset('js/eventsDonants.js') }}"></script>
@endsection

@section('body')
    <script>
        $(document).ready(function(){
            $('.buttons-copy').attr('title',"{{ __('master.copy_crud') }}");
            $('.buttons-excel').attr('title',"{{ __('master.copy_crud') }}");
            $('.buttons-pdf').attr('title',"{{ __('master.copy_crud') }}");
            $('.buttons-print').attr('title',"{{ __('master.print_crud') }}");
        });
    </script>

    @include('partial.errores')

    <div class="p-5">
        <p id="info"></p>
        <div class="toolbar">
            <button title="Añadir" class="btn btn-secondary buttons-html5">
                <a href="{{ action('DonanteController@create') }}">
                    <img src="{{ asset('media/img/add.png') }}" alt="">
                </a>
            </button>
            <button title="Modificar" class="btn btn-secondary buttons-html5">
                <div onclick="editDonant()">
                    <img src="{{ asset('media/img/edit.png') }}" alt="">
                    <form id="form_edit" action="" method="get">
                        @csrf
                    </form>
                </div>
            </button>
            <button title="Eliminar" class="btn btn-secondary buttons-html5">
                <div onclick="deleteDonant()">
                    <img src="{{ asset('media/img/delete.png') }}" alt="">
                    <form id="form_delete" action="" method="post">
                        @method('delete')
                        @csrf
                    </form>
                </div>
            </button>
            <button title="Consultar" class="btn btn-secondary buttons-html5">
                <a href="">
                    <img src="{{ asset('media/img/save.png') }}" alt="">
                </a>
            </button>
        </div>
        <table id="table" class="table table-hover table-striped display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>CIF</th>
                    <th>Tipo</th>
                    <th>Correo</th>
                    <th>Pais</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
