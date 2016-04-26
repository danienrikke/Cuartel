<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoprofesionalesTable extends Migration
{
    public function up()
    {
        Schema::create('noprofesionales', function (Blueprint $table) {
            $table->integer('cpersonal')->unique()->unsigned();
            $table->string('tmilitar', 30);
            $table->string('jerarquia', 30);
            $table->string('ncuenta', 40);
            $table->string('contingente', 30);
            $table->string('situacion', 30);
            $table->text('dtallas');
            $table->integer('nasignado');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('noprofesionales', function($table) {
            $table->foreign('cpersonal')->references('cedula')->on('personal')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('noprofesionales');
    }
}
