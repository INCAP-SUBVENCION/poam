<div class="modal fade" id="modalCambiarTodoEstadoPom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-center">Enviar Actividad a Enlace Programatico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cambiarTodoEstado" action="javascript: cambiarTodoEstadoPom();" method="post">
                    <input type="hidden" id="csubreceptor" value="<?php echo $SUBRECEPTOR; ?>">
                    <input type="hidden" id="_periodo" value="3">
                    <input type="hidden" id="cestadoA" value="PR02">
                    <input type="hidden" id="cusuario" value="<?php echo $ID; ?>">
                    <input type="hidden" id="cestadoN" value="ES01">
                    <label for="cobservacion" class="form-label">Observaciones / Comentarios </label>
                    <textarea class="form-control" id="cobservacion" cols="3" rows="3"></textarea>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-arrow-clockwise"></i> Enviar actividad al RP </button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>