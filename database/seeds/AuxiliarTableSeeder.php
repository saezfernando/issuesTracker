<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AuxiliarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    {
        DB::table('tipoCapacitaciones')->insert(array(
            'descripcion' => 'Charlas y Conferencias',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('tipoCapacitaciones')->insert(array(
            'descripcion' => 'Cursos y talleres',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('tipoCapacitaciones')->insert(array(
            'descripcion' => 'Inducción',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

       DB::table('estadoCapacitaciones')->insert(array(
            'descripcion' => 'Planificada',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('estadoCapacitaciones')->insert(array(
            'descripcion' => 'En curso',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('estadoCapacitaciones')->insert(array(
            'descripcion' => 'Cerrada',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('estadoCapacitaciones')->insert(array(
            'descripcion' => 'Cancelada',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

       DB::table('metodoEvaluaciones')->insert(array(
            'descripcion' => 'Teórico',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('metodoEvaluaciones')->insert(array(
            'descripcion' => 'Teórico/Práctico',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('metodoEvaluaciones')->insert(array(
            'descripcion' => 'Sin evaluación',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('metodoEvaluaciones')->insert(array(
            'descripcion' => 'Puesto de trabajo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

DB::table('evaluacionCapacitaciones')->insert(array(
            'descripcion' => 'Sin Evaluar',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('evaluacionCapacitaciones')->insert(array(
            'descripcion' => 'Objetivos Alcanzados',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

         DB::table('evaluacionCapacitaciones')->insert(array(
            'descripcion' => 'Objetivos No Alacanzados',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));        

         //----------------------------------------------------

        DB::table('tipoComunicaciones')->insert(array(
            'descripcion' => 'Ingreso de Personal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('tipoComunicaciones')->insert(array(
            'descripcion' => 'Egreso de Personal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));


         //----------------------------------------------------

        DB::table('tipificaciones')->insert(array(
            'descripcion' => 'tipificac 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('tipificaciones')->insert(array(
            'descripcion' => 'tipificacion 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

         //----------------------------------------------------

        DB::table('categoriasNC')->insert(array(
            'descripcion' => 'Oportunidad de Mejora',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('categoriasNC')->insert(array(
            'descripcion' => 'No Conformidad Mayor',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('categoriasNC')->insert(array(
            'descripcion' => 'No Conformidad Menor',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('categoriasNC')->insert(array(
            'descripcion' => 'Producto No Conforme',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('categoriasNC')->insert(array(
            'descripcion' => 'Observación',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

         //----------------------------------------------------

        DB::table('origenesNC')->insert(array(
            'descripcion' => 'Auditoría',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('origenesNC')->insert(array(
            'descripcion' => 'Campo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

         //----------------------------------------------------

        DB::table('estadosNC')->insert(array(
            'descripcion' => 'Inicial',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('estadosNC')->insert(array(
            'descripcion' => 'En tratamiento',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('estadosNC')->insert(array(
            'descripcion' => 'Pendiente de Verif. AC.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('estadosNC')->insert(array(
            'descripcion' => 'Cerrado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

         //----------------------------------------------------

        DB::table('estadosPM')->insert(array(
            'descripcion' => 'Inicial',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('estadosPM')->insert(array(
            'descripcion' => 'En tratamiento',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('estadosPM')->insert(array(
            'descripcion' => 'Pendiente de Verif. AC.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('estadosPM')->insert(array(
            'descripcion' => 'Cerrado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));


        //----------------------------------------------------

        DB::table('calidadesNC')->insert(array(
            'descripcion' => 'calidadesNC 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('calidadesNC')->insert(array(
            'descripcion' => 'calidadesNC 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));


                 //----------------------------------------------------

        DB::table('fortalezas')->insert(array(
            'descripcion' => 'fortalezas 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('fortalezas')->insert(array(
            'descripcion' => 'fortalezas 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

        DB::table('areaIntereses')->insert(array(
            'descripcion' => 'areaIntereses 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('areaIntereses')->insert(array(
            'descripcion' => 'areaIntereses 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

        DB::table('tipoAuditorias')->insert(array(
            'descripcion' => 'Interna',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('tipoAuditorias')->insert(array(
            'descripcion' => 'Externa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

        DB::table('auditores')->insert(array(
            'descripcion' => 'auditores 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('auditores')->insert(array(
            'descripcion' => 'auditores 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

        DB::table('nivelesAuditados')->insert(array(
            'descripcion' => 'nivelesAuditados 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('nivelesAuditados')->insert(array(
            'descripcion' => 'nivelesAuditados 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

        DB::table('certificados')->insert(array(
            'descripcion' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('certificados')->insert(array(
            'descripcion' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('certificados')->insert(array(
            'descripcion' => '3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('certificados')->insert(array(
            'descripcion' => '4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('certificados')->insert(array(
            'descripcion' => '5',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

        DB::table('clasificacionActividades')->insert(array(
            'descripcion' => 'clasificacionActividades 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('clasificacionActividades')->insert(array(
            'descripcion' => 'clasificacionActividades 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

        DB::table('estadosQR')->insert(array(
            'descripcion' => 'Inicial',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('estadosQR')->insert(array(
            'descripcion' => 'En tratamiento',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('estadosQR')->insert(array(
            'descripcion' => 'Cerrada',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

        DB::table('responsables')->insert(array(
            'descripcion' => 'responsables 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('responsables')->insert(array(
            'descripcion' => 'responsables 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

        DB::table('pncs')->insert(array(
            'descripcion' => 'pncs 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('pncs')->insert(array(
            'descripcion' => 'pncs 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

        DB::table('estadosP')->insert(array(
            'descripcion' => 'Validado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('estadosP')->insert(array(
            'descripcion' => 'Revisión',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('estadosP')->insert(array(
            'descripcion' => 'Borrador',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('estadosP')->insert(array(
            'descripcion' => 'Obsoleto',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));


//----------------------------------------------------

        DB::table('frecuencias')->insert(array(
            'descripcion' => 'Mensual',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('frecuencias')->insert(array(
            'descripcion' => 'Trimestral',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('frecuencias')->insert(array(
            'descripcion' => 'Semestral',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('frecuencias')->insert(array(
            'descripcion' => 'Anual',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('frecuencias')->insert(array(
            'descripcion' => 'Única Vez',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

//----------------------------------------------------

        DB::table('medidas')->insert(array(
            'descripcion' => 'Unidades',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('medidas')->insert(array(
            'descripcion' => 'Pesos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('medidas')->insert(array(
            'descripcion' => 'Días',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('medidas')->insert(array(
            'descripcion' => 'Kilos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('medidas')->insert(array(
            'descripcion' => 'Metros',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));


    }
}
