<?php

use Carbon\Carbon;
use Bican\Roles\Models\Permission; 
use Bican\Roles\Models\Role; 


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //$role = Role::where('slug','admin');
        $permisos = Permission::All();
        foreach($permisos as $permiso){
            DB::table('permission_role')->insert(array(
                'permission_id' => $permiso->id,
                'role_id' => 2
            ));
        }            

    }
}
