<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonativoResource;

use App\Models\Donativo;
use App\Models\Tipio;
class EstadisticasController extends Controller
{
    //
    public function DonatiusByData($dataInici, $dataFi, $tipos, $subtipo, $ordenar, $poblacio, $origen, $desti, $animal, $valor)
    {
        $whereTipos = [];
        $dataSet;
        if(strpos($tipos, ",") === false){
            array_push($whereTipos,['subtipos.id_tipo', '=', $tipos]);
        }
        else{
            $where;
            $arrTipos = explode(",",$tipos);
            foreach ($arrTipos as $t) {
              $where =['subtipos.id_tipo', '=', $t];
              array_push($whereTipos,$where);
            }
        }

        $query = Donativo::select('coste','cantidad')
                           ->where("fecha_donativo", ">" , $dataInici . " 00:00:00")
                           ->where("fecha_donativo", "<", $dataFi . " 00:00:00");


        if ($desti !==0){
           $query->where("centros_desti_id","=", $desti);
        }
        if($origen !== 0){
            $query->where("centros_receptor_id","=",$origen);
        }
        if($subtipo !== 0){
            $query->where("subtipos_id","=",$subtipo);
        }
        if($animal !== 0){
            $query->join('animales_donativos', function ($join) {
                $join->on('donativos.id', '=', 'animales_donativos.donativos_id')
                     ->where('animales_donativos.animales_id', '=', $animal);
            });
        }
        if($poblacio !== 0){
            $query->join('donantes', function ($join) {
                $join->on('donativos.donantes_id', '=', 'donantes.id')
                     ->where('donantes.poblacio', '=', $poblacio);
            });
        }
        if($tipos !== 0){
            $query->join('subtipos', function ($join) {
                $join->on('subtipos.id', '=', 'donativos.subtipos_id');
                for($i = 0; $i < count($whereTipos); $i++){
                    if ($i==0) {
                        $join->where('subtipos.id_tipo', '=', $whereTipos[$i]);
                    }
                    else{
                        $join->orWhere('subtipos.id_tipo', '=', $whereTipos[$i]);
                    }
                }
            });
        }

        switch ($ordenar){

            case 'tipus':
                $arr['data'] = [];
                $arr['sort'] = $valor;
                $arr['id'] = 'id_tipo';
                $arr['joinId'] = 'id';
                $arr['idOrigen'] = 'subtipos_id';
                $arr['tabla'] = 'subtipos';
                foreach ($tipos as $t) {
                    $tipo = Tipo::find($t);
                    $var[$t->id] = $tipo->nombre;
                    array_push($arr['data'], $var);
                }
                $dataSet = sortJoin($query, $arr);
            break;
            case 'subtipus':
                $subtipos = Subtipo::all();
                $arr['data'] = [];
                $arr['sort'] = $valor;
                $arr['id'] = 'subtipos_id';
                foreach ($subtipos as $s) {
                    $var[$s->id] = $s->nombre;
                    array_push($arr['data'], $var);
                }
                $dataSet = sort($query, $arr);
            break;
            case 'origen':
                $centros = Centro::all();
                $arr['data'] = [];
                $arr['sort'] = $valor;
                $arr['id'] = 'centros_receptor_id';
                foreach ($centros as $c) {
                    $var[$c->id] = $c->nombre;
                    array_push($arr['data'], $var);
                }
                $dataSet = sort($query, $arr);
            break;
            case 'desti':
                $centros = Centro::all();
                $arr['data'] = [];
                $arr['sort'] = $valor;
                $arr['id'] = 'centros_desti_id';
                foreach ($centros as $c) {
                    $var[$c->id] = $c->nombre;
                    array_push($arr['data'], $var);
                }
                $dataSet = sort($query, $arr);
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
                    $var[$a->id] = $a->nombre;
                    array_push($arr['data'], $var);
                }
                $dataSet = sortJoin($query, $arr);

            break;
            case 'poblacio':
                $dataSet  = [];
            break;
        }


        return response()->json($dataSet);
    }
    public function sort($query, $arr){
        $dataSet['labels']= [];
        $dataSet['data']= [];

        foreach($arr['data'] as $key => $value){
            $executa = $query;
            $executa->where($arr['id'],"=",$key);
            $executa = $executa->get();
            $label = $value;
            $quantitat = 0;
            if($arr['sort'] == 'cash'){
                foreach($executa as $result){
                    $quantitat =$quantitat + $result->coste;
                }
            }
            elseif ($arr['sort'] == 'uu') {
                foreach($executa as $result){
                    $quantitat = $quantitat + $result->cantidad;
                }
            }
            else{
                foreach($executa as $result){
                    $quantitat++;
                }
            }
            array_push($dataSet['labels'], $label);
            array_push($dataSet['data'], $quantitat);
        }

        return $dataSet;
    }
    public function sortJoin($query, $arr){
        $dataSet['labels']= [];
        $dataSet['data']= [];

        foreach($arr['data'] as $key => $value){
            $executa = $query;
            $executa->join($arr['tabla'], function ($join) {
                $join->on('donativos.'.$arr['idOrigen'], '=', $arr['tabla'].'.'.$arr['joinId'])
                     ->where($arr['tabla'].'.'.$arr['id'], '=', $key);
            });
            $executa = $executa->get();
            $label = $value;
            $quantitat = 0;
            if($arr['sort'] == 'cash'){
                foreach($executa as $result){
                    $quantitat =$quantitat + $result->coste;
                }
            }
            elseif ($arr['sort'] == 'uu') {
                foreach($executa as $result){
                    $quantitat = $quantitat + $result->cantidad;
                }
            }
            else{
                foreach($executa as $result){
                    $quantitat++;
                }
            }
            array_push($dataSet['labels'], $label);
            array_push($dataSet['data'], $quantitat);
        }

        return $dataSet;
    }
}
