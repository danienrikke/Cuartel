<?php

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'InicioController@inicio');

	Route::get('/areas', 'AreaController@inicio');
	Route::get('/areas/crear', 'AreaController@crear');
	Route::post('/areas', 'AreaController@guardar');
	Route::get('/areas/{codigo}', 'AreaController@mostrar');
	Route::get('/areas/editar/{codigo}', 'AreaController@editar');
    Route::patch('/areas/{codigo}', 'AreaController@actualizar');

	Route::get('/cargos', 'CargoController@inicio');
	Route::get('/cargos/crear', 'CargoController@crear');
	Route::post('/cargos', 'CargoController@guardar');
	Route::get('/cargos/{codigo}', 'CargoController@mostrar');
	Route::get('/cargos/editar/{codigo}', 'CargoController@editar');
    Route::patch('/cargos/{codigo}', 'CargoController@actualizar');

	Route::get('/dependencias', 'DependenciaController@inicio');
	Route::get('/dependencias/crear', 'DependenciaController@crear');
	Route::post('/dependencias', 'DependenciaController@guardar');
	Route::get('/dependencias/{codigo}', 'DependenciaController@mostrar');
	Route::get('/dependencias/editar/{codigo}', 'DependenciaController@editar');
    Route::patch('/dependencias/{codigo}', 'DependenciaController@actualizar');

	Route::get('/consultorios', 'ConsultorioController@inicio');
	Route::get('/consultorios/crear', 'ConsultorioController@crear');
	Route::post('/consultorios', 'ConsultorioController@guardar');
	Route::get('/consultorios/{codigo}', 'ConsultorioController@mostrar');
	Route::get('/consultorios/editar/{codigo}', 'ConsultorioController@editar');
    Route::patch('/consultorios/{codigo}', 'ConsultorioController@actualizar');

    // rutas de datos de las graficas
	Route::get('/permisos/registros/{cedula}', 'AdministrativoController@getRegistroPermisos');
	Route::get('/vacaciones/registros/{cedula}', 'AdministrativoController@getRegistroVacaciones');

    // rutas de personal administrativo
	Route::get('/administrativos', 'AdministrativoController@inicio');
	Route::get('/administrativos/crear', 'AdministrativoController@crear');
	Route::post('/administrativos', 'AdministrativoController@guardar');
	Route::get('/administrativos/{cedula}', 'AdministrativoController@mostrar');
	Route::get('/administrativos/editar/{cedula}', 'AdministrativoController@editar');
    Route::patch('/administrativos/{cedula}', 'AdministrativoController@actualizar');
    Route::delete('/administrativos/{cedula}', 'AdministrativoController@desactivar');

	Route::resource('obreros', 'ObreroController');
	Route::resource('medicos', 'MedicoController');
	Route::resource('profesionales', 'ProfesionalController');
	Route::resource('noprofesionales', 'NoProfesionalController');

	// rutas de asistencias
	Route::get('/asistencias', 'AsistenciaController@inicio');
	Route::post('/asistencias', 'AsistenciaController@tomarAsistencia');
	Route::get('/asistencias/consultarPersonal/{cedula}', 'AsistenciaController@consultarPersonal');
	Route::get('/asistencias/getLista', 'AsistenciaController@getLista');

	// rutas de validaciones si una personal ya se encuentra registrado
	Route::get('/administrativo/validarSiYaRegistrado/{cedula}', 'AdministrativoController@validarSiYaRegistrado');

	Route::patch('/vacaciones/aprobar/{cedula}', 'VacacionesController@aprobar');
	Route::post('/vacaciones/solicitud', 'VacacionesController@solicitud');

	Route::patch('/permisos/aprobar/{cedula}', 'PermisoController@aprobar');
	Route::post('/permiso/solicitud', 'PermisoController@solicitud');

	Route::get('/personal/buscar/{cedula}', function($cedula) {
		if (DB::table('obreros')->where('cpersonal', '=', $cedula)->count() > 0) 
		{
   			return redirect()->action('ObreroController@mostrar', ["cedula" => $cedula]);
		}
		else if (DB::table('medicos')->where('cpersonal', '=', $cedula)->count() > 0) 
		{
   			return redirect()->action('MedicoController@mostrar', ["cedula" => $cedula]);		
		}
		else if (DB::table('administrativos')->where('cpersonal', '=', $cedula)->count() > 0) 
		{
   			return redirect()->action('AdministrativoController@mostrar', ["cedula" => $cedula]);		
		}
		else if (DB::table('profesionales')->where('cpersonal', '=', $cedula)->count() > 0) 
		{
   			return redirect()->action('ProfesionalController@mostrar', ["cedula" => $cedula]);			
		}
		else if (DB::table('noprofesionales')->where('cpersonal', '=', $cedula)->count() > 0) 
		{
   			return redirect()->action('NoProfesionalController@mostrar', ["cedula" => $cedula]);			
		}
	});
});

