@extends('plantilla')

@section('contenido')
<div class="page-header">
    <ol class="breadcrumb">
	    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
	    <li class="active"><i class="glyphicon glyphicon-tag"></i> Consultorios</li>
    </ol>
    <h3>
        Consultorios <small>/ lista de registros</small>
  	    <span class="pull-right">
            <a href="{{ url('/consultorios/crear') }}" type="button" class="btn btn-primary">
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
		<table id="tablaConsultorios" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Nombre del consultorio</th>
				</tr>
			</thead>
			<tbody>
				@foreach($consultorios as $consultorio)
				<tr>
					<td style="text-align: right;"><strong><a href="{{ url('/consultorios', $consultorio->codigo) }}" title="Presione para consultar el consultorios.">{{ $consultorio->codigo }}</a></strong></td>
					<td>{{ $consultorio->nombre }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop