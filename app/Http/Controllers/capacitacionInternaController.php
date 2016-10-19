<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

use App\Area;
use App\CapacitacionInterna;
use App\ProcedimientoOP;
use App\TipoCapacitacion;
use App\EstadoCapacitacion;
use App\MetodoEvaluacion;
use App\EvaluacionCapacitacion;

use Illuminate\Database\Eloquent\SoftDeletes;



class capacitacionInternaController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

	public function index() {

	
        $user = Auth::user();

        if($user->can('Leer Capacitación Interna')) {

            $cis = CapacitacionInterna::all();
            $tipos = TipoCapacitacion::all();
            $procedimiento = ProcedimientoOP::all();	
            $areas = Area::all();
            $estados = EstadoCapacitacion::all();  

            
            return view('capacitacion-interna/index', compact('cis','tipos','procedimiento','areas','estados'));
        }

        return redirect('logout');
	}

public function create() {

        if(Auth::user()->can('Escribir Capacitación Interna')) {

            
            $tipos = TipoCapacitacion::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $procedimientos = ProcedimientoOP::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $areas = Area::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $estados = EstadoCapacitacion::orderBy('descripcion', 'asc')->lists('descripcion', 'id');  
            $metodoEvaluaciones=MetodoEvaluacion::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $evaluacionCapacitaciones = EvaluacionCapacitacion::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            

            return view('capacitacion-interna/create', compact('tipos','areas','estados','metodoEvaluaciones','procedimientos','evaluacionCapacitaciones'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

  

        //validar los datos
         $this->validate($request, [
        'titulo' => 'required|max:255',
            'tipo' => 'required',
            'objetivo' => 'required',
            'procedimiento' => 'required',
            'area' => 'required',
            'estado' => 'required',
            'año' => 'required|integer|min:2005|max:2099',
            'fechaFin' => 'date|after:fechaInicio',
            'fechaInicio' => 'date'


         ]);
    

          
   
        if(Auth::user()->can('Escribir Capacitación Interna')) {

  			//$file = array('image' => Input::file('doc'));
           
        	//controlar si no se cargo file	
           if (Input::hasFile('doc'))
           {
	           $mime = Input::file('doc')->getMimeType();
	           $size = Input::file('doc')->getSize();
	           $nombreOriginal = Input::file('doc')->getClientOriginalName();
	           $path = Input::file('doc')->getRealPath();
	           $content = file_get_contents($path);
           }	
           else
           {
           	   $mime = '';
           	   $size = 0;
           	   $nombreOriginal = '';
           	   $content = null;	
           }


            $data = CapacitacionInterna::create([
                'titulo' =>  $request->input('titulo'),
                'tipo'  =>  $request->input('tipo'),
                'objetivo'  =>  $request->input('objetivo'),
                'disertantes'  =>  $request->input('disertantes'),
				'procedimiento'  =>  $request->input('procedimiento'),	
                'area'  =>  $request->input('area'),
                'fechaInicio'     =>  $request->input('fechaInicio'),
                'fechaFin'  =>  $request->input('fechaFin'),
                'estado'  =>  $request->input('estado'),
                'observaciones'  =>  $request->input('observaciones'),
                'metodoEvaluacionEficacia'  =>  $request->input('metodoEvaluacion'),
                'evaluacionCapacitacion'  =>  $request->input('evaluacionCapacitacion'),
                'responsableEvaluacionEficacia'  =>  $request->input('responsableEvaluacion'),
                'año'  =>  $request->input('año'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal

            ]);

            $ci = CapacitacionInterna::findOrFail($data->id);

            Session::flash('message', trans('ui.ci.message_create', array('name' => $ci->titulo)));

            return redirect('capacitacion-interna');
        }

        return redirect('logout');
    }

    public function edit($id) {

        if(Auth::user()->can('Escribir Capacitación Interna')) {

        	$capacitacionInterna = CapacitacionInterna::findOrFail($id);
            $tipos = TipoCapacitacion::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $procedimientos = ProcedimientoOP::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $areas = Area::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $estados = EstadoCapacitacion::orderBy('descripcion', 'asc')->lists('descripcion', 'id');  
            $metodoEvaluaciones=MetodoEvaluacion::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $evaluacionCapacitaciones = EvaluacionCapacitacion::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            

            return view('capacitacion-interna/edit', compact('capacitacionInterna','tipos', 'procedimientos', 'areas','estados','metodoEvaluaciones','evaluacionCapacitaciones'));
        }

        return redirect('logout');
    }

    public function update($id, Request $request){

            //validar los datos
         	$this->validate($request, [
        	'titulo' => 'required|max:255',
            'tipo' => 'required',
            'objetivo' => 'required',
            'procedimiento' => 'required',
            'area' => 'required',
            'estado' => 'required',
            'año' => 'required|integer|min:2005|max:2099'
         ]);


            if(Auth::user()->can('Escribir Capacitación Interna')) {

			//controlar si no se cargo file	
           if (Input::hasFile('doc'))
           {
	           $mime = Input::file('doc')->getMimeType();
	           $size = Input::file('doc')->getSize();
	           $nombreOriginal = Input::file('doc')->getClientOriginalName();
	           $path = Input::file('doc')->getRealPath();
	           $content = file_get_contents($path);
           }	
           else
           {
           	   $mime = '';
           	   $size = 0;
           	   $nombreOriginal = '';
           	   $content = null;	
           }


            $data = array(
				'titulo' =>  $request->input('titulo'),
                'tipo'  =>  $request->input('tipo'),
                'objetivo'  =>  $request->input('objetivo'),
                'disertantes'  =>  $request->input('disertantes'),
				'procedimiento'  =>  $request->input('procedimiento'),	
                'area'  =>  $request->input('area'),
                'fechaInicio'     =>  $request->input('fechaInicio'),
                'fechaFin'  =>  $request->input('fechaFin'),
                'estado'  =>  $request->input('estado'),
                'observaciones'  =>  $request->input('observaciones'),
                'metodoEvaluacionEficacia'  =>  $request->input('metodoEvaluacion'),
                'EvaluacionCapacitacion'  =>  $request->input('EvaluacionCapacitacion'),
                'responsableEvaluacionEficacia'  =>  $request->input('responsableEvaluacion'),
                'año'  =>  $request->input('año'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal
            );

            $capacitacionInterna = CapacitacionInterna::findOrFail($id);	
            $capacitacionInterna->update($data);

            
            Session::flash('message', trans('ui.ci.message_update', array('name' => $capacitacionInterna->titulo)));

            return redirect('capacitacion-interna');
        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Escribir Capacitación Interna')) {

            $capacitacionInterna = CapacitacionInterna::findOrFail($id);

            $capacitacionInterna->delete();	
            //CapacitacionInterna::destroy($id);

            Session::flash('message', trans('ui.ci.message_delete', array('name' => $capacitacionInterna->titulo)));

            return redirect('capacitacion-interna');
        }

        return redirect('logout');
    }

    public function file($id) {

        if(Auth::user()->can('Leer Capacitación Interna')) {
            
            //recupera el documento de procedimiento id
            $ci = CapacitacionInterna::find($id);

            $response = Response::make($ci->doc, 200);
            $response->header('Content-Type',$ci->mime);
            $response->header('Content-Disposition','inline;filename='.$ci->nombre_archivo_original);
            return $response;
        }

        return redirect('logout');
    }

public function show($id) {

		$capacitacionInterna = CapacitacionInterna::find($id);
        return view('capacitacion-interna/show',compact('capacitacionInterna'));

    }

}
