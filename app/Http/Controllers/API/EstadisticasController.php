<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonanteResource;

use App\Models\Donativo;

class EstadisticasController extends Controller
{
    //
    public function DonatiusByData($dataInici, $dataFi)
    {
        $donativos = Donativo::where("fecha_donativo", ">" , $dataInici)
                            ->where("fecha_donativo", "<", $dataFi)
                            ->get();
        return DonanteResource::collection($donativos);
    }
}
