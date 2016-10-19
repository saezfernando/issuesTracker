<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

		DB::table('permissions')->insert(array(
        'name' => 'Gestionar Usuario',
        'slug' => 'Gestionar Usuario',
        'description' => 'Gestionar Usuario',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        ));


    DB::table('permissions')->insert(array(
            'name' => 'Gestionar Rol',
            'slug' => 'Gestionar Rol',
            'description' => 'Gestionar Rol',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        
        DB::table('permissions')->insert(array(
            'name' => 'Gestionar Permiso',
            'slug' => 'Gestionar Permiso',
            'description' => 'Gestionar Permiso',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        
        DB::table('permissions')->insert(array(
            'name' => 'Leer Notificación',
            'slug' => 'Leer Notificación',
            'description' => 'Leer Notificación',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'Escribir Notificación',
            'slug' => 'Escribir Notificación',
            'description' => 'Escribir Notificación',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

/*----------------------------------------------------------*/
        DB::table('permissions')->insert(array(
            'name' => 'Leer Capacitación Interna',
            'slug' => 'Leer Capacitación Interna',
            'description' => 'Leer Capacitación Interna',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'Escribir Capacitación Interna',
            'slug' => 'Escribir Capacitación Interna',
            'description' => 'Escribir Capacitación Interna',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

/*---------------------------------------------------------------*/
        DB::table('permissions')->insert(array(
            'name' => 'Escribir Comunicación Interna',
            'slug' => 'Escribir Comunicación Interna',
            'description' => 'Escribir Comunicación Interna',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'Leer Comunicación Interna',
            'slug' => 'Leer Comunicación Interna',
            'description' => 'Leer Comunicación Interna',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
/*---------------------------------------------------------------*/
        DB::table('permissions')->insert(array(
            'name' => 'Escribir No Conformidad',
            'slug' => 'Escribir No Conformidad',
            'description' => 'Escribir No Conformidad',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'Leer No Conformidad',
            'slug' => 'Leer No Conformidad',
            'description' => 'Leer No Conformidad',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

/*---------------------------------------------------------------*/
        DB::table('permissions')->insert(array(
            'name' => 'Escribir Informe Auditoría',
            'slug' => 'Escribir Informe Auditoría',
            'description' => 'Escribir Informe Auditoría',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'Leer Informe Auditoría',
            'slug' => 'Leer Informe Auditoría',
            'description' => 'Leer Informe Auditoría',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

/*---------------------------------------------------------------*/
        DB::table('permissions')->insert(array(
            'name' => 'Escribir Quejas y Reclamos',
            'slug' => 'Escribir Quejas y Reclamos',
            'description' => 'Escribir Quejas y Reclamos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'Leer Quejas y Reclamos',
            'slug' => 'Leer Quejas y Reclamos',
            'description' => 'Leer Quejas y Reclamos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

/*---------------------------------------------------------------*/
        DB::table('permissions')->insert(array(
            'name' => 'Escribir Procedimientos Operativos',
            'slug' => 'Escribir Procedimientos Operativos',
            'description' => 'Escribir Procedimientos Operativos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'Leer Procedimientos Operativos',
            'slug' => 'Leer Procedimientos Operativos',
            'description' => 'Leer Procedimientos Operativos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'Borrar Procedimientos Operativos',
            'slug' => 'Borrar Procedimientos Operativos',
            'description' => 'Borrar Procedimientos Operativos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'Revisar Procedimientos Operativos',
            'slug' => 'Revisar Procedimientos Operativos',
            'description' => 'Revisar Procedimientos Operativos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'Validar Procedimientos Operativos',
            'slug' => 'Validar Procedimientos Operativos',
            'description' => 'Validar Procedimientos Operativos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

/*---------------------------------------------------------------*/
        DB::table('permissions')->insert(array(
            'name' => 'Gestionar Areas',
            'slug' => 'Gestionar Areas',
            'description' => 'Gestionar Areas',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

/*---------------------------------------------------------------*/
        DB::table('permissions')->insert(array(
            'name' => 'Gestionar Auditores',
            'slug' => 'Gestionar Auditores',
            'description' => 'Gestionar Auditores',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

/*---------------------------------------------------------------*/
        DB::table('permissions')->insert(array(
            'name' => 'Gestionar Agenda',
            'slug' => 'Gestionar Agenda',
            'description' => 'Gestionar Agenda',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

/*---------------------------------------------------------------*/
        DB::table('permissions')->insert(array(
            'name' => 'Leer Informes',
            'slug' => 'Leer Informes',
            'description' => 'Leer Informes',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

/*---------------------------------------------------------------*/
        DB::table('permissions')->insert(array(
            'name' => 'Leer Propuesta Mejora',
            'slug' => 'Leer Propuesta Mejora',
            'description' => 'Leer Propuesta Mejora',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'Escribir Propuesta Mejora',
            'slug' => 'Escribir Propuesta Mejora',
            'description' => 'Escribir Propuesta Mejora',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

/*---------------------------------------------------------------*/
        DB::table('permissions')->insert(array(
            'name' => 'Leer Encuesta',
            'slug' => 'Leer Encuesta',
            'description' => 'Leer Encuesta',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'Escribir Encuesta',
            'slug' => 'Escribir Encuesta',
            'description' => 'Escribir Encuesta',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

/*
        $name = 'Tables_in_'.env('DB_DATABASE', 'calidad');
		
		$data = DB::select('SHOW TABLES WHERE '.$name. ' != "permission_role" and ' .$name. ' != "role_user"');
        		
		
        foreach($data as $value) {

            if(($value->$name != 'users') && ($value->$name != 'migrations') &&
                ($value->$name != 'roles') && ($value->$name != 'permissions')) {
                DB::table('permissions')->insert(array(
                    'name' => 'create-'.$value->$name,
                    'slug' => 'Create '.ucwords($value->$name),
                    'description' => 'Create '.ucwords($value->$name),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ));

                DB::table('permissions')->insert(array(
                    'name' => 'read-'.$value->$name,
                    'slug' => 'Read '.ucwords($value->$name),
                    'description' => 'List '.ucwords($value->$name),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ));

                DB::table('permissions')->insert(array(
                    'name' => 'update-'.$value->$name,
                    'slug' => 'Update '.ucwords($value->$name),
                    'description' => 'Update '.ucwords($value->$name),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ));

                DB::table('permissions')->insert(array(
                    'name' => 'delete-'.$value->$name,
                    'slug' => 'Delete '.ucwords($value->$name),
                    'description' => 'Delete '.ucwords($value->$name),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ));
            }
        }

*/        
	}
}
