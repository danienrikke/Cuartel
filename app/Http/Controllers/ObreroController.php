<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Response;

use App\Obrero;
use App\personal;
use App\Area;
use DB;

class ObreroController extends Controller
{
    public function index()
    {
        $personal = array();
        $obreros = Obrero::with('personal')->get();

        foreach ($obreros as $_obrero)
        {
            array_push($personal, Personal::find($_obrero->cpersonal));
        }

        foreach ($personal as $_personal) 
        {
            $d = date_parse_from_format("Y-m-d", $_personal->fnacimiento);
            $_personal->edad = \Carbon\Carbon::createFromDate($d['year'], $d['month'], $d['day'])->age;
        }

        return view('obreros.index')->with('personal', $personal);
    }
    
    public function show($cedula) 
    {
        try 
        {
            $personal = Personal::findOrFail($cedula);
            $obrero   = Obrero::findOrFail($cedula);
        } 
        catch(ModelNotFoundException $e) 
        {
            return response()->view('errors.'.'500');
        }

        $area  = Area::where('codigo', '=', $obrero->area)
                    ->select('codigo', 'nombre')
                    ->firstOrFail();

        $d = date_parse_from_format("Y-m-d", $personal->fnacimiento);
        $personal->edad = \Carbon\Carbon::createFromDate($d['year'], $d['month'], $d['day'])->age;

        return view('obreros.show')->with(
            [
                'personal'    => $personal,
                'obrero'      => $obrero,
                'area'        => $area
            ]
        );
    }

    public function create()
    {
        $areas         = DB::table('areas')->get();

        return view("obreros.create")->with(
            [
                'areas'         => $areas
            ]
        );
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
                'tpersonal'   => strtoupper('personal obrero'),
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now()
            ]
        );

        $seGuardo = DB::table('obreros')->insert(
            [
                'cpersonal'    => $request->get('cedula'),
                'ginstruccion' => strtoupper($request->get('ginstruccion')),
                'tobrero'      => $request->get('tobrero'),
                'area'         => $request->get('area'),
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
            $mensaje = "El personal obrero se registro con exito.";
            $tipo = "alert-success";
        }

        return Redirect::action('ObreroController@index')
                ->with(['mensaje' => $mensaje, 'tipo' => $tipo]);
    }

    public function edit($cedula) 
    {
        try 
        {
            $personal = Personal::findOrFail($cedula);
            $obrero   = Obrero::findOrFail($cedula);
        } 
        catch(ModelNotFoundException $e) 
        {
            return response()->view('errors.'.'500');
        }

        $tipo_obrero  = DB::table('tipos_obreros')
            ->select('codigo', 'nombre')
            ->where('codigo', $obrero->tobrero)
            ->first();

        $tipos_obreros  = DB::table('tipos_obreros')->select('codigo', 'nombre')->get();

        $area  = Area::where('codigo', '=', $obrero->area)
                    ->select('codigo', 'nombre')
                    ->first();

        $areas  = DB::table('areas')->select('codigo', 'nombre')->get();

        return view('obreros.edit')->with(
            [
                'personal'      => $personal,
                'obrero'        => $obrero,
                'area'          => $area,
                'areas'         => $areas,
                'tipo_obrero'   => $tipo_obrero,
                'tipos_obreros' => $tipos_obreros
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
                ->update(
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

            DB::table('obreros')
                ->where('cpersonal', $cedula)
                ->update(
                            [
                                'ginstruccion' => strtoupper($request->get('ginstruccion')),
                                'tobrero'      => $request->get('tobrero'),
                                'updated_at'   => \Carbon\Carbon::now()
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
            $mensaje = "Ocurrio un problema al actualizar la informacion del obrero.";
            $tipo    = "alert-danger";
        }
        else 
        {
            $mensaje = "La informacion del personal obrero se actualizado con exito.";
            $tipo    = "alert-success";
        }

        return Redirect::action('ObreroController@index')
                ->with(['mensaje' => $mensaje, 'tipo' => $tipo]);
    }

    public function destroy($cedula) 
    {
        $obrero = Obrero::where('cpersonal', '=', $cedula)->first();
        $obrero->delete();

        $personal = Personal::where('cedula', '=', $cedula)->first();
        $personal->delete();

        return redirect('obreros');
    }
}
