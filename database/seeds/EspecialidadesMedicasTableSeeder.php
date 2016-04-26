<?php

use Illuminate\Database\Seeder;

class EspecialidadesMedicasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('especialidades_medicas')->insert(
        	array
        	(
        		array('nombre' => strtoupper('psiquiatria'), 'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now')),
        		array('nombre' => strtoupper('toxicologia'), 'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now')),
        		array('nombre' => strtoupper('cardiologia'), 'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now')),
        		array('nombre' => strtoupper('hematologia'), 'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now')),
        		array('nombre' => strtoupper('anestesiologia y rehabilitacion'), 'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now'))
        	)
        );
    }
}
