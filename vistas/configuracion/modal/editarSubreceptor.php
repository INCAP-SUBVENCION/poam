<div class="modal fade" id="modalEditarSub" tabindex="-1" aria-labelledby="editarSubLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <p class="modal-title" id="editarSubLabel"> EDITAR </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size: 11px;">
                <form name="editarSub" id="editarSub" action="javascript: editarSubreceptor();" method="POST">
                    <input type="hidden" name="eid" id="eid">
                    <div class="row">

                        <div class="form-group input-group-sm col-sm-4">
                            <label class="form-label">Codigo:</label>
                            <input type="text" name="ecodigo" id="ecodigo" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-8">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="enombre" id="enombre" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Condon natural:</label>
                            <input type="number" min="0" name="enatural" id="enatural" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Condon sabor:</label>
                            <input type="number" min="0" name="esabor" id="esabor" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Condon femenino:</label>
                            <input type="number" min="0" name="efemenino" id="efemenino" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Lubricante:</label>
                            <input type="number" min="0" name="elubricante" id="elubricante" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">% Prueba VIH:</label>
                            <input type="number" min="0" max="1" step="0.01" name="eppvih" id="eppvih" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">% Auto-prueba VIH:</label>
                            <input type="number" min="0" max="1" step="0.01" name="eautoprueba" id="eautoprueba" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-sm btn-outline-warning"><em class="bi bi-arrow-clockwise"></em>Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
