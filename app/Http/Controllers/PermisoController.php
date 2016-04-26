<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Input;

use \Carbon\Carbon as carbon;

use DB;

class PermisoController extends Controller
{
    public function solicitud() {
    	DB::table('permisos')->insert([
		   	'cpersonal'     => Input::get('cpersonal'),  
		    'tipo'          => Input::get('tipo'),  
		    'descripcion'   => Input::get('descripcion'), 
		    'fecha_permiso' => Input::get('fecha_permiso'), 
		    'fecha_ingreso' => Input::get('fecha_ingreso'), 
		    'created_at'    => carbon::now(),
            'updated_at'    => carbon::now()
		]);
		
		return back();
    }

    public function aprobar($cedula) {
    	DB::table('permisos')
        	->where('cpersonal', $cedula)
        	->where('estatus', 0)
            ->update(['estatus' => 1]);

        return back();
    }
}
