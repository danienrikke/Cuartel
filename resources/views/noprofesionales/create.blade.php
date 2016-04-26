@extends('master')

@section('styles')
<style type="text/css">
  #formNoProfesional .form-control-feedback { right: 15px; }
  #formNoProfesional .selectContainer .form-control-feedback { right: 25px; }
  .yaRegistrado { display: none; font-size: 13px; }
  .oculto{ display: none; }
</style>
@endsection

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ route('inicio') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ route('noprofesionales.index') }}"><i class="glyphicon glyphicon-star-empty"></i> No profesionales</a></li>
    <li class="active"><i class="glyphicon glyphicon-file"></i> Registro</li>
  </ol>
  <h3>Personal Militar No Profesional <small>/ nuevo registro</small></h3>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="alert alert-info alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Mensaje de ayuda:</strong> primero ingresa el numero de cedula y luego presiona el boton validar.
    </div>
  </div>
</div>

{!! Form::open(array('route' => array('noprofesionales.store'), 'class' => 'form-horizontal', 'autocomplete' => 'off', 'method' => 'post', 'role' => 'form', 'id' => 'formulario')) !!}

  <div class="form-group">
    {!! Form::label('cedula', 'Cedula', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-4">
      {!! Form::text('cedula', null, array('class' => 'form-control', 'id' => 'cedula', 'tabindex' => '1')) !!}
      <span class="yaRegistrado text-danger">Este numero de cedula ya esta registrado.</span>
    </div>
    <div class="col-lg-2">
      <div class="pull-right">
        <button class="btn btn-success" id="btnValidar" tabindex="2"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> validar</button>
      </div>
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('nombre', 'Nombre', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::text('nombre', null, array('class' => 'form-control', 'tabindex' => '2')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('apellido', 'Apellido', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::text('apellido', null, array('class' => 'form-control', 'tabindex' => '3')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('fnacimiento', 'Fecha de nacimiento', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::date('fnacimiento', null, array('class' => 'form-control', 'tabindex' => '4')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('sexo', 'Sexo', array('class' => 'col-lg-2 control-label selectContainer')) !!}
    <div class="col-lg-6">
      {!! Form::select('sexo', array('' => '', 'MASCULINO' => 'MASCULINO', 'FEMENINO' => 'FEMEINO'), null, array('class' => 'form-control', 'tabindex' => '5')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('direccion', 'Direccion', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::textarea('direccion', null, array('class' => 'form-control', 'size' => '10x2', 'tabindex' => '6')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('telefono', 'Telefono', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::text('telefono', null, array('class' => 'form-control', 'tabindex' => '7')) !!}
    </div>
  </div> 

  <div class="form-group oculto">
    {!! Form::label('fingreso', 'Fecha de ingreso', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::date('fingreso', null, array('class' => 'form-control', 'tabindex' => '8')) !!}
    </div>
  </div> 

  <div class="form-group oculto">
    {!! Form::label('ecivil', 'Estado civil', array('class' => 'col-lg-2 control-label selectContainer')) !!}
    <div class="col-lg-6">
      {!! Form::select('ecivil', array('' => '', 'SOLTERO' => 'SOLTERO', 'CASADO' => 'CASADO'), null, array('class' => 'form-control', 'tabindex' => '9')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('nhijos', 'Numero de hijos', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::text('nhijos', '0', array('class' => 'form-control', 'tabindex' => '10')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('jerarquia', 'Jerarquia', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::select('jerarquia', array('' => '', 'JERARQUIA 1' => 'JERARQUIA 1', 'JERARQUIA 2' => 'JERARQUIA 2'), null, array('class' => 'form-control', 'tabindex' => '11')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('ncuenta', 'Numero de cuenta', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::text('ncuenta', null, array('class' => 'form-control', 'tabindex' => '12')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('contingente', 'Contingente', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::text('contingente', null, array('class' => 'form-control', 'tabindex' => '13')) !!}
    </div>
  </div>

  <div class="form-group oculto">  
    {!! Form::label('situacion', 'Situacion', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::text('situacion', null, array('class' => 'form-control', 'tabindex' => '14')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('dtallas', 'Tallas de uniformes', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::textarea('dtallas', null, array('class' => 'form-control', 'size' => '10x2', 'tabindex' => '15')) !!}
    </div>
  </div>

  <div class="form-group oculto">  
    {!! Form::label('nasignado', 'Numero asignado', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::text('nasignado', null, array('class' => 'form-control', 'tabindex' => '16')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    <div class="col-lg-8">
      <div class="pull-right">
        <a href="{{ route('profesionales.index') }}" type="button" class="btn btn-default" tabindex="18">
          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
        </a>
        <button type="submit" class="btn btn-primary" tabindex="17"> 
          <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Guardar
        </button>
      </div>
    </div>
  </div>

</form>
@endsection