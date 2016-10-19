<?php

use Carbon\Carbon;
use Bican\Roles\Models\Role;
use App\User;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //mejorar la entrada sobre tablas pivot
        $user = User::where('email','admin@demo.com')->get();
        $roles = Role::All();
        foreach($roles as $role){
            DB::table('role_user')->insert(array(
                'user_id' => 1,
                'role_id' => $role->id
            ));
        }    

    }
}
