<div class="modal" id="solicitarPermiso" tabindex="-1" role="dialog" aria-labelledby="solicitarPermiso">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {!! Form::open(array('url' => '/permiso/solicitud', 'method' => 'post', 'role' => 'form', 'id' => 'enviarSolicitudPermiso')) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="eliminarRegistroTitulo"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;Solicitar permiso</h4>
      </div>
      <div class="modal-body">

        {!! Form::hidden('cpersonal', $personal->cedula) !!}

        <div class="form-group">
          {!! Form::label('tipo', 'Tipo de permiso', array('class' => 'control-label')) !!}
          {!! Form::select('tipo', array('' => '', '1' => 'Personal', '2' => 'Medico', '3' => 'Duelo'), null, array('class' => 'form-control', 'id' => 'permiso_tipo', 'tabindex' => '1')) !!}
        </div>

        <div class="form-group">
          {!! Form::label('fecha_permiso', 'Fecha de permiso', array('class' => 'control-label')) !!}
          {!! Form::date('fecha_permiso', null, array('class' => 'form-control', 'id' => 'permiso_fecha_salida', 'tabindex' => '2')) !!}
        </div>

        <div class="form-group">
          {!! Form::label('fecha_ingreso', 'Fecha de ingreso', array('class' => 'control-label')) !!}
          {!! Form::date('fecha_ingreso', null, array('class' => 'form-control', 'id' => 'permiso_fecha_ingreso', 'tabindex' => '3')) !!}
        </div>

        <div class="form-group">
          {!! Form::label('descripcion', 'Descripcion', array('class' => 'control-label')) !!}
          {!! Form::textarea('descripcion', null, array('class' => 'form-control', 'size' => '10x3', 'id' => 'permiso_descripcion', 'tabindex' => '4')) !!}
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" tabindex="5"> 
          <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Enviar solicitud
        </button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>