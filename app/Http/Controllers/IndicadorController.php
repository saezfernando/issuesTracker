<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Frecuencia;
use App\Indicador;
use App\ProcedimientoOP;
use App\Medida;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Bican\Roles\Models\Role; 
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class IndicadorController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

    public function show($id) {

 
        $user = Auth::user();

        if($user->can('Leer Procedimientos Operativos')) {

            $indicadores = Indicador::where('procedimiento',$id)->get();
           
            $procedimientosValidados = ProcedimientoOP::where('estado','1')->orderBy('titulo', 'asc')->lists('titulo', 'id');
            $idProc = $id;

            return view('indicador/index', compact('indicadores','procedimientosValidados','idProc'));
        }

        return redirect('logout');
    }


	public function index() {

	
        $user = Auth::user();

        if($user->can('Leer Procedimientos Operativos')) {

            $indicadores = Indicador::All();
            //$procedimientos = ProcedimientoOP::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $procedimientosValidados = ProcedimientoOP::where('estado','1')->orderBy('titulo', 'asc')->lists('titulo', 'id');
            $idProc = null;

            return view('indicador/index', compact('indicadores','procedimientosValidados','idProc'));
        }

        return redirect('logout');
	}

    public function create() {

        if(Auth::user()->can('Escribir Procedimientos Operativos')) {

            $frecuencias = Frecuencia::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $medidas = Medida::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $usuarios = User::orderBy('apellido', 'asc')->lists('apellido', 'id');
            //$procedimientos = ProcedimientoOP::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $procedimientosValidados = ProcedimientoOP::where('estado','1')->orderBy('titulo', 'asc')->lists('titulo', 'id');

            $create = true;

            return view('indicador/create',compact('usuarios','frecuencias','procedimientosValidados','medidas','create'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

        //validar los datos
         $this->validate($request, [
        'titulo' => 'required|max:255',
            'responsable' => 'required',
            'fecha' => 'date|required',
            'objetivo' => 'required',
            'actividad' => 'required',
            'indicadorDescripcion' => 'required',
            'frecuencia' => 'required',
        ]);
    
          
   
        if(Auth::user()->can('Escribir Procedimientos Operativos')) {

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

            $data = Indicador::create([
                'titulo' =>  $request->input('titulo'),
                'responsable'  =>  $request->input('responsable'),
                'procedimiento'  =>  $request->input('procedimiento'),
                'actividad'  =>  $request->input('actividad'),
                'fecha'  =>  $request->input('fecha'),
                'frecuencia'  =>  $request->input('frecuencia'),
                'indicadorDescripcion'  =>  $request->input('indicadorDescripcion'),
                'objetivo'  =>  $request->input('objetivo'),
                'resultadosObtenidos'  =>  $request->input('resultadosObtenidos'),
                'observaciones'  =>  $request->input('observaciones'),
                'observacionesDireccionn'  =>  $request->input('observacionesDireccionn'),
                'meta'  =>  $request->input('meta'),
                'formula'  =>  $request->input('formula'),
                'medida'  =>  $request->input('medida'),
                'fuenteInformacion'  =>  $request->input('fuenteInformacion'),
                'enlaceEncuesta'  =>  $request->input('enlaceEncuesta'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal

            ]);


            $indicador = Indicador::findOrFail($data->id);
                
            Session::flash('message', trans('ui.in.message_create', array('name' => $indicador->titulo)));

            return redirect('indicador');
        }

        return redirect('logout');
    }

    public function edit($id) {

        if(Auth::user()->can('Escribir Procedimientos Operativos')) {

            $indicador = Indicador::findOrFail($id);

            $frecuencias = Frecuencia::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $medidas = Medida::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $usuarios = User::orderBy('apellido', 'asc')->lists('apellido', 'id');
            //$procedimientos = ProcedimientoOP::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $procedimientosValidados = ProcedimientoOP::where('estado','1')->orderBy('titulo', 'asc')->lists('titulo', 'id');

            $create = false;

            return view('indicador/edit', compact('indicador', 'frecuencias', 'usuarios','procedimientosValidados','medidas','create'));
        }

        return redirect('logout');
    }

    public function update($id, Request $request){

            //validar los datos
             $this->validate($request, [
            'titulo' => 'required|max:255',
            'responsable' => 'required',
            'fecha' => 'date|required',
            'objetivo' => 'required',
            'actividad' => 'required',
            'indicadorDescripcion' => 'required',
            'frecuencia' => 'required',
            //'doc' => 'required', //Es obligatorio si se cambia la version o revision

            ]);


            if(Auth::user()->can('Escribir Procedimientos Operativos')) {

                $data =  array(
                    'titulo' =>  $request->input('titulo'),
                    'responsable'  =>  $request->input('responsable'),
                    'procedimiento'  =>  $request->input('procedimiento'),
                    'actividad'  =>  $request->input('actividad'),
                    'fecha'  =>  $request->input('fecha'),
                    'frecuencia'  =>  $request->input('frecuencia'),
                    'indicadorDescripcion'  =>  $request->input('indicadorDescripcion'),
                    'objetivo'  =>  $request->input('objetivo'),
                    'resultadosObtenidos'  =>  $request->input('resultadosObtenidos'),
                    'observaciones'  =>  $request->input('observaciones'),
                    'observacionesDireccionn'  =>  $request->input('observacionesDireccionn'),
                    'meta'  =>  $request->input('meta'),
                    'formula'  =>  $request->input('formula'),
                    'medida'  =>  $request->input('medida'),
                    'fuenteInformacion'  =>  $request->input('fuenteInformacion'),
                    'enlaceEncuesta'  =>  $request->input('enlaceEncuesta'),
                    
                );


               if (Input::hasFile('doc'))
               {
                   $mime = Input::file('doc')->getMimeType();
                   $size = Input::file('doc')->getSize();
                   $nombreOriginal = Input::file('doc')->getClientOriginalName();
                   $path = Input::file('doc')->getRealPath();
                   $content = file_get_contents($path);

                   $data['doc'] = $content;
                   $data['mime'] = $mime;
                   $data['size'] = $size;
                   $data['nombre_archivo_original'] = $nombreOriginal;

               }    
               


            $indicador = Indicador::findOrFail($id);

            $indicador->update($data);

            Session::flash('message', trans('ui.in.message_update', array('name' => $indicador->titulo)));

            return redirect('indicador');
        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Escribir Procedimientos Operativos')) {

            $procedimiento = ProcedimientoOP::findOrFail($id);

            ProcedimientoOP::destroy($id);

            Session::flash('message', trans('ui.proc.message_delete', array('name' => $procedimiento->titulo)));

            return redirect('indicador');
        }

        return redirect('logout');
    }


    public function file($id) {

        if(Auth::user()->can('Leer Procedimientos Operativos')) {
            
            //recupera el documento de proceso id
            $indicador = Indicador::find($id);

            $response = Response::make($indicador->doc, 200);
            $response->header('Content-Type',$indicador->mime);
            return $response;
        }

        return redirect('logout');
    }

   public function graficar($id) {

        if(Auth::user()->can('Leer Procedimientos Operativos')) {
            
            //recupera el documento de proceso id
            $indicador = Indicador::find($id);

            $tabla = \Lava::DataTable();  // Lava::DataTable() if using Laravel

            $tabla->addDateColumn('Fecha')
                    ->addNumberColumn('Valor Medido')
                    ->addNumberColumn('Meta');
                        //->addNumberColumn('Official');

            // Cargo los seguimientos del indicador
            /*foreach($indicador->seguimientos as $seguimiento)
            {
                $tabla->addRow([
                  $seguimiento->fecha, $seguimiento->valorIndicador,$indicador->meta
                ]);

            }
            */
 

              $tabla->addRow(['2016-09-10',180,160]);
              $tabla->addRow(['2016-10-10',93,160]);  
              $tabla->addRow(['2016-11-10',192,160]);  
              $tabla->addRow(['2016-12-10',120,160]);  
              $tabla->addRow(['2017-01-10',143,160]);  
              $tabla->addRow(['2017-02-10',156,160]);  

              

            \Lava::ComboChart('indi', $tabla, [
                'title' => 'Seguimiento del Indicador '.$indicador->titulo,
                'hAxis' => ['title' => 'Fecha de Seguimiento'],
                'vAxis' => ['title' => 'Valor Medido'],
                'seriesType' =>'bars',
                'series' => ['1' => ['type' =>'line']]
                ]);
        

        return view('indicador/grafico', compact('Stocks'));
        }

        return redirect('logout');
    }


}