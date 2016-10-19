<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('TestCase', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',255)->required();
            $table->text('descripcion')->required();
            $table->integer('usuario')->required();
            $table->integer('proyecto')->required();
            $table->integer('version')->required(); //version del soft a probar
            $table->integer('userStory')->required(); 

            $table->date('fecha')->required();
            $table->text('objetivo')->required();
            $table->integer('tipo')->required(); //funcional, integracion,aceptación etc

            $table->integer('prioridad')->required();//bajo, medio, alto
            $table->integer('metodo')->required(); //manual,automatico
            $table->integer('riesgo')->required();//bajo, medio, alto

            $table->text('precondicion')->nullable();
            $table->text('postcondicion')->nullable();
            $table->text('entrada')->nullable();
            $table->text('valorEsperado')->nullable();
            $table->text('observacion')->nullable();

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
        Schema::dropIfExists('TestCase');
    }
}
