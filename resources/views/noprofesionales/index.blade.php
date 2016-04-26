@extends('master')

@section('styles')
<style type="text/css">
	div.dataTables_wrapper { margin: 0 auto; }
</style>
@endsection

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
	<li><a href="{{ route('inicio') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
	<li class="active"><i class="glyphicon glyphicon-star-empty"></i> No profesionales</li>
  </ol>
  <h3>
  	Personal Militar No Profesional <small>/ lista de registros</small>
  	<span class="pull-right">
  		<a href="{{ route('noprofesionales.create') }}" type="button" class="btn btn-primary">
			<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Nuevo
		</a>
  	</span>
  </h3>
</div>

	@if(Session::has('mensaje'))
	<div class="alert {{ Session::get('tipo') }} alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	  	<strong>Mensaje: </strong> {{ Session::get('mensaje') }}
	</div>
    @endif

<table id="TablaNoProfesionales" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
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
			<td><a href="{{ route('noprofesionales.show', $_personal->cedula) }}" title="Ver toda la informacion">{{ $_personal->cedula }}</a></td>
			<td>{{ $_personal->nombre }}</td>
			<td>{{ $_personal->apellido }}</td>
			<td style="text-align: right;">{{ $_personal->edad }}</td>
			<td>{{ $_personal->sexo }}</td>
			<td>{{ \Carbon\Carbon::parse($_personal->fingreso)->format('d/m/Y') }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@stop

@section('scripts')
<script>
	$(document).ready(function() {
		$('#TablaNoProfesionales').DataTable({
			"language" : {
				"url" : "http://localhost/dpart.personal/public/libs/DataTables/media/js/language/Spanish.json"
			},
			//"scrollY" : 340,
			"scrollX": true,
			"columnDefs": [
				{ "width": "9%", "targets": 0 },
				{ "width": "4%", "targets": 3 }
			]
		});

		window.setTimeout(function() {
		    $(".alert").fadeTo(1500, 0).slideUp(500, function(){
		        $(this).remove(); 
		    });
		}, 5000);
	});
</script>
@endsection