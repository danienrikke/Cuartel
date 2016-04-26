@extends('plantilla')

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ url('/dependencias') }}"><i class="glyphicon glyphicon-tag"></i> Dependencias</a></li>
    <li class="active"><i class="glyphicon glyphicon-file"></i> Registrar</li>
  </ol>
  <h3>Dependencia <small>/ registro de datos.</small></h3>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    {!! Form::open(['url' => '/dependencias', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'formularioDependencia']) !!}
      <div class="alert alert-info" role="alert">
        <i class="glyphicon glyphicon-file"></i> <strong>Registrar dependencia</strong> formulario de registro de datos.
      </div>

      <div class="form-group">
        {!! Form::label('nombre', 'Nombre de la dependencia', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
          {!! Form::text('nombre', null, array('class' => 'form-control', 'autofocus', 'tabindex' => '1')) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('actividad', 'Actividad', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
          {!! Form::textarea('actividad', null, array('class' => 'form-control', 'size' => '10x2', 'tabindex' => '2')) !!}
        </div>
      </div>

      <br/>

      <div class="pull-right">
        <a href="{{ url('/dependencias') }}" type="button" class="btn btn-default" tabindex="4"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="3"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Guardar</button>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop