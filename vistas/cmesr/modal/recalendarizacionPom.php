<div class="modal fade" id="modalRecalendarizacionPom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body bg-light-primary">
                <h5 class="text-center">Recalendarizar actividad </h5>
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
                    <h6 class="text-center text-info">Lugar y fecha actual de POM </h6>
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
                    <div class="col-sm-8">
                        <label for="">Supervisor: </label>
                        <input type="text" class="form-control" id="asupervisor" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                    </div>

                    <h6 class="text-center text-warning">Recalendarizar la actividad: </h6>

                    <div class="col-sm-3">
                        <label for="">Fecha:</label>
                        <input type="date" class="form-control form-control-sm" name="n_fecha" id="n_fecha" style="font-size: 12px;">
                    </div>
                    <div class="col-sm-9">
                        <label for="">Lugar: </label>
                        <input type="text" class="form-control form-control-sm" name="n_lugar" id="n_lugar" style="font-size: 12px;">
                    </div>
                    <div class="col-sm-2">
                        <label for="">Inicio: </label>
                        <input type="time" class="form-control form-control-sm" name="n_inicio" id="n_inicio">
                    </div>
                    <div class="col-sm-2">
                        <label for="">Fin:</label>
                        <input type="time" class="form-control form-control-sm" name="n_inicio" id="n_inicio">
                    </div>
                    <div class="col-sm-8">
                        <label for="">Supervisor: </label>
                        <input type="text" class="form-control" id="n_supervisor" style="font-size: 12px; color:darkblue; font-weight: bolder;">
                    </div>

                    <div class="form-group">
                        <label>MOTIVO: </label>
                        <textarea name="re_descripcion" id="descripcion" cols="2" rows="2" class="form-control"></textarea>
                    </div>
                </div>


                <!-- hidden -->
                <input type="hidden" id="aid">
                <input type="hidden" id="ausuario">
                <input type="hidden" id="aestado">

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary btn-sm" onclick="recalendarizacionPom()">Solicitar recalendarizacion</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>

                </div>

            </div>

        </div>
    </div>
</div>