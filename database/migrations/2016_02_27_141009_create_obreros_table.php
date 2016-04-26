<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObrerosTable extends Migration
{
    public function up()
    {
        Schema::create('obreros', function (Blueprint $table) {
            $table->integer('cpersonal')->unique()->unsigned();
            $table->string('ginstruccion', 20);
            $table->string('tobrero', 30);
            $table->integer('area')->unsigned();

            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::table('obreros', function($table) {
            $table->foreign('cpersonal')->references('cedula')->on('personal')->onDelete('cascade');
            $table->foreign('area')->references('codigo')->on('areas');
        });
    }

    public function down()
    {
        Schema::drop('obreros');
    }
}
