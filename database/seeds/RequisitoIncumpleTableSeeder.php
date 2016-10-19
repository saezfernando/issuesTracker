<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RequisitoIncumpleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    {
        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Contexto de la organización | Comprensión de la organización',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Contexto de la organización | Comprensión de las necesidades y expectativas de las partes interesadas',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Contexto de la organización | Determinación del alcance del sistema de gestión de la calidad',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Contexto de la organización | Sistema de gestión de la calidad y sus procesos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Liderazgo | compromiso | Generalidades',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Liderazgo | compromiso | Enfoque al cliente',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Liderazgo | Política | Establecimiento de la política de la calidad',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Liderazgo | Política | Comunicación de la política de la calidad',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Liderazgo | Roles, responsabilidades y autoridades en la organización',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Planificación | Acciones para abordar riesgos y oportunidades',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Planificación | Objetivos de la calidad y planificación para lograrlos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Planificación | Planificación de los cambios',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Apoyo | Recursos | Generalidades',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Apoyo | Recursos | Personas',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Apoyo | Recursos | Infraestructura',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Apoyo | Recursos | Ambiente para la operación de los procesos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Apoyo | Recursos | Recursos de seguimiento y medición',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Apoyo | Recursos | Conocimientos de la organización',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Apoyo | Competencia',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Apoyo | Toma de conciencia',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Apoyo | comunicación',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Apoyo | Información documentada | Generalidades',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Apoyo | Información documentada | Creación y actualización',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Apoyo | Información documentada | Control de la información documentada',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Planificación y control operacional',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

       DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Requisitos para los productos y servicios | Comunicación con el cliente',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Requisitos para los productos y servicios | Determinación de los requisitos para los productos y servicios',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Requisitos para los productos y servicios | Revisión de los requisitos para los productos y servicios',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Requisitos para los productos y servicios | Cambios en los requisitos para los productos y servicios',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Diseño y desarrollo de los productos y servicios | Generalidades',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Diseño y desarrollo de los productos y servicios | Planificación del diseño y desarrollo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Diseño y desarrollo de los productos y servicios | Entradas para el diseño y desarrollo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Diseño y desarrollo de los productos y servicios | Controles del diseño y desarrollo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Diseño y desarrollo de los productos y servicios | Salidas del diseño y desarrollo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Diseño y desarrollo de los productos y servicios | Cambios del diseño y desarrollo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Control de los procesos, productos y servicios suministrados externamente | Generalidades',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Control de los procesos, productos y servicios suministrados externamente | Tipo y alcance del control',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Control de los procesos, productos y servicios suministrados externamente | Información para los proveedores externos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Producción y provisión del servicio | Control de la producción y de la provisión del servicio',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Producción y provisión del servicio | Identificación y trazabilidad',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Producción y provisión del servicio | Propiedad perteneciente a los clientes o proveedores externos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Producción y provisión del servicio | Preservación',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Producción y provisión del servicio | Actividades posteriores a la entrega',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Producción y provisión del servicio | Control de los cambios',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Producción y provisión del servicio | Liberación de los productos y servicios',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Operación | Producción y provisión del servicio | Control de las salidas no conformes',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Evaluación del desempeño | Seguimiento, medición, análisis y evaluación | Generalidades',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Evaluación del desempeño | Seguimiento, medición, análisis y evaluación | Satisfacción del cliente',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Evaluación del desempeño | Seguimiento, medición, análisis y evaluación | Análisis y evaluación',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Evaluación del desempeño | Auditoria interna',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Evaluación del desempeño | Revisión por la dirección | Generalidades',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Evaluación del desempeño | Revisión por la dirección | Entradas de la revisión por la dirección',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Evaluación del desempeño | Revisión por la dirección | Salidas de la revisión por la dirección',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Mejora | Generalidades',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Mejora | No conformidad y acción correctiva',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('requisitoincumple')->insert(array(
            'descripcion' => 'Mejora | Mejora Continua',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));


    }
}




