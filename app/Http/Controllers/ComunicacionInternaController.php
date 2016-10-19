<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

use App\ComunicacionInterna;
use App\TipoComunicacion;

use Illuminate\Database\Eloquent\SoftDeletes;



class comunicacionInternaController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

	public function index() {

	
        $user = Auth::user();

        if($user->can('Leer Comunicación Interna')) {

            $comis = ComunicacionInterna::all();
            $tipos = TipoComunicacion::all();
                        
            return view('comunicacion-interna/index', compact('comis','tipos'));
        }

        return redirect('logout');
	}

public function create() {

        if(Auth::user()->can('Escribir Comunicación Interna')) {

            
            $tipos = TipoComunicacion::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            
            return view('comunicacion-interna/create', compact('tipos'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

  

        //validar los datos
         $this->validate($request, [
        'comunicacion' => 'required|max:255',
            'tipoComunicacion' => 'required',
            'fecha' => 'required|date',
            'dueño' => 'required',
            'contenido' => 'required',
            
         ]);
    

          
   
        if(Auth::user()->can('Escribir Comunicación Interna')) {

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


            $data = ComunicacionInterna::create([
                'comunicacion' =>  $request->input('comunicacion'),
                'tipoComunicacion'  =>  $request->input('tipoComunicacion'),
                'fecha'  =>  $request->input('fecha'),
                'dueño'  =>  $request->input('dueño'),
				'contenido'  =>  $request->input('contenido'),	
                'año'  =>  $request->input('año'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal

            ]);

            $comi = ComunicacionInterna::findOrFail($data->id);

            Session::flash('message', trans('ui.comi.message_create', array('name' => $comi->comunicacion)));

            return redirect('comunicacion-interna');
        }

        return redirect('logout');
    }

    public function edit($id) {

        if(Auth::user()->can('Escribir Comunicación Interna')) {

        	$comunicacionInterna = ComunicacionInterna::findOrFail($id);
            $tipos = TipoComunicacion::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            
            return view('comunicacion-interna/edit', compact('comunicacionInterna','tipos'));
        }

        return redirect('logout');
    }

    public function update($id, Request $request){

            //validar los datos
         	$this->validate($request, [
        	'comunicacion' => 'required|max:255',
            'tipoComunicacion' => 'required',
            'fecha' => 'required|date',
            'dueño' => 'required',
            'contenido' => 'required',
         ]);


            if(Auth::user()->can('Escribir Comunicación Interna')) {

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
				'comunicacion' =>  $request->input('comunicacion'),
                'tipoComunicacion'  =>  $request->input('tipoComunicacion'),
                'fecha'  =>  $request->input('fecha'),
                'dueño'  =>  $request->input('dueño'),
				'contenido'  =>  $request->input('contenido'),	
                'año'  =>  $request->input('año'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal
            );

            $comunicacionInterna = ComunicacionInterna::findOrFail($id);	
            $comunicacionInterna->update($data);

            
            Session::flash('message', trans('ui.comi.message_update', array('name' => $comunicacionInterna->comunicacion)));

            return redirect('comunicacion-interna');
        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Escribir Comunicación Interna')) {

            $comunicacionInterna = ComunicacionInterna::findOrFail($id);

            $comunicacionInterna->delete();	
            //ComunicacionInterna::destroy($id);

            Session::flash('message', trans('ui.comi.message_delete', array('name' => $comunicacionInterna->comunicacion)));

            return redirect('comunicacion-interna');
        }

        return redirect('logout');
    }

    public function file($id) {

        if(Auth::user()->can('Leer Comunicación Interna')) {
            
            //recupera el documento de proceso id
            $comi = ComunicacionInterna::find($id);

            $response = Response::make($comi->doc, 200);
            $response->header('Content-Type',$comi->mime);
            $response->header('Content-Disposition','inline;filename='.$comi->nombre_archivo_original);
            return $response;
        }

        return redirect('logout');
    }

public function show($id) {

		$comunicacionInterna = ComunicacionInterna::find($id);
        return view('comunicacion-interna/show',compact('comunicacionInterna'));

    }

}
