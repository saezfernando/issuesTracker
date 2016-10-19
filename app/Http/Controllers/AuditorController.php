<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Auditor;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Exception;


class AuditorController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

	public function index() {

	
        $user = Auth::user();

        if($user->can('Gestionar Auditores')) {

            $auditores = Auditor::All();

            return view('auditor/index', compact('auditores'));
        }

        return redirect('logout');
	}

    public function create() {

        if(Auth::user()->can('Gestionar Auditores')) {

            $create = true;

            return view('auditor/create', compact('create'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

        //validar los datos
         $this->validate($request, [
        'descripcion' => 'required|max:255|unique:auditores',
        ]);
        
        if(Auth::user()->can('Gestionar Auditores')) {

            try{

                $data = Auditor::create([
                    'descripcion' =>  $request->input('descripcion'),
                    ]);

                $auditor = Auditor::findOrFail($data->id);

                Session::flash('message', trans('ui.auditor.message_create', array('name' => $auditor->descripcion)));

                
            }
            catch(\Exception $e){

                Session::flash('error', 'No se pudo agregar el nuevo Auditor');
            }
            finally{
               return redirect('auditor');
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

        if(Auth::user()->can('Gestionar Auditores')) {

            $auditor = Auditor::findOrFail($id);

            Auditor::destroy($id);

            Session::flash('message', trans('ui.auditor.message_delete', array('name' => $auditor->descripcion)));

            return redirect('auditor');
        }

        return redirect('logout');
    }



}