@extends('plantilla')

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ url('/consultorios') }}"><i class="glyphicon glyphicon-tag"></i> Consultorios</a></li>
    <li class="active"><i class="glyphicon glyphicon-pencil"></i> Editar</li>
  </ol>
  <h3>Consultorio <small>/ ver informacion</small></h3>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    {!! Form::open(['url' => ['/consultorios', $consultorio->codigo], 'method' => 'patch', 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'formularioConsultorio']) !!}
      <div class="alert alert-warning" role="alert">
        <i class="glyphicon glyphicon-pencil"></i> <strong>Editar consultorio</strong> formulario de actualizacion de datos.
      </div>

      <div class="form-group">
        {!! Form::label('nombre', 'Nombre del consultorio', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
          {!! Form::textarea('nombre', $consultorio->nombre, ['class' => 'form-control', 'size' => '10x2', 'tabindex' => '1']) !!}
        </div>
      </div>

      <br/>

      <div class="pull-right">
        <a href="{{ url('/consultorios', $consultorio->codigo) }}" type="button" class="btn btn-default" tabindex="3"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="2"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Confirmar actualizacion</button>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop