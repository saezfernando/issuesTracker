<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Bican\Roles\Models\Role; 
use Bican\Roles\Models\Permission;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class PermissionController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }
	
	public function index() {

        if(Auth::user()->can('Gestionar Permiso')) {

        $permissions = Permission::all();

		return view('auth/permission/index', compact('permissions'));
        }

        return redirect('logout');
	}

	public function create() {

        if(Auth::user()->can('Gestionar Permiso')) {

        return view('auth/permission/create');
        }

        return redirect('logout');
    }

    public function store(Request $request) {

        if(Auth::user()->can('Gestionar Permiso')) {

        //validar        
        $this->validate($request, [
            'name' => 'required|max:255|unique:permissions',
            'description' => 'required|max:255', 
        ]);
    

        $data = Permission::create([
            'name' =>  $request->input('name'),
            'slug'  =>  $request->input('name'),
            'description'  =>  $request->input('description'),
        ]);

        $permission = Permission::findOrFail($data->id);

       Session::flash('message', trans('ui.permission.message_create', array('name' => $permission->name)));

        return redirect('auth/permission');

        }

        return redirect('logout');
	
    }

    public function edit($id) {

        if(Auth::user()->can('Gestionar Permiso')) {

        $permission = Permission::findOrFail($id);

        return view('auth/permission/edit', compact('permission'));

        }

        return redirect('logout');
    }

    public function update($id,Request $request) {

        if(Auth::user()->can('Gestionar Permiso')) {

         //validar        
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255', 
        ]);

        $permission = Permission::findOrFail($id);

        $permission->update([
                    'name' =>  $request->input('name'),
                    'slug' =>  $request->input('name'),
                    'description' =>  $request->input('description'),
                ]);


        Session::flash('message', trans('ui.permission.message_update', array('name' => $permission->name)));

        return redirect('auth/permission');

        }

        return redirect('logout');
	
    }

    public function destroy($id) {

        if(Auth::user()->can('Gestionar Permiso')) {
    	
    	$permission = Permission::findOrFail($id);

    	Permission::destroy($id);

    	Session::flash('message', trans('ui.permission.message_delete', array('name' => $permission->name)));

        return redirect('auth/permission');

        }

        return redirect('logout');
    }
	
}