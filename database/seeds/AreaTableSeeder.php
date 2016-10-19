<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    {
        DB::table('areas')->insert(array(
            'descripcion' => 'Calidad',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('areas')->insert(array(
            'descripcion' => 'Pilp',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('areas')->insert(array(
            'descripcion' => 'Recursos Humanos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('areas')->insert(array(
            'descripcion' => 'Sec. Académica',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
    }
}
