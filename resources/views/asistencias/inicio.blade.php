@extends('asistencias')

@section('contenido')
<div class="page-header">
  {!! Form::open(array('url' => '/asistencias', 'class' => 'form-inline', 'method' => 'get')) !!}
    <h4>
      <a href="{{ url('/asistencias') }}" class="btn btn-default"><span class="glyphicon glyphicon-book"></span> Nueva asistencia</a>
      <span class="pull-right">
        Fecha: {!! Form::date('fecha', $fecha, array('class' => 'form-control', 'id' => 'fecha')) !!} &nbsp;
        Turno: {!! Form::select('turno', array('mañana' => 'Mañana', 'tarde' => 'Tarde', 'noche' => 'Noche'), $turno, ['class' => 'form-control', 'id' => 'fecha']) !!}
        {!! Form::hidden('mostrar', '1', array('id' => 'mostrar')) !!}
        <button type="submit" class="btn btn-primary" title="Mostrar lista"><span class="glyphicon glyphicon-search"></span></button>
      </span>
    </h4>
  {!! Form::close() !!}
</div>

<br/>

<div class="panel panel-default">
  <div class="panel-body">
    <table id="asistencias" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Apellido y nombre</th>
                <th>Hora de entrada</th>
                <th>Hora de Salida</th>
            </tr>
        </thead>
        <tbody>
          @foreach($lista as $item)
            <tr>
                <td>{{ $item->cedula }}</td>
                <td>{{ $item->nombre }} {{ $item->apellido }}</td>
                <td>{{ date('g:i a', strtotime($item->hora_entrada)) }}</td>
                <td>@if($item->hora_salida != null) date('g:i a', strtotime($item->hora_salida)) @endif</td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>

<div class="modal" id="pedirCedula" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="validacionDatos">
    <div class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['url' => '/asistencias', 'method' => 'post', 'role' => 'form', 'autocomplete' => 'off']) !!}
        <div class="modal-body">
          <div class="alert alert-warning" role="alert"><strong>Ingrese su numero de cedula</strong> y luego presione el boton ENTER.</div>

          <div class="form-group">
            {!! Form::label('cedula', 'Cedula', ['class' => 'control-label']) !!}
            {!! Form::text('cedula', null, array('class' => 'form-control input-lg', 'id' => 'cedula', 'tabindex' => '1', 'autofocus')) !!}
          </div>

          <div class="form-group oculto">
            {!! Form::label('nombre', 'Nombre', array('class' => 'control-label')) !!}
            {!! Form::text('nombre', null, array('class' => 'form-control input-lg', 'readonly' => 'true', 'id' => 'nombre')) !!}
          </div>

          <div class="form-group oculto">
            {!! Form::label('apellido', 'Apellido', array('class' => 'control-label')) !!}
            {!! Form::text('apellido', null, array('class' => 'form-control input-lg', 'readonly' => 'true', 'id' => 'apellido')) !!}
          </div>

          <div class="form-group">
            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-list-alt"></span> Ver lista</button>
            <div class="pull-right oculto">
              <div class="btn-group" role="group" aria-label="...">
                <button type="submit" id="tomarAsistencia" class="btn btn-primary" tabindex="2">Tomar asistencia</button>
              </div>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    $(document).ready(function() {
        $('#asistencias').DataTable({
            "language" : {
                "url" : "{{ url('libs/DataTables/media/js/language/Spanish.json') }}"
            }
        });

        @if($modal)
          $('#pedirCedula').modal("show");
        @endif

        $('#cedula').keypress(function (e) 
        {
          if (event.which == 13) 
          {
            $('.text-danger').hide();

            if ($("#cedula").val().length > 6 && $("#cedula").val().length < 9) 
            {
              e.preventDefault();

              $.ajax({
                headers: {
                  'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/asistencias/consultarPersonal') }}" + "/" + $('#cedula').val(),
                type: 'GET',
                dataType: 'json',
              }).done(
              function(data){
                if(data.cedula != 0) 
                {
                  $('#nombre').val(data.nombre);
                  $('#apellido').val(data.apellido);
                  $('.oculto').removeClass('oculto');
                } 
                else 
                {
                  $("#cedula").after('<span class="text-danger">Esta cedula no esta registrada.</span>');
                  $('#cedula').select();
                  return false;
                }
              });
            }
            else 
            {
              $("#cedula").after('<span class="text-danger">La cedula debe tener entre 7 y 8 numeros.</span>');
              return false;
            }
          }
        });

        $('#cedula').keydown(function(e) {
          if($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
              return; }
          if((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
          }
        });
    });
</script>
@endsection