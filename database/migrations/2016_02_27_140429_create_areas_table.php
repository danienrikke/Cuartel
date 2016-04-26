<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('codigo')->unsigned();
            $table->string('nombre', 100);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('areas');
    }
}
