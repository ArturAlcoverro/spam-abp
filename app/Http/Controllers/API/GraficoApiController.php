<?php

namespace App\Http\Controllers\API;

use App\Models\Grafico;
use App\Models\Animal;
use App\Models\Centro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GraficoResource;

class GraficoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $graficos = Grafico::all();

        foreach ($graficos as $g) {
            if($g->desti == 0){
                $g->desti = 'Tots';
            }else{
                $g->desti = Centro::find($g->desti)->nombre;
            }

            if($g->origen == 0){
                $g->origen = 'Tots';
            }else{
                $g->origen = Centro::find($g->origen)->nombre;
            }

            if($g->animales == 0){
                $g->animales = 'Tots';
            }
            else{
                $g->animales = Animal::find($g->animales)->nombre;
            }
        }

        return new GraficoResource($graficos);
    }


}
