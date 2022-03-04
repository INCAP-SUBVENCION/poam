<div class="table-responsive">
<table class="table table-hover table-bordered" id="poa_periodo_4" aria-describedby="">
    <thead class="text-center" style="font-size: 11px;">
        <th scope="">#</th>
        <th scope="">Mes</th>
        <th scope="">Municipio</th>
        <th scope="">Nuevos</th>
        <th scope="">Recurrentes</th>
        <th scope="">Total</th>
        <th scope="">Condon natural</th>
        <th scope="">Condon sabor</th>
        <th scope="">Condon femenino</th>
        <th scope="">Lubricantes</th>
        <th scope="">Prueba VIH</th>
        <th scope="">Reactivos esperados</th>
        <th scope="">Prueba Sifilis</th>
        <th scope="">Observaciones</th>
    </thead>
    <tbody class="text-center bg-light" style="font-size: 12px;">
        <?php
        $cont = 1;
        $consult = "SELECT DISTINCT t1.idPoa, t5.nombre as mes, t4.nombre as municipio, t1.nuevo, t1.recurrente, 
        (t1.nuevo + t1.recurrente) AS total, t1.observacion, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, 
        t2.pruebaVIH, t2.autoPrueba, t2.reactivoE, t2.sifilis, t1.estado FROM poa t1
	    LEFT JOIN insumo t2 ON t2.poa_id = t1.idPoa
	    LEFT JOIN catalogo t3 ON t3.codigo = t1.departamento
	    LEFT JOIN catalogo t4 ON t4.codigo = t1.municipio
	    LEFT JOIN catalogo t5 ON t5.codigo = t1.mes
	    WHERE t1.subreceptor_id = $SUBRECEPTOR AND t1.periodo = 4";
        if ($res = $enlace->query($consult)) {
            while ($periodo_4 = $res->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $cont++; ?></td>
                    <td><?php echo $periodo_4['mes']; ?></td>
                    <td><?php echo $periodo_4['municipio']; ?></td>
                    <td><?php echo $periodo_4['nuevo']; ?></td>
                    <td><?php echo $periodo_4['recurrente']; ?></td>
                    <th scope=""><?php echo round($periodo_4['total'], 2); ?></th>
                    <td><?php echo $periodo_4['cnatural']; ?></td>
                    <td><?php echo $periodo_4['csabor']; ?></td>
                    <td><?php echo $periodo_4['cfemenino']; ?></td>
                    <td><?php echo $periodo_4['lubricante']; ?></td>
                    <td><?php echo $periodo_4['pruebaVIH']; ?></td>
                    <td><?php echo $periodo_4['reactivoE']; ?></td>
                    <td><?php echo $periodo_4['sifilis']; ?></td>
                    <td><?php echo $periodo_4['observacion']; ?></td>
                </tr>
        <?php }
            $res->close();
        }  ?>
    </tbody>
    <tfoot>
        <th scope="">#</th>
        <th scope="">Mes</th>
        <th scope="">Municipio</th>
        <td class="text-center"><strong id="tnuevos4">0</strong></td>
        <td class="text-center"><strong id="trecurrentes4">0</strong></td>
        <td class="text-center"><strong id="total4">0</strong></td>
        <td class="text-center"><strong id="tnatural4">0</strong></td>
        <td class="text-center"><strong id="tsabor4">0</strong></td>
        <td class="text-center"><strong id="tfemenino4">0</strong></td>
        <td class="text-center"><strong id="tlubricantes4">0</strong></td>
        <td class="text-center"><strong id="tpruebavih4">0</strong></td>
        <td class="text-center"><strong id="treactivos4">0</strong></td>
        <td class="text-center"><strong id="tsifilis4">0</strong></td>
        <th scope="">Observaciones</th>
    </tfoot>
</table>
</div>


<?php if ($SUBRECEPTOR == '2') { ?>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="col-sm-6">
            <form action="../../php/excel/generarExcelPoaOmes.php" method="POST">
                <input type="hidden" name="periodo" id="periodo" value="4">
                <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
                <select name="muni" id="muni">
                    <option value="">Todo los municipios ...</option>
                    <?php
                    $municipioSql = "SELECT DISTINCT p.municipio, c.nombre FROM poa p LEFT JOIN catalogo c ON c.codigo = p.municipio WHERE p.subreceptor_id = $SUBRECEPTOR AND p.periodo = 4";
                    $rmunicipio = $enlace->query($municipioSql);
                    while ($municipio = $rmunicipio->fetch_assoc()) { ?>
                        <option value="<?php echo $municipio['municipio'] ?>"><?php echo $municipio['nombre'] ?></option>
                    <?php } $rmunicipio->close(); ?>
                </select>
                <select name="me" id="me">
                    <option value="">Todo los meses ...</option>
                    <?php
                    $mesSql = "SELECT DISTINCT p.mes, c.nombre FROM poa p LEFT JOIN catalogo c ON c.codigo = p.mes WHERE p.subreceptor_id = $SUBRECEPTOR AND p.periodo = 4";
                    $rmes = $enlace->query($mesSql);
                    while ($mes = $rmes->fetch_assoc()) { ?>
                        <option value="<?php echo $mes['mes'] ?>"><?php echo $mes['nombre'] ?></option>
                    <?php } $rmes->close(); ?>
                </select>
                <button type="submit" class="btn btn-sm btn-success"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar </button>
            </form>
        </div>
    </div>
<?php } elseif ($SUBRECEPTOR == '3' || $SUBRECEPTOR == '4' || $SUBRECEPTOR == '6' || $SUBRECEPTOR == '7') { ?>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="col-sm-6">
            <form action="../../php/excel/generarExcelPoaHsh.php" method="POST">
                <input type="hidden" name="periodo" id="periodo" value="4">
                <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
                <select name="muni" id="muni">
                    <option value="">Todo los municipios ...</option>
                    <?php
                    $municipioSql = "SELECT DISTINCT p.municipio, c.nombre FROM poa p LEFT JOIN catalogo c ON c.codigo = p.municipio WHERE p.subreceptor_id = $SUBRECEPTOR AND p.periodo = 4";
                    $rmunicipio = $enlace->query($municipioSql);
                    while ($municipio = $rmunicipio->fetch_assoc()) { ?>
                        <option value="<?php echo $municipio['municipio'] ?>"><?php echo $municipio['nombre'] ?></option>
                    <?php } $rmunicipio->close(); ?>
                </select>
                <select name="me" id="me">
                    <option value="">Todo los meses ...</option>
                    <?php
                    $mesSql = "SELECT DISTINCT p.mes, c.nombre FROM poa p LEFT JOIN catalogo c ON c.codigo = p.mes WHERE p.subreceptor_id = $SUBRECEPTOR AND p.periodo = 4";
                    $rmes = $enlace->query($mesSql);
                    while ($mes = $rmes->fetch_assoc()) { ?>
                        <option value="<?php echo $mes['mes'] ?>"><?php echo $mes['nombre'] ?></option>
                    <?php } $rmes->close(); ?>
                </select>
                <button type="submit" class="btn btn-sm btn-success"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar </button>
            </form>
        </div>
    </div>
<?php } elseif ($SUBRECEPTOR == '5') { ?>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="col-sm-6">
            <form action="../../php/excel/generarExcelPoaTrans.php" method="POST">
                <input type="hidden" name="periodo" id="periodo" value="4">
                <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
                <select name="muni" id="muni">
                    <option value="">Todo los municipios ...</option>
                    <?php
                    $municipioSql = "SELECT DISTINCT p.municipio, c.nombre FROM poa p LEFT JOIN catalogo c ON c.codigo = p.municipio WHERE p.subreceptor_id = $SUBRECEPTOR AND p.periodo = 4";
                    $rmunicipio = $enlace->query($municipioSql);
                    while ($municipio = $rmunicipio->fetch_assoc()) { ?>
                        <option value="<?php echo $municipio['municipio'] ?>"><?php echo $municipio['nombre'] ?></option>
                    <?php } $rmunicipio->close(); ?>
                </select>
                <select name="me" id="me">
                    <option value="">Todo los meses ...</option>
                    <?php
                    $mesSql = "SELECT DISTINCT p.mes, c.nombre FROM poa p LEFT JOIN catalogo c ON c.codigo = p.mes WHERE p.subreceptor_id = $SUBRECEPTOR AND p.periodo = 4";
                    $rmes = $enlace->query($mesSql);
                    while ($mes = $rmes->fetch_assoc()) { ?>
                        <option value="<?php echo $mes['mes'] ?>"><?php echo $mes['nombre'] ?></option>
                    <?php } $rmes->close(); ?>
                </select>
                <button type="submit" class="btn btn-sm btn-success"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar </button>
            </form>
        </div>
    </div>
<?php } ?>