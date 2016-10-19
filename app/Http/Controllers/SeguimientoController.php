<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Indicador;
use App\Seguimiento;
use DB;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Bican\Roles\Models\Role; 
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class SeguimientoController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

    public function show($id) {

    
        $user = Auth::user();

        if($user->can('Leer Seguimiento')) {

            $seguimientos = Seguimiento::where('indicador',$id)->get();
            //$indicadores = Indicador::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $indicadores = Indicador::select('id',DB::raw('CONCAT(titulo, " Meta:", meta) AS tituloMeta'))->lists('tituloMeta','id');
            $idIndicador = $id;

            return view('seguimiento/index', compact('seguimientos','indicadores','idIndicador'));
        }

        return redirect('logout');
    }


	public function index() {

	
        $user = Auth::user();

        if($user->can('Leer Seguimiento')) {

            $seguimientos = Seguimiento::orderBy('fecha','desc')->get();
            //$indicadores = Indicador::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $indicadores = Indicador::select('id',DB::raw('CONCAT(titulo, " Meta:", meta) AS tituloMeta'))->lists('tituloMeta','id');
            $idIndicador = null;

            return view('seguimiento/index', compact('seguimientos','indicadores','idIndicador'));
        }

        return redirect('logout');
	}

    public function create() {

        if(Auth::user()->can('Escribir Seguimiento')) {

            $indicadores = Indicador::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $create = true;

            return view('seguimiento/create',compact('indicadores','create'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

        //validar los datos
         $this->validate($request, [
            'indicador' => 'required',
            'valorIndicador' => 'required',
            'fecha' => 'date|required',
            
        ]);
    
          
   
        if(Auth::user()->can('Escribir Seguimiento')) {

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

            $data = Seguimiento::create([
                'indicador' =>  $request->input('indicador'),
                'fecha'  =>  $request->input('fecha'),
                'valorIndicador'  =>  $request->input('valorIndicador'),
                'analisis'  =>  $request->input('analisis'),
                'acciones'  =>  $request->input('acciones'),
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal

            ]);


            $seguimiento = Seguimiento::findOrFail($data->id);
                
            Session::flash('message', trans('ui.seg.message_create', array('name' => $seguimiento->fecha)));

            return redirect('seguimiento');
        }

        return redirect('logout');
    }

    public function edit($id) {

        if(Auth::user()->can('Escribir Seguimiento')) {

            $seguimiento = Seguimiento::findOrFail($id);

            $indicadores = Indicador::orderBy('titulo', 'asc')->lists('titulo', 'id');
            $create = false;

            return view('seguimiento/edit', compact('indicadores','seguimiento','create'));
        }

        return redirect('logout');
    }

    public function update($id, Request $request){

            //validar los datos
             $this->validate($request, [
            'indicador' => 'required',
            'valorIndicador' => 'required',
            'fecha' => 'date|required',
        
            ]);


            if(Auth::user()->can('Escribir Seguimiento')) {

                $data =  array(
                'indicador' =>  $request->input('indicador'),
                'fecha'  =>  $request->input('fecha'),
                'valorIndicador'  =>  $request->input('valorIndicador'),
                'analisis'  =>  $request->input('analisis'),
                'acciones'  =>  $request->input('acciones'),
                    
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
               


            $seguimiento = Seguimiento::findOrFail($id);

            $seguimiento->update($data);

            Session::flash('message', trans('ui.seg.message_update', array('name' => $seguimiento->indicador)));

            return redirect('seguimiento');
        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Escribir Seguimiento')) {

            $seguimiento = Seguimiento::findOrFail($id);

            Seguimiento::destroy($id);

            Session::flash('message', trans('ui.seg.message_delete', array('name' => $seguimiento->indicador)));

            return redirect('seguimiento');
        }

        return redirect('logout');
    }


    public function file($id) {

        if(Auth::user()->can('Leer Seguimiento')) {
            
            //recupera el documento de proceso id
            $seguimiento = Seguimiento::find($id);

            $response = Response::make($seguimiento->doc, 200);
            $response->header('Content-Type',$seguimiento->mime);
            return $response;
        }

        return redirect('logout');
    }



}