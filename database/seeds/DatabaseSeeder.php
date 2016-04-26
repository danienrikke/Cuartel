<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        //factory('App\Area', 10)->create();
        //factory('App\Cargo', 15)->create();
        //factory('App\Dependencia', 5)->create();
        //factory('App\Consultorio', 1)->create();
        
        //$this->call(UsersTableSeeder::class);
        
        //$this->call(EspecialidadesMedicasTableSeeder::class);
        //$this->call(ProfesionesTableSeeder::class);
        //$this->call(JerarquiasTableSeeder::class);
        //$this->call(EspecialidadesTableSeeder::class);

        //factory('App\Personal', 18)->create();
        //factory('App\Personal', 4)->create();
        //factory('App\Personal', 7)->create();
        //factory('App\Personal', 145)->create();

        //factory('App\Obrero', 18)->create();
        //factory('App\Medico', 4)->create();
        //factory('App\Administrativo', 7)->create();
        //factory('App\Profesional', 25)->create();
        //factory('App\NoProfesional', 120)->create();
        
	    Model::reguard();
    }
}
