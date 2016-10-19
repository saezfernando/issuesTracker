<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SysInformesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    {
        DB::table('sysInformes')->insert(array(
            'descripcion' => 'Capacitación Interna',
            'tabla' => 'capacitacionInternas',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('sysInformes')->insert(array(
            'descripcion' => 'No Conformidad',
            'tabla' => 'noConformidades',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('sysInformes')->insert(array(
            'descripcion' => 'Procedimientos Operativos',
            'tabla' => 'procedimientosOP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('sysInformes')->insert(array(
            'descripcion' => 'Sec. Académica',
            'tabla' => 'otrasssss',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
    }
}
