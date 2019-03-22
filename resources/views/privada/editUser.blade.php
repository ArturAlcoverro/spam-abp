@extends('privada.templates.master')

@section('body')
    <div class="p-4">
        <form action="{{ action('UsuarioController@update', [$user->id]) }}" method="POST">
            @method('put')
            @csrf
            <div class="form-group row">
                <label for="correo" class="col-2 col-form-label">Correo electronico</label>
                <div class="col-10">
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo electronico" value="{{ $user->correo }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-2 col-form-label">Password</label>
                <div class="col-10">
                    <input type="text" name="password" id="password" class="form-control" placeholder="Password" value="{{ $user->password }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-2 col-form-label">Username</label>
                <div class="col-10">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ $user->nombre_usuario }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="nombre" class="col-2 col-form-label">Nombre</label>
                <div class="col-10">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="{{ $user->nombre }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="rol" class="col-2 col-form-label">Rol</label>
                <div class="col-10">
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
                <button type="submit" name="altaAceptar" class="btn btn-primary boton-amplada">Aceptar</button>
            </div>
        </form>
    </div>


@endsection
