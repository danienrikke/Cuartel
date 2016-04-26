<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Session;
use Carbon\Carbon as carbon;

use App\Area;
use DB;

class AreaController extends Controller
{
    public function inicio()
    {
        $areas = Area::all();
        return view('areas.inicio')->with('areas', $areas);
    }

    public function mostrar($codigo)
    {
        $area = Area::where('codigo', $codigo)->firstOrFail();
        return view('areas.mostrar')->with('area', $area);
    }

    public function crear()
    {
        return view('areas.crear');
    }

    public function guardar(Request $request)
    {
        $codigo = DB::table('areas')->insertGetId([
            'nombre'     => strtoupper($request->get('nombre')),
            'created_at' => carbon::now(),
            'updated_at' => carbon::now()
        ]);

        if(Area::where('codigo', $codigo)->exists()) {
            return redirect()->action('AreaController@inicio')
                ->with(['mensaje' => 'El area fue registrada satisfactoriamente.']);
        }
    }

    public function editar($codigo)
    {
        $area = Area::where('codigo', $codigo)->firstOrFail();
        return view('areas.editar')->with('area', $area);
    }

    public function actualizar(Request $request, $codigo)
    {
        DB::table('areas')
            ->where('codigo', $codigo)
            ->update([
                'nombre' => strtoupper($request->get('nombre')),
                'updated_at' => carbon::now() 
            ]);

        return redirect()->action('AreaController@inicio')
            ->with(['mensaje' => 'La informacion del area fue actualizada con exito.']);
    }
}
