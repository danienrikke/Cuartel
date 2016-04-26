<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Profesional;
use App\Personal;
use App\Dependencia;
use App\Cargo;
use DB;

class ProfesionalController extends Controller
{
    public function index()
    {
        $personal = array();
        $profesionales = Profesional::with('personal')->get();

        foreach ($profesionales as $_profesional)
        {
            array_push($personal, Personal::find($_profesional->cpersonal));
        }

        foreach ($personal as $_personal) 
        {
            $d = date_parse_from_format("Y-m-d", $_personal->fnacimiento);
            $_personal->edad = \Carbon\Carbon::createFromDate($d['year'], $d['month'], $d['day'])->age;
        }

        return view('profesionales.index')->with('personal', $personal);
    }

    public function show($cedula )
    {
        try 
        {
            $personal    = Personal::findOrFail($cedula);
            $profesional = Profesional::findOrFail($cedula);
        } 
        catch(ModelNotFoundException $e) 
        {
            return response()->view('errors.'.'500');
        }

        $dependencia  = Dependencia::where('codigo', '=', $profesional->dependencia)
                    ->select('codigo', 'nombre')
                    ->firstOrFail();

        $cargo        = Cargo::where('codigo', '=', $profesional->cargo)
                    ->select('codigo', 'tipo')
                    ->firstOrFail();

        $especialidad = DB::table('especialidades')
                        ->where('codigo', $profesional->especialidad)
                        ->select('nombre')
                        ->first();

        $jerarquia = DB::table('jerarquias')
                        ->where('codigo', $profesional->jerarquia)
                        ->select('nombre')
                        ->first();

        $d = date_parse_from_format("Y-m-d", $personal->fnacimiento);
        $personal->edad = \Carbon\Carbon::createFromDate($d['year'], $d['month'], $d['day'])->age;

        $d = date_parse_from_format("Y-m-d", $personal->fingreso);
        $profesional->antiguedad = \Carbon\Carbon::createFromDate($d['year'], $d['month'], $d['day'])->diff(\Carbon\Carbon::now())->format('%y años, %m meses y %d dias');

        return view('profesionales.show')->with(
            [
                'personal'    => $personal,
                'profesional' => $profesional,
                'dependencia' => $dependencia,
                'cargo'       => $cargo,
                'especialidad' => $especialidad,
                'jerarquia'    => $jerarquia
            ]
        );
    }

    public function create()
    {
        $cargos = Cargo::all();
        $dependencias = Dependencia::all();
        $jerarquias = DB::table('jerarquias')->get();
        $especialidades = DB::table('especialidades')->orderBy('nombre', 'Asc')->get();

        return view("profesionales.create")->with(
            [
                'cargos'       => $cargos,
                'dependencias' => $dependencias,
                'jerarquias'   => $jerarquias,
                'especialidades' => $especialidades
            ]
        );
    }

    public function store(Request $request)
    {
        $especialidad = $request->get('especialidad');

        if($request->get('otra_especialidad') != '') 
        {
            $especialidad = DB::table('especialidades')->insertGetId(
                [
                    'nombre' => strtoupper($request->get('otra_especialidad')),
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
                'tpersonal'   => strtoupper('personal militar'),
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now()
            ]
        );

        $seGuardo = DB::table('profesionales')->insert(
            [
                'cpersonal'    => $request->get('cedula'),
                'tmilitar'     => strtoupper('profesional'),
                'matricula'    => strtoupper($request->get('matricula')),
                'jerarquia'    => strtoupper($request->get('jerarquia')),
                'especialidad' => strtoupper($especialidad),
                'dtallas'      => strtoupper($request->get('dtallas')),
                'iproveniente' => strtoupper($request->get('iproveniente')),
                'fuascenso'    => strtoupper($request->get('fuascenso')),
                'dependencia'  => $request->get('dependencia'),
                'cargo'        => $request->get('cargo'),
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
            $mensaje = "El personal militar se registro con exito.";
            $tipo = "alert-success";
        }

        return Redirect::action('ProfesionalController@index')
                ->with(['mensaje' => $mensaje, 'tipo' => $tipo]);
    }

    public function edit($cedula) 
    {
        try 
        {
            $personal    = Personal::findOrFail($cedula);
            $profesional = Profesional::findOrFail($cedula);
        } 
        catch(ModelNotFoundException $e) 
        {
            return response()->view('errors.'.'500');
        }

        $dependencia = Dependencia::where('codigo', '=', $profesional->dependencia)
                        ->select('codigo', 'nombre')
                        ->firstOrFail();

        $cargo       = Cargo::where('codigo', '=', $profesional->cargo)
                        ->select('codigo', 'tipo')
                        ->firstOrFail();

        $dependencias = Dependencia::all();
        $cargos       = Cargo::all();

        return view('profesionales.edit')->with(
            [
                'personal'     => $personal,
                'profesional'  => $profesional,
                'dependencia'  => $dependencia,
                'cargo'        => $cargo,
                
                'dependencias' => $dependencias,
                'cargos'       => $cargos
            ]
        );
    }

    public function update(Request $request, $cedula) 
    {
        $profesional = Profesional::where('cpersonal', $cedula)
            ->select('dependencia', 'cargo')
            ->first();

        if($profesional->dependencia != strtoupper($request->get('dependencia'))
        || $profesional->cargo       != strtoupper($request->get('cargo'))) 
        {
            DB::table('his_profesional')->insert(
                 [
                    'danterior'    => $profesional->dependencia,
                    'canterior'    => $profesional->cargo,
                    'cprofesional' => $cedula,
                    'created_at'   => \Carbon\Carbon::now(),
                    'updated_at'   => \Carbon\Carbon::now()
                ]
            );
        }

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

        DB::table('profesionales')
            ->where('cpersonal', $cedula)
            ->update
                (
                    [
                        'tmilitar'     => strtoupper($request->get('tmilitar')),
                        'jerarquia'    => strtoupper($request->get('jerarquia')),
                        'matricula'    => strtoupper($request->get('matricula')),
                        'especialidad' => strtoupper($request->get('especialidad')),
                        'dtallas'      => strtoupper($request->get('dtallas')),
                        'iproveniente' => strtoupper($request->get('iproveniente')),
                        'fuascenso'    => strtoupper($request->get('fuascenso')),
                        'dependencia'  => strtoupper($request->get('dependencia')),
                        'cargo'        => strtoupper($request->get('cargo')),
                    ]
                );

        return redirect('profesionales');
    }

    public function destroy($cedula)
    {
        $profesional = Profesional::where('cpersonal', '=', $cedula)->first();
        $profesional->delete();

        $personal = Personal::where('cedula', '=', $cedula)->first();
        $personal->delete();

        return redirect('profesionales');
    }
}
