<div class="modal fade" id="modalRechazarReprogramacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Rechazar recalendarizacion </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="razon" class="form-label"> Razon: </label>
                <textarea class="form-control" id="razon" cols="3" rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" onclick="rechazarReprogramacion()"> Rechazar </button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"> <i class="bi bi-x"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>