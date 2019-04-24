<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonativoResource;
use App\Clases\Sort;
use App\Models\Donativo;
use App\Models\Tipo;
use App\Models\Animal;
use App\Models\Subtipo;
use App\Models\Centro;

class EstadisticasController extends Controller
{
    //
    public function DonatiusByData($dataInici, $dataFi, $tipos, $subtipo, $ordenar, $poblacio, $origen, $desti, $animal, $valor)
    {


        $dataSet;
        if(strpos($tipos, ",") === false){
            $arrTipos = [];
            array_push($arrTipos, $tipos);

        }
        else{
            $arrTipos = explode(",",$tipos);
        }

        $query = Donativo::select('coste','cantidad')
                           ->where("fecha_donativo", ">" , $dataInici . " 00:00:00")
                           ->where("fecha_donativo", "<", $dataFi . " 00:00:00");


        if ($desti != 0){
           $query->where("centros_desti_id","=", $desti);
        }
        if($origen != 0){
            $query->where("centros_receptor_id","=",$origen);
        }
        // if($subtipo !== 0){
        //     $query->where("subtipos_id","=",$subtipo);
        // }
        if($animal != 0 && $ordenar != 'animals'){

            $query->join('animales_donativos', function ($join) use ($animal){

                $join->on('donativos.id', '=', 'animales_donativos.donativos_id')
                     ->where('animales_donativos.animales_id', '=', $animal);

            });
        }
        // if($poblacio != 0){
        //     $query->join('donantes', function ($join) use ($poblacio){
        //         $join->on('donativos.donantes_id', '=', 'donantes.id')
        //              ->where('donantes.poblacio', '=', $poblacio);
        //     });
        // }
        if($ordenar != 'tipus'){
            $query->join('subtipos', function ($join) use ($arrTipos) {
                $join->on('subtipos.id', '=', 'donativos.subtipos_id');
                for($i = 0; $i < count($arrTipos); $i++){
                    if ($i==0) {
                        $join->where('subtipos.tipos_id', '=', $arrTipos[$i]);
                    }
                    else{
                        $join->orWhere('subtipos.tipos_id', '=', $arrTipos[$i]);
                    }
                }
            });
        }

        switch ($ordenar){

            case 'tipus':
                $arr['data'] = [];
                $arr['sort'] = $valor;
                $arr['id'] = 'tipos_id';
                $arr['joinId'] = 'id';
                $arr['idOrigen'] = 'subtipos_id';
                $arr['tabla'] = 'subtipos';
                foreach ($arrTipos as $t) {
                    $tipo = Tipo::find($t);
                    $arr['data'][$t] = $tipo->nombre;
                }
                $dataSet = Sort::sortJoin($query, $arr);
            break;
            case 'subtipus':
                $subtipos = Subtipo::all();
                $arr['data'] = [];
                $arr['sort'] = $valor;
                $arr['id'] = 'subtipos_id';
                foreach ($subtipos as $s) {
                    //$var[$s->id] = $s->nombre;
                    $arr['data'][$s->id] = $s->nombre;
                    //array_push($arr['data'], $var);
                }
                $dataSet = Sort::sort($query, $arr);
            break;
            case 'origen':
                $centros = Centro::all();
                $arr['data'] = [];
                $arr['sort'] = $valor;
                $arr['id'] = 'centros_receptor_id';
                foreach ($centros as $c) {
                    // $var[$c->id] = $c->nombre;
                    // array_push($arr['data'], $var);
                    $arr['data'][$c->id] = $c->nombre;
                }
                $dataSet = Sort::sort($query, $arr);
            break;
            case 'desti':
                $centros = Centro::all();
                $arr['data'] = [];
                $arr['sort'] = $valor;
                $arr['id'] = 'centros_desti_id';
                foreach ($centros as $c) {
                    // $var[$c->id] = $c->nombre;
                    // array_push($arr['data'], $var);
                    $arr['data'][$c->id] = $c->nombre;
                }
                $dataSet = Sort::sort($query, $arr);
            break;
            case 'animals':
                $animales = Animal::all();
                $arr['data'] = [];
                $arr['sort'] = $valor;
                $arr['id'] = 'animales_id';
                $arr['joinId'] = 'donativos_id';
                $arr['idOrigen'] = 'id';
                $arr['tabla'] = 'animales_donativos';
                foreach ($animales as $a) {
                    // $var[$a->id] = $a->nombre;
                    // array_push($arr['data'], $var);
                    $arr['data'][$a->id] = $a->nombre;
                }
                $dataSet = Sort::sortJoin($query, $arr);

            break;
            case 'poblacio':
                $dataSet  = [];
            break;
        }


        return json_encode($dataSet);
        // }catch(Exception $e){
        //     // return json_encode($query->toSql());
        //     return 'hola';
        // }
    }

}

