@extends('master')

@section('styles')
<style type="text/css">
  #formMedico .form-control-feedback { right: 15px; }
  #formMedico .selectContainer .form-control-feedback { right: 25px; }
  .yaRegistrado { display: none; font-size: 13px; }
  .oculto{ display: none; }
  #div_otra_emedica_input { display: none; }
</style>
@endsection

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ route('inicio') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ route('medicos.index') }}"><i class="glyphicon glyphicon-briefcase"></i> Medicos</a></li>
    <li class="active"><i class="glyphicon glyphicon-file"></i> Registro</li>
  </ol>
  <h3>Personal Medico <small>/ nuevo registro</small></h3>
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

{!! Form::open(array('route' => array('medicos.store'), 'class' => 'form-horizontal', 'method' => 'post', 'autocomplete' => 'off', 'role' => 'form', 'id' => 'formulario')) !!}
  
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
      {!! Form::select('sexo', array('' => '', 'MASCULINO' => 'MASCULINO', 'FEMENINO' => 'FEMENINO'), null, array('class' => 'form-control', 'tabindex' => '5')) !!}
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
      {!! Form::select('ecivil', array('' => '', 'SOLTERO/A' => 'SOLTERO/A', 'COMPROMETIDO/A' => 'COMPROMETIDO/A', 'CASADO/A' => 'CASADO/A', 'DIVORCIADO/A' => 'DIVORCIADO/A', 'VIUDO/A' => 'VIUDO/A'), null, array('class' => 'form-control', 'tabindex' => '9')) !!}
    </div>
  </div>
    
  <div class="form-group oculto">
    {!! Form::label('nhijos', 'Numero de hijos', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::text('nhijos', '0', array('class' => 'form-control', 'tabindex' => '10')) !!}
    </div>
  </div>
      
  <div class="form-group oculto">
    {!! Form::label('matricula', 'Matricula', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      {!! Form::text('matricula', null, array('class' => 'form-control', 'tabindex' => '11')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('especialidad', 'Especialidad', array('class' => 'col-lg-2 control-label selectContainer')) !!}
    <div class="col-lg-6" id="div_emedica">
      <select class="form-control" name="especialidad" id="especialidad" tabindex="12">
        <option selected="selected"></option>
        @foreach($especialidades_medicas as $_emedica)
          <option value="{{ $_emedica->codigo }}">{{ $_emedica->nombre }}</option>
        @endforeach
        <option value="otra">OTRA</option>
      </select>
    </div>
    <div id="div_otra_emedica_input">
      {!! Form::text('otra_emedica', null, array('class' => 'form-control', 'required' => 'required', 'id' => 'otra_emedica', 'placeholder' => 'Especifique la especialidad medica', 'tabindex' => '-1')) !!}
    </div>
  </div>

  <div class="form-group oculto">
    {!! Form::label('consultorio', 'Consultorio', array('class' => 'col-lg-2 control-label')) !!}
    <div class="col-lg-6">
      <select class="form-control" name="consultorio" id="consultorio" tabindex="13">
        <option selected></option>
        @foreach($consultorios as $_consultorio)
          <option value="{{ $_consultorio->codigo }}">{{ $_consultorio->nombre }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group oculto">
    <div class="col-lg-8">
      <div class="pull-right">
        <a href="{{ route('medicos.index') }}" type="button" class="btn btn-default" tabindex="15">
          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
        </a>
        <button type="submit" class="btn btn-primary" tabindex="14"> 
          <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Guardar
        </button>
      </div>
    </div>
  </div>

{!! Form::close() !!}
@endsection


@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {

    $('#especialidad').change(function() {
      var valor = $("#especialidad option:selected").val();

      if(valor ==  'otra') 
      {
        $('#div_emedica').attr('class', 'col-lg-2');
        $('#div_otra_emedica_input').css('display', 'block');
        $('#div_otra_emedica_input').addClass('col-lg-4');
        $('#otra_emedica').focus();
      }
      else 
      {
        $('#div_otra_emedica_input').removeClass('col-lg-4');
        $('#div_otra_emedica_input').css('display', 'none');
        $('#div_emedica').attr('class', 'col-lg-6');
      }
    });
  });
</script>
@endsection