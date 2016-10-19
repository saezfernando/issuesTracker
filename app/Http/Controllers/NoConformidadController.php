<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

use App\NoConformidad;
use App\EstadoNC;
use App\RequisitoIncumple;
use App\CategoriaNC;
use App\OrigenNC;
use App\ProcedimientoOP;
use App\InformeAuditoria;

use Illuminate\Database\Eloquent\SoftDeletes;

class NoConformidadController extends Controller
{

public function __construct() {

        $this->middleware('auth');
    }

public function index() {

	
        $user = Auth::user();

        if($user->can('Leer No Conformidad')) {

            $ncs = NoConformidad::all();
            $estados = EstadoNC::all();
            $categorias = CategoriaNC::all();
            $requisitos = RequisitoIncumple::all();
            $origenes = OrigenNC::all();
            //$calidades = CalidadNC::All();
            $procedimientos = ProcedimientoOP::All();
            //$areas = Area::All();

                        
            return view('no-conformidad/index', compact('ncs','estados','categorias','requisitos','origenes','procedimientos'));
        }

        return redirect('logout');
	}

public function create() {

        if(Auth::user()->can('Escribir No Conformidad')) {

            
            $estados = EstadoNC::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $categorias = CategoriaNC::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            //$tipificaciones = Tipificacion::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $origenes = OrigenNC::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            //$calidades = CalidadNC::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $procedimientos = ProcedimientoOP::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $requisitos = RequisitoIncumple::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            //$areas = Area::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $informeAuditorias = InformeAuditoria::orderBy('numero', 'asc')->lists('numero', 'id');
            
            return view('no-conformidad/create', compact('estados','categorias','requisitos','origenes','procedimientos','informeAuditorias'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {


        //validar los datos
         $this->validate($request, [
        'procedimiento' => 'required',
        'categoria' => 'required',
        'requisitoIncumple' => 'required',
        'descripcion' => 'required',
        'origen' => 'required',
        'estado' => 'required'        
       ]);
    

        if(Auth::user()->can('Escribir No Conformidad')) {

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


            $data = NoConformidad::create([
                'procedimiento' =>  $request->input('procedimiento'),
                'requisitoIncumple'  =>  $request->input('requisitoIncumple'),
                'categoria'  =>  $request->input('categoria'),
                'fechaIntervencion'  =>  $request->input('fechaIntervencion'),  
                'estado'  =>  $request->input('estado'),  
                'descripcion'  =>  $request->input('descripcion'),
                'correccion'  =>  $request->input('correccion'),  
                'fechaImplementacion'  =>  $request->input('fechaImplementacion'),  
                'accionCorrectiva'  =>  $request->input('accionCorrectiva'),  
                'fechaImplementacionAC'  =>  $request->input('fechaImplementacionAC'),  
                'fechaVerificacionAC'  =>  $request->input('fechaVerificacionAC'),
                'origen'  =>  $request->input('origen'),    
                'informeAuditoria'  =>  $request->input('informeAuditoria'),    
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal

            ]);

            $nc = Noconformidad::findOrFail($data->id);

            Session::flash('message', trans('ui.nc.message_create', array('name' => $nc->observacion)));

            return redirect('no-conformidad');
        }

        return redirect('logout');
    }


    public function edit($id) {

            if(Auth::user()->can('Escribir No Conformidad')) {

            $nc = NoConformidad::findOrFail($id);
            $estados = EstadoNC::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $categorias = CategoriaNC::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $requisitos = RequisitoIncumple::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $origenes = OrigenNC::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $procedimientos = ProcedimientoOP::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $informeAuditorias = InformeAuditoria::orderBy('numero', 'asc')->lists('numero', 'id');

            return view('no-conformidad/edit',compact('nc','estados','categorias','requisitos','origenes','procedimientos','informeAuditorias'));
        }


        return redirect('logout');
    }

    public function update($id, Request $request){

            //validar los datos
            $this->validate($request, [
            'procedimiento' => 'required',
            'categoria' => 'required',
            'requisitoIncumple' => 'required',
            'descripcion' => 'required',
            'origen' => 'required',
            'informeAuditoria' => 'required',
            'estado' => 'required'        
         ]);


            if(Auth::user()->can('Escribir No Conformidad')) {

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
                'procedimiento' =>  $request->input('procedimiento'),
                'requisitoIncumple'  =>  $request->input('requisitoIncumple'),
                'categoria'  =>  $request->input('categoria'),
                'fechaIntervencion'  =>  $request->input('fechaIntervencion'),  
                'estado'  =>  $request->input('estado'),  
                'descripcion'  =>  $request->input('descripcion'),
                'correccion'  =>  $request->input('correccion'),  
                'fechaImplementacion'  =>  $request->input('fechaImplementacion'),  
                'accionCorrectiva'  =>  $request->input('accionCorrectiva'),  
                'fechaImplementacionAC'  =>  $request->input('fechaImplementacionAC'),  
                'fechaVerificacionAC'  =>  $request->input('fechaVerificacionAC'),
                'origen'  =>  $request->input('origen'),    
                'informeAuditoria'  =>  $request->input('informeAuditoria'),    
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal
            );

            $nc = NoConformidad::findOrFail($id);   
            $nc->update($data);

            
            Session::flash('message', trans('ui.nc.message_update', array('name' => $nc->descripcion)));

            return redirect('no-conformidad');
        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Escribir No Conformidad')) {

            $nc = NoConformidad::findOrFail($id);

            $nc->delete();	
            //ComunicacionInterna::destroy($id);

            Session::flash('message', trans('ui.nc.message_delete', array('name' => $nc->observacion)));

            return redirect('no-conformidad');
        }

        return redirect('logout');
    }

    public function file($id) {

        if(Auth::user()->can('Leer No Conformidad')) {
            
            //recupera el documento de procedimiento id
            $nc = NoConformidad::find($id);

            $response = Response::make($nc->doc, 200);
            $response->header('Content-Type',$nc->mime);
            $response->header('Content-Disposition','inline;filename='.$nc->nombre_archivo_original);
            return $response;
        }

        return redirect('logout');
    }

public function show($id) {

        $user = Auth::user();

        if($user->can('Leer No Conformidad')) {

            $ia = InformeAuditoria::findOrFail($id);
            $ncs = $ia->noConformidades;
            $estados = EstadoNC::all();
            $categorias = CategoriaNC::all();
            $requisitos = RequisitoIncumple::all();
            $origenes = OrigenNC::all();
            //$calidades = CalidadNC::All();
            $procedimientos = ProcedimientoOP::All();
            //$areas = Area::All();

                        
            return view('no-conformidad/index', compact('ncs','estados','categorias','requisitos','origenes','procedimientos'));
        }

    return redirect('logout');


    }

}
