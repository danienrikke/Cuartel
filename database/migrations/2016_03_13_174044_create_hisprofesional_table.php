<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHisprofesionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('his_profesional', function (Blueprint $table) {
            $table->increments('codigo')->unsigned();
            $table->integer('danterior')->default(0);
            $table->integer('canterior')->default(0);
            $table->integer('cprofesional')->unsigned();
            $table->timestamps();
        });

        Schema::table('his_profesional', function($table) {
            $table->foreign('cprofesional')->references('cpersonal')->on('profesionales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('his_profesional');
    }
}
