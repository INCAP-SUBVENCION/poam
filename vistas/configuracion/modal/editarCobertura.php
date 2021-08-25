<div class="modal fade" id="editarCobertura<?php echo $cobertura['idCobertura']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" style="font-size: 11px;">
                    <div class="input-group-sm col-sm-4">
                        <label class="form-label">Subreceptor</label>
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" disabled>
                    </div>
                    <div class="input-group-sm col-sm-4">
                        <label class="form-label">Departamento</label>
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" disabled>
                    </div>
                    <div class="input-group-sm col-sm-4">
                        <label class="form-label">Municipio</label>
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" disabled>
                    </div>
                    <div class="input-group-sm col-sm-3">
                        <label class="form-label">Region</label>
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" disabled>
                    </div>
                    <div class="form-group input-group-sm col-sm-3">
                        <label class="form-label">Nuevos:</label>
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" disabled>
                    </div>
                    <div class="form-group input-group-sm col-sm-3">
                        <label class="form-label">Recurrentes:</label>
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" disabled>
                    </div>
                    <div class="form-group input-group-sm col-sm-3">
                        <label class="form-label">Reactividad:</label>
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" disabled>
                    </div>
                </div>

            </div>
            <div class="card">
      <div class="card-body">
        <h5 class="card-title">Editar cobertura del subreceptor</h5>
        
        <form name="agregarCobertura" id="agregarCobertura" action="javascript: agregarCobertura();" method="GET">
                    <div class="row">
                        <div class="input-group-sm col-sm-4">
                            <label class="form-label">Subreceptor:</label>
                            <select name="sub" id="sub" class="form-select" style="font-size: 12px;" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                $sqlSub = "SELECT * FROM subreceptor";
                                $resultadoSub = $enlace->query($sqlSub);
                                while ($sub = $resultadoSub->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $sub['idSubreceptor']; ?>"><?php echo $sub['nombre']; ?></option>
                                <?php
                                }
                                $resultadoSub->close();
                                ?>
                            </select>
                        </div>
                        <div class="input-group-sm col-sm-3">
                            <label class="form-label">Departamento:</label>
                            <select name="departamento" id="departamento" class="form-select" onchange="llenarMunicipio();" style="font-size: 12px;" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                $sqlDep = "SELECT * FROM catalogo WHERE categoria = 'departamento' ORDER BY codigo AND categoria";
                                $resultadoDep = $enlace->query($sqlDep);
                                while ($departamento = $resultadoDep->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $departamento['codigo']; ?>"><?php echo $departamento['nombre']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-group-sm col-sm-5">
                            <label class="form-label">Muinicipio:</label>
                            <select id="municipio" name="municipio" class="form-control" style="font-size: 12px;" required></select>
                        </div>
                        <div class="input-group-sm col-sm-3">
                            <label class="form-label">Region:</label>
                            <select id="region" name="region" class="form-control" style="font-size: 12px;" required>
                                <option value="">Seleccionar</option>
                                <option value="1">Region 1</option>
                                <option value="2">Region 2</option>
                                <option value="3">Region 3</option>
                                <option value="4">Region 4</option>
                                <option value="5">Region 5</option>
                                <option value="1">Region 6</option>
                                <option value="2">Region 7</option>
                                <option value="3">Region 8</option>
                            </select>
                        </div>
                        <div class="input-group-sm col-sm-3">
                            <label class="form-label">Nuevos:</label>
                            <input type="number" min="0.0" step="0.01" name="nuevo" id="nuevo" class="form-control form-control-sm" style="font-size: 12px;" required>
                        </div>
                        <div class="input-group-sm col-sm-3">
                            <label class="form-label">Recurrentes:</label>
                            <input type="number" min="0.0" step="0.01" name="recurrente" id="recurrente" class="form-control form-control-sm" style="font-size: 12px;" required>
                        </div>
                        <div class="input-group-sm col-sm-3">
                            <label class="form-label">Reactividad:</label>
                            <input type="number" min="0.0" max="1" step="0.01" name="reactivo" id="reactivo" class="form-control form-control-sm" style="font-size: 12px;" required>
                        </div>

                    </div>
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check"></i> Guardar</button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="bi bi-x"></i> Cancelar</button>
                    </div>
                </form>
      </div>
    </div>
        </div>
    </div>
</div>
</div>