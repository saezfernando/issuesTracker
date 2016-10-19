<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestRunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {
            Schema::create('TestRun', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario')->required();
            $table->integer('testCase')->required();

            $table->date('fecha')->required();
            $table->string('duracion')->required();
            $table->integer('veredicto')->required(); //pasa, falla, bloqueado, inconcluso, error

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
        Schema::dropIfExists('TestRun');
    }
}
