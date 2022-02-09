<div class="modal fade" id="modalRecalendarizacionPom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header bg-dark text-center">
                <h5 class="modal-title text-white">Solicitud de recalendarizacion de actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light-primary">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Mes:</span>
                            <input type="text" class="form-control" id="ames" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Municipio:</span>
                            <input type="text" class="form-control" id="amunicipio" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Nuevo:</span>
                            <input type="text" class="form-control" id="anuevo" style="font-size: 12px; color:darkred; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Recurente:</span>
                            <input type="text" class="form-control" id="arecurrente" style="font-size: 12px; color:darkred; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Total:</span>
                            <input type="text" class="form-control" id="atotal" style="font-size: 12px; color:red; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="card text-dark bg-info mb-3" style="max-width: 60rem;">
                        <div class="text-center">
                            <h6>Actividad anterior </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="">Fecha: </label>
                                    <input type="date" class="form-control" id="afecha" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                                </div>
                                <div class="col-sm-9">
                                    <label for="">Lugar: </label>
                                    <input type="text" class="form-control" id="alugar" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                                </div>
                                <div class="col-sm-2">
                                    <label for="">Inicio:</label>
                                    <input type="time" class="form-control" id="ainicia" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                                </div>
                                <div class="col-sm-2">
                                    <label for="">Fin: </label>
                                    <input type="time" class="form-control" id="afinaliza" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                                </div>
                                <div class="col-sm-2">
                                    <label for="">Supervisado: </label>
                                    <input type="text" class="form-control" id="_supervisado" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                                    <input type="hidden" id="asupervisado">
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Supervisor: </label>
                                    <input type="text" class="form-control" id="asupervisor" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card text-dark bg-warning mb-3" style="max-width: 60rem;">
                        <div class="text-center">
                            <h6>Actividad cambiada </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="">Fecha:</label>
                                    <input type="date" class="form-control form-control-sm" id="nfecha" disabled>
                                </div>
                                <div class="col-sm-9">
                                    <label for="">Lugar: </label>
                                    <input type="text" class="form-control form-control-sm" id="nlugar" disabled>
                                </div>
                                <div class="col-sm-2">
                                    <label for="">Inicio: </label>
                                    <input type="time" class="form-control form-control-sm" id="ninicia" disabled>
                                </div>
                                <div class="col-sm-2">
                                    <label for="">Fin:</label>
                                    <input type="time" class="form-control form-control-sm" id="nfinaliza" disabled>
                                </div>
                                <input type="hidden" id="nsupervisado">
                                <div class="col-sm-2">
                                    <label class="form-label" style="font-size: 10px;">Supervisado</label>
                                    <input type="text" class="form-control form-control-sm" id="nsuper" disabled>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Supervisor: </label>
                                    <input type="text" class="form-control form-control-sm" id="nsupervisor" disabled>
                                </div>
                                <div class="col-sm-12">
                                    <label for="">Motivo: </label>
                                    <textarea id="motivo" cols="2" rows="2" class="form-control form-control-sm" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- hidden -->
                <input type="hidden" id="aid">
                <input type="hidden" id="ausuario">
                <input type="hidden" id="aestado" value="RE02">
                <input type="hidden" id="restado" value="RE03">
                <input type="hidden" id="dess" value="Solicitud de recalendarizacion aceptada con exito">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    
                    <button type="button" class="btn btn-success btn-sm" onclick="aceptarSolicitud()"> <i class="bi bi-check-circle-fill"></i> Aceptar solicitud</button>
                    <button type="button" class="btn btn-danger btn-sm"  onclick="modalRechazarSolicitud()"> <i class="bi bi-x-circle-fill"></i> Rechazar solicitud </button>               
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"> <i class="bi bi-x"></i> Cerrar</button>
                </div>
            </div>

        </div>
    </div>
</div>