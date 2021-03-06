@extends('privada.templates.master')

@section('name')
    @lang('users.users')
@endsection

@section('css')
    <script src="{{ asset('js/toast.js') }}"></script>
    <script src="{{ asset('js/eventsIndexPrivat.js') }}"></script>
    <script src="{{ asset('js/eventsUsers.js') }}"></script>
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

        <h1>@lang('users.users')</h1>

        <div class="toolbar">
            <button title="Añadir" class="btn btn-secondary buttons-html5">
                <a href="{{ action('UsuarioController@create') }}">
                    <img src="{{ asset('media/img/add.png') }}" alt="">
                </a>
            </button>
            <button title="Modificar" class="btn btn-secondary buttons-html5">
                <div onclick="editUser()">
                    <img src="{{ asset('media/img/edit.png') }}" alt="">
                    <form id="form_edit" action="" method="get">
                        @csrf
                    </form>
                </div>
            </button>
            <button title="Eliminar" class="btn btn-secondary buttons-html5">
                <div onclick="deleteUsuario()">
                    <img src="{{ asset('media/img/delete.png') }}" alt="">
                    <form id="form_delete" action="" method="post">
                        @method('delete')
                        @csrf
                    </form>
                </div>
            </button>
        </div>
        <table id="table" class="table table-hover table-striped display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>@lang('users.username')</th>
                    <th>@lang('users.email')</th>
                    <th>@lang('users.name')</th>
                    <th>@lang('users.rol')</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
