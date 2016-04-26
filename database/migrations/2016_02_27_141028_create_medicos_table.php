<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicosTable extends Migration
{
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->integer('cpersonal')->unique()->unsigned();
            $table->string('matricula', 20);
            $table->string('especialidad', 30);
            $table->integer('consultorio')->unsigned();

            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::table('medicos', function($table) {
            $table->foreign('cpersonal')->references('cedula')->on('personal')->onDelete('cascade');
            $table->foreign('consultorio')->references('codigo')->on('consultorios');
        });
    }

    public function down()
    {
        Schema::drop('medicos');
    }
}
