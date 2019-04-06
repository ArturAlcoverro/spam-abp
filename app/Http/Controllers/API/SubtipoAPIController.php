<?php

namespace App\Http\Controllers\API;

use App\Models\Subtipo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubtipoResource;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;

class SubtipoAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtipos = Subtipo::all();

        foreach ($subtipos as $subtipo) {
            $subtipo->tipo = $subtipo->tipo;
        }

        return SubtipoResource::collection($subtipos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subtipo  $subtipo
     * @return \Illuminate\Http\Response
     */
    public function show(Subtipo $subtipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subtipo  $subtipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subtipo $subtipo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subtipo  $subtipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subtipo $subtipo)
    {
        //
    }
}