@extends('plantilla')

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ url('/cargos') }}"><i class="glyphicon glyphicon-tag"></i> Cargos</a></li>
    <li class="active"><i class="glyphicon glyphicon-pencil"></i> Editar</li>
  </ol>
  <h3>Cargo <small>/ ver informacion</small></h3>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    {!! Form::open(['url' => ['/cargos', $cargo->codigo], 'method' => 'patch', 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'formularioCargo']) !!}
      <div class="alert alert-warning" role="alert">
        <i class="glyphicon glyphicon-pencil"></i> <strong>Editar cargo</strong> formulario de actualizacion de datos.
      </div>

      <div class="form-group">
        {!! Form::label('tipo', 'Tipo de cargo', ['class' => 'col-lg-2 control-label']) !!}
          <div class="col-lg-10">
            {!! Form::text('tipo', $cargo->tipo, ['class' => 'form-control', 'autofocus', 'tabindex' => '1']) !!}
          </div>
      </div>

      <div class="form-group">
        {!! Form::label('descripcion', 'Descripcion', ['class' => 'col-lg-2 control-label']) !!}
          <div class="col-lg-10">
            {!! Form::textarea('descripcion', $cargo->descripcion, ['class' => 'form-control', 'size' => '10x2', 'tabindex' => '2']) !!}
          </div>
      </div>

      <br/>

      <div class="pull-right">
        <a href="{{ url('/cargos', $cargo->codigo) }}" type="button" class="btn btn-default" tabindex="3"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="2"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Confirmar actualizacion</button>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop