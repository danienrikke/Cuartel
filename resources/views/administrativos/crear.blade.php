@extends('plantilla')

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ url('/administrativos') }}"><i class="glyphicon glyphicon-bookmark"></i> Administrativos</a></li>
    <li class="active"><i class="glyphicon glyphicon-file"></i> Registro</li>
  </ol>
  <h3>Personal Civil Administrativo <small>/ nuevo registro</small></h3>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    {!! Form::open(['url' => '/administrativos', 'autocomplete' => 'off', 'method' => 'post', 'role' => 'form', 'id' => 'formulario']) !!}
      
      <div class="alert alert-info" role="alert">
        <span class="glyphicon glyphicon-info-sign"></span> <strong>Ingresa la cedula</strong> del personal a registrar y luego presiona ENTER.
      </div>  

      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            {!! Form::label('cedula', 'Cedula', ['class' => 'control-label']) !!}
            {!! Form::text('cedula', null, ['class' => 'form-control', 'autofocus', 'tabindex' => '1']) !!}
            <span class="yaRegistrado text-danger">Este numero de cedula ya esta registrado.</span>
          </div>
        </div>
      </div>

      <br/>

      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            {!! Form::label('nombre', 'Nombre', ['class' => 'control-label']) !!}
            {!! Form::text('nombre', null, ['class' => 'form-control', 'disabled' => 'disabled', 'tabindex' => '2']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('apellido', 'Apellido', ['class' => 'control-label']) !!}
            {!! Form::text('apellido', null, ['class' => 'form-control', 'disabled' => 'disabled', 'tabindex' => '3']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('fnacimiento', 'Fecha de nacimiento', ['class' => 'control-label']) !!}
            {!! Form::date('fnacimiento', null, ['class' => 'form-control', 'disabled' => 'disabled', 'tabindex' => '4']) !!}
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            {!! Form::label('sexo', 'Sexo', ['class' => 'control-label selectContainer']) !!}
            {!! Form::select('sexo', ['' => '', 'MASCULINO' => 'MASCULINO', 'FEMENINO' => 'FEMENINO'], null, ['class' => 'form-control', 'disabled' => 'disabled', 'tabindex' => '5']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('direccion', 'Direccion', ['class' => 'control-label']) !!}
            {!! Form::textarea('direccion', null, ['class' => 'form-control', 'size' => '10x2', 'disabled' => 'disabled', 'tabindex' => '6']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('telefono', 'Telefono', ['class' => 'control-label']) !!}
            {!! Form::text('telefono', null, ['class' => 'form-control', 'disabled' => 'disabled', 'tabindex' => '7']) !!}
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            {!! Form::label('ecivil', 'Estado civil', ['class' => 'control-label selectContainer']) !!}
            {!! Form::select('ecivil', ['' => '', 'SOLTERO/A' => 'SOLTERO/A', 'COMPROMETIDO/A' => 'COMPROMETIDO/A', 'CASADO/A' => 'CASADO/A', 'DIVORCIADO/A' => 'DIVORCIADO/A', 'VIUDO/A' => 'VIUDO/A'], null, ['class' => 'form-control', 'disabled' => 'disabled', 'tabindex' => '9']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('nhijos', 'Numero de hijos', ['class' => 'control-label']) !!}
            {!! Form::text('nhijos', '0', ['class' => 'form-control', 'disabled' => 'disabled', 'tabindex' => '10']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('fingreso', 'Fecha de ingreso', ['class' => 'control-label']) !!}
            {!! Form::date('fingreso', null, ['class' => 'form-control', 'disabled' => 'disabled', 'tabindex' => '8']) !!}
          </div>
        </div>
      </div>
            
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4" id="div_profesion">
            {!! Form::label('profesion', 'Profesion', ['class' => 'control-label']) !!}
            <select class="form-control" name="profesion" id="profesion" disabled="disabled" tabindex="11">
              <option selected="selected"></option>
              @foreach($profesiones as $profesion)
                <option value="{{ $profesion->codigo }}">{{ $profesion->nombre }}</option>
              @endforeach
              <option value="otra">OTRA</option>
            </select>
          </div>
          <div id="div_otra_profesion_input">
            {!! Form::label('otra_profesion', 'Profesion', ['class' => 'control-label']) !!}
            {!! Form::text('otra_profesion', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'otra_profesion', 'data-toggle' => 'tooltip', 'title' => 'Especifique la nueva profesion', 'tabindex' => '-1']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('dependencia', 'Dependencia', ['class' => 'control-label selectContainer']) !!}
            {!! Form::select('dependencia', ['' => ''] + DB::table('dependencias')->pluck('nombre', 'codigo'), null, ['class' => 'form-control', 'disabled' => 'disabled', 'tabindex' => '12']) !!}
          </div>

          <div class="col-lg-4">
            {!! Form::label('cargo', 'Cargo', ['class' => 'control-label selectContainer']) !!}
            {!! Form::select('cargo', ['' => ''] + DB::table('cargos')->pluck('tipo', 'codigo'), null, ['class' => 'form-control', 'disabled' => 'disabled', 'tabindex' => '13']) !!}
          </div>
        </div>
      </div>

      <br/>
          
      <div class="pull-right">
        <a href="{{ url('/administrativos') }}" type="button" class="btn btn-default" tabindex="15">
          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
        </a>
        <button type="submit" class="btn btn-primary" disabled tabindex="14"> 
          <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Guardar
        </button>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection