<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    function static getDocumentosPorDirectorio($dir){

    	return ['documento1IRAM.pdf','documento2IRAM.pdf','documento3IRAM.pdf','documento44IRAM.pdf'];
    }
}
