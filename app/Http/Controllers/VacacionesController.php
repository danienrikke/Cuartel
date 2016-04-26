<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use \Carbon\Carbon as carbon;

use DB;

class VacacionesController extends Controller
{
	public function solicitud() {
		DB::table('vacaciones')->insert([
		    'cpersonal'     => Input::get('cpersonal'), 
		    'cdependencia'  => Input::get('cdependencia'), 
		    'fecha_salida'  => Input::get('fecha_salida'), 
		    'fecha_ingreso' => Input::get('fecha_ingreso'), 
		    'created_at'    => carbon::now(),
            'updated_at'    => carbon::now()
		]);
		
		return back();
	}

    public function aprobar($cedula) {
    	DB::table('vacaciones')
        	->where('cpersonal', $cedula)
        	->where('aprobado', 0)
            ->update(['aprobado' => 1]);

        return back();
    }
}
