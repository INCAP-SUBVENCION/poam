<div class="modal fade" id="modalEnviarCambioPom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body bg-light-primary">
                <div class="row">
                <h5 class="text-center">Enviar correcciones de la actividad al RP </h5>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Mes:</span>
                            <input type="text" class="form-control" id="cambio_mes" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Municipio:</span>
                            <input type="text" class="form-control" id="cambio_municipio" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Lugar:</span>
                            <input type="text" class="form-control" id="cambio_lugar" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Fecha:</span>
                            <input type="date" class="form-control" id="cambio_fecha" style="font-size: 10px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 11px;">Inicia:</span>
                            <input type="time" class="form-control" id="cambio_inicia" style="font-size: 11px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 11px;">Finaliza:</span>
                            <input type="time" class="form-control" id="cambio_finaliza" style="font-size: 11px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Nuevo:</span>
                            <input type="text" class="form-control" id="cambio_nuevo" style="font-size: 12px; color:darkred; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Recurente:</span>
                            <input type="text" class="form-control" id="cambio_recurrente" style="font-size: 12px; color:darkred; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Total:</span>
                            <input type="text" class="form-control" id="cambio_total" style="font-size: 12px; color:red; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Observaciones / cometarios</label>
                        <textarea  id="cambio_descripcion" cols="2" rows="2" class="form-control"></textarea>
                    </div>
                    <!-- hidden -->
                    <input type="hidden" id="cambio_id">
                    <input type="hidden" id="cambio_usuario">
                    <input type="hidden" id="cambio_estado">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    
                    <button type="button" class="btn btn-primary btn-sm" onclick="enviarCambiosPom()">Enviar correccion </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div>

        </div>
    </div>
</div> 