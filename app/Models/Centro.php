<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    protected $table = 'centros';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    public function donativo_desti()
    {
        return $this->hasMany('App\Models\Donativo', 'centros_desti_id');
    }

    public function donativo_receptor()
    {
        return $this->hasMany('App\Models\Donativo', 'centros_receptor_id');
    }
}
