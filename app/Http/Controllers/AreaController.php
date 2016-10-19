<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Area;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Exception;


class AreaController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

	public function index() {

	
        $user = Auth::user();

        if($user->can('Gestionar Areas')) {

            $areas = Area::All();

            return view('area/index', compact('areas'));
        }

        return redirect('logout');
	}

    public function create() {

        if(Auth::user()->can('Gestionar Areas')) {

            $create = true;

            return view('area/create', compact('create'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

        //validar los datos
         $this->validate($request, [
        'descripcion' => 'required|max:255|unique:areas',
        ]);
        
        if(Auth::user()->can('Gestionar Areas')) {

            try{

                $data = Area::create([
                    'descripcion' =>  $request->input('descripcion'),
                    ]);

                $area = Area::findOrFail($data->id);

                Session::flash('message', trans('ui.area.message_create', array('name' => $area->descripcion)));

                
            }
            catch(\Exception $e){

                Session::flash('error', 'No se pudo agregar la nueva area');
            }
            finally{
               return redirect('area');
            }    
            
            
        }

        return redirect('logout');
    }

    public function edit($id) {

        //sacar a page not found
    }

    public function update($id, Request $request){

     //sacar a page not found
    }

    
    public function destroy($id) {

        if(Auth::user()->can('Gestionar Areas')) {

            $area = Area::findOrFail($id);

            Area::destroy($id);

            Session::flash('message', trans('ui.area.message_delete', array('name' => $area->descripcion)));

            return redirect('area');
        }

        return redirect('logout');
    }



}