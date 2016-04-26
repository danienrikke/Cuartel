<?php

use Illuminate\Database\Seeder;

class EspecialidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('especialidades')->insert(
        	array
        	(
        		array('nombre' => strtoupper('perfeccionamiento en logistica militar'), 'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now')),
        		array('nombre' => strtoupper('especializacion en logistica militar'), 'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now')),
        		array('nombre' => strtoupper('especializacion en inteligencia militar'), 'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now')),
        		array('nombre' => strtoupper('perfeccionamiento de comunicaciones'), 'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now')),
        		array('nombre' => strtoupper('perfeccionamiento en infanteria'), 'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now'))
        	)
        );
    }
}
