<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

use DB;
use App\ProcedimientoOP;
use App\InformeAuditoria;
use App\InformeAuditoriaAuditor;
use App\InformeAuditoriaProcedimientoOP;
use App\AreaInteres;
use App\Certificado;
use App\ClasificacionActividad;
use App\Fortaleza;
use App\Auditor;
use App\NivelAuditado;
use App\TipoAuditoria;


use Illuminate\Database\Eloquent\SoftDeletes;

class InformeAuditoriaController extends Controller
{

public function __construct() {

        $this->middleware('auth');
    }

public function index() {

	
        $user = Auth::user();

        if($user->can('Leer Informe Auditoría')) {

            $ias = InformeAuditoria::all();
            $certificados = Certificado::all();
            $tipos = TipoAuditoria::all();
            $clasificaciones = ClasificacionActividad::all();
            $fortalezas = Fortaleza::all();
            $auditores = Auditor::All();
            $niveles = NivelAuditado::All();
            $areas = AreaInteres::All();
            

                        
            return view('informe-auditoria/index', compact('ias','certificados','tipos','clasificaciones','fortalezas','auditores','niveles','areas'));
        }

        return redirect('logout');
	}

public function create() {

        if(Auth::user()->can('Escribir Informe Auditoría')) {

            
            //$certificados = Certificado::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $tipos = TipoAuditoria::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            //$clasificaciones = ClasificacionActividad::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            //$fortalezas = Fortaleza::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $auditores = Auditor::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $niveles = NivelAuditado::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            //$areas = AreaInteres::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $procedimientos = ProcedimientoOP::orderBy('titulo','asc')->lists('titulo','id');
            
            return view('informe-auditoria/create', compact('tipos','auditores','niveles','procedimientos'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

  

        //validar los datos
         $this->validate($request, [
        'numero' => 'required|unique:informeAuditorias',
        'fecha' => 'required',
        'tipo' => 'required',
        'auditorLider' => 'required',
        'nivelAuditado' => 'required',
        'auditorEquipo' => 'required|array|min:1',
        'procedimientos' => 'required|array|min:1',
        ]);
    

          
   
        if(Auth::user()->can('Escribir Informe Auditoría')) {

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

            $data = InformeAuditoria::create([
                'numero' =>  $request->input('numero'),
                'tipo'  =>  $request->input('tipo'),
                'fecha'  =>  $request->input('fecha'),
                'auditorLider'  =>  $request->input('auditorLider'),
				'nivelesAuditados'  =>  $request->input('nivelAuditado'),	
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal

            ]);

            $ia = InformeAuditoria::findOrFail($data->id);

            foreach($request->input('auditorEquipo') as $auditor){
                $data2 = InformeAuditoriaAuditor::create([
                    'auditor' =>  $auditor,
                    'informeAuditoria'  =>  $ia->id,
                ]);
            }

            foreach($request->input('procedimientos') as $procedimiento){
                $data3 = InformeAuditoriaProcedimientoOP::create([
                    'procedimiento' =>  $procedimiento,
                    'informeAuditoria'  =>  $ia->id,
                ]);
            }

            Session::flash('message', trans('ui.ia.message_create', array('name' => $ia->titulo)));
            DB::commit();
   }
catch(\Exception $e){

            Session::flash('error', 'No pudo insertar Informe de auditoría');
            DB::rollback();
}            


            return redirect('informe-auditoria');
        }

        return redirect('logout');
    }

    public function edit($id) {

        if(Auth::user()->can('Escribir Informe Auditoría')) {

            $ia = InformeAuditoria::findOrFail($id);
        	//$certificados = Certificado::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $tipos = TipoAuditoria::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            //$clasificaciones = ClasificacionActividad::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            //$fortalezas = Fortaleza::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $auditores = Auditor::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $niveles = NivelAuditado::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            //$areas = AreaInteres::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $procedimientos = ProcedimientoOP::orderBy('titulo','asc')->lists('titulo','id');

            $informeAuditoriaAuditores = $ia->auditorEquipo->lists('auditor')->toArray();
            $informeAuditoriaProcedimientos = $ia->procedimientos->lists('procedimiento')->toArray();

            
            return view('informe-auditoria/edit', compact('ia','tipos','auditores','niveles','procedimientos','informeAuditoriaProcedimientos','informeAuditoriaAuditores'));
        }

        return redirect('logout');
    }

    public function update($id, Request $request){

            //validar los datos
         	$this->validate($request, [
        	'numero' => 'required|unique:informeAuditorias,numero,'.$id,
            'fecha' => 'required',
            'tipo' => 'required',
            'auditorLider' => 'required',
            'nivelAuditado' => 'required',
            'auditorEquipo' => 'required|array|min:1',
            'procedimientos' => 'required|array|min:1',
            
         ]);


            if(Auth::user()->can('Escribir Informe Auditoría')) {

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
                'numero' =>  $request->input('numero'),
                'tipo'  =>  $request->input('tipo'),
                'fecha'  =>  $request->input('fecha'),
                'auditorLider'  =>  $request->input('auditorLider'),
                'nivelesAuditados'  =>  $request->input('nivelesAuditados'),    
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal
            );

            $ia = InformeAuditoria::findOrFail($id);	

DB::beginTransaction();
try{
            $ia->update($data);

            //Actualizo los equipo de auditores
            foreach($ia->auditorEquipo as $auditor){

                InformeAuditoriaAuditor::destroy($auditor->id);
            }
            foreach($request->input('auditorEquipo') as $auditor){
                $data2 = InformeAuditoriaAuditor::create([
                    'auditor' =>  $auditor,
                    'informeAuditoria'  =>  $ia->id,
                ]);
            }

                  
            //Actualizo los procedimientos asociados
            foreach($ia->procedimientos as $procedimiento){

                InformeAuditoriaProcedimientoOP::destroy($procedimiento->id);
            }
            foreach($request->input('procedimientos') as $procedimiento){
                $data3 = InformeAuditoriaProcedimientoOP::create([
                    'procedimiento' =>  $procedimiento,
                    'informeAuditoria'  =>  $ia->id,
                ]);
            }



            Session::flash('message', trans('ui.ia.message_update', array('name' => $ia->numero)));
            DB::commit();
}
catch(\Exception $e){

            Session::flash('error', 'No se pudo editar Informe de auditoría');
            DB::rollback();

}
            return redirect('informe-auditoria');
        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Escribir Informe Auditoría')) {

            $ia = InformeAuditoria::findOrFail($id);

            $ia->delete();	
            //ComunicacionInterna::destroy($id);

            Session::flash('message', trans('ui.ia.message_delete', array('name' => $ia->titulo)));

            return redirect('informe-auditoria');
        }

        return redirect('logout');
    }

    public function file($id) {

        if(Auth::user()->can('Leer Informe Auditoría')) {
            
            //recupera el documento de proceso id
            $ia = InformeAuditoria::find($id);

            $response = Response::make($ia->doc, 200);
            $response->header('Content-Type',$ia->mime);
            $response->header('Content-Disposition','inline;filename='.$ia->nombre_archivo_original);
            return $response;
        }

        return redirect('logout');
    }

public function show($id) {

		$ia = InformeAuditoria::find($id);
        return view('informe-auditoria/show',compact('ia'));

    }

}
