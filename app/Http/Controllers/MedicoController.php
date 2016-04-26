<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Response;

use App\Medico;
use App\Personal;
use App\Consultorio;
use DB;

class MedicoController extends Controller
{
    public function index()
    {
        $personal = array();
        $medicos = Medico::with('personal')->get();

        foreach ($medicos as $_medico)
        {
            array_push($personal, Personal::find($_medico->cpersonal));
        }

        foreach ($personal as $_personal) 
        {
            $d = date_parse_from_format("Y-m-d", $_personal->fnacimiento);
            $_personal->edad = \Carbon\Carbon::createFromDate($d['year'], $d['month'], $d['day'])->age;
        }

        return view('medicos.index')->with('personal', $personal);
    }
    
    public function show($cedula)
    {
        try 
        {
            $personal = Personal::findOrFail($cedula);
            $medico   = Medico::findOrFail($cedula);
        } 
        catch(ModelNotFoundException $e) 
        {
            return response()->view('errors.'.'500');
        }

        $consultorio  = Consultorio::where('codigo', '=', $medico->consultorio)
                    ->select('codigo', 'nombre')
                    ->firstOrFail();

        $especialidad_medica = DB::table('especialidades_medicas')
                        ->where('codigo', $medico->especialidad)
                        ->select('nombre')
                        ->first();

        $d = date_parse_from_format("Y-m-d", $personal->fnacimiento);
        $personal->edad = \Carbon\Carbon::createFromDate($d['year'], $d['month'], $d['day'])->age;

        return view('medicos.show')->with(
            [
                'personal'    => $personal,
                'medico'      => $medico,
                'consultorio' => $consultorio,
                'especialidad_medica' => $especialidad_medica
            ]
        );
    }

    public function create()
    {
        $consultorios = Consultorio::all();
        $especialidades_medicas = DB::table('especialidades_medicas')->orderBy('nombre', 'Asc')->get();
        return view("medicos.create")->with(
            [
                'consultorios' => $consultorios,
                'especialidades_medicas' => $especialidades_medicas
            ]
        );
    }

    public function store(Request $request)
    {
        $especialidad = $request->get('especialidad');

        if($request->get('otra_emedica') != '') 
        {
            $especialidad = DB::table('especialidades_medicas')->insertGetId(
                [
                    'nombre' => strtoupper($request->get('otra_emedica')),
                    'created_at'  => \Carbon\Carbon::now(),
                    'updated_at'  => \Carbon\Carbon::now()
                ]
            );
        }

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
                'tpersonal'   => strtoupper('personal medico'),
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now()
            ]
        );

        $seGuardo = DB::table('medicos')->insert(
            [
                'cpersonal'    => $request->get('cedula'),
                'matricula'    => strtoupper($request->get('matricula')),
                'especialidad' => strtoupper($especialidad),
                'consultorio'  => $request->get('consultorio'),
                'created_at'   => \Carbon\Carbon::now(),
                'updated_at'   => \Carbon\Carbon::now()
            ]
        );

        if(!$seGuardo) 
        {
            $mensaje = "Ocurrio un problema al registrar.";
            $tipo = "alert-danger";
        }
        else 
        {
            $mensaje = "El medico se registro con exito.";
            $tipo = "alert-success";
        }

        return Redirect::action('MedicoController@index')
                ->with(['mensaje' => $mensaje, 'tipo' => $tipo]);
    }

    public function edit($cedula)
    {
        try 
        {
            $personal = Personal::findOrFail($cedula);
            $medico   = Medico::findOrFail($cedula);
        } 
        catch(ModelNotFoundException $e) 
        {
            return response()->view('errors.'.'500');
        }

        $especialidad = DB::table('especialidades_medicas')
            ->select('codigo', 'nombre')
            ->where('codigo', $medico->especialidad)
            ->first();

        $especialidades = DB::table('especialidades_medicas')->select('codigo', 'nombre')->get();

        $consultorio  = Consultorio::where('codigo', '=', $medico->consultorio)
                    ->select('codigo', 'nombre')
                    ->firstOrFail();

        $consultorios = DB::table('consultorios')->select('codigo', 'nombre')->get();

        return view('medicos.edit')->with(
            [
                'personal'       => $personal,
                'medico'         => $medico, 
                'consultorio'    => $consultorio,
                'consultorios'   => $consultorios,
                'especialidad'   => $especialidad,
                'especialidades' => $especialidades
            ]
        );
    }

    public function update(Request $request, $cedula)
    {
        $error = false;
        
        DB::beginTransaction();

        try{
            DB::table('personal')
                ->where('cedula', $cedula)
                ->update
                    (
                        [
                            'nombre'      => strtoupper($request->get('nombre')),
                            'apellido'    => strtoupper($request->get('apellido')),
                            'fnacimiento' => $request->get('fnacimiento'),
                            'sexo'        => $request->get('sexo'),
                            'direccion'   => strtoupper($request->get('direccion')),
                            'telefono'    => $request->get('telefono'),
                            'fingreso'    => $request->get('fingreso'),
                            'ecivil'      => strtoupper($request->get('ecivil')),
                            'nhijos'      => $request->get('nhijos'),
                        ]
                    );

            DB::table('medicos')
                ->where('cpersonal', $cedula)
                ->update
                    (
                        [
                            'especialidad' => strtoupper($request->get('especialidad')),
                            'matricula'    => strtoupper($request->get('matricula')),
                        ]
                    );

        }
        catch ( Exception $e ){
            DB::rollback();
            $error = true;
        }

        DB::commit();

        if($error) 
        {
            $mensaje = "Ocurrio un problema al actualizar la informacion del medico.";
            $tipo    = "alert-danger";
        }
        else 
        {
            $mensaje = "La informacion del personal medico se actualizo con exito.";
            $tipo    = "alert-success";
        }

        return Redirect::action('MedicoController@index')
                ->with(['mensaje' => $mensaje, 'tipo' => $tipo]);
    }

    public function destroy($cedula)
    {
        $medico = Medico::where('cpersonal', '=', $cedula)->first();
        $medico->delete();

        $personal = Personal::where('cedula', '=', $cedula)->first();
        $personal->delete();

        return redirect('medicos');
    }
}
