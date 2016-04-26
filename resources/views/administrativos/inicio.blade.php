@extends('plantilla')

@section('contenido')
<div class="page-header">
	<ol class="breadcrumb">
		<li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
		<li class="active"><i class="glyphicon glyphicon-bookmark"></i> Administrativos</li>
  	</ol>
  	<h3>
	  	Personal Civil Administrativo <small>/ lista de registros</small>
	  	<span class="pull-right">
	  		<a href="{{ url('/administrativos/crear') }}" type="button" class="btn btn-primary">
				<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Nuevo
			</a>
	  	</span>
  	</h3>
</div>

<div class="panel panel-default">
    <div class="panel-body">
		<div class="row">
			<div class="row vdivide">
			    <div class="col-lg-4 text-center">
			    	<strong>Cantidad de administrativos</strong> <br/>
		            <span style="font-size: 20px;">{{  $cAdministrativos['nAdministrativos'] }}</span> de un total de {{ $cAdministrativos['nPersonal'] }} trabajadores.
		        </div>
			    <div class="col-lg-4 text-center">
			    	<strong>Asistencias de hoy</strong> <small>(turno {{ $turno }})</small><br/>
		           	<span style="font-size: 20px;">{{ $estatus['asistencias'] }}%</span> de los administrativos activos.
			    </div>
			    <div class="col-lg-4 text-center">
			    	<strong>Estatus</strong> del personal administrativo<br/>
			    	<span style="font-size: 20px;">{{ $estatus['permisos'] }}%</span> <strong>de permiso</strong> /
		           	<span style="font-size: 20px;">{{ $estatus['vacaciones'] }}%</span> <strong>en vacaciones</strong>
			    </div>
			</div>
		</div>
	</div>
</div>

@if(Session::has('mensaje'))
	<div class="alert alert-success alert-dismissible" id="mensajeBaseDatos" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	  	<strong>Mensaje: </strong> {{ Session::get('mensaje') }}
	</div>
@endif

<div class="panel panel-default">
	<div class="panel-body">
		<table id="tablaAdministrativos" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Cedula</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Edad</th>
					<th>Sexo</th>
					<th>Fec. ingreso</th>
				</tr>
			</thead>
			<tbody>
				@foreach($personal as $_personal)
				<tr>
					<td style="text-align: right;"><a href="{{ url('/administrativos', $_personal->cedula) }}" title="Ver toda la informacion"><strong>{{ $_personal->cedula }}</strong></a></td>
					<td>{{ $_personal->nombre }}</td>
					<td>{{ $_personal->apellido }}</td>
					<td style="text-align: right;">{{ $_personal->edad }}</td>
					<td>{{ $_personal->sexo }}</td>
					<td>{{ \Carbon\Carbon::parse($_personal->fingreso)->format('d/m/Y') }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop