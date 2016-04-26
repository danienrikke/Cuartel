@extends('master')

@section('styles')
<style type="text/css">
  #formAdministrativo .form-control-feedback { right: 15px; }
  #formAdministrativo .selectContainer .form-control-feedback { right: 25px; }
</style>
@endsection

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ route('inicio') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ route('administrativos.index') }}"><i class="glyphicon glyphicon-bookmark"></i> Administrativos</a></li>
    <li class="active"><i class="glyphicon glyphicon-pencil"></i> Actualizar</li>
  </ol>
  <h3>Personal Civil Administrativo <small>/ actualización de informacion</small></h3>
</div>

{!! Form::model($profesional, array('route' => array('profesionales.update', $personal->cedula), 'class' => 'form-horizontal', 'autocomplete' => 'off', 'method' => 'patch', 'role' => 'form', 'id' => 'formularios')) !!}
  
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
      {!! Form::select('ecivil', array('SOLTERO' => 'SOLTERO', 'CASADO' => 'CASADO'), $personal->ecivil, array('class' => 'form-control', 'tabindex' => '8')) !!}
    </div>
  </div>
      
  <div class="form-group">
    <label for="nhijos" class="col-lg-2 control-label">Numero de hijos</label>
    <div class="col-lg-6">
      <input type="text" class="form-control" name="nhijos" value="{{ $personal->nhijos }}" tabindex="9">
    </div>
  </div>

  <div class="form-group">
    <label for="tmilitar" class="col-lg-2 control-label">Tipo de militar</label>
    <div class="col-lg-6">
      <input type="text" class="form-control" name="tmilitar" value="{{ $profesional->tmilitar }}" tabindex="10">
    </div>
  </div>

  <div class="form-group">
    <label for="jerarquia" class="col-lg-2 control-label selectContainer">Jerarquia</label>
    <div class="col-lg-6">
      {!! Form::select('jerarquia', array('' => '', 'JERARQUIA 1' => 'JERARQUIA 1', 'JERARQUIA 2' => 'JERARQUIA 2'), $profesional->jerarquia, array('class' => 'form-control', 'tabindex' => '11')) !!}
    </div>
  </div>

  <div class="form-group">
    <label for="matricula" class="col-lg-2 control-label">Matricula</label>
    <div class="col-lg-6">
      <input type="text" class="form-control" name="matricula" value="{{ $profesional->matricula }}" tabindex="2">  
    </div>
  </div>

  <div class="form-group">
    <label for="especialidad" class="col-lg-2 control-label selectContainer">Especialidad</label>
    <div class="col-lg-6">
      {!! Form::select('especialidad', array('' => '', 'ESPECIALIDAD 1' => 'ESPECIALIDAD 1', 'ESPECIALIDAD 2' => 'ESPECIALIDAD 2'), $profesional->especialidad, array('class' => 'form-control', 'tabindex' => '13')) !!}
    </div>
  </div>

  <div class="form-group">
    <label for="dtallas" class="col-lg-2 control-label">Tallas de uniformes</label>
    <div class="col-lg-6">
      <textarea name="dtallas" class="form-control" cols="10" rows="2" tabindex=14>{{ $profesional->dtallas }}</textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="iproveniente" class="col-lg-2 control-label">Institucion proveniente</label>
    <div class="col-lg-6">
      <textarea name="iproveniente" class="form-control" cols="10" rows="2" tabindex="15">{{ $profesional->iproveniente }}</textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="fuascenso" class="col-lg-2 control-label">Ultimo ascenso</label>
    <div class="col-lg-6">
      <input type="date" class="form-control" name="fuascenso" value="{{ $profesional->fuascenso }}" tabindex="16">
    </div>
  </div>
    
  <div class="form-group">
    <label for="dependencia" class="col-lg-2 control-label">Dependencia</label>
    <div class="col-lg-6">
      <select name="dependencia" class="form-control" tabindex="17">
        <option value="{{ $dependencia->codigo }}" selected>{{ $dependencia->nombre }}</option>
        <option value="-1">--</option>
        @foreach($dependencias as $_dependencia)
        <option value="{{ $_dependencia->codigo }}">{{ $_dependencia->nombre }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="cargo" class="col-lg-2 control-label">Cargo</label>
    <div class="col-lg-6">
      <select name="cargo" class="form-control" tabindex="18">
        <option value="{{ $cargo->codigo }}" selected>{{ $cargo->tipo }}</option>
        <option value="-1"></option>
        @foreach($cargos as $_cargo)
        <option value="{{ $_cargo->codigo }}">{{ $_cargo->tipo }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-8">
      <div class="pull-right">
        <a href="{{ route('administrativos.index') }}" type="button" class="btn btn-default" tabindex="20">
          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
        </a>
        <button type="submit" class="btn btn-primary" tabindex="19"> 
          <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar cambios
        </button>
      </div>
    </div>
  </div>
  
{!! Form::close() !!}
@endsection