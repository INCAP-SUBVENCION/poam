<div class="modal fade" id="modalReprogramacionPom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="text-center text-white">Reprogramar Actividad </h5>
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
                    <h6 class="text-center text-info">Actividad: </h6>
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
                    <input type="hidden" id="asupervisor">
                    <div class="col-sm-6">
                        <label for="">Supervisor: </label>
                        <input type="text" class="form-control" id="asupervisores" style="font-size: 12px; color:darkblue; font-weight: bolder;" disabled>
                    </div>
                    <h6 class="text-center text-danger">Reprogramar la actividad: </h6>
                    <div class="col-sm-3">
                        <label for="">Fecha:</label>
                        <input type="date" class="form-control form-control-sm" id="nfecha" style="font-size: 12px;">
                    </div>
                    <div class="col-sm-9">
                        <label for="">Lugar: </label>
                        <input type="text" class="form-control form-control-sm" id="nlugar" style="font-size: 12px;">
                    </div>
                    <div class="col-sm-2">
                        <label for="">Inicio: </label>
                        <input type="time" class="form-control form-control-sm" id="ninicio">
                    </div>
                    <div class="col-sm-2">
                        <label for="">Fin: </label>
                        <input type="time" class="form-control form-control-sm" id="nfin">
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label" style="font-size: 10px;">Supervisado </label>
                        <select id="nsupervisado" class="form-select" style="font-size: 12px;">
                            <option value="0">NO </option>
                            <option value="1">SI </option>
                        </select>
                    </div>
                    <?php if ($SUBRECEPTOR == 4) { ?>
                        <input type="hidden" id="nsupervisor" value="<?php echo $ID; ?>">
                    <?php } else { ?>
                        <div class="form-group input-group-sm col-sm-3">
                            <label class="form-label" style="font-size: 12px;">Supervisor:</label>
                            <select id="nsupervisor" class="form-select">
                                <option value="">Seleccionar ... </option>
                                <?php
                                $sql = "SELECT u.idUsuario, CONCAT(p.nombre,' ',p.apellido) as supervisor FROM usuario u
                                        LEFT JOIN persona p ON p.idPersona=u.persona_id WHERE subreceptor_id = $SUBRECEPTOR AND rol = 'R006'";
                                $resultado = $enlace->query($sql);
                                while ($supervisores = $resultado->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $supervisores['idUsuario']; ?>"><?php echo $supervisores['supervisor']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>MOTIVO: </label>
                        <textarea id="descripcion" cols="2" rows="2" class="form-control"></textarea>
                    </div>
                </div>
                <!-- hidden -->
                <input type="hidden" id="aid">
                <input type="hidden" id="ausuario">
                <input type="hidden" id="aestado">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary btn-sm" onclick="reprogramacionPom()">Solicitar reprogramacion</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>