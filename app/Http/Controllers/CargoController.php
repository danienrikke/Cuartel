<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Session;
use Carbon\Carbon as Carbon;

use App\Cargo;
use DB;

class CargoController extends Controller
{
    public function inicio()
    {
        $cargos = Cargo::all();
        return view('cargos.inicio')->with('cargos', $cargos);
    }

    public function mostrar($codigo)
    {
        $cargo = Cargo::where('codigo', $codigo)->firstOrFail();
        return view('cargos.mostrar')->with('cargo', $cargo);
    }

    public function crear()
    {
        return view('cargos.crear');
    }

    public function guardar(Request $request)
    {
        $codigo = DB::table('cargos')->insertGetId([
                'tipo' => strtoupper($request->get('tipo')),
                'descripcion' => strtoupper($request->get('descripcion')),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

        if(Cargo::where('codigo', $codigo)->exists()) {
            return redirect()->action('CargoController@inicio')
                ->with(['mensaje' => 'El cargo fue registrado satisfactoriamente.']);
        }
    }

    public function editar($codigo)
    {
        $cargo = Cargo::where('codigo', $codigo)->firstOrFail();
        return view('cargos.editar')->with('cargo', $cargo);
    }

    public function actualizar(Request $request, $codigo)
    {
        DB::table('cargos')
                    ->where('codigo', $codigo)
                    ->update([
                        'tipo' => strtoupper($request->get('tipo')),
                        'descripcion' => strtoupper($request->get('descripcion')),
                        'updated_at' => Carbon::now() 
                    ]);

        return redirect()->action('CargoController@inicio')
            ->with(['mensaje' => 'La informacion del cargo fue actualizada con exito.']);
    }
}
