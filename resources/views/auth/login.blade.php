@extends('auth')

@section('contenido')
<div class="page-header">
  <h3>Inicio de Sesion <small>/ iniciar sesion como usuario del sistema</small></h3>
</div>

{!! Form::open(['url' => '/login', 'id' => 'formulario_inicioSesion', 'method' => 'post', 'autocomplete' => 'off', 'role' => 'form', 'class' => 'form-horizontal']) !!}
  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', 'Correo', ['class' => 'col-lg-1 control-label']) !!}
    <div class="col-lg-4">
        {!! Form::text('email', old('email'), ['class' => 'form-control', 'tabindex' => '1']) !!}
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
       @endif
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('password', 'Contraseña', ['class' => 'col-lg-1 control-label']) !!}
    <div class="col-lg-4">
       {!! Form::password('password', ['class' => 'form-control', 'tabindex' => '2']) !!}
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-5">
      <div class="pull-right">
        <button type="submit" class="btn btn-primary" tabindex="3"> 
          <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Validar
        </button>
      </div>
    </div>
  </div>
{!! Form::close() !!}
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('#formInicioSesion').formValidation({
      framework: 'bootstrap',
      icon: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
        email: {
          validators: {
            emailAddress: {
                message: 'No es un correo valido'
            },
            regexp: {
                regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                message: 'La entrada no es un correo valido.'
            },
            notEmpty: {
              message: 'El correo del usuario es importante'
            }
          }
        },
        password: {
          validators: {
            stringLength: {
                max: 15,
                min: 8,
                message: 'La contraseña debe contener entre 8 y 15 caracteres alfanumericos'
            },
            notEmpty: {
              message: 'No olvide la contraseña'
            }
          }
        }
      }
    });
  });
</script>
@endsection
