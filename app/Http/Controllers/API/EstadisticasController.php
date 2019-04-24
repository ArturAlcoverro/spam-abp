<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonativoResource;

use App\Models\Donativo;

class EstadisticasController extends Controller
{
    //
    public function DonatiusByData($dataInici, $dataFi)
    {

        $donativos = Donativo::with('subtipo')
                            ->with('centro_receptor')
                            ->with('centro_desti')
                            ->with('usuario')
                            ->with('subtipo.tipo')
                            ->with('donante.tipo_donante')
                            ->where("fecha_donativo", ">" , $dataInici . " 00:00:00")
                            ->where("fecha_donativo", "<", $dataFi . " 00:00:00")
                            ->get();
        return DonativoResource::collection($donativos);
    }
}
