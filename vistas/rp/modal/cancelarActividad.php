<div class="modal fade" id="modalAceptarCancelacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header bg-warning">
        <h5 class="text-dark">Solicitud de cancelacion de actividad </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body bg-light-info">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Mes:</span>
                            <input type="text" class="form-control" id="estado_mes" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Municipio:</span>
                            <input type="text" class="form-control" id="estado_municipio" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Lugar:</span>
                            <input type="text" class="form-control" id="estado_lugar" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Fecha:</span>
                            <input type="date" class="form-control" id="estado_fecha" style="font-size: 10px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 11px;">Inicia:</span>
                            <input type="time" class="form-control" id="estado_inicia" style="font-size: 11px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 11px;">Finaliza:</span>
                            <input type="time" class="form-control" id="estado_finaliza" style="font-size: 11px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Nuevo:</span>
                            <input type="text" class="form-control" id="estado_nuevo" style="font-size: 12px; color:darkred; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Recurente:</span>
                            <input type="text" class="form-control" id="estado_recurrente" style="font-size: 12px; color:darkred; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Total:</span>
                            <input type="text" class="form-control" id="estado_total" style="font-size: 12px; color:red; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label> Motivo de la cancelacion: </label>
                        <textarea name="estado_descripcion" id="estado_descripcion" cols="2" rows="2" class="form-control" disabled></textarea>
                    </div>
                    <!-- hidden -->
                    <input type="hidden" id="estado_id">
                    <input type="hidden" id="estado_usuario">
                    <input type="hidden" id="estado_estado">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary btn-sm" onclick="cambiarEstadoPom()"> Aceptar solicitud </button>
                    <button type="button" class="btn btn-danger btn-sm"  onclick="modalRechazarCancelacion()"> <i class="bi bi-x-circle-fill"></i> Rechazar solicitud </button>   
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div>

        </div>
    </div>
</div> 