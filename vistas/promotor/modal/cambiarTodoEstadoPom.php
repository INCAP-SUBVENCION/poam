<div class="modal fade" id="modalCambiarTodoEstadoPom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Enviar todas las actividades</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cambiarTodoEstado" action="javascript: actividadPromotor();" method="post">
                    <input type="hidden" id="csubreceptor" value="<?php echo $SUBRECEPTOR; ?>">
                    <input type="hidden" id="_periodo">
                    <input type="hidden" id="cestadoA" value="PR01">
                    <input type="hidden" id="cusuario" value="<?php echo $ID; ?>">
                    <input type="hidden" id="cestadoN" value="PR02">
                    <label >Supervisor:</label>
                    <select id="super" class="form-control" required>
                        <option value="">Seleccionar ...</option>
                        <?php
                        $cs = "SELECT t1.idUsuario, CONCAT(nombre, ' ', apellido) as supervisor 
                        FROM usuario t1 LEFT JOIN persona t2 ON t1.persona_id = t2.idPersona  
                        WHERE t1.rol = 'R006' AND t1.subreceptor_id = $SUBRECEPTOR";
                        $rs = $enlace->query($cs);
                        while ($supervisor = $rs->fetch_assoc()) { ?>
                            <option value="<?php echo $supervisor['idUsuario'] ?>"><?php echo $supervisor['supervisor'] ?></option>
                        <?php }
                        $rs->close(); ?>
                    </select>
                    <label for="cobservacion" class="form-label">Observaciones / Comentarios </label>
                    <textarea class="form-control" id="cobservacion" rows="3" cols="3"></textarea>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-arrow-clockwise"></i> Enviar actividad </button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"> Cerrar </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>