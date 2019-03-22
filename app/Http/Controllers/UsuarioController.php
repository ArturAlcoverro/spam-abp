<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

use App\Models\Rol;

use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();

        $data['usuarios'] = $usuarios;

        return view('privada.users', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();

        $data['roles'] = $roles;

        return view('privada.createUser', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUser = new Usuario();

        $newUser->nombre_usuario= $request->input('username');
        $newUser->correo = $request->input('correo');
        $newUser->roles_id = $request->input('rol');
        $newUser->nombre = $request->input('nombre');

        $newUser->password = Hash::make($request->input('password'));

        $newUser->save();

        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id_user)
    {
        $usuario = Usuario::find($id_user);

        $roles = Rol::all();

        $data['roles'] = $roles;
        $data['user'] = $usuario;

        return view('privada.editUser', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_usuario)
    {
        $usuario = Usuario::find($id_usuario);

        $usuario->nombre_usuario= $request->input('username');
        $usuario->correo = $request->input('correo');
        $usuario->roles_id = $request->input('rol');
        $usuario->nombre = $request->input('nombre');

        $usuario->password = Hash::make($request->input('password'));

        $usuario->save();

        return redirect()->action('UsuarioController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_user)
    {
        $usuario = Usuario::find($id_user);

        $usuario->delete();

        return redirect()->action('UsuarioController@index');
    }
}
