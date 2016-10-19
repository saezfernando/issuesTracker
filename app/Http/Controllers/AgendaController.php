<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Evento;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
class AgendaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
	public function index() {
	
        $user = Auth::user();
        if($user->can('Gestionar Agenda')) {
         	// mostrar eventos de la BD 
         	$eventos = Evento::all();
/*
            $eventos[] = \Calendar::event(
			    "Valentine's Day", //event title
			    true, //full day event?
			    '2016-09-14', //start time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg)
			    '2016-09-14', //end time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg),
			    1, //optional event ID
			    [
			        //'url' => 'http://full-calendar.io',
			        'eventStartEditable' => 'true',
			        'minTime' => '10:00',
            		'maxTime' => '22:00',
            		'color' => '#43ac6a',
            		'description' => 'fosbfsnfnslkdnfsdnfknsdf fsfafdf'
			    ]
			);
			 $eventos[] = \Calendar::event(
			    "Día de la Bandera", //event title
			    true, //full day event?
			    '2016-09-17', //start time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg)
			    '2016-09-17', //end time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg),
			    1, //optional event ID
			    [
			        'url' => 'http://full-calendar.io',
			        'eventStartEditable' => 'true',
			        'minTime' => '10:00',
            		'maxTime' => '22:00',
            		'color' => '#43ac6a',
            		'description' => 'segundo evento'
			    ]
			);
  */             
            $agenda = \Calendar::addEvents($eventos)->setCallbacks([
  			'eventClick' =>  "function(event, jsEvent, view) {

                $('#modalTitle').html(event.title);
                var message = '<h4> Día: ' + moment(event.start).format('L') + '</h4>';
                message += '<h4> Hora: ' + event.minTime + 'hs ' + '</h4>';
                message += '<h4> Descripción: ' + event.descripcion + '</h4>';
                message += '<h4> URL: <a href=' + event.url +  '>' + event.url + '</h4>';
    			
                $('#modalBody').html(message);
                $('#fullCalModal').modal();
                if (event.url) {//cancela que se dispare la url
                   return false;
                }
            	}",
               'dayClick' => "function(date) {
    			$('#modalForm #fechaInicio').val(date.format());
    			$('#modalForm').modal();
           }"
        	]); 
          
//  message += '<h4> URL: <a href="' + event.url + '">' + event.url + '</a></h4>';
            $agenda->setId('calidad');     
            return view('agenda/index', compact('agenda'));
        }
        return redirect('401');
	}
	public function store(Request $request) {
        //validar los datos
         $this->validate($request, [
	        'titulo' => 'required|max:255',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'after:fechaInicio|date',
            'descripcion' => 'required'
           ]);


        if($request->input('fechaFin')==null){
        	$fechaFin = $request->input('fechaInicio');
        } 	
        else{
        	$fechaFin = $request->input('fechaFin');
        }

        try{
            if(Auth::user()->can('Gestionar Agenda')) {
                $data = Evento::create([
                    'titulo' =>  $request->input('titulo'),
                    'fechaInicio'  =>  $request->input('fechaInicio'),
                    'fechaFin'  =>  $fechaFin,
                    'descripcion'  =>  $request->input('descripcion'),
    				'hora'  =>  $request->input('hora'),	
                    'url'     =>  $request->input('url'),
                    'user'     =>  Auth::user()->id
                    
                ]);
                $evento = Evento::findOrFail($data->id);
                Session::flash('message', trans('ui.ci.message_create', array('name' => $evento->titulo)));
            }
        }    
        catch(\Exception $e){
             Session::flash('error', 'No se pudo agregar el nuevo Evento');
        }
        finally{
             return redirect('agenda');
        }
        return redirect('logout');
    }
}