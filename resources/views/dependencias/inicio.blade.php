@extends('plantilla')

@section('contenido')
<div class="page-header">
    <ol class="breadcrumb">
	    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
	    <li class="active"><i class="glyphicon glyphicon-tag"></i> Dependencias</li>
    </ol>
    <h3>
        Dependencias <small>/ lista de registros</small>
  	    <span class="pull-right">
            <a href="{{ url('/dependencias/crear') }}" type="button" class="btn btn-primary">
		        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Nuevo
		    </a>
  	    </span>
    </h3>
</div>

@if(Session::has('mensaje'))
	<div class="alert alert-success alert-dismissible" id="mensajeBaseDatos" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	  	<span class="glyphicon glyphicon-ok"></span> <strong>¡Mensaje de exito! </strong> {{ Session::get('mensaje') }}
	</div>
@endif

<div class="panel panel-default">
	<div class="panel-body">
		<table id="tablaDependencias" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Nombre de la dependencia</th>
					<th>Actividad</th>
				</tr>
			</thead>
			<tbody>
				@foreach($dependencias as $dependencia)
				<tr>
					<td style="text-align: right;"><strong><a href="{{ url('/dependencias', $dependencia->codigo) }}" title="Presione para consultar la dependencia.">{{ $dependencia->codigo }}</a></strong></td>
					<td>{{ $dependencia->nombre }}</td>
					<td>{{ $dependencia->actividad }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop