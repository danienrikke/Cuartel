<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use \Carbon\Carbon as carbon;
use Response;
use Input;

use App\Personal;
use App\Administrativo;
use App\Dependencia;
use App\Cargo;
use DB;

class AdministrativoController extends Controller
{
    public function inicio()
    {
        $personal = array();
        $turno = $this->devolverTurno();

        $cAdministrativos = array('nAdministrativos' => 0, 'nPersonal' => 0);
        $estatus = array('asistencias' => 0, 'permisos' => 0, 'vacaciones' => 0);
        $administrativos = Administrativo::with('personal')->get();

        $cAdministrativos['nAdministrativos'] = Administrativo::count();
        $cAdministrativos['nPersonal'] = Personal::count();

        $asistencias = DB::table('asistencias')
            ->join('administrativos', 'asistencias.cpersonal', '=', 'administrativos.cpersonal')
            ->where('asistencias.fecha', '=', carbon::now()->format('Y-m-d'))
            ->where('asistencias.turno', '=', $turno)
            ->count();

        $estatus['asistencias'] = round(($asistencias * 100) / $cAdministrativos['nAdministrativos'], 1);

        $permisos = DB::table('permisos')
            ->join('administrativos', 'permisos.cpersonal', '=', 'administrativos.cpersonal')
            ->where('permisos.estatus', '=', 2)
            ->count();

        $estatus['permisos'] = round(($permisos * 100) / $cAdministrativos['nAdministrativos'], 1);

        $vacaciones = DB::table('vacaciones')
            ->join('administrativos', 'vacaciones.cpersonal', '=', 'administrativos.cpersonal')
            ->where('vacaciones.estatus', '=', 2)
            ->count();

        $estatus['vacaciones'] = round(($vacaciones * 100) / $cAdministrativos['nAdministrativos'], 1);

        foreach ($administrativos as $_administrativo) {
            array_push($personal, Personal::find($_administrativo->cpersonal));
        }

        foreach ($personal as $_personal) {
            $d = date_parse_from_format("Y-m-d", $_personal->fnacimiento);
            $_personal->edad = carbon::createFromDate($d['year'], $d['month'], $d['day'])->age;
        }

        return view('administrativos.inicio')->with([
            'personal'         => $personal,
            'cAdministrativos' => $cAdministrativos,
            'estatus'          => $estatus,
            'turno'            => $turno
        ]);
    }

    public function mostrar($cedula)
    {
        try {
            $personal = Personal::findOrFail($cedula);
            $administrativo = Administrativo::findOrFail($cedula);
        } 
        catch(ModelNotFoundException $e) {
            return response()->view('errors.500');
        }

        $dependencia = Dependencia::where('codigo', $administrativo->dependencia)
            ->select('codigo', 'nombre')->firstOrFail();

        $cargo = Cargo::where('codigo', $administrativo->cargo)
            ->select('codigo', 'tipo')->firstOrFail();

        $profesion = DB::table('profesiones')->where('codigo', $administrativo->profesion)
            ->select('nombre')->first();

        $d = date_parse_from_format("Y-m-d", $personal->fnacimiento);
        $personal->edad = carbon::createFromDate($d['year'], $d['month'], $d['day'])->age;

        $d = date_parse_from_format("Y-m-d", $personal->fingreso);
        $administrativo->tiempo_servicio = carbon::createFromDate($d['year'], $d['month'], $d['day'])
            ->diff(\Carbon\Carbon::now())->format('%y años / %m meses / %d dias');

        $aniosSevicio = carbon::createFromDate($d['year'], $d['month'], $d['day'])->age;
        $vacacionesAnioActual = 0;
        $vacacionesTotales = 0;
        
        if($aniosSevicio > 0) {
            $vacacionesTotales = (($aniosSevicio - 1) * 30);
            
            $vacacionesAnioActual = 30;
            $historialVacacionesTotales = DB::table('vacaciones')->where('cpersonal', $cedula)->whereIn('estatus', [1, 2, 3])->get();

            foreach ($historialVacacionesTotales as $historial) {
                $vacaciones = date_parse_from_format("Y", $historial->fecha_salida);
                if($vacaciones['year'] == carbon::now()->year) {
                    $vacacionesAnioActual -= $this->calcularDiasVacaciones($historial->fecha_salida, $historial->fecha_ingreso);
                }
            }
        }

        $vacacionesTotales += $vacacionesAnioActual;
        $estatusVacaciones = array('vacacionesTotales' => $vacacionesTotales, 'vacacionesAnioActual' => $vacacionesAnioActual);
        
        // color de los labels de vacaciones
        $labelVacaciones = array("label1" => "danger", "label2" => "danger");
        if ($vacacionesTotales > 0) { $labelVacaciones["label1"] = "success"; }
        if ($vacacionesAnioActual > 0) { $labelVacaciones["label2"] = "success"; }
        
        // activar o desactivar botones de solicitudes de permisos y vacaciones
        $botonSolicitud = array("reciente" => "", "tieneVacaciones" => "");
        $ultimoPermiso = DB::table('permisos')->where('cpersonal', $cedula)->whereIn('estatus', [0, 1, 2])->orderBy('codigo', 'asc')->exists();
        $ultimasVacaciones = DB::table('vacaciones')->where('cpersonal', $cedula)->whereIn('estatus', [0, 1, 2])->orderBy('codigo', 'asc')->exists();
        if($ultimoPermiso || $ultimasVacaciones) { $botonSolicitud["reciente"] = "disabled"; }
        if($vacacionesTotales == 0) { $botonSolicitud["tieneVacaciones"] = "disabled"; }

        /*
        $administrativosTotales = DB::table('administrativos')->count();

        $administrativosDeVacaciones = DB::table('vacaciones')
            ->join('personal', 'vacaciones.cpersonal', '=', 'personal.cedula')
            ->join('administrativos', 'personal.cedula', '=', 'administrativos.cpersonal')
            ->where('vacaciones.aprobado', '=', 1)
            ->where('vacaciones.estado', '<', 2)
            ->count();

        $porcentaje = round((($administrativosDeVacaciones * 100) / $administrativosTotales));
        */   

        // registros de solicitudes de permisos y vacaciones (hisotrial - tablas)
        $historialPermisos = DB::table('permisos')->where('cpersonal', $cedula)->orderBy('created_at', 'desc')->get();
        $historialVacaciones = DB::table('vacaciones')
            ->join('dependencias', 'vacaciones.cdependencia', '=', 'dependencias.codigo')
            ->where('cpersonal', $cedula)
            ->select('vacaciones.*', 'dependencias.nombre as dependencia')
            ->orderBy('vacaciones.fecha_salida', 'asc')
            ->get();


        // indicadores de permisos pedidos en el mes (actual)
        $permisosMesActual = array('personales' => 0, 'medicos' => 0, 'duelo' => 0);
        $permisosMesActual['personales'] = DB::table('permisos')->where('cpersonal', $cedula)->where('tipo', 1)->where('created_at', '>=', carbon::now()->startOfMonth())->count();
        $permisosMesActual['medicos']    = DB::table('permisos')->where('cpersonal', $cedula)->where('tipo', 2)->where('created_at', '>=', carbon::now()->startOfMonth())->count();
        $permisosMesActual['duelo']      = DB::table('permisos')->where('cpersonal', $cedula)->where('tipo', 3)->where('created_at', '>=', carbon::now()->startOfMonth())->count();

        return view('administrativos.mostrar')->with([
            'personal'            => $personal,
            'administrativo'      => $administrativo,
            'dependencia'         => $dependencia,
            'cargo'               => $cargo,
            'profesion'           => $profesion,
            'permisosMesActual'   => $permisosMesActual,
            'historialPermisos'   => $historialPermisos,
            'estatusVacaciones'   => $estatusVacaciones,
            'historialVacaciones' => $historialVacaciones,
            'labelVacaciones'     => $labelVacaciones,
            'botonSolicitud'      => $botonSolicitud
        ]);
    }

    public function crear()
    {
        $profesiones = DB::table('profesiones')->orderBy('nombre', 'Asc')->get();

        return view("administrativos.crear")->with([
            'profesiones' => $profesiones
        ]);
    }

    public function guardar(Request $request)
    {
        $profesion = $request->get('profesion');

        if($request->get('otra_profesion') != '') {
            $profesion = DB::table('profesiones')->insertGetId([
                'nombre'      => strtoupper($request->get('otra_profesion')),
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now()
            ]);
        }

        DB::table('personal')->insert([
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
            'tpersonal'   => strtoupper('personal administrativo'),
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now()
        ]);

        $cedula = DB::table('administrativos')->insertGetId([
            'cpersonal'   => $request->get('cedula'),
            'profesion'   => strtoupper($profesion),
            'cargo'       => strtoupper($request->get('cargo')),
            'dependencia' => $request->get('dependencia'),
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now()
        ]);

        if(Administrativo::where('cpersonal', $request->get('cedula'))->exists()) {
            return redirect()->action('AdministrativoController@inicio')
                ->with(['mensaje' => 'El administrativo fue registrado satisfactoriamente.']);
        }
    }

    public function editar($cedula) 
    {
        try {
            $personal       = Personal::findOrFail($cedula);
            $administrativo = Administrativo::findOrFail($cedula);
        } 
        catch(ModelNotFoundException $e) {
            return response()->view('errors.'.'500');
        }

        return view('administrativos.editar')->with([
            'personal'       => $personal,
            'administrativo' => $administrativo
        ]);
    }

    public function actualizar(Request $request, $cedula) 
    {
        $administrativo = Administrativo::where('cpersonal', $cedula)
            ->select('dependencia', 'cargo')
            ->first();

        if($administrativo->dependencia != strtoupper($request->get('dependencia'))
        || $administrativo->cargo       != strtoupper($request->get('cargo'))) {
            DB::table('his_administrativo')->insert([
                'danterior'       => $administrativo->dependencia,
                'canterior'       => $administrativo->cargo,
                'cadministrativo' => $cedula,
                'created_at'      => carbon::now(),
                'updated_at'      => carbon::now()
            ]);
        }

        DB::table('personal')
            ->where('cedula', $cedula)
            ->update([
                'nombre'      => strtoupper($request->get('nombre')),
                'apellido'    => strtoupper($request->get('apellido')),
                'fnacimiento' => $request->get('fnacimiento'),
                'sexo'        => $request->get('sexo'),
                'direccion'   => strtoupper($request->get('direccion')),
                'telefono'    => $request->get('telefono'),
                'fingreso'    => $request->get('fingreso'),
                'ecivil'      => strtoupper($request->get('ecivil')),
                'nhijos'      => $request->get('nhijos'),
                'updated_at'  => carbon::now()
        ]);

        DB::table('administrativos')
            ->where('cpersonal', $cedula)
            ->update([
                'profesion'   => strtoupper($request->get('profesion')),
                'dependencia' => strtoupper($request->get('dependencia')),
                'cargo'       => strtoupper($request->get('cargo')),
                'updated_at'  => carbon::now()
            ]);

        return redirect()->action('AdministrativoController@inicio')
            ->with(['mensaje' => 'El administrativo fue actualizado con exito.']);
    }

    public function desactivar($cedula)
    {
        $administrativo = Administrativo::where('cpersonal', '=', $cedula)->first();
        $administrativo->delete();

        $personal = Personal::where('cedula', '=', $cedula)->first();
        $personal->delete();

        return redirect('administrativos');
    }

    private function calcularDiasVacaciones($salida, $ingreso) 
    {
        $fsalida  = \Carbon\Carbon::createFromFormat('Y-m-d', $salida);
        $fingreso = \Carbon\Carbon::createFromFormat('Y-m-d', $ingreso);
        return $fsalida->diffInDays($fingreso);
    }

    public function validarSiYaRegistrado($cedula) {
        $existe = DB::table('personal')->where('cedula', '=', $cedula)->exists();
        return response()->json(['existe' => $existe]);
    }

    public function getRegistroPermisos($cedula) 
    {
        $meses = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');

        $permisos = array(
            "periodos" => array(),
            "personal" => array('name' => 'Personal', 'data' => array()),
            "medico"   => array('name' => 'Medico', 'data' => array()),
            "duelo"    => array('name' => 'Duelo', 'data' => array())
        );

        $mesInicio = 0; $permisoPersonal = 0; $permisoMedico = 0; $permisoDuelo = 0;
        $anioActual = carbon::now()->year;

        if(Input::get('anio') == 1 || empty(Input::get('anio'))) { $anioConsulta = $anioActual; }
        else if(Input::get('anio') == 2) { $anioConsulta = ($anioActual - 1); }
        else { $anioConsulta = ($anioActual - 2); }

        if (Input::get('periodo') == 1 || empty(Input::get('periodo'))) { $mesFinal = carbon::now()->month; }
        else { $mesFinal = 12; }
        
        for ($i = $mesInicio; $i < $mesFinal; $i++) {
            array_push($permisos['periodos'], $meses[$i]);

            if (Input::get('solicitudes') == 1 || empty(Input::get('solicitudes'))) {
                $permisoPersonal = DB::table('permisos')->where('cpersonal', '=', $cedula)->where('tipo', '=', 1)->whereYear('created_at', '=', $anioConsulta)->whereRaw('extract(month from created_at) = ?', [$i+1])->count();
                $permisoMedico = DB::table('permisos')->where('cpersonal', '=', $cedula)->where('tipo', '=', 2)->whereYear('created_at', '=', $anioConsulta)->whereRaw('extract(month from created_at) = ?', [$i+1])->count();
                $permisoDuelo = DB::table('permisos')->where('cpersonal', '=', $cedula)->where('tipo', '=', 3)->whereYear('created_at', '=', $anioConsulta)->whereRaw('extract(month from created_at) = ?', [$i+1])->count();
            }else if (Input::get('solicitudes') == 2){
                $permisoPersonal = DB::table('permisos')->where('cpersonal', '=', $cedula)->where('tipo', '=', 1)->where('estatus', '=', 3)->whereYear('created_at', '=', $anioConsulta)->whereRaw('extract(month from created_at) = ?', [$i+1])->count();
                $permisoMedico = DB::table('permisos')->where('cpersonal', '=', $cedula)->where('tipo', '=', 2)->where('estatus', '=', 3)->whereYear('created_at', '=', $anioConsulta)->whereRaw('extract(month from created_at) = ?', [$i+1])->count();
                $permisoDuelo = DB::table('permisos')->where('cpersonal', '=', $cedula)->where('tipo', '=', 3)->where('estatus', '=', 3)->whereYear('created_at', '=', $anioConsulta)->whereRaw('extract(month from created_at) = ?', [$i+1])->count();
            }else if (Input::get('solicitudes') == 3){
                $permisoPersonal = DB::table('permisos')->where('cpersonal', '=', $cedula)->where('tipo', '=', 1)->where('estatus', '=', 0)->whereYear('created_at', '=', $anioConsulta)->whereRaw('extract(month from created_at) = ?', [$i+1])->count();
                $permisoMedico = DB::table('permisos')->where('cpersonal', '=', $cedula)->where('tipo', '=', 2)->where('estatus', '=', 0)->whereYear('created_at', '=', $anioConsulta)->whereRaw('extract(month from created_at) = ?', [$i+1])->count();
                $permisoDuelo = DB::table('permisos')->where('cpersonal', '=', $cedula)->where('tipo', '=', 3)->where('estatus', '=', 0)->whereYear('created_at', '=', $anioConsulta)->whereRaw('extract(month from created_at) = ?', [$i+1])->count();
            }
         
            array_push($permisos['personal']['data'], $permisoPersonal);
            array_push($permisos['medico']['data'], $permisoMedico);
            array_push($permisos['duelo']['data'], $permisoDuelo);   
        }

        return response()->json($permisos);
    }

    public function getRegistroVacaciones($cedula) {
        $consulta = DB::table('vacaciones')->where('cpersonal', '=', $cedula)->select('fecha_salida')->get();

        $meses = array(
            array('name' => 'Ene', 'y' => 0),
            array('name' => 'Feb', 'y' => 0),
            array('name' => 'Mar', 'y' => 0),
            array('name' => 'Abr', 'y' => 0),
            array('name' => 'May', 'y' => 0),
            array('name' => 'Jun', 'y' => 0),
            array('name' => 'Jul', 'y' => 0),
            array('name' => 'Ago', 'y' => 0),
            array('name' => 'Sep', 'y' => 0),
            array('name' => 'Oct', 'y' => 0),
            array('name' => 'Nov', 'y' => 0),
            array('name' => 'Dic', 'y' => 0)
        );

        foreach ($consulta as $mes) {
            $fecha = strtotime($mes->fecha_salida);
            $m = date("m", $fecha);
            $meses[intval($m) - 1]['y'] += 1;
        }

        return response()->json(['meses' => $meses]);
    }

    private function devolverTurno() 
    {
        $hora = intval(date('H'));

        if (($hora >= 5) && ($hora < 12)) { return "mañana"; }
        else if (($hora >= 12) && ($hora < 18)) { return "tarde"; }
        else { return "noche"; }
    }
}
