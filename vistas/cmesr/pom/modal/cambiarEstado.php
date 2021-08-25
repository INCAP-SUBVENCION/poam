<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="revision<?php echo $periodo_1['idPom']; ?>" tabindex="-1" aria-labelledby="revisionLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title text-white" id="revisionLabel">ENVIAR A REVISION </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        $ID_POM = $periodo_1['idPom'];
        $res = $enlace->query("SELECT DISTINCT p.lugar, p.fecha, p.horaInicio, p.horaFin, p.pNuevo, p.pRecurrente, e.pom_id
        FROM estado e RIGHT JOIN pom p ON p.idPom = e.pom_id WHERE p.idPom = $ID_POM");
        while ($revision = $res->fetch_assoc()) {
        ?>

          <div class="row">

            <div class="input-group input-group-sm">
              <span class="input-group-text" id="inputGroup-sizing-sm" style="font-size: 12px;">Lugar:</span>
              <input type="text" class="form-control" value="<?php echo $revision['lugar']; ?>" style="color:crimson; font-size: 12px;" disabled>
            </div>
            <div class="input-group input-group-sm">
              <span class="input-group-text" id="inputGroup-sizing-sm" style="font-size: 12px;">Fecha: </span>
              <input type="date" class="form-control" value="<?php echo $revision['fecha']; ?>" style="color: crimson; font-size: 12px;" disabled>
            </div>
            <div class="col-sm-6">
              <div class="input-group input-group-sm">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="font-size: 12px;">Inicia: </span>
                <input type="text" class="form-control" value="<?php echo $revision['horaInicio']; ?>" style="color: crimson; font-size: 12px;" disabled>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="input-group input-group-sm">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="font-size: 12px;">Finaliza: </span>
                <input type="text" class="form-control" value="<?php echo $revision['horaFin']; ?>" style="color: crimson; font-size: 12px;" disabled>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="input-group input-group-sm">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="font-size: 12px;">Nuevo: </span>
                <input type="text" class="form-control" value="<?php echo $revision['pNuevo']; ?>" style="color:darkblue; font-weight: bold; font-size: 12px;" disabled>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="input-group input-group-sm">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="font-size: 12px;">Recurrente: </span>
                <input type="text" class="form-control" value="<?php echo $revision['pRecurrente']; ?>" style="color:darkblue; font-weight: bold; font-size: 12px;" disabled>
              </div>
            </div>

          </div>

          <form name="cambiarEstado" id="cambiarEstado" action="javascript: cambiarEstado();" method="GET">
          <!--Datos para cambiar de estado -->

            <input type="hidden" name="usuarioe" id="usuarioe" value="<?php echo $ID;?>">
            <input type="hidden" name="tipoe" id="tipoe" value="1">
            <input type="hidden" name="id_pome" id="id_pome" value="<?php echo $revision['pom_id'];?>">
            <input type="hidden" name="estadoe" id="estadoe" value="ES03">

          <div class="form-group">
            <label>Observaciones / comentarios</label>
            <textarea name="descripcione" id="descripcione" cols="1" rows="1" class="form-control"></textarea>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-sm btn-success" value="Enviar">
          </div>
        </form>
        <?php } ?>
      </div>

    </div>
  </div>
</div>
</div>
