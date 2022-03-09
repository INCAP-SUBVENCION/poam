<!--- POM OMES---->
<div id="omes3" class="table-responsive">
<table class="table table-hover table-bordered" id="poa_omes_3" aria-describedby="">
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
        <th scope="">Tubo Lubricantes</th>
        <th scope="">Observaciones</th>
        <th scope="">Estado</th>
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
	    WHERE t1.subreceptor_id = $SUBRECEPTOR AND t1.periodo = 3 
        AND t1.estado NOT IN (SELECT estado FROM pom HAVING estado IN ('ES01','ES02','ES03'))";
        if ($res = $enlace->query($consult)) {
            while ($periodo_3 = $res->fetch_assoc()) {
        ?> 
                <tr>
                    <td><?php echo $cont++; ?></td>
                    <td><?php echo $periodo_3['mes']; ?></td>
                    <td><?php echo $periodo_3['municipio']; ?></td>
                    <td><?php echo $periodo_3['nuevo']; ?></td>
                    <td><?php echo $periodo_3['recurrente']; ?></td>
                    <th scope=""><?php echo round($periodo_3['total'], 2); ?></th>
                    <td><?php echo $periodo_3['cnatural']; ?></td>
                    <td><?php echo $periodo_3['csabor']; ?></td>
                    <td><?php echo $periodo_3['cfemenino']; ?></td>
                    <td><?php echo $periodo_3['lubricante']; ?></td>
                    <td><?php echo $periodo_3['observacion']; ?></td>
                    <th scope="">
                        <?php if ($periodo_3['estado'] == 'ES03') {
                            echo '<p style="color: dodgerblue;">Revisar</p>';
                        } else if ($periodo_3['estado'] == 'ES04') {
                            echo '<p style="color: green;">Aprobado</p>';
                        } else if ($periodo_3['estado'] == 'ES05') {
                            echo '<p style="color:red;">En correccion</p>';
                        }
                        ?>
                    </th>

                </tr>
        <?php }
            $res->close();
        }  ?>
    </tbody>
    <tfoot>
        <th scope="">#</th>
        <th scope="">Mes</th>
        <th scope="">Municipio</th>
        <td class="text-center"><strong id="omesnuevos3">0</strong></td>
        <td class="text-center"><strong id="omesrecurrentes3">0</strong></td>
        <td class="text-center"><strong id="omestotal3">0</strong></td>
        <td class="text-center"><strong id="omesnatural3">0</strong></td>
        <td class="text-center"><strong id="omessabor3">0</strong></td>
        <td class="text-center"><strong id="omesfemenino3">0</strong></td>
        <td class="text-center"><strong id="omeslubricantes3">0</strong></td>
        <th scope="">Observaciones</th>
        <th scope="">Estado</th>
    </tfoot>
</table>
</div>

<!--- POM HSH ---->
<div id="hsh3" class="table-responsive">
<table class="table table-hover table-bordered" id="poa_hsh_3" aria-describedby="">
    <thead class="text-center" style="font-size: 11px;">
        <th scope="">#</th>
        <th scope="">Mes</th>
        <th scope="">Municipio</th>
        <th scope="">Nuevos</th>
        <th scope="">Recurrentes</th>
        <th scope="">Total</th>
        <th scope="">Condon natural</th>
        <th scope="">Lubricantes</th>
        <th scope="">Tamizaje</th>
        <th scope="">Reactivos esperados</th>
        <th scope="">Prueba Sifilis</th>
        <th scope="">Observaciones</th>
        <th scope="">Estado</th>
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
	    WHERE t1.subreceptor_id = $SUBRECEPTOR AND t1.periodo = 3 
        AND t1.estado NOT IN (SELECT estado FROM pom HAVING estado IN ('ES01','ES02','ES03'))";
        if ($res = $enlace->query($consult)) {
            while ($periodo_3 = $res->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $cont++; ?></td>
                    <td><?php echo $periodo_3['mes']; ?></td>
                    <td><?php echo $periodo_3['municipio']; ?></td>
                    <td><?php echo $periodo_3['nuevo']; ?></td>
                    <td><?php echo $periodo_3['recurrente']; ?></td>
                    <th scope=""><?php echo round($periodo_3['total'], 2); ?></th>
                    <td><?php echo $periodo_3['cnatural']; ?></td>
                    <td><?php echo $periodo_3['lubricante']; ?></td>
                    <td><?php echo $periodo_3['pruebaVIH']; ?></td>
                    <td><?php echo $periodo_3['reactivoE']; ?></td>
                    <td><?php echo $periodo_3['sifilis']; ?></td>
                    <td><?php echo $periodo_3['observacion']; ?></td>
                    <th scope="">
                        <?php if ($periodo_3['estado'] == 'ES03') {
                            echo '<p style="color: dodgerblue;">Revisar</p>';
                        } else if ($periodo_3['estado'] == 'ES04') {
                            echo '<p style="color: green;">Aprobado</p>';
                        } else if ($periodo_3['estado'] == 'ES05') {
                            echo '<p style="color:red;">En correccion</p>';
                        }
                        ?>
                    </th>

                </tr>
        <?php }
            $res->close();
        }  ?>
    </tbody>
    <tfoot>
        <th scope="">#</th>
        <th scope="">Mes</th>
        <th scope="">Municipio</th>
        <td class="text-center"><strong id="hshnuevos3">0</strong></td>
        <td class="text-center"><strong id="hshrecurrentes3">0</strong></td>
        <td class="text-center"><strong id="hshtotal3">0</strong></td>
        <td class="text-center"><strong id="hshnatural3">0</strong></td>
        <td class="text-center"><strong id="hshlubricantes3">0</strong></td>
        <td class="text-center"><strong id="hshpruebavih3">0</strong></td>
        <td class="text-center"><strong id="hshreactivos3">0</strong></td>
        <td class="text-center"><strong id="hshsifilis3">0</strong></td>
        <th scope="">Observaciones</th>
        <th scope="">Estado</th>
    </tfoot>
</table>
</div>

<!--- POM OTRANS ---->
<div id="otrans3" class="table-responsive">
<table class="table table-hover table-bordered" id="poa_otrans_3" aria-describedby="">
    <thead class="text-center" style="font-size: 11px;">
        <th scope="">#</th>
        <th scope="">Mes</th>
        <th scope="">Municipio</th>
        <th scope="">Nuevos</th>
        <th scope="">Recurrentes</th>
        <th scope="">Total</th>
        <th scope="">Condon natural</th>
        <th scope="">Condon sabor</th>
        <th scope="">Lubricantes</th>
        <th scope="">Tamizaje</th>
        <th scope="">Reactivos esperados</th>
        <th scope="">Prueba Sifilis</th>
        <th scope="">Observaciones</th>
        <th scope="">Estado</th>
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
	    WHERE t1.subreceptor_id = $SUBRECEPTOR AND t1.periodo = 3 
        AND t1.estado NOT IN (SELECT estado FROM pom HAVING estado IN ('ES01','ES02','ES03'))";
        if ($res = $enlace->query($consult)) {
            while ($periodo_3 = $res->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $cont++; ?></td>
                    <td><?php echo $periodo_3['mes']; ?></td>
                    <td><?php echo $periodo_3['municipio']; ?></td>
                    <td><?php echo $periodo_3['nuevo']; ?></td>
                    <td><?php echo $periodo_3['recurrente']; ?></td>
                    <th scope=""><?php echo round($periodo_3['total'], 2); ?></th>
                    <td><?php echo $periodo_3['cnatural']; ?></td>
                    <td><?php echo $periodo_3['csabor']; ?></td>
                    <td><?php echo $periodo_3['lubricante']; ?></td>
                    <td><?php echo $periodo_3['pruebaVIH']; ?></td>
                    <td><?php echo $periodo_3['reactivoE']; ?></td>
                    <td><?php echo $periodo_3['sifilis']; ?></td>
                    <td><?php echo $periodo_3['observacion']; ?></td>
                    <th scope="">
                        <?php if ($periodo_3['estado'] == 'ES03') {
                            echo '<p style="color: dodgerblue;">Revisar</p>';
                        } else if ($periodo_3['estado'] == 'ES04') {
                            echo '<p style="color: green;">Aprobado</p>';
                        } else if ($periodo_3['estado'] == 'ES05') {
                            echo '<p style="color:red;">En correccion</p>';
                        }
                        ?>
                    </th>

                </tr>
        <?php } $res->close(); } ?>
    </tbody>
    <tfoot>
        <th scope="">#</th>
        <th scope="">Mes</th>
        <th scope="">Municipio</th>
        <td class="text-center"><strong id="otransnuevos3">0</strong></td>
        <td class="text-center"><strong id="otransrecurrentes3">0</strong></td>
        <td class="text-center"><strong id="otranstotal3">0</strong></td>
        <td class="text-center"><strong id="otransnatural3">0</strong></td>
        <td class="text-center"><strong id="otranssabor3">0</strong></td>
        <td class="text-center"><strong id="otranslubricantes3">0</strong></td>
        <td class="text-center"><strong id="otranspruebavih3">0</strong></td>
        <td class="text-center"><strong id="otransreactivos3">0</strong></td>
        <td class="text-center"><strong id="otranssifilis3">0</strong></td>
        <th scope="">Observaciones</th>
        <th scope="">Estado</th>
    </tfoot>
</table>
</div>

<?php if ($SUBRECEPTOR == '2') { ?>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="col-sm-6">
            <form action="../../php/excel/generarExcelPoaOmes.php" method="POST">
                <input type="hidden" name="periodo" id="periodo" value="3">
                <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
                <select name="muni" id="muni">
                    <option value="">Todo los municipios ...</option>
                    <?php
                    $municipioSql = "SELECT DISTINCT p.municipio, c.nombre FROM poa p LEFT JOIN catalogo c ON c.codigo = p.municipio WHERE p.subreceptor_id = $SUBRECEPTOR AND p.periodo = 3";
                    $rmunicipio = $enlace->query($municipioSql);
                    while ($municipio = $rmunicipio->fetch_assoc()) { ?>
                        <option value="<?php echo $municipio['municipio'] ?>"><?php echo $municipio['nombre'] ?></option>
                    <?php } $rmunicipio->close(); ?>
                </select>
                <select name="me" id="me">
                    <option value="">Todo los meses ...</option>
                    <?php
                    $mesSql = "SELECT DISTINCT p.mes, c.nombre FROM poa p LEFT JOIN catalogo c ON c.codigo = p.mes WHERE p.subreceptor_id = $SUBRECEPTOR AND p.periodo = 3";
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
                <input type="hidden" name="periodo" id="periodo" value="3">
                <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
                <select name="muni" id="muni">
                    <option value="">Todo los municipios ...</option>
                    <?php
                    $municipioSql = "SELECT DISTINCT p.municipio, c.nombre FROM poa p LEFT JOIN catalogo c ON c.codigo = p.municipio WHERE p.subreceptor_id = $SUBRECEPTOR AND p.periodo = 3";
                    $rmunicipio = $enlace->query($municipioSql);
                    while ($municipio = $rmunicipio->fetch_assoc()) { ?>
                        <option value="<?php echo $municipio['municipio'] ?>"><?php echo $municipio['nombre'] ?></option>
                    <?php } $rmunicipio->close(); ?>
                </select>
                <select name="me" id="me">
                    <option value="">Todo los meses ...</option>
                    <?php
                    $mesSql = "SELECT DISTINCT p.mes, c.nombre FROM poa p LEFT JOIN catalogo c ON c.codigo = p.mes WHERE p.subreceptor_id = $SUBRECEPTOR AND p.periodo = 3";
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
                <input type="hidden" name="periodo" id="periodo" value="3">
                <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
                <select name="muni" id="muni">
                    <option value="">Todo los municipios ...</option>
                    <?php
                    $municipioSql = "SELECT DISTINCT p.municipio, c.nombre FROM poa p LEFT JOIN catalogo c ON c.codigo = p.municipio WHERE p.subreceptor_id = $SUBRECEPTOR AND p.periodo = 3";
                    $rmunicipio = $enlace->query($municipioSql);
                    while ($municipio = $rmunicipio->fetch_assoc()) { ?>
                        <option value="<?php echo $municipio['municipio'] ?>"><?php echo $municipio['nombre'] ?></option>
                    <?php } $rmunicipio->close(); ?>
                </select>
                <select name="me" id="me">
                    <option value="">Todo los meses ...</option>
                    <?php
                    $mesSql = "SELECT DISTINCT p.mes, c.nombre FROM poa p LEFT JOIN catalogo c ON c.codigo = p.mes WHERE p.subreceptor_id = $SUBRECEPTOR AND p.periodo = 3";
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