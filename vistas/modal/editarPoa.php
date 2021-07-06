<div class="modal fade" id="editarPoa<?php echo $data['idPoa'];?>" tabindex="-1" aria-labelledby="editarPoaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="editarPoaLabel">EDITAR POA <?php echo $data['idPoa'];?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="editarPoa" id="editarPoa" action="javascript: editarPoa();" method="POST">
                    <div class="row" style="font-size: 12px;">
                        <div class="col-md-6">
                            <div class="card-header">DATOS PRINCIPALES </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="eusuario" id="eusuario" value="<?php echo $ID;?>">
                                    <input type="hidden" name="esubreceptor" id="esubreceptor" value="<?php echo $SUBRECEPTOR;?>">

                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Mes:</label>
                                        <select name="emes" id="emes" class="form-select" style="font-size: 12px;" required>
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            $sql = "SELECT * FROM catalogo WHERE categoria = 'mes' ORDER BY codigo AND categoria";
                                            $resultado = mysqli_query($enlace, $sql);
                                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                                    echo '<option value="'.$fila['idCatalogo'].'">'.$fila['nombre'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-4">
                                        <label class="form-label">Departamento:</label>
                                        <select name="edepartamento" id="edepartamento" class="form-select" onchange="llenarMunicipioEditar();" style="font-size: 12px;" required>
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            $sql = "SELECT * FROM catalogo WHERE categoria = 'departamento' ORDER BY codigo AND categoria";
                                            $resultado = mysqli_query($enlace, $sql);
                                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                                    echo '<option value="' . $fila['idCatalogo'] . '">' . $fila['nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-5">
                                        <label class="form-label">Muinicipio:</label>
                                        <select id="emunicipio" name="emunicipio" class="form-select" style="font-size: 12px;" required></select>
                                    </div>

                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Nuevos</label>
                                        <input type="number" min="0.00" step="0.0001" name="enuevo" id="enuevo" oninput="sumaPoaEditar()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Recurrentes</label>
                                        <input type="number" min="0" step="0.0001" name="erecurrente" id="erecurrente" oninput="sumaPoaEditar()" class="form-control form-control-sm" required>
                                    </div>

                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Total</label>
                                        <input type="text" name="etotal" id="etotal" class="form-control form-control-sm" disabled style="color:orangered;">
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Proyeccion</label>
                                        <button type="button" class="btn btn-outline-info" onclick="calcularProyeccionEditar()"><i class="bi bi-calculator-fill"></i> Calcular</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-header">PROYECCION DE INSUMOS</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Condon natural</label>
                                        <input type="text" name="ecnatural" id="ecnatural" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Condon sabor</label>
                                        <input type="text" name="ecsabor" id="ecsabor" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Condon femenino</label>
                                        <input type="text" name="ecfemenino" id="ecfemenino" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Lubricante</label>
                                        <input type="text" name="elubricante" id="elubricante" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Prueba VIH</label>
                                        <input type="text" step="0.0000" name="epruebaVIH" id="epruebaVIH" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Autoprueba VIH</label>
                                        <input type="text" step="0.0000" name="eautoPrueba" id="eautoPrueba" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Reactivo esperado</label>
                                        <input type="number" min="0.00" step="0.01" name="ereactivoEs" id="ereactivoEs" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Prueba sifilis</label>
                                        <input type="text" name="esifilis" id="esifilis" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-group-sm col-md-12">
                            <label class="form-label">* Observaciones</label>
                            <input type="text" name="eobservacion" id="eobservacion" class="form-control form-control-sm">
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