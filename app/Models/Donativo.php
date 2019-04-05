<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donativo extends Model
{
    protected $table = 'donativos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    public function centro_receptor()
    {
        return $this->belongsTo('App\Models\Centro', 'centros_receptor_id');
    }

    public function centro_desti()
    {
        return $this->belongsTo('App\Models\Centro', 'centros_desti_id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'usuarios_id');
    }

    public function subtipo()
    {
        return $this->belongsTo('App\Models\Subtipo', 'subtipos_id');
    }

    public function donante()
    {
        return $this->belongsTo('App\Models\Donante', 'donantes_id');
    }

    public function animales()
    {
        return $this->belongsToMany('App\Models\Animal', 'animales_donativos', 'animales_id', 'donativos_id');
    }
}
