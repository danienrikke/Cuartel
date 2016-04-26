<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Session;
use Carbon\Carbon as Carbon;

use App\Dependencia;
use DB;

class DependenciaController extends Controller
{
    public function inicio()
    {
        $dependencias = Dependencia::all();
        return view('dependencias.inicio')->with('dependencias', $dependencias);
    }

    public function mostrar($codigo)
    {
        $dependencia = Dependencia::where('codigo', $codigo)->firstOrFail();
        return view('dependencias.mostrar')->with('dependencia', $dependencia);
    }

    public function crear()
    {
        return view('dependencias.crear');
    }

    public function guardar(Request $request)
    {
        $codigo = DB::table('dependencias')->insertGetId([
                'nombre' => strtoupper($request->get('nombre')),
                'actividad' => strtoupper($request->get('actividad')),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

        if(Dependencia::where('codigo', $codigo)->exists()) {
            return redirect()->action('DependenciaController@inicio')
                ->with(['mensaje' => 'La dependencia fue registrada satisfactoriamente.']);
        }
    }

    public function editar($codigo)
    {
        $dependencia = Dependencia::where('codigo', $codigo)->firstOrFail();
        return view('dependencias.editar')->with('dependencia', $dependencia);
    }

    public function actualizar(Request $request, $codigo)
    {
        DB::table('dependencias')
                    ->where('codigo', $codigo)
                    ->update([
                        'nombre' => strtoupper($request->get('nombre')),
                        'actividad' => strtoupper($request->get('actividad')),
                        'updated_at' => Carbon::now() 
                    ]);

        return redirect()->action('DependenciaController@inicio')
            ->with(['mensaje' => 'La informacion de la  dependencia fue actualizada con exito.']);
    }
}
