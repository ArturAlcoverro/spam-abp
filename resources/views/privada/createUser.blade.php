@extends('privada.templates.master')

@section('name')
    Crear usuari
@endsection

@section('body')

    @include('partial.errores')

    <div class="p-4">
        <form class="container pt-2" action="{{ action('UsuarioController@store') }}" method="POST">
            @csrf
            <h3>@lang('createUser.new_user')</h3>
            <div class="form-group">
                <label for="correo" class="col-form-label">@lang('createUser.email')</label>
                <div class="">
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="@lang('createUser.email')"
                    value="{{ old('correo') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-form-label">@lang('createUser.password')</label>
                <div class="">
                    <input type="password" name="password" id="password" class="form-control" placeholder="@lang('createUser.password')"
                    value="{{ old('password') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-form-label">@lang('createUser.username')</label>
                <div class="">
                    <input type="text" name="username" id="username" class="form-control" placeholder="@lang('createUser.username')"
                    value="{{ old('username') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="nombre" class="col-form-label">@lang('createUser.name')</label>
                <div class="">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="@lang('createUser.name')"
                    value="{{ old('nombre') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="rol" class="col-form-label">@lang('createUser.rol')</label>
                <div class="">
                    <select name="rol" id="rol" class="form-control">
                        @foreach ($roles as $rol)
                            @if(old('rol') == $rol->id)
                                <option value="{{ $rol->id }}" selected>{{ $rol->rol }}</option>
                            @else
                                <option value="{{ $rol->id }}">{{ $rol->rol }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group float-right">
                <button type="submit" name="altaAceptar" class="btn btn-primary boton-amplada">@lang('createUser.accept')</button>
            </div>
        </form>
    </div>


@endsection
