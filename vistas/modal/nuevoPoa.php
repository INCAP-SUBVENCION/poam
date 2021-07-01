<div class="modal fade" id="nuevoPoa" tabindex="-1" aria-labelledby="nuevoPoaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="nuevoPoaLabel">POA - <?php echo $anio = date("Y") ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="agregarPoa" id="agregarPoa" action="javascript: agregarPoa();" method="POST">
                    <div class="row" style="font-size: 12px;">
                        <div class="col-md-6">
                            <div class="card-header">DATOS PRINCIPALES </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="usuario" id="usuario" value="1">
                                    <input type="hidden" name="subreceptor" id="subreceptor" value="1">
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Mes:</label>
                                        <select name="mes" id="mes" class="form-select" style="font-size: 12px;" required>
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            $sql = "SELECT * FROM catalogo WHERE categoria = 'mes' ORDER BY codigo AND categoria";
                                            $resultado = mysqli_query($enlace, $sql);
                                            $filas = mysqli_affected_rows($enlace);
                                            if ($filas > 0) {
                                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                                    echo '<option value="' . $fila['idCatalogo'] . '">' . $fila['nombre'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-4">
                                        <label class="form-label">Departamento:</label>
                                        <select name="departamento" id="departamento" class="form-select" onchange="llenarMunicipio();" style="font-size: 12px;" required>
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            $sql = "SELECT * FROM catalogo WHERE categoria = 'departamento' ORDER BY codigo AND categoria";
                                            $resultado = mysqli_query($enlace, $sql);
                                            $filas = mysqli_affected_rows($enlace);
                                            if ($filas) {
                                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                                    echo '<option value="' . $fila['idCatalogo'] . '">' . $fila['nombre'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-5">
                                        <label class="form-label">Muinicipio:</label>
                                        <select id="municipio" name="municipio" class="form-select" style="font-size: 12px;" required></select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Nuevos</label>
                                        <input type="number" min="0.00" step="0.0001" name="nuevo" id="nuevo" oninput="sumaPoa()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Recurrentes</label>
                                        <input type="number" min="0" step="0.0001" name="recurrente" id="recurrente" oninput="sumaPoa()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Total</label>
                                        <input type="text" name="total" id="total" class="form-control form-control-sm" disabled style="color:orangered;">
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                    <label class="form-label">Proyeccion</label>
                                        <button type="button" class="btn btn-outline-info" onclick="calcularProyeccionPOA()"><i class="bi bi-calculator-fill"></i> Calcular</button>
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
                                        <input type="text" name="cnatural" id="cnatural" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Condon sabor</label>
                                        <input type="text" name="csabor" id="csabor" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Condon femenino</label>
                                        <input type="text" name="cfemenino" id="cfemenino" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Lubricante</label>
                                        <input type="text" name="lubricante" id="lubricante" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Prueba VIH</label>
                                        <input type="text" step="0.0000" name="pruebaVIH" id="pruebaVIH" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Autoprueba VIH</label>
                                        <input type="text" step="0.0000" name="autoPrueba" id="autoPrueba" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Reactivo esperado</label>
                                        <input type="number" min="0.00" step="0.01" name="reactivoEs" id="reactivoEs" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Prueba sifilis</label>
                                        <input type="text" name="sifilis" id="sifilis" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-group-sm col-md-12">
                            <label class="form-label">* Observaciones</label>
                            <input type="text" name="observacion" id="observacion" class="form-control form-control-sm">
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