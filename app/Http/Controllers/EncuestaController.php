<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

use DB;
use App\Encuesta;
use App\ProcedimientoOP;

use Illuminate\Database\Eloquent\SoftDeletes;



class EncuestaController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

	public function index() {

	
        $user = Auth::user();

        if($user->can('Leer Encuesta')) {

            $encs = Encuesta::all();
                                    
            return view('encuesta/index', compact('encs'));
        }

        return redirect('logout');
	}

public function create() {

        if(Auth::user()->can('Escribir Encuesta')) {

            
            
            $procedimientos = ProcedimientoOP::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $create = true;
                        
            return view('encuesta/create', compact('procedimientos','create'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

  

        //validar los datos
         $this->validate($request, [
            'nombre' => 'required',
            'periodo' => 'required',
            'procedimiento' => 'required',
            'tratamientoDesfavorable' => 'required',
            
         ]);
    

          
   
        if(Auth::user()->can('Escribir Encuesta')) {

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

try{
            $data = Encuesta::create([
                'nombre' => $request->input('nombre'),
                'periodo'  =>  $request->input('periodo'),
                'procedimiento'  =>  $request->input('procedimiento'),
                'porcentajeSatisfaccion'  =>  $request->input('porcentajeSatisfaccion'),
				'tratamientoDesfavorable'  =>  $request->input('tratamientoDesfavorable'),	
                'porcentaje'  =>  $request->input('porcentaje'),
                'causa'  =>  $request->input('causa'),
                'accionCorrectiva'  =>  $request->input('accionCorrectiva'),
                'enlaceEncuesta'  =>  $request->input('enlaceEncuesta'),
                'enlaceReporte'  =>  $request->input('enlaceReporte'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal

            ]);

            $enc = Encuesta::findOrFail($data->id);

            Session::flash('message', trans('ui.enc.message_create', array('name' => $enc->nombre)));
    }
catch(\Exception $e){

            Session::flash('error', 'No pudo insertar Encuesta');
}            

            return redirect('encuesta');
        }

        return redirect('logout');
    }

    public function edit($id) {

        if(Auth::user()->can('Escribir Encuesta')) {

        	$encuesta = Encuesta::findOrFail($id);
            $procedimientos = ProcedimientoOP::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $create = false;
            
            
            return view('encuesta/edit', compact('procedimientos','encuesta','create'));
        }

        return redirect('logout');
    }

    public function update($id, Request $request){

            //validar los datos
         	$this->validate($request, [
            'nombre' => 'required',
            'periodo' => 'required',
            'procedimiento' => 'required',
            'tratamientoDesfavorable' => 'required',
         ]);


            if(Auth::user()->can('Escribir Encuesta')) {

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
                'nombre' => $request->input('nombre'),
                'periodo'  =>  $request->input('periodo'),
                'procedimiento'  =>  $request->input('procedimiento'),
                'porcentajeSatisfaccion'  =>  $request->input('porcentajeSatisfaccion'),
                'tratamientoDesfavorable'  =>  $request->input('tratamientoDesfavorable'),  
                'porcentaje'  =>  $request->input('porcentaje'),
                'causa'  =>  $request->input('causa'),
                'accionCorrectiva'  =>  $request->input('accionCorrectiva'),
                'enlaceEncuesta'  =>  $request->input('enlaceEncuesta'),
                'enlaceReporte'  =>  $request->input('enlaceReporte'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal
            );

            $encuesta = Encuesta::findOrFail($id);	

try{
            $encuesta->update($data);
            Session::flash('message', trans('ui.enc.message_update', array('name' => $encuesta->nombre)));

}
catch(\Exception $e){

            Session::flash('error', 'No se pudo editar Encuesta de Satisfacción');
}

            return redirect('encuesta');
        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Escribir Encuesta')) {

            $encuesta = Encuesta::findOrFail($id);

            $encuesta->delete();	
            //CapacitacionInterna::destroy($id);

            Session::flash('message', trans('ui.enc.message_delete', array('name' => $encuesta->nombre)));

            return redirect('encuesta');
        }

        return redirect('logout');
    }

    public function file($id) {

        if(Auth::user()->can('Leer Encuesta')) {
            
            //recupera el documento de procedimiento id
            $enc = Encuesta::find($id);

            $response = Response::make($enc->doc, 200);
            $response->header('Content-Type',$enc->mime);
            $response->header('Content-Disposition','inline;filename='.$enc->nombre_archivo_original);
            return $response;
        }

        return redirect('logout');
    }

public function show($id) {

		$encuesta = Encuesta::find($id);
        return view('encuesta/show',compact('encuesta'));

    }

}
