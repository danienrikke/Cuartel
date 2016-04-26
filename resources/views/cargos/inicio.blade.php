@extends('plantilla')

@section('contenido')
<div class="page-header">
    <ol class="breadcrumb">
	    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
	    <li class="active"><i class="glyphicon glyphicon-tag"></i> Cargos</li>
    </ol>
    <h3>
        Cargos <small>/ lista de registros</small>
  	    <span class="pull-right">
            <a href="{{ url('/cargos/crear') }}" type="button" class="btn btn-primary">
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
		<table id="tablaCargos" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Tipo de Cargo</th>
					<th>Descripcion</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cargos as $cargo)
				<tr>
					<td style="text-align: right;"><strong><a href="{{ url('/cargos', $cargo->codigo) }}" title="Presione para consultar el cargo.">{{ $cargo->codigo }}</a></strong></td>
					<td>{{ $cargo->tipo }}</td>
					<td>{{ $cargo->descripcion }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop