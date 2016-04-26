<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \Carbon\Carbon as carbon;

use DB;

class InicioController extends Controller
{
    public function inicio()
    {
    	$vacaciones_vigentes = DB::table('vacaciones')
    		->where('fecha_salida', '=', carbon::now()->format('Y-m-d'))
    		->where('estatus', '<=', 1)
    		->count();

    	for ($i=0; $i < $vacaciones_vigentes; $i++) 
    	{ 
    		DB::table('vacaciones')
	            ->where('fecha_salida', '<=', carbon::now()->format('Y-m-d'))
	    		->where('estatus', '=', 1)
            	->update(['estatus' => 2]);
    	}

    	$vacaciones_cumplidas = DB::table('vacaciones')
    		->where('fecha_ingreso', '<=', carbon::now()->format('Y-m-d'))
    		->where('estatus', '=', 2)
    		->count();

    	for ($i=0; $i < $vacaciones_cumplidas; $i++) 
    	{ 
    		DB::table('vacaciones')
	            ->where('fecha_ingreso', '<=', carbon::now()->format('Y-m-d'))
	    		->where('estatus', '=', 2)
            	->update(['estatus' => 3]);
    	}

    	$vacaciones_no_aprobadas = DB::table('vacaciones')
    		->where('fecha_salida', '<=', carbon::now()->format('Y-m-d'))
    		->where('estatus', '=', 0)
    		->count();

    	for ($i=0; $i < $vacaciones_no_aprobadas; $i++) 
    	{ 
    		DB::table('vacaciones')
	            ->where('fecha_salida', '<=', carbon::now()->format('Y-m-d'))
	    		->where('estatus', '=', 0)
            	->update(['estatus' => 4]);
    	}

        $permisos_vigentes = DB::table('permisos')
            ->where('fecha_permiso', '<=', carbon::now()->format('Y-m-d'))
            ->where('estatus', '=', 1)
            ->count();

        for ($i=0; $i < $permisos_vigentes; $i++) 
        { 
            DB::table('permisos')
                ->where('fecha_permiso', '<=', carbon::now()->format('Y-m-d'))
                ->where('estatus', '=', 1)
                ->update(['estatus' => 2]);
        }

        $permisos_cumplidos = DB::table('permisos')
            ->where('fecha_ingreso', '<=', carbon::now()->format('Y-m-d'))
            ->where('estatus', '=', 2)
            ->count();

        for ($i=0; $i < $permisos_cumplidos; $i++) 
        { 
            DB::table('permisos')
                ->where('fecha_ingreso', '<=', carbon::now()->format('Y-m-d'))
                ->where('estatus', '=', 2)
                ->update(['estatus' => 3]);
        }

        $permisos_no_aprobados = DB::table('permisos')
            ->where('fecha_permiso', '<=', carbon::now()->format('Y-m-d'))
            ->where('estatus', '=', 0)
            ->count();

        for ($i=0; $i < $permisos_no_aprobados; $i++) 
        { 
            DB::table('permisos')
                ->where('fecha_permiso', '<=', carbon::now()->format('Y-m-d'))
                ->where('estatus', '=', 0)
                ->update(['estatus' => 4]);
        }
    
    	$permisos_pendientes = DB::table('permisos')
    		->join('personal', 'permisos.cpersonal', '=', 'personal.cedula')
    		->where('fecha_permiso', '>', carbon::now()->format('Y-m-d'))
	    	->where('estatus', '=', 0)
	    	->select('personal.cedula', 'personal.nombre', 'personal.apellido', 'permisos.tipo', 'permisos.descripcion',
	    		'permisos.fecha_permiso', 'permisos.fecha_ingreso', 'permisos.created_at')
			->get();

        $vacaciones_pendientes = DB::table('vacaciones')
            ->join('personal', 'vacaciones.cpersonal', '=', 'personal.cedula')
            ->join('dependencias', 'vacaciones.cdependencia', '=', 'dependencias.codigo')
            ->where('fecha_salida', '>', carbon::now()->format('Y-m-d'))
            ->where('estatus', '=', 0)
            ->select('personal.cedula', 'personal.nombre', 'personal.apellido', 'dependencias.nombre as dependencia', 
                'vacaciones.fecha_salida', 'vacaciones.fecha_ingreso', 'vacaciones.created_at')
            ->get();

        return view('inicio.inicio')->with([
            'permisos_pendientes'   => $permisos_pendientes,
            'vacaciones_pendientes' => $vacaciones_pendientes
        ]);
    }
}
