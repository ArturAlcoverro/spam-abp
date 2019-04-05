<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\SubtipoResource;
// use App\Http\Resources\CentroResource;
// use App\Http\Resources\UsuarioResource;
// use App\Http\Resources\DonanteResource;

class DonativoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // return [
        //     "id" => $this->id,
        //     "donatiuscol" => $this->donatiuscol,
        //     //"tipos" => SubtipoResource::collection($this->subtipo),
        //     "desc_animal" => $this->desc_animal,
        //     //"centro_receptor" => CentroResource::collection($this->centro_receptor_id),
        //     "usuario" => UsuarioResource::collection($this->usuario),
        //     //"centro_desti" => CentroResource::collection($this->centro_desti_id),
        //     //"donante" => DonanteResource::collection($this->donantes_id),
        //     "coste" => $this->coste,
        //     "unidades" => $this->unidades,
        //     "peso" => $this->peso,
        //     "fecha_donativo" => $this->fecha_donativo,
        //     "hay_factura" => $this->hay_factura,
        //     "ruta_factura" => $this->ruta_factura,
        //     "es_coordinada" => $this->es_coordinada
        // ];
    }
}
