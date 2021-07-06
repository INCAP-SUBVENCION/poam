<form name="agregarPoa1" id="agregarPoa1" action="javascript: agregarPoa1();" method="POST">
    <div class="row">
        <div class="col-6">
            <div class="card border-primary">
                <div class="card-headertext-white text-center" style="background-color:darkred; color:snow">Datos principales</div>
                <div class="card-body text-primary" style="font-size: 12px;">
                    <div class="row">
                        <input type="hidden" name="usuario1" id="usuario1" value="<?php echo $ID; ?>">
                        <input type="hidden" name="subreceptor1" id="subreceptor1" value="<?php echo $SUBRECEPTOR; ?>">
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Mes:</label>
                            <select name="mes1" id="mes1" class="form-select" style="font-size: 12px;" required>
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
                        <div class="form-group input-group-sm col-sm-3">
                            <label class="form-label">Departamento:</label>
                            <select name="departamento1" id="departamento1" class="form-select" onchange="llenarMunicipio1();" style="font-size: 12px;" required>
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
                        <div class="form-group input-group-sm col-sm-4">
                            <label class="form-label">Muinicipio:</label>
                            <select id="municipio1" name="municipio1" class="form-select" style="font-size: 12px;" required></select>
                        </div>
                        <div class="form-group input-group-sm col-sm-3">
                            <label class="form-label">Nuevos</label>
                            <input type="number" min="0.00" step="0.0001" name="nuevo1" id="nuevo1" oninput="sumaPoa1();" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-3">
                            <label class="form-label">Recurrentes</label>
                            <input type="number" min="0" step="0.0001" name="recurrente1" id="recurrente1" oninput="sumaPoa1();" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-3">
                            <label class="form-label">Total</label>
                            <input type="text" name="total1" id="total1" class="form-control form-control-sm" disabled style="color:orangered;">
                        </div>
                        <div class="form-group input-group-sm col-sm-4">
                            <label for="exampleFormControlTextarea1" class="form-label">Observaciones / otros</label>
                            <input type="text" name="observacion1" id="observacion1" class="form-control form-control-sm">
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Proyeccion</label>
                            <button type="button" class="btn btn-outline-info" onclick="calcularProyeccionPOA1()"><i class="bi bi-calculator-fill"></i> Calcular</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card border-primary">
                <div class="card-headertext-white text-center" style="background-color:darkred; color:snow">Proyeccion de insumos</div>
                <div class="card-body text-primary" style="font-size: 12px;">
                    <div class="row">
                        <div class="form-group input-group-sm col-sm-3">
                            <label class="form-label">Condon natural</label>
                            <input type="text" name="cnatural1" id="cnatural1" class="form-control form-control-sm" style="color:blue" disabled>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Condon sabor</label>
                            <input type="text" name="csabor1" id="csabor1" class="form-control form-control-sm" style="color:blue" disabled>
                        </div>
                        <div class="form-group input-group-sm col-sm-3">
                            <label class="form-label">Condon femenino</label>
                            <input type="text" name="cfemenino1" id="cfemenino1" class="form-control form-control-sm" style="color:blue" disabled>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Lubricante</label>
                            <input type="text" name="lubricante1" id="lubricante1" class="form-control form-control-sm" style="color:blue" disabled>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Prueba VIH</label>
                            <input type="text" step="0.0000" name="pruebaVIH1" id="pruebaVIH1" class="form-control form-control-sm" style="color:blue" disabled>
                        </div>
                        <div class="form-group input-group-sm col-sm-3">
                            <label class="form-label">Autoprueba VIH</label>
                            <input type="text" step="0.0000" name="autoPrueba1" id="autoPrueba1" class="form-control form-control-sm" style="color:blue" disabled>
                        </div>
                        <div class="form-group input-group-sm col-sm-3">
                            <label class="form-label">Reactivo esperado</label>
                            <input type="number" min="0.00" step="0.01" name="reactivoEs1" id="reactivoEs1" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Prueba sifilis</label>
                            <input type="text" name="sifilis1" id="sifilis1" class="form-control form-control-sm" style="color:blue" disabled>
                        </div>
                        <div class="form-group input-group-sm col-sm-2 text-center">
                            <label for="form-label">..::..</label>
                            <button type="submit" class="btn btn-outline-success"><i class="bi bi-save-fill"></i> Guardar</button>
                        </div>
                        <div class="form-group input-group-sm col-sm-2 text-center">
                            <label for="form-label">..::..</label>
                            <button type="reset" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-square-fill"></i> Cancelar</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<table class="table table-bordered border-primary">
    <thead class="text-center border" style="background-color:lightslategrey;">
        <tr>
            <td colspan="6" class="text-white">DATOS PRINCIPALES </td>
            <td colspan="10" class="text-white">INSUMOS PROYECTADOS POR MES</td>
        </tr>
        <tr style="font-size: 11px; color:linen">
            <th>#</th>
            <th>Mes</th>
            <th>Municipio</th>
            <th>Nuevos</th>
            <th>Recurrentes</th>
            <th>Total</th>
            <th>Condon natural</th>
            <th>Condon sabor</th>
            <th>Condon femenino</th>
            <th>Lubricantes</th>
            <th>Prueba VIH</th>
            <th>Auto prueba VIH</th>
            <th>Reactivos esperados</th>
            <th>Prueba Sifilis</th>
            <th>Observaciones</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody class="text-center" style="font-size: 11px;">
        <?php
        $contador = 1;
        $sql = "SELECT DISTINCT p.idPoa,t2.nombre as mes,t1.nombre as municipio,p.nuevo,p.recurrente,(p.nuevo + p.recurrente) AS total,
                        p.observacion,i.cnatural,i.csabor,i.cfemenino,i.lubricante,i.pruebaVIH,i.autoPrueba,i.reactivoE,i.sifilis 
                        FROM poa p LEFT JOIN insumo i ON i.poa_id =p.idPoa
                        LEFT JOIN catalogo d ON d.idCatalogo = p.departamento
                        LEFT JOIN catalogo t1 ON t1.idCatalogo = p.municipio 
                        LEFT JOIN catalogo t2 ON t2.idCatalogo = p.mes
                        WHERE p.subreceptor_id = $SUBRECEPTOR AND p.anio = YEAR(NOW())";
        $consulta = mysqli_query($enlace, $sql);
        while ($data = mysqli_fetch_assoc($consulta)) {
        ?>
            <tr>
                <td><?php echo $contador++; ?></td>
                <td><?php echo $data['mes']; ?></td>
                <td><?php echo $data['municipio']; ?></td>
                <td><?php echo $data['nuevo']; ?></td>
                <td><?php echo $data['recurrente']; ?></td>
                <th><?php echo round($data['total'], 4); ?></th>
                <td><?php echo $data['cnatural']; ?></td>
                <td><?php echo $data['csabor']; ?></td>
                <td><?php echo $data['cfemenino']; ?></td>
                <td><?php echo $data['lubricante']; ?></td>
                <td><?php echo $data['pruebaVIH']; ?></td>
                <td><?php echo $data['autoPrueba']; ?></td>
                <td><?php echo $data['reactivoE']; ?></td>
                <td><?php echo $data['sifilis']; ?></td>
                <td><?php echo $data['observacion']; ?></td>
                <td>
                    <a href="editarPoa.php?id=<?php echo $data['idPoa']; ?>" class="btn-sm btn-outline-warning"><i class="bi bi-pencil-fill"></i> Editar</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>