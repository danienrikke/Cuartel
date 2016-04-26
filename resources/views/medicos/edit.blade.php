@extends('master')

@section('styles')
<style type="text/css">
  #formObrero .form-control-feedback { right: 15px; }
  #formObrero .selectContainer .form-control-feedback { right: 25px; }
</style>
@endsection

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ route('inicio') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ route('medicos.index') }}"><i class="glyphicon glyphicon-briefcase"></i> Medicos</a></li>
    <li class="active"><i class="glyphicon glyphicon-pencil"></i> Actualizar</li>
  </ol>
  <h3>Personal Medico <small>/ actualización de informacion</small></h3>
</div>

{!! Form::model($medico, array('route' => array('medicos.update', $personal->cedula), 'class' => 'form-horizontal', 'autocomplete' => 'off', 'method' => 'patch', 'role' => 'form')) !!}
  
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="form-group">
    <label for="cedula" class="col-lg-2 control-label">Cedula</label>
    <div class="col-lg-6">
      <input type="text" class="form-control" name="cedula" value="{{ $personal->cedula }}" readonly tabindex="-1">
    </div>
  </div>

  <div class="form-group">
    <label for="nombre" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-6">
      <input type="text" class="form-control" name="nombre" value="{{ $personal->nombre }}" tabindex="1">
    </div>
  </div>

  <div class="form-group">
    <label for="apellido" class="col-lg-2 control-label">Apellido</label>
    <div class="col-lg-6">
      <input type="text" class="form-control" name="apellido" value="{{ $personal->apellido }}" tabindex="2">
    </div>
  </div>

  <div class="form-group">
    <label for="fnacimiento" class="col-lg-2 control-label">Fecha de nacimiento</label>
    <div class="col-lg-6">
      <input type="date" class="form-control" name="fnacimiento" value="{{ $personal->fnacimiento }}" tabindex="3">
    </div>
  </div>

  <div class="form-group">
    <label for="sexo" class="col-lg-2 control-label selectContainer">Sexo</label>
    <div class="col-lg-6">
      {!! Form::select('sexo', array('MASCULINO' => 'MASCULINO', 'FEMENINO' => 'FEMENINO'), $personal->sexo ,array('class' => 'form-control', 'tabindex' => '4')) !!}
    </div>
  </div>

  <div class="form-group">
    <label for="direccion" class="col-lg-2 control-label">Direccion</label>
    <div class="col-lg-6">
      <textarea name="direccion" class="form-control" cols="10" rows="2" tabindex="5">{{ $personal->direccion }}</textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="telefono" class="col-lg-2 control-label">Telefono</label>
    <div class="col-lg-6">
      <input type="text" class="form-control" name="telefono" value="{{ $personal->telefono }}" tabindex="6">
    </div>
  </div>

  <div class="form-group">
    <label for="fingreso" class="col-lg-2 control-label">Fecha de ingreso</label>
    <div class="col-lg-6">
      <input type="date" class="form-control" name="fingreso" value="{{ $personal->fingreso }}" tabindex="7">
    </div>
  </div>

  <div class="form-group">
    <label for="ecivil" class="col-lg-2 control-label selectContainer">Estado civil</label>
    <div class="col-lg-6">
      {!! Form::select('ecivil', array('SOLTERO/A' => 'SOLTERO/A', 'COMPROMETIDO/A' => 'COMPROMETIDO/A', 'CASADO/A' => 'CASADO/A', 'DIVORCIADO/A' => 'DIVORCIADO/A', 'VIUDO/A' => 'VIUDO/A'), $personal->ecivil, array('class' => 'form-control', 'tabindex' => '8')) !!}
    </div>
  </div>
      
  <div class="form-group">
    <label for="nhijos" class="col-lg-2 control-label">Numero de hijos</label>
    <div class="col-lg-6">
      <input type="text" class="form-control" name="nhijos" value="{{ $personal->nhijos }}" tabindex="9">
    </div>
  </div>

  <div class="form-group">
    <label for="matricula" class="col-lg-2 control-label">Matricula</label>
    <div class="col-lg-6">
      <input type="text" class="form-control" name="matricula" value="{{ $medico->matricula }}" tabindex="10">
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('especialidad', 'Especialidad', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      <select class="form-control" name="especialidad" id="especialdad" tabindex="11">
        <option value="{{ $especialidad->codigo }}" selected>{{ $especialidad->nombre }}</option>
        <option><small>--</small></option>
        @foreach($especialidades as $_especialidad)
          <option value="{{ $_especialidad->codigo }}">{{ $_especialidad->nombre }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('consultorio', 'Consultorio', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      <select class="form-control" name="consultorio" id="consultorio" tabindex="12">
        <option value="{{ $consultorio->codigo }}" selected>{{ $consultorio->nombre }}</option>
        <option><small>--</small></option>
        @foreach($consultorios as $_consultorio)
          <option value="{{ $_consultorio->codigo }}">{{ $_consultorio->nombre }}</option>
        @endforeach
      </select>
    </div>
  </div>
      
  <div class="form-group">
    <div class="col-lg-8">
      <div class="pull-right">
        <a href="{{ route('medicos.index') }}" type="button" class="btn btn-default" tabindex="14">
          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
        </a>
        <button type="submit" class="btn btn-primary" tabindex="13"> 
          <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar cambios
        </button>
      </div>
    </div>
  </div>
  
{!! Form::close() !!}
@endsection