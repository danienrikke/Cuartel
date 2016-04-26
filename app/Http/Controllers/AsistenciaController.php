<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Input;

use \Carbon\Carbon as carbon;

use App\personal;
use DB;

class AsistenciaController extends Controller
{
	public function inicio() 
	{
		$turno = $this->devolverTurno();
		$fecha = carbon::now()->format('Y-m-d');
		$modal = false;

		if (!empty(Input::get('turno'))) { $turno = Input::get('turno'); }
		if (!empty(Input::get('fecha'))) { $fecha = Input::get('fecha'); }
		if (empty(Input::get('mostrar'))) { $modal = true; }

		$lista = DB::table('asistencias')
			->join('personal', 'asistencias.cpersonal', '=', 'personal.cedula')
			->where('asistencias.turno', '=', $turno)
			->where('asistencias.fecha', '=', $fecha)
			->select('asistencias.hora_entrada', 'asistencias.hora_salida', 'personal.cedula', 'personal.nombre', 'personal.apellido')
			->get();

		return view("asistencias.inicio")->with([
			"turno" => $turno,
			"lista" => $lista,
			'fecha' => $fecha,
			"modal" => $modal
		]);
	}

	public function tomarAsistencia(Request $request) 
	{
		$tomada = DB::table('asistencias')
			->where('cpersonal', '=', $request->get('cedula'))
			->where('fecha', '=', carbon::now()->format('Y-m-d'))
			->where('turno', '=', $this->devolverTurno())
			->exists();

		if($tomada) {
			DB::table('asistencias')
                ->where('cpersonal', '=', $request->get('cedula'))
				->where('fecha', '=', carbon::now()->format('Y-m-d'))
				->where('turno', '=', $this->devolverTurno())
                ->update([
                    'hora_salida' => carbon::now()->format('H:i:s'),
            ]);
		}
		else {
			DB::table('asistencias')->insert([
		    	'cpersonal'     => $request->get('cedula'),  
		    	'turno'         => $this->devolverTurno(),  
		    	'hora_entrada'  => carbon::now()->format('H:i:s'),  
		    	'fecha'         => carbon::now()->format('Y-m-d')
		    ]);
		}
		
		return Redirect::action('AsistenciaController@inicio');
	}

	public function consultarPersonal($cedula) 
    {
    	$personal = Personal::where('cedula', '=', $cedula)->first();

    	if(count($personal) > 0) {
    		$cedula = $personal->cedula;
    		$nombre = $personal->nombre;
    		$apellido = $personal->apellido;
    	}
    	else {
    		$cedula = 0;
    		$nombre = '';
    		$apellido = '';
    	}

        return response()->json(['cedula' => $cedula, 'nombre' => $nombre, 'apellido' => $apellido]);
    }

	private function devolverTurno() 
	{
		$hora = intval(date('H'));

		if (($hora >= 5) && ($hora < 12)) { return "mañana"; }
		else if (($hora >= 12) && ($hora < 18)) { return "tarde"; }
		else { return "noche"; }
	}
}
