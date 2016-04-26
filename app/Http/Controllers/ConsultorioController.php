<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Session;
use Carbon\Carbon as Carbon;

use App\Consultorio;
use DB;

class ConsultorioController extends Controller
{
    public function inicio()
    {
        $consultorios = Consultorio::all();
        return view('consultorios.inicio')->with('consultorios', $consultorios);
    }

    public function mostrar($codigo)
    {
        $consultorio = Consultorio::where('codigo', $codigo)->firstOrFail();
        return view('consultorios.mostrar')->with('consultorio', $consultorio);
    }

    public function crear()
    {
        return view('consultorios.crear');
    }

    public function guardar(Request $request)
    {
        $codigo = DB::table('consultorios')->insertGetId([
                'nombre'     => strtoupper($request->get('nombre')),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

        if(Consultorio::where('codigo', $codigo)->exists()) {
            return redirect()->action('ConsultorioController@inicio')
                ->with(['mensaje' => 'El consultorio fue registrado satisfactoriamente.']);
        }
    }

    public function editar($codigo)
    {
        $consultorio = Consultorio::where('codigo', $codigo)->firstOrFail();
        return view('consultorios.editar')->with('consultorio', $consultorio);
    }

    public function actualizar(Request $request, $codigo)
    {
        DB::table('consultorios')
                    ->where('codigo', $codigo)
                    ->update([
                        'nombre' => strtoupper($request->get('nombre')),
                        'updated_at' => Carbon::now() 
                    ]);

        return redirect()->action('ConsultorioController@inicio')
            ->with(['mensaje' => 'La informacion del consultorio fue actualizada con exito.']);
    }
}
