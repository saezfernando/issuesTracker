<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model  implements \MaddHatter\LaravelFullcalendar\Event
{

	use SoftDeletes;

	public $table = "eventos";

    protected $fillable = [
        'titulo', 'fullDay', 'fechaInicio','fechaFin','hora','descripcion','url','user','diaAlerta'];

    public function eventoUser(){

    	return $this->belongsTo('App\User','user');
    }


	protected $dates = ['fechaInicio', 'fechaFin'];
    //protected $dates = ['start', 'end'];

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->titulo;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->fullDay;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->fechaInicio;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        //sumo 1 a la fecha solo con el fin de que se renderize correctamente
        //end date en fullcalendar es exclusivo
        $endDate = new \Carbon\Carbon($this->fechaFin);
        return  $endDate->addDays(1);
    }

    public function getEventOptions()
    {
        return [
           // 'color' => $this->background_color,
            'descripcion' => $this->descripcion,
            'minTime' => $this->hora,
            'url' => $this->url
        ];
    }
    
}
