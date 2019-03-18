<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    public function rol()
    {
        return $this->belongsTo('App\Models\Rol', 'roles_id');
    }

    public function donativo()
    {
        return $this->hasMany('App\Models\Donativo', 'usuarios_id');
    }
}
