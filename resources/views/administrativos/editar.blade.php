@extends('plantilla')

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ url('/administrativos') }}"><i class="glyphicon glyphicon-bookmark"></i> Administrativos</a></li>
    <li class="active"><i class="glyphicon glyphicon-pencil"></i> Actualizar</li>
  </ol>
  <h3>Personal Civil Administrativo <small>/ actualización de informacion</small></h3>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    {!! Form::model($administrativo, ['url' => ['/administrativos', $personal->cedula], 'autocomplete' => 'off', 'method' => 'patch', 'role' => 'form', 'id' => 'formulario']) !!}
      
      <div class="alert alert-warning" role="alert">
        <span class="glyphicon glyphicon-info-sign"></span> <strong>Atencion</strong> se modificaran los datos del personal.
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            {!! Form::label('cedula', 'Cedula', ['class' => 'control-label']) !!}
            {!! Form::text('cedula', $personal->cedula, ['class' => 'form-control', 'readonly', 'tabindex' => '-1']) !!}
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            {!! Form::label('nombre', 'Nombre', ['class' => 'control-label']) !!}
            {!! Form::text('nombre', $personal->nombre, ['class' => 'form-control', 'tabindex' => '1']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('apellido', 'Apellido', ['class' => 'control-label']) !!}
            {!! Form::text('apellido', $personal->apellido, ['class' => 'form-control', 'tabindex' => '2']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('fnacimiento', 'Fecha de nacimiento', ['class' => 'control-label']) !!}
            {!! Form::date('fnacimiento', $personal->fnacimiento, ['class' => 'form-control', 'tabindex' => '3']) !!}
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            {!! Form::label('sexo', 'Sexo', ['class' => 'control-label selectContainer']) !!}
            {!! Form::select('sexo', ['MASCULINO' => 'MASCULINO', 'FEMENINO' => 'FEMENINO'], $personal->sexo, ['class' => 'form-control', 'tabindex' => '4']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('direccion', 'Direccion', ['class' => 'control-label']) !!}
            {!! Form::textarea('direccion', $personal->direccion, ['class' => 'form-control', 'size' => '10x2', 'tabindex' => '5']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('telefono', 'Telefono', ['class' => 'control-label']) !!}
            {!! Form::text('telefono', $personal->telefono, ['class' => 'form-control', 'tabindex' => '6']) !!}
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            {!! Form::label('fingreso', 'Fecha de ingreso', ['class' => 'control-label']) !!}
            {!! Form::date('fingreso', $personal->fingreso, ['class' => 'form-control', 'tabindex' => '7']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('ecivil', 'Estado civil', ['class' => 'control-label selectContainer']) !!}
            {!! Form::select('ecivil', ['SOLTERO/A' => 'SOLTERO/A', 'COMPROMETIDO/A' => 'COMPROMETIDO/A', 'CASADO/A' => 'CASADO/A', 'DIVORCIADO/A' => 'DIVORCIADO/A', 'VIUDO/A' => 'VIUDO/A'], $personal->ecivil, ['class' => 'form-control', 'tabindex' => '8']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('nhijos', 'Numero de hijos', ['class' => 'control-label']) !!}
            {!! Form::text('nhijos', $personal->nhijos, ['class' => 'form-control', 'tabindex' => '9']) !!}
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            {!! Form::label('profesion', 'Profesion', ['class' => 'control-label selectContainer']) !!}
            {!! Form::select('profesion', DB::table('profesiones')->pluck('nombre', 'codigo'), $administrativo->profesion, ['class' => 'form-control', 'tabindex' => '10']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('dependencia', 'Dependencia', ['class' => 'control-label selectContainer']) !!}
            {!! Form::select('dependencia', DB::table('dependencias')->pluck('nombre', 'codigo'), $administrativo->dependencia, ['class' => 'form-control', 'tabindex' => '11']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('cargo', 'Cargo', ['class' => 'control-label selectContainer']) !!}
            {!! Form::select('cargo', DB::table('cargos')->pluck('tipo', 'codigo'), $administrativo->cargo, ['class' => 'form-control', 'tabindex' => '12']) !!}
          </div>
        </div>
      </div>

      <br/>

      <div class="pull-right">
        <a href="{{ url('/administrativos', $personal->cedula) }}" type="button" class="btn btn-default" tabindex="14">
          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
        </a>
        <button type="submit" class="btn btn-primary" tabindex="13"> 
          <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Confirmar actualizacion
        </button>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection