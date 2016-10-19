<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\EstadoP;
use App\Certificado;

use App\ProcedimientoOP;
use App\ProcedimientoOPVersion;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Bican\Roles\Models\Role; 
use Illuminate\Http\Request;
use DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class ProcedimientoOPController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

	public function index() {

	
        $user = Auth::user();

        if($user->can('Leer Procedimientos Operativos')) {

            $procedimientos = ProcedimientoOP::with('versiones')->get();
            /*
            $procesos = Proceso::with(['versiones' => function($query){
                $query->orderBy('version','desc');   
                $query->take(1);
            }])->get();
            */

            $procedimientos->map(function($procedimiento){
              $procedimiento->versiones = $procedimiento->versiones()->orderBy('version','desc')->take(1);
              return $procedimiento;      
            });    


            return view('procedimiento-operativo/index', compact('procedimientos'));
        }

        return redirect('logout');
	}

    public function create() {

        if(Auth::user()->can('Escribir Procedimientos Operativos')) {

            $estados = EstadoP::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $usuarios = User::select('id', DB::raw('CONCAT(apellido, ", ", nombre) AS nombreCompleto'))
            ->orderBy('apellido')
            ->lists('nombreCompleto', 'id');

            $certificados = Certificado::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $create = true;

            return view('procedimiento-operativo/create',compact('usuarios','certificados','estados','create'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

        //validar los datos
         $this->validate($request, [
        'titulo' => 'required|max:255',
            'dueño' => 'required',
            'codigo' => 'required',
            'certificado' => 'required',
            'fechaEmision' => 'date|required',
            'estado' => 'required',  
            'doc' => 'required'
        ],['doc.required'=>'Datos Adjuntos Obligatorios']);
    
          
   
        if(Auth::user()->can('Escribir Procedimientos Operativos')) {

           //$file = array('image' => Input::file('doc'));
           $mime = Input::file('doc')->getMimeType();
           $size = Input::file('doc')->getSize();
           $nombreOriginal = Input::file('doc')->getClientOriginalName();

           $path = Input::file('doc')->getRealPath();
           $content = file_get_contents($path);


DB::beginTransaction();
            try{
                

                    //Inserto los datos del procedimiento
                    $data = ProcedimientoOP::create([
                    'titulo' =>  $request->input('titulo'),
                    'dueño'  =>  $request->input('dueño'), //Auth::user()->id
                    'codigo'  =>  $request->input('codigo'),
                    'certificado'  =>  $request->input('certificado'),
                    'fechaEmision'  =>  $request->input('fechaEmision'),
                    'version'  =>  1, //1
                    'revision'  =>  1, //1
                    'estado'  =>  $request->input('estado'),
                    'doc' => $content,
                    'mime' => $mime,
                    'size' => $size,
                    'nombre_archivo_original' => $nombreOriginal

                ]);

                $procedimiento = ProcedimientoOP::findOrFail($data->id);

                //Si es para revision configuro los datos de revision    
                if ($request->input('estado') == 2){
                    $fechaRevision = $request->input('fechaEmision');
                    $revisadoPor = Auth::user()->id;
                }
                else{
                    $fechaRevision = null;
                    $revisadoPor = null;
                }   


                $data2 = ProcedimientoOPVersion::create([
                    'procedimiento' => $procedimiento->id,
                    'version' => 1, //1,
                    'revision' => 1, //1,
                    'estado' => $request->input('estado'),
                    'fechaRevision' => $fechaRevision,
                    'revisadoPor' => $revisadoPor,
                    'modificaciones' => null,
                    'validadoPor' => null,
                    'fechaValidacion' => null,
                    'doc' => $content,
                    'mime' => $mime,
                    'size' => $size,
                    'nombre_archivo_original' => $nombreOriginal
                ]);

                    
                Session::flash('message', trans('ui.proc.message_create', array('name' => $procedimiento->titulo)));
                DB::commit();
            }
            catch(\Exception $e){
                 Session::flash('error','No se pudo agregar el Procedimiento'.$e->getMessage());   
                 DB::rollback();
            }
            finally{
            return redirect('procedimiento-operativo');
            }
        }

        return redirect('logout');
    }

    public function edit($id) {

        if(Auth::user()->can('Escribir Procedimientos Operativos')) {

            $procedimiento = ProcedimientoOP::findOrFail($id);

            $estados = EstadoP::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $usuarios = User::select('id', DB::raw('CONCAT(apellido, ", ", nombre) AS nombreCompleto'))
            ->orderBy('apellido')
            ->lists('nombreCompleto', 'id');
            $certificados = Certificado::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $create = false;

            return view('procedimiento-operativo/edit', compact('procedimiento', 'estados', 'usuarios','certificados','create'));
        }

        return redirect('logout');
    }

    public function update($id, Request $request){

            //validar los datos
             $this->validate($request, [
            'titulo' => 'required|max:255',
            'dueño' => 'required',
            'codigo' => 'required',
            'certificado' => 'required',
            'fechaEmision' => 'date|required',

            //'doc' => 'required', //Es obligatorio si se cambia la version o revision

            ]);


            if(Auth::user()->can('Escribir Procedimientos Operativos')) {

            $data =  array(
                'titulo' =>  $request->input('titulo'),
                'dueño'  =>  $request->input('dueño'), //Auth::user()->id
                'codigo'  =>  $request->input('codigo'),
                'certificado'  =>  $request->input('certificado'),
                'fechaEmision'  =>  $request->input('fechaEmision'),
            );

            $procedimiento = ProcedimientoOP::findOrFail($id);

            $procedimiento->update($data);

            Session::flash('message', trans('ui.proc.message_update', array('name' => $procedimiento->titulo)));

            return redirect('procedimiento-operativo');
        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Borrar Procedimientos Operativos')) {

            $procedimiento = ProcedimientoOP::findOrFail($id);

            ProcedimientoOP::destroy($id);

            Session::flash('message', trans('ui.proc.message_delete', array('name' => $procedimiento->titulo)));

            return redirect('procedimiento-operativo');
        }

        return redirect('logout');
    }


    public function file($id) {

        if(Auth::user()->can('Leer Procedimientos Operativos')) {
            
            //recupera el documento de proceso id
            $procedimientoVersion = ProcedimientoOPVersion::find($id);

            $response = Response::make($procedimientoVersion->doc, 200);
            $response->header('Content-Type',$procedimientoVersion->mime);
            return $response;
        }

        return redirect('logout');
    }

   public function tablero() {

        if(Auth::user()->can('Leer Tablero')) {
            
            //recupera el documento de proceso id
            $procedimientos = ProcedimientoOP::All();
            $certificados = Certificado::All();
            
            $proc = [];
            foreach($certificados as $certificado){
                //$proc[] = $certificado->procedimientos->count();
                $indi = 0;        
                foreach($certificado->procedimientos as $procedimiento){
                    $indi += $procedimiento->indicadores->count();        
                }
                $proc[] = $indi;
            }


        return view('procedimiento-operativo/tablero', compact('proc','certificados'));
        }

        return redirect('logout');
    }




}