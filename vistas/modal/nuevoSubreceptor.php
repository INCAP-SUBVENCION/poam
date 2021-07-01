<div class="modal fade" id="nuevoSub" tabindex="-1" aria-labelledby="nuevoSubLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="nuevoSubLabel">[ Nuevo subreceptor ]</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size: 11px;">
                <form name="agregarSub" id="agregarSub" action="javascript: agregarSubreceptor();" method="GET">
                    <div class="row">
                        <div class="form-group input-group-sm col-sm-4">
                            <label class="form-label">Codigo:</label>
                            <input type="text" name="codigo" id="codigo" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-8">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Condon natural:</label>
                            <input type="number" min="0" name="cnatural" id="cnatural" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Condon sabor:</label>
                            <input type="number" min="0" name="csabor" id="csabor" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Condon femenino:</label>
                            <input type="number" min="0" name="cfemenino" id="cfemenino" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Lubricante:</label>
                            <input type="number" min="0" name="lubricante" id="lubricante" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">% Prueba VIH:</label>
                            <input type="number" min="0" max="1" step="0.01" name="pruebavih" id="pruebavih" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">% Auto-prueba VIH:</label>
                            <input type="number" min="0" max="1" step="0.01" name="autoprueba" id="autoprueba" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="reset" value="Cancelar" class="btn btn-outline-danger">
                        <input type="submit" value="Guardar" class="btn btn-outline-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>