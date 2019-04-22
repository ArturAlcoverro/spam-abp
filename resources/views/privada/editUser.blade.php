@extends('privada.templates.master')

@section('name')
    Editar usuari
@endsection

@section('css')
    <script src="{{ asset('js/eventsEditUser.js') }}"></script>
@endsection

@section('body')

    @include('partial.errores')

    <div class="p-4">
        <form class="container pt-2" action="{{ action('UsuarioController@update', [$user->id]) }}" method="POST">
            @method('put')
            @csrf
            <h3>@lang('editUser.edit')</h3>
            <div class="form-group">
                <label for="correo" class="col-form-label">@lang('editUser.email')</label>
                <div class="">
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="@lang('editUser.email')" value="{{ $user->correo }}">
                </div>
            </div>
            <div class="form-group">
                <label for="lblpassword" class="col-form-label">@lang('editUser.password')</label>
                <div class="">
                    <input type="password" name="password" id="password" class="form-control" placeholder="@lang('editUser.password')" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-form-label">@lang('editUser.username')</label>
                <div class="">
                    <input type="text" name="username" id="username" class="form-control" placeholder="@lang('editUser.username')" value="{{ $user->nombre_usuario }}">
                </div>
            </div>
            <div class="form-group">
                <label for="nombre" class="col-form-label">@lang('editUser.name')</label>
                <div class="">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="@lang('editUser.name')" value="{{ $user->nombre }}">
                </div>
            </div>
            <div class="form-group">
                <label for="rol" class="col-form-label">@lang('editUser.rol')</label>
                <div class="">
                    <select name="rol" id="rol" class="form-control">
                        @foreach ($roles as $rol)
                            @if($rol->id == $user->rol->id)
                                <option value="{{ $rol->id }}" selected>{{ $rol->rol }}</option>
                            @else
                                <option value="{{ $rol->id }}">{{ $rol->rol }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group float-right">
                <button type="button" name="pass" class="btn btn-primary boton-amplada" onclick="changePassword()">@lang('editUser.change')</button>
                <button type="submit" name="altaAceptar" class="btn btn-primary boton-amplada">@lang('editUser.accept')</button>
            </div>
        </form>
    </div>


@endsection
