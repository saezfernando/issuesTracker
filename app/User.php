<?php

/* anterior a modificarlo por rol
namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
 */
namespace App;

use App\Notification; 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

//para implementar notificaciones
use Michaeljennings\Feed\Contracts\Notifiable as NotifiableContract;
use Michaeljennings\Feed\Notifications\Notifiable;

class User extends Authenticatable implements HasRoleAndPermissionContract, NotifiableContract
{
use HasRoleAndPermission, Notifiable;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','apellido', 'dni','telefono','area', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function notificaciones(){

        return $this->hasMany('App\Notification','notifiable_id');
    }

    public function nombreCompleto(){

        return $this->apellido . ', ' . $this->nombre;
    }  

    public function areaDescripcion(){

        return $this->belongsTo('App\Area','area');
    }
}
