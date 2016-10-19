<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

use DB;
use App\PropuestaMejora;
use App\ProcedimientoOP;
use App\PropuestaMejoraProcedimientoOP;
use App\EstadoPM;

use Illuminate\Database\Eloquent\SoftDeletes;



class PropuestaMejoraController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

	public function index() {

	
        $user = Auth::user();

        if($user->can('Leer Propuesta Mejora')) {

            $pms = PropuestaMejora::all();
            $procedimiento = ProcedimientoOP::all();	
            $estados = EstadoPM::all();  

            
            return view('propuesta-mejora/index', compact('pms','procedimiento','estados'));
        }

        return redirect('logout');
	}

public function create() {

        if(Auth::user()->can('Escribir Propuesta Mejora')) {

            
            
            $procedimientos = ProcedimientoOP::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $estados = EstadoPM::orderBy('descripcion', 'asc')->lists('descripcion', 'id');  
            
            return view('propuesta-mejora/create', compact('tipos','areas','estados','metodoEvaluaciones','procedimientos','evaluacionCapacitaciones'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

  

        //validar los datos
         $this->validate($request, [
            'propuestaImplementar' => 'required',
            'recursosNecesarios' => 'required',
            'procedimientos' => 'required|array|min:1',
            'fecha' => 'required|date',
            'estado' => 'required',
            'accionRealizada' => 'required',

         ]);
    

          
   
        if(Auth::user()->can('Escribir Propuesta Mejora')) {

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

DB::beginTransaction();
try{

            $data = PropuestaMejora::create([
                'propuestaImplementar' => $request->input('propuestaImplementar'),
                'recursosNecesarios'  =>  $request->input('recursosNecesarios'),
                'estado'  =>  $request->input('estado'),
                'fecha'  =>  $request->input('fecha'),
				'fechaImplementacionEstimada'  =>  $request->input('fechaImplementacionEstimada'),	
                'accionRealizada'  =>  $request->input('accionRealizada'),
                'año'  =>  $request->input('año'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal

            ]);

            $pm = PropuestaMejora::findOrFail($data->id);

            foreach($request->input('procedimientos') as $procedimiento){
                            $data3 = PropuestaMejoraProcedimientoOP::create([
                                'procedimiento' =>  $procedimiento,
                                'propuestaMejora'  =>  $pm->id,
                            ]);
                        }

            Session::flash('message', trans('ui.pm.message_create', array('name' => $pm->propuestaImplementar)));
            DB::commit();
               }
catch(\Exception $e){

            Session::flash('error', 'No pudo insertar Propuesta de Mejora');
            DB::rollback();
}            

            return redirect('propuesta-mejora');
        }

        return redirect('logout');
    }

    public function edit($id) {

        if(Auth::user()->can('Escribir Propuesta Mejora')) {

        	$propuestaMejora = PropuestaMejora::findOrFail($id);
            $procedimientos = ProcedimientoOP::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $estados = EstadoPM::orderBy('descripcion', 'asc')->lists('descripcion', 'id');  
            $propuestaMejoraProcedimientos =  $propuestaMejora->procedimientos->lists('procedimiento')->toArray();
            
            return view('propuesta-mejora/edit', compact('propuestaMejora', 'procedimientos','estados','propuestaMejoraProcedimientos'));
        }

        return redirect('logout');
    }

    public function update($id, Request $request){

            //validar los datos
         	$this->validate($request, [
            'propuestaImplementar' => 'required',
            'recursosNecesarios' => 'required',
            'procedimientos' => 'required|array|min:1',
            'fecha' => 'required|date',
            'estado' => 'required',
            'accionRealizada' => 'required',
         ]);


            if(Auth::user()->can('Escribir Propuesta Mejora')) {

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
                'propuestaImplementar' =>  $request->input('propuestaImplementar'),
                'recursosNecesarios'  =>  $request->input('recursosNecesarios'),
                'estado'  =>  $request->input('estado'),
                'fecha'  =>  $request->input('fecha'),
                'fechaImplementacionEstimada'  =>  $request->input('fechaImplementacionEstimada'),  
                'accionRealizada'  =>  $request->input('accionRealizada'),
                'año'  =>  $request->input('año'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal

            );

            $PropuestaMejora = PropuestaMejora::findOrFail($id);	

DB::beginTransaction();
try{
            $PropuestaMejora->update($data);

            //Actualizo los procedimientos asociados
            foreach($PropuestaMejora->procedimientos as $procedimiento){

                PropuestaMejoraProcedimientoOP::destroy($procedimiento->id);
            }
            foreach($request->input('procedimientos') as $procedimiento){
                $data3 = PropuestaMejoraProcedimientoOP::create([
                    'procedimiento' =>  $procedimiento,
                    'propuestaMejora'  =>  $PropuestaMejora->id,
                ]);
            }



            Session::flash('message', trans('ui.pm.message_update', array('name' => $PropuestaMejora->propuestaImplementar)));
            DB::commit();
}
catch(\Exception $e){

            Session::flash('error', 'No se pudo editar Informe de auditoría');
            DB::rollback();

}

            return redirect('propuesta-mejora');
        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Escribir Propuesta Mejora')) {

            $PropuestaMejora = PropuestaMejora::findOrFail($id);

            $PropuestaMejora->delete();	
            //CapacitacionInterna::destroy($id);

            Session::flash('message', trans('ui.pm.message_delete', array('name' => $PropuestaMejora->propuestaImplementar)));

            return redirect('propuesta-mejora');
        }

        return redirect('logout');
    }

    public function file($id) {

        if(Auth::user()->can('Leer Propuesta Mejora')) {
            
            //recupera el documento de procedimiento id
            $pm = PropuestaMejora::find($id);

            $response = Response::make($pm->doc, 200);
            $response->header('Content-Type',$pm->mime);
            $response->header('Content-Disposition','inline;filename='.$pm->nombre_archivo_original);
            return $response;
        }

        return redirect('logout');
    }

public function show($id) {

		$propuestaMejora = PropuestaMejora::find($id);
        return view('propuesta-mejora/show',compact('propuestaMejora'));

    }

}
