@extends('error')

@section('styles')
<style type="text/css">
.error-template {padding: 40px 15px;text-align: center;}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }
</style>
@endsection

@section('contenido')
<div class="row">
	<div class="col-lg-12">
        <div class="error-template">
            <h2>Error 404</h2>
            <p class="error-details">La ruta solicitada no existe o ya no esta disponible.</p>
            <div class="error-actions">
            	<a href="{{ url('/') }}" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Ir al inicio</a>
           	</div>
        </div>
	</div>
</div>
@stop