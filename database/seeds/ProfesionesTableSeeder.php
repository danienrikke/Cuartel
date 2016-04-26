<?php

use Illuminate\Database\Seeder;

class ProfesionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profesiones')->insert(
        	array
        	(
        		array('nombre' => strtoupper('contabilidad y auditoria'),           'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now')),
        		array('nombre' => strtoupper('gestion y administacion financiera'), 'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now')),
        		array('nombre' => strtoupper('ingenieria en telecomunicaciones'),   'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now')),
        		array('nombre' => strtoupper('informatica y telematica'),		    'created_at' => new DateTime('now'), 'updated_at' => new DateTime('now'))
        	)
        );
    }
}
