<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Area;

use DB;
use Bican\Roles\Models\Role; 
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Exception;


class UserController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

	public function index() {

	
        $user = Auth::user();

        if($user->can('Gestionar Usuario')) {

            $users = User::with('roles')->get();

            return view('auth/user/index', compact('users'));
        }

        return redirect('logout');
	}

    public function create() {

        if(Auth::user()->can('Gestionar Usuario')) {

            $roles = Role::orderBy('name', 'asc')->lists('name', 'id');
            $areas = Area::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $create = true;

            return view('auth/user/create', compact('roles','areas','create'));
        }

        return redirect('logout');
    }

    public function store(Request $request) {

        //validar los datos
         $this->validate($request, [
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'dni' => 'required|numeric|digits_between:8,8|unique:users', //|unique:users
            'telefono' => 'numeric|digits_between:6,12',
            'area' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',

        ]);
        
        if(Auth::user()->can('Gestionar Usuario')) {

DB::beginTransaction();
            try{

                $data = User::create([
                    'nombre' =>  $request->input('nombre'),
                    'apellido'  =>  $request->input('apellido'),
                    'dni'  =>  $request->input('dni'),
                    'telefono'  =>  $request->input('telefono'),
                    'area'  =>  $request->input('area'),
                    'email'     =>  $request->input('email'),
                    'password'  =>  \Hash::make($request->input('password')),
                ]);

                $user = User::findOrFail($data->id);

                $data->attachRole($request->input('role_id'));

                Session::flash('message', trans('ui.user.message_create', array('name' => $user->nombre .' '. $user->apellido)));

                DB::commit();
            }
            catch(\Illuminate\Database\QueryException $e){
                if($e->errorInfo[1]==1062)
                 Session::flash('error', trans('ui.user.message_create', array('name' => 'El registro ya se encuentra en la BD')));
                 DB::rollback();    
            }
            catch(\Exception $e){

                Session::flash('error', 'No se pudo crear el nuevo Usuario');
                DB::rollback();
            }
            finally{
               return redirect('auth/user');
            }    
            
            
        }

        return redirect('logout');
    }

    public function edit($id) {

        if(Auth::user()->can('Gestionar Usuario')) {

            $user = User::findOrFail($id);

            $roles_user = User::find($id)->roles()->lists('role_id')->toArray();

            $roles = Role::orderBy('name', 'asc')->lists('name', 'id');
            $areas = Area::orderBy('descripcion', 'asc')->lists('descripcion', 'id');
            $create = false;

            return view('auth/user/edit', compact('user', 'roles', 'roles_user','areas','create'));
        }

        return redirect('logout');
    }

    public function update($id, Request $request){

            //validar los datos
             $this->validate($request, [
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'dni' => 'required|numeric|digits_between:8,8|unique:users,dni,'.$id,
            'area' => 'required',
            'telefono' => 'numeric|digits_between:6,12',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
                //'password' => 'required|min:6|confirmed',

            ]);


            if(Auth::user()->can('Gestionar Usuario')) {

            $data = ! $request->has('password') ? $request->except('password') : array(
                    'nombre' =>  $request->input('nombre'),
                    'apellido'  =>  $request->input('apellido'),
                    'dni'       =>  $request->input('dni'),
                    'telefono'  =>  $request->input('telefono'),
                    'area'  =>      $request->input('area'),
                    'email'     =>  $request->input('email'),
                  //  'password'  =>  \Hash::make($request->input('password')),
            );

            $user = User::findOrFail($id);

DB::beginTransaction();
            try{
                $user->update($data);

                if($user->roles->count()) {

                    $user->roles()->detach($user->roles()->lists('role_id')->toArray());
                }

                $user->attachRole($request->input('role_id'));

                Session::flash('message', trans('ui.user.message_update', array('name' => $user->nombre.' '. $user->apellido)));
                DB::commit();
            }
            catch(\Illuminate\Database\QueryException $e){

                if($e->errorInfo[1]==1062)
                 Session::flash('error', 'El registro ya se encuentra en la BD. Consulte con el Administrador');
                DB::rollback();     
            }
            catch(\Exception $e){

                Session::flash('error', 'El registro ya se encuentra en la BD. Consulte con el Administrador');    
                DB::rollback();
            }
            finally{
               return redirect('auth/user');
            }    

        }

        return redirect('logout');
    }

    public function destroy($id) {

        if(Auth::user()->can('Gestionar Usuario')) {

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

        return redirect('home');
    }

    public function userxrol($id) {

    
        $user = Auth::user();

        if($user->can('Gestionar Usuario')) {
//dd(Role::where('id',$id)->get()[0]);
            $users = Role::where('id',$id)->get()[0]->users;

            return view('auth/user/index', compact('users'));
        }

        return redirect('logout');
    }


}