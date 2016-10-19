<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Proceso_version;

use App\Proceso;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Bican\Roles\Models\Role; 
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class ProcesoController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

	public function index() {

	
        $user = Auth::user();

        if($user->can('Leer Proceso')) {

            $procesos = Proceso::with('versiones')->get();
            
            /*
            $procesos = Proceso::with(['versiones' => function($query){
                $version =  $query->max('version');   
                $query->where('version',$version);
            }])->get();
            */

            /*
            $procesos = Proceso::with(['versiones' => function($query){
                $query->orderBy('version','desc');   
                $query->take(1);
            }])->get();
            */

            $procesos->map(function($proceso){
              $proceso->versiones = $proceso->versiones()->orderBy('version','desc')->take(1);
              return $proceso;      
            });    

//dd($procesos);
            return view('proceso/index', compact('procesos'));
        }

        return redirect('logout');
	}

    public function create() {

        if(Auth::user()->can('Crear Proceso')) {

            return view('proceso/create');
        }

        return redirect('logout');
    }

    public function store(Request $request) {

        //validar los datos
         $this->validate($request, [
        'nombre' => 'required|max:255',
            'body' => 'required|max:255',
            'doc' => 'required',
        ]);
    
          
   
        if(Auth::user()->can('Crear Proceso')) {

           //$file = array('image' => Input::file('doc'));
           $mime = Input::file('doc')->getMimeType();
           $size = Input::file('doc')->getSize();
           $nombreOriginal = Input::file('doc')->getClientOriginalName();

            $path = Input::file('doc')->getRealPath();
    
            $content = file_get_contents($path);

            $data = Proceso::create([
                'nombre' =>  $request->input('nombre'),
                'body'  =>  $request->input('body'),
                'creador'  =>  Auth::user()->id,
                'estado'  =>  $request->input('estado'),
            ]);


            $proceso = Proceso::findOrFail($data->id);

             $data2 = Proceso_version::create([
                'proceso_id' => $data->id,
                'version' => 1,
                'estado' => 1,
                'doc' => $content,
                'mime' => $mime,
                'size' => $size,
                'nombre_archivo_original' => $nombreOriginal
            ]);

                
            Session::flash('message', trans('ui.proceso.message_create', array('name' => $proceso->nombre)));

            return redirect('proceso');
        }

        return redirect('logout');
    }

    public function edit($id) {

        if(Auth::user()->can('Actualizar Usuario')) {

            $user = User::findOrFail($id);

            $roles_user = User::find($id)->roles()->lists('role_id')->toArray();

            $roles = Role::orderBy('name', 'asc')->lists('name', 'id');
            $areas = Area::orderBy('descripcion', 'asc')->lists('descripcion', 'id');

            return view('auth/user/edit', compact('user', 'roles', 'roles_user','areas'));
        }

        return redirect('logout');
    }

    public function update($id, Request $request){

            //validar los datos
             $this->validate($request, [
            'nombre' => 'required|max:255',
                'apellido' => 'required|max:255',
                'dni' => 'size:8',
                'telefono' => 'min:10',
                'email' => 'required|email|max:255',
                'password' => 'required|min:6|confirmed',

            ]);


            if(Auth::user()->can('Actualizar Usuario')) {

            $data = ! $request->has('password') ? $request->except('password') : array(
                    'nombre' =>  $request->input('nombre'),
                    'apellido'  =>  $request->input('apellido'),
                    'dni'       =>  $request->input('dni'),
                    'telefono'  =>  $request->input('telefono'),
                    'area'  =>      $request->input('area'),
                    'email'     =>  $request->input('email'),
                    'password'  =>  \Hash::make($request->input('password')),
            );

            $user = User::findOrFail($id);

            $user->update($data);

            if($user->roles->count()) {

                $user->roles()->detach($user->roles()->lists('role_id')->toArray());
            }

            $user->attachRole($request->input('role_id'));

            Session::flash('message', trans('ui.user.message_update', array('name' => $user->nombre.' '. $user->apellido)));

            return redirect('auth/user');
        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Borrar Usuario')) {

            $user = User::findOrFail($id);

            User::destroy($id);

            Session::flash('message', trans('ui.user.message_delete', array('name' => $user->nombre .' '. $user->apellido)));

            return redirect('auth/user');
        }

        return redirect('logout');
    }

    public function show() {

        return view('auth/user/form_change_password');

    }

    public function changePassword(Request $request) {

        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        $data = array(
            'password' => \Hash::make($request->input('password'))
        );

        $user->update($data);

        Session::flash('message', trans('ui.user.message_change_password'));

        return redirect('auth/user/change-password');
    }

    public function file($id) {

        if(Auth::user()->can('Leer Proceso')) {
            
            //recupera el documento de proceso id
            $procesoVersion = Proceso_version::find($id);

            $response = Response::make($procesoVersion->doc, 200);
            $response->header('Content-Type',$procesoVersion->mime);
            return $response;
        }

        return redirect('logout');
    }



}