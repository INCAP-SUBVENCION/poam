<div class="modal fade" id="modalAnularPom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body bg-light-info">
            <div class="text-center">
                <h5 style="color:crimson">.:. Anular Actividad .:.</h5>
            <p>Esta accion no se puede deshacer</p>
            </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text" style="font-size: 12px;">Periodo: </span>
                            <input type="text" class="form-control" id="periodo_" style="font-size: 12px; color:darkblue; font-weight: bold;" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text" style="font-size: 12px;">Mes: </span>
                            <input type="text" class="form-control" id="mes_" style="font-size: 12px; color:darkblue; font-weight: bold;" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text" style="font-size: 12px;">Municipio: </span>
                            <input type="text" class="form-control" id="municipio_" style="font-size: 12px; color:darkblue; font-weight: bold;" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text" style="font-size: 12px;">Lugar: </span>
                            <input type="text" class="form-control" id="lugar_" style="font-size: 12px; color:darkblue; font-weight: bold;" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text" style="font-size: 12px;">Fecha: </span>
                            <input type="date" class="form-control" id="fecha_" style="font-size: 12px; color:darkblue; font-weight: bold;" disabled>
                        </div>
                    </div>

                    <input type="hidden" name="aPom" id="aPom">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-sm btn-danger" onclick="anularPOM()"> <em class="bi bi-trash2-fill"></em> Anular Actividad</button>
                    </div>

                </div>
            </div>
        </div>
    </div>