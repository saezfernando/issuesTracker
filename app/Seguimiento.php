<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seguimiento extends Model
{

	use SoftDeletes;

	public $table = "seguimientos";


    protected $fillable = [
        'indicador', 'fecha', 'valorIndicador','analisis','acciones',
        'doc','mime','size','nombre_archivo_original'
    ];

    public function indicadorDescripcion(){

        return $this->belongsTo('App\Indicador','indicador');
    }


}
