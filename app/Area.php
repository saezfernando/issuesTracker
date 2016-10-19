<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    

   	use SoftDeletes;

	public $table = "areas";

	protected $fillable = [
        'descripcion'
    ];


     public function users(){

        return $this->hasMany('App\User','area');
    }
}
