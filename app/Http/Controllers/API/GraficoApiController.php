<?php

namespace App\Http\Controllers\API;

use App\Models\Grafico;
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

        return new GraficoResource($graficos);
    }


}
