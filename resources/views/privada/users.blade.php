@extends('privada.templates.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
    <script src="{{ asset('js/eventsIndexPrivat.js') }}"></script>
@endsection

@section('body')
    <div class="p-5">
        <div class="toolbar">
            <button title="Añadir" class="btn btn-secondary buttons-html5">
                <a href="{{ action('UsuarioController@create') }}">
                    <img src="{{ asset('media/img/add.png') }}" alt="">
                </a>
            </button>
            <button title="Modificar" class="btn btn-secondary buttons-html5">
                <a href="">
                    <img src="{{ asset('media/img/edit.png') }}" alt="">
                </a>
            </button>
            <button title="Eliminar" class="btn btn-secondary buttons-html5">
                <a href="">
                    <img src="{{ asset('media/img/delete.png') }}" alt="">
                </a>
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
                    <th>Username</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $user)
                    <tr>
                        <td>{{ $user->nombre_usuario }}</td>
                        <td>{{ $user->correo }}</td>
                        <td>{{ $user->nombre }}</td>
                        <td>{{ $user->rol->rol }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
