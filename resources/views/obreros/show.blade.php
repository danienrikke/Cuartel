@extends('master')

@section('styles')
<style type="text/css">
	form .form-group{ margin-bottom: 5px; }
  .tab-content .tab-pane { margin-top: 20px; }
</style>
@endsection

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ route('inicio') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ route('obreros.index') }}"><i class="glyphicon glyphicon-user"></i> Obreros</a></li>
    <li class="active"><i class="glyphicon glyphicon-file"></i> Mostrar</li>
  </ol>
  <h3>Personal Civil Obrero <small>/ ver informacion</small></h3>
</div>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#informacion">Informacion</a></li>
  <li><a data-toggle="tab" href="#empleado">Datos de empleado</a></li>
</ul>
<div class="tab-content">
  <div id="informacion" class="tab-pane active">
    <form class="form-horizontal">
      <div class="form-group">
        <label class="col-lg-2 control-label">Cedula</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ $personal->cedula }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Nombre completo</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ $personal->nombre }} {{ $personal->apellido }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Edad</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ $personal->edad }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Sexo</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ $personal->sexo }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Estado civil</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ $personal->ecivil }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Numero de hijos</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ $personal->nhijos }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Direccion</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ $personal->direccion }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Telefono</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ $personal->telefono }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Grado de instruccion</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ $obrero->ginstruccion }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Fecha de nacimiento</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ \Carbon\Carbon::parse($personal->fnacimiento)->format('d/m/Y') }}</p>
        </div>
      </div>
    </form>
  </div>

  <div id="empleado" class="tab-pane">
    <form class="form-horizontal">

      <div class="form-group">
        <label class="col-lg-2 control-label">Tipo personal</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ $personal->tpersonal }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Tipo obrero</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ $obrero->tobrero }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Fecha de ingreso</label>
        <div class="col-lg-10">
          <p class="form-control-static">{{ \Carbon\Carbon::parse($personal->fingreso)->format('d/m/Y') }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Area</label>
        <div class="col-lg-10">
          <p class="form-control-static"><a href="{{ route('areas.show', $area->codigo) }}">{{ $area->nombre }}</a></p>
        </div>
      </div>
    </form>
  </div>
</div>

<hr>

<div class="col-sm-6">
  <strong>Creado el</strong>: {{ Carbon\Carbon::parse($obrero->created_at)->format('d/m/Y') }} - <strong>Ultima actualizacion:</strong> {{ Carbon\Carbon::parse($obrero->updated_at)->format('d/m/Y H:s:i A') }}
</div>

<div class="col-sm-6">
  <div class="pull-right">
    <a href="{{ route('obreros.index') }}" type="button" class="btn btn-default"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Atras</a>
    <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-ventana"><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span> Desactivar</a>
    <a href="{{ route('obreros.edit', $personal->cedula) }}" type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Actualizar</a>
  </div>
</div>
@stop

@section('modal')
<div class="modal" id="modal-ventana" tabindex="-1" role="dialog" aria-labelledby="eliminarRegistro">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="eliminarRegistroTitulo"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;CONFIRMAR OPERACION</h4>
      </div>
      <div class="modal-body">
        <p>¿Enviar a <strong>{{ $personal->nombre }} {{ $personal->apellido }}</strong> a registros inactivos?</p>
      </div>
      <div class="modal-footer">
        {!! Form::open(['method' => 'delete']) !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
          <button type="submit" class="btn btn-primary">SI</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@show