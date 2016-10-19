<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\EstadoP;
use App\Certificado;

use App\ProcedimientoOP;
use App\ProcedimientoOPVersion;

use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Bican\Roles\Models\Role; 
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ProcedimientoOPVersionController extends Controller
{
        public function __construct() {

        $this->middleware('auth');
    }

	public function index($id) {

		$user = Auth::user();

        $procedimiento = ProcedimientoOP::findOrFail($id);

        if($user->can('Leer Procedimientos Operativos')) {

           return view('procedimiento-operativo/version/index', compact('procedimiento'));
        }

        return redirect('logout');
	}

	public function store(Request $request) {

        //validar los datos
         $this->validate($request, [
            'estado' => 'required',
            'doc' => 'required',
        ],['doc.required'=>'Datos Adjuntos Obligatorios']);
    
             
        if(Auth::user()->can('Escribir Procedimientos Operativos')) {

           //$file = array('image' => Input::file('doc'));
           $mime = Input::file('doc')->getMimeType();
           $size = Input::file('doc')->getSize();
           $nombreOriginal = Input::file('doc')->getClientOriginalName();

            $path = Input::file('doc')->getRealPath();
    
            $content = file_get_contents($path);

            $now = \Carbon\Carbon::now();	

            $data = ProcedimientoOPVersion::create([
                'procedimiento' =>  $request->input('procedimiento'),
                'estado'  =>  $request->input('estado'), 
                'version'  =>  $request->input('version'),
                'revision'  =>  $request->input('revision'),
                'fechaRevision'  =>  $now,
                'revisadoPor'  =>  Auth::user()->id, //1
                'modificaciones'  =>  $request->input('modificaciones'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal
            ]);


            $procedimientoVersion = ProcedimientoOPVersion::findOrFail($data->id);

                
            Session::flash('message', trans('ui.proc.message_create', array('name' => $procedimientoVersion->version .'.'.$procedimientoVersion->revision)));

            return redirect('procedimiento-operativo-version/'.$procedimientoVersion->procedimiento);
        }

        return redirect('logout');
    }


public function update($id,Request $request) {

    if(Auth::user()->can('Escribir Procedimientos Operativos')) {

        //En el caso de querer validar
		if( $request->input('estado')==1){  
			
			$data =  array(
                'estado'  =>  1, 
              	'validadoPor' => Auth::user()->id,
                'fechaValidacion' => \Carbon\Carbon::now()->toDateString()
            );

                
DB::beginTransaction();
            try{
                
            
                $procedimientoVersion = ProcedimientoOPVersion::findOrFail($id);

                //Si existe Actualiza version anterior a Obsoleto
                $procedimiento = ProcedimientoOP::findOrFail($procedimientoVersion->procedimiento);



                //verifico si hay alguna versión validada para este pocedimiento
                if ($procedimiento->ultimaVersionValidada->count()==1){
                    //ultima version validada la marco como obsoleta    
                    $ultimaVersion = $procedimiento->ultimaVersionValidada[0];
                    $ultimaVersion->estado = 4;
                    $ultimaVersion->update();
                }

                
                //Actuliza version a Validado
                $procedimientoVersion->update($data); 



                //Actualiza procedimiento para tener disponible última versión            
                $data2 =  array(
                    'estado'  =>  1, 
                  	'version' =>  $procedimientoVersion->version,
                  	'revision' => $procedimientoVersion->revision,
                  	'doc' => $procedimientoVersion->doc,
    	            'mime' => $procedimientoVersion->mime,
    	            'size' => $procedimientoVersion->size,
    	            'nombre_archivo_original' => $procedimientoVersion->nombre_archivo_original

                );
    			$procedimiento->update($data2);

                DB::commit();    


                Session::flash('message', trans('ui.proc.message_create', array('name' => $procedimientoVersion->version .'.'.$procedimientoVersion->revision)));
            }
            catch(\Exception $e){
                 Session::flash('error','No se pudo Actualizar la versión del Procedimiento');   
                 DB::rollback();
            }
            finally{
                return redirect('procedimiento-operativo-version/'.$procedimientoVersion->procedimiento);
            }

		}
		else{


                $this->validate($request, [
                        'estado' => 'required',
                        'doc' => 'required',
                ],['doc.required'=>'Datos Adjuntos Obligatorios']);


                $fechaRevision = null;
                $revisadoPor = null;

               //En el caso de querer asentar revision
               if( $request->input('estado')==2){
                    //configuramos los datos de revisión    
                     $now = \Carbon\Carbon::now();  
                     $fechaRevision =  $now;
                     $revisadoPor =  Auth::user()->id;
                
                }

	           //$file = array('image' => Input::file('doc'));
	           $mime = Input::file('doc')->getMimeType();
	           $size = Input::file('doc')->getSize();
	           $nombreOriginal = Input::file('doc')->getClientOriginalName();

	           $path = Input::file('doc')->getRealPath();
	           $content = file_get_contents($path);

	           $data =  array(
	                'estado'  =>  $request->input('estado'), 
	                'modificaciones'  =>  $request->input('modificaciones'),
                    'fechaRevision' => $fechaRevision,
                    'revisadoPor' => $revisadoPor,
	                'doc' => $content,
	                'mime' => $mime,
	                'size' => $size,
	                'nombre_archivo_original' => $nombreOriginal
	            );

DB::beginTransaction();

            try{
                $procedimientoVersion = ProcedimientoOPVersion::findOrFail($id);
                $procedimientoVersion->update($data);

                $procedimiento = ProcedimientoOP::findOrFail($procedimientoVersion->procedimiento);

                //Si no existe ultima version validada actualizo procedimiento para tener datos actualizados
                if($procedimiento->ultimaVersionValidada->count()==0){
                    $data2 =  array(
                        'estado'  =>  $procedimientoVersion->estado, 
                        'version' =>  $procedimientoVersion->version,
                        'revision' => $procedimientoVersion->revision,
                        'doc' => $procedimientoVersion->doc,
                        'mime' => $procedimientoVersion->mime,
                        'size' => $procedimientoVersion->size,
                        'nombre_archivo_original' => $procedimientoVersion->nombre_archivo_original

                    );
                    $procedimiento->update($data2);    
                }
                DB::commit();

                Session::flash('message', trans('ui.proc.message_create', array('name' => $procedimientoVersion->version .'.'.$procedimientoVersion->revision)));
            }
            catch(\Exception $e){
                 Session::flash('error','No se pudo Actualizar la versión del Procedimiento');   
                 DB::rollback();
            }
            finally{
                return redirect('procedimiento-operativo-version/'.$procedimientoVersion->procedimiento);
            }

        }//fin del else

    }//fin de auth    

    return redirect('logout');

}//fin de function

    public function destroy($id) {
            //Se encarga de descartar una version en revision

        if(Auth::user()->can('Borrar Procedimientos Operativos')) {


            $procedimientoVersion = ProcedimientoOPVersion::findOrFail($id);
            $procedimiento = ProcedimientoOP::findOrFail($procedimientoVersion->procedimiento);

            //Si existe al menos una version validada, Elimino la versión a descartar, sino se pasa a borrador
            if ($procedimiento->ultimaVersionValidada->count()==1){                
                ProcedimientoOPVersion::destroy($id);
                Session::flash('message','Se descarto la última versión no validada correctamente');
                return redirect('procedimiento-operativo-version'.'/'.$procedimientoVersion->procedimiento);
            }
            else{
                //Paso a borrador (también seteo a null los datos de revisión)

DB::beginTransaction();
                try{
                    $data = array('estado' => 3,
                        'revisadoPor' => null,
                        'fechaRevision' => null
                        );
                    
                    $procedimientoVersion->update($data);

                    $procedimiento->estado = '3';
                    $procedimiento->update();    

                    DB::commit();

                    Session::flash('message', 'La versión del procedimiento no puede ser descartada por que no existe un proc. válido aún. La versión será pasada a estado Borrador');

                }
                catch(\Exception $e){
                     Session::flash('error','No se pudo Actualizar la versión del Procedimiento');   
                     DB::rollback();
                }
                finally{
                    return redirect('procedimiento-operativo-version'.'/'.$procedimientoVersion->procedimiento);
                }
            }//fin else

        }//fin if
        return redirect('logout');
    }//fin function


}
