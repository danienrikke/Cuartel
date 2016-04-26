<div class="modal" id="solicitarVacaciones" tabindex="-1" role="dialog" aria-labelledby="eliminarRegistro">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {!! Form::open(array('url' => '/vacaciones/solicitud', 'method' => 'post', 'role' => 'form', 'id' => 'enviarSolicitudVacaciones')) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="eliminarRegistroTitulo"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;Solicitar vacaciones</h4>
      </div>
      <div class="modal-body">
          <div class="alert alert-warning" role="alert">
              <strong>¡Estatus de vacaciones del personal administrativo!</strong> 
            actualmente hay (% de personal administrativo) en etapa de espera y/o ejecucion de sus vacaciones.
          </div>

          {!! Form::hidden('cpersonal', $personal->cedula) !!}

          <div class="form-group">
            {!! Form::label('cdependencia', 'Dependencia', array('class' => 'control-label')) !!}
            {!! Form::select('cdependencia', app\Dependencia::lists('nombre', 'codigo'), null, array('class' => 'form-control', 'id' => 'dependencia', 'required' => 'required', 'tabindex' => '1')) !!}
          </div>

          <div class="form-group">
            {!! Form::label('fecha_salida', 'Fecha de salida', array('class' => 'control-label')) !!}
            {!! Form::date('fecha_salida', null, array('class' => 'form-control', 'id' => 'fecha_salida', 'tabindex' => '2')) !!}
          </div>

          <div class="form-group">
            {!! Form::label('fecha_ingreso', 'Fecha de ingreso', array('class' => 'control-label')) !!}
            {!! Form::date('fecha_ingreso', null, array('class' => 'form-control', 'id' => 'fecha_ingreso', 'tabindex' => '3')) !!}
          </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" tabindex="4"> 
          <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Enviar solicitud
        </button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>