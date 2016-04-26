<div class="modal" id="aprobarVacaciones" tabindex="-1" role="dialog" aria-labelledby="aprobarVacaciones">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="eliminarRegistroTitulo"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;Confirmar aprobacion</h4>
      </div>
      <div class="modal-body">
        ¿<strong>Aprobar la solicitud de vacaciones</strong> en espera de este personal administrativo?
      </div>
      <div class="modal-footer">
        {!! Form::open(['url' => ['/vacaciones/aprobar', $personal->cedula], 'method' => 'patch']) !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
          <button type="submit" class="btn btn-primary">SI</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>