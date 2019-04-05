<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\TipoResource;

class SubtipoResource extends JsonResource
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
        //     "nombre" => $this->nombre,
        //     "tipo" => TipoResource::collection($this->tipo),
        //     "gama_alta" => $this->gama_alta,
        //     "gama_media" => $this->gama_media,
        //     "gama_baja" => $this->gama_baja,
        //     "tipo_unidad" => $this->tipo_unidad
        // ];
    }
}
