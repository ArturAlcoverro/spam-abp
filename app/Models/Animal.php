<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $table = 'animales';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    public function donativo()
    {
        return $this->belongsToMany('App\Models\Donativo', 'animales_donativos', 'animales_id', 'donativos_id');
    }

    public function donante()
    {
        return $this->belongsToMany('App\Models\Donante', 'donantes_animales', 'donantes_id', 'animales_id');
    }
}
