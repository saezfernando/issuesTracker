<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{

    protected $fillable = [
        'nombre', 'body', 'creador','estado','doc','mime','size','nombre_archivo_original'
    ];

     public function versiones(){

        return $this->hasMany('App\Proceso_version','proceso_id');
    }

     public function ultima_version(){
     	
        return $this->hasMany('App\Proceso_version')->orderBy('version', 'desc')->limit(1);
    }
}
