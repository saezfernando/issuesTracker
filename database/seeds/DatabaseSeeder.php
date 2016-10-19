<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Model::unguard();

	    $this->call(PermissionTableSeeder::class);
	    $this->call(RoleTableSeeder::class);
	    $this->call(UserTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(AuxiliarTableSeeder::class);
        $this->call(SysInformesTableSeeder::class);
        $this->call(RequisitoIncumpleTableSeeder::class);



	    Model::reguard();
    }
}
