@extends('plantilla')

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ url('/areas') }}"><i class="glyphicon glyphicon-tag"></i> Areas</a></li>
    <li class="active"><i class="glyphicon glyphicon-file"></i> Registrar</li>
  </ol>
  <h3>Area <small>/ registro de datos.</small></h3>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    {!! Form::open(['url' => '/areas', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'formularioArea']) !!}
      <div class="alert alert-info" role="alert">
        <i class="glyphicon glyphicon-file"></i> <strong>Registrar area</strong> formulario de registro de datos.
      </div>

      <div class="form-group">
        {!! Form::label('nombre', 'Nombre del area', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
          {!! Form::textarea('nombre', null, ['class' => 'form-control', 'size' => '10x2', 'autofocus', 'tabindex' => '1']) !!}
        </div>
      </div>

      <br/>

      <div class="pull-right">
        <a href="{{ url('/areas') }}" type="button" class="btn btn-default" tabindex="3"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="2"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Guardar</button>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop