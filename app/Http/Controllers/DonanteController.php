<?php

namespace App\Http\Controllers;

use App\Models\Donante;
use App\Models\Animal;
use App\Models\Tipo_donante;
use App\Models\Sexo;
use App\Models\Donativo;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;
use Session;

class DonanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$donantes = Donante::all();

        //$data['donantes'] = $donantes;

        //return view('privada.donants', $data);

        return view('privada.donants');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->has('back')){
            Session::put('back', '');
        }elseif (Session::has('back')){
            Session::forget('back');
            Session::flash('back','');

        }
        $animales = Animal::all();
        $tipos_donantes = Tipo_donante::all();
        $sexos = Sexo::all();
        $donativos = Donativo::all();

        $data['animales'] = $animales;
        $data['tipos_donante'] = $tipos_donantes;
        $data['sexos'] = $sexos;
        $data['donativos'] = $donativos;
        $data['paises'] = array(
            "España",
            "Francia"
        );
        $data['poblaciones'] = array(
            "Barcelona",
            "Lleida",
            "Tarragona",
            "Girona"
        );
        $data['colaboraciones'] = array(
            "Padrino",
            "Adoptante",
            "Voluntario",
            "Patrocinador",
            "RRSS"
        );

        return view('privada.createDonante', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $donante = new Donante();

        $donante->tipos_donantes_id = $request->input('tipos_donante');
        $donante->cif = $request->input('cif');
        $donante->telefono = $request->input('telefono');
        $donante->correo = $request->input('correo');
        $donante->direccion = $request->input('direccion');
        $donante->poblacion = $request->input('poblacion');
        $donante->pais = $request->input('pais');
        $donante->nombre = $request->input('nombre');
        $donante->fecha_alta = date('Y-m-d H:i:s');
        $donante->tipo_colaboracion = $request->input('colaboracion');

        if($request->input('animales') == ""){
            $donante->tiene_aninales = 0;
        }
        else{
            $donante->tiene_aninales = 1;
        }

        if($request->input('colaboracion') == ""){
            $donante->es_colaborador = 0;
        }
        else{
            $donante->es_colaborador = 1;
        }

        if($request->input('tipos_donante') == 2){
            $donante->sexos_id = $request->input('sexos');
        }
        elseif($request->input('tipos_donante') == 1){
            $donante->vinculo_entidad = $request->input('vinculo');
        }

        if($request->input('habitual')=="on"){

            $donante->es_habitual = 1;
        }
        else{
            $donante->es_habitual = 0;
        }

        if($request->input('spam')=="on"){

            $donante->spam = 1;
        }
        else{
            $donante->spam = 0;
        }

        try
        {
            $donante->save();
        }
        catch(QueryException $e){

            $error = Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
            return redirect()->action('DonanteController@create')->withInput();
        }

        $animales = $request->input('animales');

        $donante->animal()->attach($animales);

        if (Session::has('back')){
            Session::forget('back');
            Session::flash('dni',$donante->cif);
            return redirect(action('DonativoController@create'));
        }

        return redirect('donants');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donante  $donante
     * @return \Illuminate\Http\Response
     */
    public function show(Donante $donante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donante  $donante
     * @return \Illuminate\Http\Response
     */
    public function edit($id_donante)
    {
        $donante = Donante::find($id_donante);
        $animales = Animal::all();
        $tipos_donantes = Tipo_donante::all();
        $sexos = Sexo::all();
        $donativos = Donativo::all();

        $data['animales'] = $animales;
        $data['tipos_donante'] = $tipos_donantes;
        $data['sexos'] = $sexos;
        $data['donativos'] = $donativos;
        $data['donante'] = $donante;
        $data['paises'] = array(
            "España",
            "Francia"
        );
        $data['poblaciones'] = array(
            "Barcelona",
            "Lleida",
            "Tarragona",
            "Girona"
        );
        $data['colaboraciones'] = array(
            "Padrino",
            "Adoptante",
            "Voluntario",
            "Patrocinador",
            "RRSS"
        );
        $data['animales_donante'] = array_pluck($donante->animal, 'id');

        return view('privada.editDonante', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donante  $donante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_donante)
    {
        $donante = Donante::find($id_donante);

        $donante->tipos_donantes_id = $request->input('tipos_donante');
        $donante->cif = $request->input('cif');
        $donante->telefono = $request->input('telefono');
        $donante->correo = $request->input('correo');
        $donante->direccion = $request->input('direccion');
        $donante->poblacion = $request->input('poblacion');
        $donante->pais = $request->input('pais');
        $donante->nombre = $request->input('nombre');
        $donante->fecha_alta = date('Y-m-d H:i:s');
        $donante->tipo_colaboracion = $request->input('colaboracion');

        if($request->input('animales') == ""){
            $donante->tiene_aninales = 0;
        }
        else{
            $donante->tiene_aninales = 1;
        }

        if($request->input('colaboracion') == ""){
            $donante->es_colaborador = 0;
        }
        else{
            $donante->es_colaborador = 1;
        }

        if($request->input('tipos_donante') == 2){
            $donante->sexos_id = $request->input('sexos');
        }
        elseif($request->input('tipos_donante') == 1){
            $donante->vinculo_entidad = $request->input('vinculo');
        }

        if($request->input('habitual')=="on"){

            $donante->es_habitual = 1;
        }
        else{
            $donante->es_habitual = 0;
        }

        if($request->input('spam')=="on"){

            $donante->spam = 1;
        }
        else{
            $donante->spam = 0;
        }

        try
        {
            $donante->save();
        }
        catch(QueryException $e){

            $error = Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
            return redirect()->action('DonanteController@edit')->withInput();
        }

        $donante->animal()->detach();

        $animales = $request->input('animales');

        $donante->animal()->attach($animales);

        return redirect()->action('DonanteController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donante  $donante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_donante)
    {
        $donante = Donante::find($id_donante);

        try
        {
            $donante->delete();
        }
        catch(QueryException $e){

            $error = Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
            return redirect()->action('DonanteController@index')->withInput();
        }

        return redirect()->action('DonanteController@index');
    }
}