<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    public $table = "certificados";

    protected $fillable = [
        'descripcion'
    ];

    public function procedimientos(){

        return $this->hasMany('App\ProcedimientoOP','certificado');
    }
}
