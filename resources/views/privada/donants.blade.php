@extends('privada.templates.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
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
    <div class="p-5">
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
                    <th hidden>Id</th>
                    <th>Nombre</th>
                    <th>CIF</th>
                    <th>Tipo</th>
                    <th>Correo</th>
                    <th>Pais</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donantes as $donante)
                    <tr>
                        <td hidden>{{ $donante->id }}</td>
                        <td>{{ $donante->nombre }}</td>
                        <td>{{ $donante->cif }}</td>
                        <td>{{ $donante->tipo_donante->tipo }}</td>
                        <td>{{ $donante->correo }}</td>
                        <td>{{ $donante->pais }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
