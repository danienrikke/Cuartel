<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Response;

use App\NoProfesional;
use App\Personal;
use DB;

class NoProfesionalController extends Controller
{
    public function index()
    {
        $personal = array();
        $noprofesionales = NoProfesional::with('personal')->get();

        foreach ($noprofesionales as $_noprofesional)
        {
            array_push($personal, Personal::find($_noprofesional->cpersonal));
        }

        foreach ($personal as $_personal) 
        {
            $d = date_parse_from_format("Y-m-d", $_personal->fnacimiento);
            $_personal->edad = \Carbon\Carbon::createFromDate($d['year'], $d['month'], $d['day'])->age;
        }

        return view('noprofesionales.index')->with('personal', $personal);
    }

    public function show($cedula)
    {
        try 
        {
            $personal      = Personal::findOrFail($cedula);
            $noprofesional = NoProfesional::findOrFail($cedula);
        } 
        catch(ModelNotFoundException $e) 
        {
            return response()->view('errors.'.'500');
        }

        $jerarquia = DB::table('jerarquias')
                        ->where('codigo', $noprofesional->jerarquia)
                        ->select('nombre')
                        ->first();

        $d = date_parse_from_format("Y-m-d", $personal->fnacimiento);
        $personal->edad = \Carbon\Carbon::createFromDate($d['year'], $d['month'], $d['day'])->age;

        return view('noprofesionales.show')->with(
            [
                'personal'      => $personal,
                'noprofesional' => $noprofesional,
                'jerarquia'     => $jerarquia
            ]
        );
    }

    public function create()
    {
        return view("noprofesionales.create");
    }

    public function store(Request $request)
    {
        DB::table('personal')->insert(
            [
                'cedula'      => $request->get('cedula'),
                'nombre'      => strtoupper($request->get('nombre')),
                'apellido'    => strtoupper($request->get('apellido')),
                'fnacimiento' => $request->get('fnacimiento'),
                'sexo'        => $request->get('sexo'),
                'direccion'   => strtoupper($request->get('direccion')),
                'telefono'    => $request->get('telefono'),
                'fingreso'    => $request->get('fingreso'),
                'ecivil'      => $request->get('ecivil'),
                'nhijos'      => $request->get('nhijos'),
                'tpersonal'   => strtoupper('personal militar'),
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now()
            ]
        );

        $seGuardo = DB::table('noprofesionales')->insert(
            [
                'cpersonal'   => $request->get('cedula'),
                'tmilitar'    => strtoupper('no profesional'),
                'jerarquia'   => strtoupper($request->get('jerarquia')),
                'ncuenta'     => $request->get('ncuenta'),
                'contingente' => strtoupper($request->get('contingente')),
                'situacion'   => strtoupper($request->get('situacion')),
                'dtallas'     => strtoupper($request->get('dtallas')),
                'nasignado'   => $request->get('nasignado'),
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now()
            ]
        );

        if(!$seGuardo) 
        {
            $mensaje = "Ocurrio un problema al registrar.";
            $tipo = "alert-danger";
        }
        else 
        {
            $mensaje = "El personal militar se registro con exito.";
            $tipo = "alert-success";
        }

        return Redirect::action('NoProfesionalController@index')
                ->with(['mensaje' => $mensaje, 'tipo' => $tipo]);
    }

    public function destroy($cedula) 
    {
        $noprofesional = NoProfesional::where('cpersonal', '=', $cedula)->first();
        $noprofesional->delete();

        $personal = Personal::where('cedula', '=', $cedula)->first();
        $personal->delete();

        return redirect('noprofesionales');
    }
}
