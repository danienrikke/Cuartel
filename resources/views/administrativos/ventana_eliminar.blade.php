<div class="modal" id="ventanaEliminar" tabindex="-1" role="dialog" aria-labelledby="eliminarRegistro">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="alert alert-warning" role="alert">
          <strong><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Corfirmar operacion</strong>.
        </div>

        Esta accion desabilitara los datos de este registro y cualquier accion a realizar. ¿Quieres ejecutar esta operacion ahora?
      </div>
      <div class="modal-footer">
        {!! Form::open(['url' => ['/administrativos', $personal->cedula], 'method' => 'delete']) !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
          <button type="submit" class="btn btn-primary">SI</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>