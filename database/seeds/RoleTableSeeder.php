<?php

use Carbon\Carbon;
use Bican\Roles\Models\Permission; 

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            'name' => 'Admin',
            'slug' => 'Admin',
            'description' => 'Administra los módulos de usuarios',
            'level' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('roles')->insert(array(
            'name' => 'Calidad',
            'slug' => 'Calidad',
            'description' => 'Usuarios de calidad - Todos los permisos excepto Gestión de Usuarios y Roles',
            'level' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('roles')->insert(array(
            'name' => 'Calidad Lector',
            'slug' => 'Calidad Lector',
            'description' => 'Todos los permisos de Lectura en la aplicación',
            'level' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('roles')->insert(array(
            'name' => 'Calidad Validador',
            'slug' => 'Calidad Validador',
            'description' => 'Todos los permisos de Lectura más validación más revisión',
            'level' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('roles')->insert(array(
            'name' => 'Privilegios Mínimos',
            'slug' => 'Privilegios Mínimos',
            'description' => 'Privilegios Mínimos',
            'level' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

    }
}
