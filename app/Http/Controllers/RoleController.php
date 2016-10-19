<?php 

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;

use Bican\Roles\Models\Role; 
use Bican\Roles\Models\Permission;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class RoleController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }
	
	public function index() {

        if(Auth::user()->can('Gestionar Rol')) {

            $roles = Role::with('permissions')->get();

            return view('auth/role/index', compact('roles'));
        }

        return redirect('logout');
	}

	public function create() {

        if(Auth::user()->can('Gestionar Rol')) {

		$permissions = Permission::lists('name', 'id');
		
		return view('auth/role/create', compact('permissions'));
        }

        return redirect('logout');
	}

	public function store(Request $request) {

        if(Auth::user()->can('Gestionar Rol')) {

            //validar
            $this->validate($request, [
                'name' => 'required|max:255|unique:roles',
                //'slug' => 'required|max:255',
                'description' => 'max:255',
                /*
                //No lo vamos a implementar en la app
                'level' => 'required|int', 
                
            ],['level.required'=>'El campo Nivel es obligatorio']
            */
            ]);

DB::beginTransaction();
            try{     
                $data = Role::create([
                        'name' =>  $request->input('name'),
                        'slug' =>  $request->input('name'),
                        'description' =>  $request->input('description'),
                        'level' => 1, //$request->input('level'),
                    ]);

                $role = Role::findOrFail($data->id);

                $data->attachPermission($request->input('permission_id'));

                Session::flash('message', trans('ui.role.message_create', array('name' => $role->name)));
                DB::commit();
                }
            catch(\Exception $e){
                 Session::flash('error','No se pudo agregar el nuevo Rol');   
                 DB::rollback();
            }
            finally{
                return redirect('auth/role');    
            }

            
        }

        return redirect('logout');
    }

    public function edit($id) {

        if(Auth::user()->can('Gestionar Rol')) {

        $role = Role::findOrFail($id);

        $role_permission = Role::find($id)->permissions()->lists('permission_id')->toArray();

        $permissions = Permission::lists('name', 'id');

        return view('auth/role/edit', compact('role', 'permissions', 'role_permission'));
        }

        return redirect('logout');
    }

    public function update($id, Request $request){

        if(Auth::user()->can('Gestionar Rol')) {

            //validar
            $this->validate($request, [
                'name' => 'required|max:255|unique:roles,name,'.$id,
                //'slug' => 'required|max:255',
                'description' => 'max:255',
            ]);

DB::beginTransaction();
            try{
                $role = Role::findOrFail($id);

                $role->update([
                        'name' =>  $request->input('name'),
                        'slug' =>  $request->input('name'),
                        'description' =>  $request->input('description'),
                    ]);

                if($role->permissions->count()) {

                   $role->permissions()->detach($role->permissions()->lists('permission_id')->toArray());
                }

                $role->attachPermission($request->input('permission_id'));

                Session::flash('message', trans('ui.role.message_update', array('name' => $role->name)));
                DB::commit();
            }
            catch(\Exception $e){
                 Session::flash('error','No se pudo editar el Rol');   
                 DB::rollback();
            }
            finally{
                return redirect('auth/role');
            }

        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Gestionar Rol')) {

        $role = Role::findOrFail($id);

        Role::destroy($id);

        Session::flash('message', trans('ui.role.message_delete', array('name' => $role->name)));

        return redirect('auth/role');
        }

        return redirect('logout');
    }
	
}