<?php

namespace App\Http\Controllers;

use App\Models\Donativo;
use App\Models\Tipo;
use App\Models\Subtipo;
use App\Models\Centro;
use App\Models\Animal;
use Illuminate\Http\Request;

class DonativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::all();
        $subtipos = Subtipo::all();
        $centros = Centro::all();
        $animales = Animal::all();
        $data["tipos"] = $tipos;
        $data["subtipos"] = $subtipos;
        $data["centros"] = $centros;
        $data["animales"] = $animales;

        return view('privada.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::all();
        $subtipos = Subtipo::all();
        $centros = Centro::all();
        $animales = Animal::all();
        $data["tipos"] = $tipos;
        $data["subtipos"] = $subtipos;
        $data["centros"] = $centros;
        $data["animales"] = $animales;
        return view('privada.crearDonacion', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donativo  $donativo
     * @return \Illuminate\Http\Response
     */
    public function show(Donativo $donativo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donativo  $donativo
     * @return \Illuminate\Http\Response
     */
    public function edit($id_donativo)
    {
        $donativo = Donativo::find($id_donativo);
        $subtipo = $donativo->subtipo;
        $tipos = Tipo::all();
        $subtipos = Subtipo::all();
        $centros = Centro::all();
        $animales = Animal::all();

        $data["donativo"] = $donativo;
        $data["tipos"] = $tipos;
        $data["subtipo"] = $subtipo;
        $data["subtipos"] = $subtipos;
        $data["centros"] = $centros;
        $data["animales"] = $animales;
        $data["animales_donativo"] = array_pluck($donativo->animales, "id");
        return view('privada.editDonacion', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donativo  $donativo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donativo $donativo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donativo  $donativo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donativo $donativo)
    {
        //
    }
}
