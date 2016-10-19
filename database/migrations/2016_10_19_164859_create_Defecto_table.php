<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {
            Schema::create('Defecto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario')->required();
            $table->integer('testRun')->required();

            $table->date('fecha')->required();
            $table->integer('estado')->required();//abierto, cerrado, fixed, submitted,bloqueado

            $table->text('descripcion')->nullable();
            $table->integer('prioridad')->required();//baka, media, alta
            $table->integer('severidad')->required();//catastrofico, mayor, menor, cosmetico

            $table->integer('enviadoA')->nullable();//usuario a quien se asigna para solucionar
            $table->date('fechaCreacion')->nullable();//fecha en que se envia para resolver
            $table->date('fechaApertura')->nullable();//fecha en que usuario asignado abre el defecto
            $table->date('fechaCierre')->nullable();//fecha en que usuario cierra el defecto
            
            $table->integer('tipoResolucion')->required();//interface, cambios a DB, no es un defecto, etc            

            $table->binary('doc')->nullable();
            $table->string('mime',100)->nullable();
            $table->integer('size')->nullable();
            $table->string('nombre_archivo_original',255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Defecto');
    }
}
