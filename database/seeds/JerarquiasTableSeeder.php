<?php

use Illuminate\Database\Seeder;

class JerarquiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jerarquias')->insert(
        	array
        	(
        		array('nombre' => strtoupper('general en jefe')),
        		array('nombre' => strtoupper('mayor general')),
        		array('nombre' => strtoupper('general de division')),
        		array('nombre' => strtoupper('general de brigada')),
        		array('nombre' => strtoupper('coronel')),
        		array('nombre' => strtoupper('teniente coronel')),
        		array('nombre' => strtoupper('mayor')),
        		array('nombre' => strtoupper('capitan')),
        		array('nombre' => strtoupper('primer teniente')),
        		array('nombre' => strtoupper('teniente')),
        		array('nombre' => strtoupper('sargento supervisor')),
        		array('nombre' => strtoupper('sargento ayudante')),
        		array('nombre' => strtoupper('sargento mayor de primera')),
        		array('nombre' => strtoupper('sargento mayor de segunda')),
        		array('nombre' => strtoupper('sargento mayor de tercera')),
        		array('nombre' => strtoupper('sargento primero')),
        		array('nombre' => strtoupper('sargento segundo'))
        	)
        );
    }
}
