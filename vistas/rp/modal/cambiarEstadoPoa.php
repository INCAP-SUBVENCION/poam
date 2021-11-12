<div class="modal fade" id="modalCambiarEstado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Mes:</span>
                            <input type="text" class="form-control" id="estado_mes" style="font-size: 12px;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Municipio:</span>
                            <input type="text" class="form-control" id="estado_municipio" style="font-size: 12px;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Nuevo:</span>
                            <input type="text" class="form-control" id="estado_nuevo" style="font-size: 12px;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Recurrente</span>
                            <input type="text" class="form-control" id="estado_recurrente" style="font-size: 12px;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Total:</span>
                            <input type="text" class="form-control" id="estado_total" style="font-size: 12px;" disabled>
                        </div>
                    </div>
                    <h3>Enviar POA a revision</h3>
                    <div class="form-group">
                        <label>Observaciones / cometarios</label>
                        <input type="text" class="form-control" id="estado_descripcion" style="font-size: 12px;">
                    </div>
                    <!-- hidden -->
                    <input type="hidden" id="estado_id">
                    <input type="hidden" id="estado_usuario">
                    <input type="hidden" id="estado_estado">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="cambiarEstadoPoa()">Enviar</button>
                </div>

            </div>

        </div>
    </div>
</div> 