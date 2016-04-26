@extends('plantilla')

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ url('/dependencias') }}"><i class="glyphicon glyphicon-tag"></i> Dependencias</a></li>
    <li class="active"><i class="glyphicon glyphicon-folder-open"></i> Mostrar</li>
  </ol>
  <h3>Dependencia <small>/ ver informacion</small></h3>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="col-lg-2 control-label">Codigo</label>
            <div class="col-lg-10">
              <p class="form-control-static">{{ $dependencia->codigo }}</p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Nombre de la dependencia</label>
            <div class="col-lg-10">
              <p class="form-control-static">{{ $dependencia->nombre }}</p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Actividad</label>
            <div class="col-lg-10">
              <p class="form-control-static">{{ $dependencia->actividad }}</p>
            </div>
          </div>
        </form>
    </div>
</div>

<div class="col-lg-6">
  <strong>Creado el</strong>: {{ $dependencia->created_at->format('d/m/Y') }} / <strong>Ultima actualizacion:</strong> {{ $dependencia->updated_at->format('d/m/Y h:i:s A') }}
</div>

<div class="col-lg-6">
  <div class="pull-right">
    <a href="{{ url('/dependencias') }}" type="button" class="btn btn-default"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Atras</a>
    <a href="{{ url('/dependencias/editar', $dependencia->codigo) }}" type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a>  
  </div>
</div>
@stop 