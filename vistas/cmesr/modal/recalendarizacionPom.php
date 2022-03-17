<div class="modal fade" id="modalRecalendarizacionPom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="text-center text-white">Recalendarizar Actividad </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light-success">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Mes:</span>
                            <input type="text" class="form-control" id="mesa" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Municipio:</span>
                            <input type="text" class="form-control" id="municipioa" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Nuevo:</span>
                            <input type="text" class="form-control" id="nuevoa" style="font-size: 12px; color:darkred; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Recurente:</span>
                            <input type="text" class="form-control" id="recurrentea" style="font-size: 12px; color:darkred; font-weight: bolder;" disabled>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="font-size: 12px;">Total:</span>
                            <input type="text" class="form-control" id="totala" style="font-size: 12px; color:red; font-weight: bolder;" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="text-center text-primary">Actividad: </h6>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-center text-danger">Recalendarizar: </h6>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Fecha: </label>
                        <input type="date" class="form-control" id="fechaa" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Inicio: </label>
                        <input type="time" class="form-control" id="iniciaa" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Fin: </label>
                        <input type="time" class="form-control" id="finalizaa" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Fecha:</label>
                        <input type="date" class="form-control form-control-sm" id="_nfecha" style="font-size: 12px;">
                    </div>
                    <div class="col-sm-2">
                        <label for="">Inicio: </label>
                        <input type="time" class="form-control form-control-sm" id="_ninicio">
                    </div>
                    <div class="col-sm-2">
                        <label for="">Fin:</label>
                        <input type="time" class="form-control form-control-sm" id="_nfin">
                    </div>
                </div>
                <input type="hidden" id="lugara">
                <input type="hidden" id="supervisadoa">
                <input type="hidden" id="supervisora">
                <div class="form-group">
                    <label>MOTIVO: </label>
                    <textarea id="_descripcion" cols="2" rows="2" class="form-control"></textarea>
                </div>
                <!--- hidden --->
                <input type="hidden" id="_ida">
                <input type="hidden" id="usuarioa">
                <input type="hidden" id="estadoa">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary btn-sm" onclick="recalendarizacionPom()">Solicitar recalendarizacion</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>