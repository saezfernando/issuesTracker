<?php

namespace App\Http\Controllers;

use DB;
use PDO;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Informe;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InformeController extends Controller
{
    	public function index() {

	
        $user = Auth::user();

        if($user->can('Leer Informes')) {

         	
         	$informes = Informe::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
          
            $informes = array_merge(array('0'=>'Seleccione un Informe'),$informes->toArray());

            $informesObj = Informe::orderBy('descripcion', 'asc')->get();
            $campos = null;
            $tablaDB = null;


         	return view('generar-informe/index', compact('informes','campos','informesObj','tablaDB'));
        }

        return redirect('logout');
	}


        public function indexPorId($id) {

    
        $user = Auth::user();

        if($user->can('Leer Informes')) {

            DB::setFetchMode(PDO::FETCH_ASSOC);
            $informes = Informe::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $informe = Informe::findOrFail($id);
            $informesObj = Informe::orderBy('descripcion', 'asc')->get();

           //$campos = DB::select(DB::raw('SHOW COLUMNS FROM calidad.'.$informe->tabla .';'));
            $camposDB = DB::select(DB::raw("SELECT COLUMN_NAME 'Field' FROM information_schema.columns WHERE  table_name = '". $informe->tabla ."' AND table_schema = 'calidad'"));
            DB::setFetchMode(PDO::FETCH_CLASS);
            $campos = [];

            foreach ($camposDB as $clave => $campo) {
                if (($campo['Field'] == 'id')||
                   ($campo['Field'] == 'doc')||
                   ($campo['Field'] == 'mime')||
                   ($campo['Field'] == 'size')||
                   ($campo['Field'] == 'nombre_archivo_original')||
                   ($campo['Field'] == 'deleted_at')||
                   ($campo['Field'] == 'created_at')||                   
                   ($campo['Field'] == 'updated_at')) {
                    unset($camposDB[$clave]);        
                }
                else {

                    $campos[] = $campo['Field'];
                }                      
            }

            $tablaDB = DB::select(DB::raw("select * from ". $informe->tabla));   
            return view('generar-informe/index', compact('informes','campos','informesObj','tablaDB','informe'));
        }

        return redirect('logout');
    }


}
