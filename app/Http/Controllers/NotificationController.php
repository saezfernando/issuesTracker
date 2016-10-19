<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Area;
use App\Notification;

use DB;
use Bican\Roles\Models\Role; 
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class NotificationController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

	public function index() {

        $user = Auth::user();

        if($user->can('Leer Notificación')) {

            //notificaiones del usuario ordenadas por no leido y fecha    
            $notificaciones = $user->notificaciones()->orderBy('read','asc')->orderBy('created_at','desc')->get();
            foreach ($notificaciones as $notificacion) {
                $notificacion['emisor'] = User::find($notificacion['emisor'])->nombre . ' ' . User::find($notificacion['emisor'])->apellido;
            }
            return view('notificacion/index', compact('notificaciones'));
        }

        return redirect('logout');
	}

    public function create() {

        if(Auth::user()->can('Escribir Notificación')) {

            $roles = Role::orderBy('name', 'asc')->lists('name', 'id');
            //$usuarios = User::orderBy('apellido', 'asc')->lists('apellido' . ', ' . 'nombre, 'id');
           $usuarios = User::select('id', DB::raw('CONCAT(apellido, ", ", nombre) AS nombreCompleto'))
            ->orderBy('apellido')
            ->lists('nombreCompleto', 'id');
  
            $areas = Area::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
  
            return view('notificacion/create', compact('roles','usuarios','areas'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

        //validar los datos
         $this->validate($request, [
        'motivo' => 'required|max:255',
            'body' => 'required',
         ]);
    
        $ids = [];       
   
        if(Auth::user()->can('Escribir Notificación')) {

        if ($request->input('notifiable_type') == 'User') {

            $ids[0] = $request->input('notifiable_id');
            }


        if ($request->input('notifiable_type') == 'Rol') {
       
            if (empty($request->input('role_id'))){
                Session::flash('message','Debe seleccionar al menos un Rol');
                return redirect('notificacion/create');                

            }            
                foreach ($request->input('role_id') as $rol) {
                      
                    foreach (Role::find($rol)->users as $user) {
                                      $ids[] = $user->id;
                                  }              
                    $ids = array_unique($ids);
                    }
            
        }        
    
        if ($request->input('notifiable_type') == 'Area') {

            if (empty($request->input('area_id'))){
                Session::flash('message','Debe seleccionar al menos un Area');
                return redirect('notificacion/create');                

            }
                foreach ($request->input('area_id') as $area) {
                    foreach (Area::find($area)->users as $user) {
                                      $ids[] = $user->id;
                                  }              
                    $ids = array_unique($ids);
                    }
            
        }

        if ($request->input('notifiable_type') == 'All') {

            $ids = DB::table('users')->select('id')->pluck('id');
            }


        foreach ($ids as $id) {
            
            $data = Notification::create([
                'motivo' =>  $request->input('motivo'),
                'body'  =>  $request->input('body'),
                'emisor'  =>  Auth::user()->id,
                'read' => 0,
                'notifiable_type'  =>  $request->input('notifiable_type'),
                'notifiable_id'  =>  $id,
            
            ]);
            
        }

            Session::flash('message', trans('ui.notificacion.message_create', array('numero' => count($ids))));

            return redirect('notificacion');
        }

        return redirect('logout');
    }

/* no es necesario
    public function edit($id) {

        if(Auth::user()->can('Marcar Leido')) {

            $user = User::findOrFail($id);

            $roles_user = User::find($id)->roles()->lists('role_id')->toArray();

            $roles = Role::orderBy('name', 'asc')->lists('name', 'id');
            $areas = Area::orderBy('descripcion', 'asc')->lists('descripcion', 'id');

            return view('notificacion/edit', compact('user', 'roles', 'roles_user','areas'));
        }

        return redirect('logout');
    }
*/

    public function update($id, Request $request){

            //validar los datos
             $this->validate($request, [
            'read' => 'required|max:1',
             ]);


            if(Auth::user()->can('Leer Notificación')) {


            $notificacion = Notification::findOrFail($id);

            $notificacion->update(['read'=>$request->input('read')]);

            //Session::flash('message', trans('ui.user.message_update', array('name' => $user->nombre.' '. $user->apellido)));

            return redirect('notificacion');
        }

        return redirect('logout');
    }


    public function destroy($id) {

        return redirect('logout');
    }

    public function show() {

        return redirect('logout');

    }

}