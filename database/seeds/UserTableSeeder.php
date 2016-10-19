<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    {
        DB::table('users')->insert(array(
            'nombre' => 'Jose',
            'apellido' => 'Perez Lopez',
            'dni' => '12345678',
            'telefono' => '2664555555',
            'area' => '1',
            'email' => 'admin@demo.com',
            'password' => \Hash::make('admin123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));


    }
}
