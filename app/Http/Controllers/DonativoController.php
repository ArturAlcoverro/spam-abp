<?php

namespace App\Http\Controllers;

use App\Models\Donativo;
use App\Models\Tipo;
use App\Models\Subtipo;
use App\Models\Centro;
use App\Models\Animal;
use App\Models\Donante;
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
        $particulares = Donante::where('tipos_donantes_id', 2)->get();
        $empresas = Donante::where('tipos_donantes_id', 1)->get();

        $data["tipos"] = $tipos;
        $data["subtipos"] = $subtipos;
        $data["centros"] = $centros;
        $data["animales"] = $animales;
        $data["empresas"] = $empresas;
        $data["particulares"] = $particulares;
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
    public function update(Request $request, $id_donativo)
    {
        $donativo = Donativo::find($id_donativo);

        $donativo->cantidad = $request->input('cantidad');
        $donativo->centros_desti_id = $request->input('centro_destino');
        $donativo->centros_receptor_id = $request->input('centro_receptor');
        $donativo->coste = $request->input('coste');
        $donativo->subtipos_id = $request->input('subtipo_donacion');
        $donativo->unidad = $request->input('unidades');
        $donativo->ruta_factura = $request->input('factura');

        $request->input('coordinada') == true ?
                $donativo->es_coordinada = 1 :
                $donativo->es_coordinada = 0;

        $request->input('factura') == "" ?
                $donativo->hay_factura = 0 :
                $donativo->hay_factura = 1 ;

        try{
            $donativo->save();
        }
        catch(QueryException $e){
            $error=Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
            return redirect()->action('DonativoController@edit')->withInput();
        }

        $animales = $request->input('animales');
        $donativo->animales()->attach($animales);

        return redirect()->action('DonativoController@index');
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