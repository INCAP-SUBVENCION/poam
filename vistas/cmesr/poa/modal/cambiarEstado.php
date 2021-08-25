<!-- Modal -->
<div class="modal fade" id="cambiarEstado<?php echo $periodo_1['idPoa']; ?>" tabindex="-1" aria-labelledby="cambiarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-white" id="cambiarLabel">ENVIAR A REVISION <?php echo $POA = $periodo_1['idPoa']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="cambiar" id="cambiar" action="javascript: cambiarEstadoPoa();" method="GET">
          <input type="text" name="use" id="use" value="<?php echo $ID; ?>">
          <input type="text" name="poae" id="poae" value="<?php echo $POA; ?>">
          <input type="text" name="ese" id="ese" value="ES02">
          <div class="form-group input-group-sm col-sm-6">
            <label class="form-label">Observacion / Comentarios</label>
            <input type="text" name="dese" id="dese" class="form-control form-control-sm" style="font-size: 12px;">
          </div>
            <input type="submit" class="btn btn-success btn-sm" value="Enviar">
        </form>
      </div>

    </div>
  </div>
</div>
</div>