@extends('plantilla')

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="active"><i class="glyphicon glyphicon-home"></i> Inicio</li>
  </ol>
  <h3>Pagina principal <small>/ bienvenido</small></h3>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<div class="bs-callout bs-callout-primary">
		  	<h5>Hay <strong>{{ count($permisos_pendientes) }} solicitud(es) de permiso(s)</strong> en espera por aprobacion.</h5>
		  
		  	<br/>

			<table id="permisosPendientes" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Cedula</th>
						<th>Nombre completo</th>
						<th>Tipo</th>
						<th>Descripcion</th>
						<th>Fec. solicitud</th>
						<th>Fec. permiso</th>
						<th>Fec. ingreso</th>
					</tr>
				</thead>
				<tbody>
					@foreach($permisos_pendientes as $permiso)
					<tr>
						<td style="text-align: right;"><a href="{{ url('/personal/buscar', $permiso->cedula) }}" title="Ver toda la informacion"><strong>{{ $permiso->cedula }}</strong></a></td>
						<td>{{ $permiso->nombre }} {{ $permiso->apellido }}</td>
						<td>
						  @if($permiso->tipo == 1)
			                Personal
			              @elseif($permiso->tipo == 2)
			                Medico
			              @elseif($permiso->tipo == 3)
			                Duelo
			              @endif
						</td>
						<td>{{ $permiso->descripcion }}</td>
						<td>{{ \Carbon\Carbon::parse($permiso->created_at)->format('d/m/Y') }}</td>
						<td>{{ \Carbon\Carbon::parse($permiso->fecha_permiso)->format('d/m/Y') }}</td>
						<td>{{ \Carbon\Carbon::parse($permiso->fecha_ingreso)->format('d/m/Y') }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<hr>

		<div class="bs-callout bs-callout-primary">
		  	<h5>Hay <strong>{{ count($vacaciones_pendientes) }} solicitud(es) de vacacione(s)</strong> en espera por aprobacion.</h5>
		  
		  	<br/>

			<table id="vacacionesPendientes" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Cedula</th>
						<th>Nombre completo</th>
						<th>Depedencia</th>
						<th>Fec. solicitud</th>
						<th>Fec. salida</th>
						<th>Fec. ingreso</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
