<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

use App\QuejaReclamo;
use App\EstadoQR;
use App\Responsable;
use App\PNC;


use Illuminate\Database\Eloquent\SoftDeletes;

class QuejaReclamoController extends Controller
{

public function __construct() {

        $this->middleware('auth');
    }

public function index() {

	
        $user = Auth::user();

        if($user->can('Leer Quejas y Reclamos')) {

            $qrs = QuejaReclamo::all();
            $responsables = Responsable::all();
            $estados = EstadoQR::all();
            $pncs = PNC::all();
            

                        
            return view('queja-reclamo/index', compact('qrs','responsables','estados','pncs'));
        }

        return redirect('logout');
	}

public function create() {

        if(Auth::user()->can('Escribir Quejas y Reclamos')) {

            
            $responsables = Responsable::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $estados = EstadoQR::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $pncs = PNC::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            
            return view('queja-reclamo/create', compact('responsables','estados','pncs'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

  

        //validar los datos
         $this->validate($request, [
        'titulo' => 'required'
            
         ]);
    

          
   
        if(Auth::user()->can('Escribir Quejas y Reclamos')) {

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


            $data = QuejaReclamo::create([
                'titulo' =>  $request->input('titulo'),
                'estado'  =>  $request->input('estado'),
                'fechaCreacion'  =>  $request->input('fechaCreacion'),
                'descripcion'  =>  $request->input('descripcion'),
				'responsable'  =>  $request->input('responsable'),	
                'derivadoA'  =>  $request->input('derivadoA'),  
                'solicitante'  =>  $request->input('solicitante'),  
                'datosContacto'  =>  $request->input('datosContacto'),  
                'solucion'  =>  $request->input('solucion'),  
                'fechaImplementacion'  =>  $request->input('fechaImplementacion'),
                'fechaCierre'  =>  $request->input('fechaCierre'),
                'pnc'  =>  $request->input('pnc'),
                'añoCreacion'  =>  $request->input('añoCreacion'),
                'comentarios'  =>  $request->input('comentarios'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal

            ]);

            $qr = QuejaReclamo::findOrFail($data->id);

            Session::flash('message', trans('ui.qr.message_create', array('name' => $qr->titulo)));

            return redirect('queja-reclamo');
        }

        return redirect('logout');
    }

    public function edit($id) {

        if(Auth::user()->can('Escribir Quejas y Reclamos')) {

            $qr = QuejaReclamo::findOrFail($id);
            $responsables = Responsable::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $estados = EstadoQR::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $pncs = PNC::orderBy('descripcion', 'asc')->lists('descripcion', 'id');

            
            return view('queja-reclamo/edit', compact('qr','responsables','estados','pncs'));
        }

        return redirect('logout');
    }

    public function update($id, Request $request){

            //validar los datos
         	$this->validate($request, [
        	'titulo' => 'required'
         ]);


            if(Auth::user()->can('Escribir Quejas y Reclamos')) {

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
                'estado'  =>  $request->input('estado'),
                'fechaCreacion'  =>  $request->input('fechaCreacion'),
                'descripcion'  =>  $request->input('descripcion'),
                'responsable'  =>  $request->input('responsable'),  
                'derivadoA'  =>  $request->input('derivadoA'),  
                'solicitante'  =>  $request->input('solicitante'),  
                'datosContacto'  =>  $request->input('datosContacto'),  
                'solucion'  =>  $request->input('solucion'),  
                'fechaImplementacion'  =>  $request->input('fechaImplementacion'),
                'fechaCierre'  =>  $request->input('fechaCierre'),
                'pnc'  =>  $request->input('pnc'),
                'añoCreacion'  =>  $request->input('añoCreacion'),
                'comentarios'  =>  $request->input('comentarios'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal

            );

            $qr = QuejaReclamo::findOrFail($id);	
            $qr->update($data);

            
            Session::flash('message', trans('ui.qr.message_update', array('name' => $qr->titulo)));

            return redirect('queja-reclamo');
        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Escribir Quejas y Reclamos')) {

            $qr = QuejaReclamo::findOrFail($id);

            $qr->delete();	
            //ComunicacionInterna::destroy($id);

            Session::flash('message', trans('ui.qr.message_delete', array('name' => $qr->titulo)));

            return redirect('queja-reclamo');
        }

        return redirect('logout');
    }

    public function file($id) {

        if(Auth::user()->can('Leer Quejas y Reclamos')) {
            
            //recupera el documento de proceso id
            $qr = QuejaReclamo::find($id);

            $response = Response::make($qr->doc, 200);
            $response->header('Content-Type',$qr->mime);
            $response->header('Content-Disposition','inline;filename='.$qr->nombre_archivo_original);
            return $response;
        }

        return redirect('logout');
    }

public function show($id) {

		$qr = QuejaReclamo::find($id);
        return view('queja-reclamo/show',compact('qr'));

    }

}
