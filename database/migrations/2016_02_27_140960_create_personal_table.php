<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalTable extends Migration
{
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->integer('cedula')->primary()->unsigned();
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->date('fnacimiento');
            $table->string('sexo', 10);
            $table->text('direccion');
            $table->string('telefono', 20);
            $table->date('fingreso');
            $table->string('ecivil', 15);
            $table->integer('nhijos');
            $table->string('tpersonal', 30);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('personal');
    }
}
