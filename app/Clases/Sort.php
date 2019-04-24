<?php
namespace App\Clases;
class Sort{
    public static function sort($query, $arr){
        $dataSet['labels']= [];
        $dataSet['data']= [];

        foreach($arr['data'] as $key => $value){
            $executa = clone $query;
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
    public static function sortJoin($query, $arr){
        $dataSet['labels']= [];
        $dataSet['data']= [];

        foreach($arr['data'] as $key => $value){

            $executa = clone $query;
            $executa->join($arr['tabla'], function ($join) use ($arr, $key) {
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

?>
