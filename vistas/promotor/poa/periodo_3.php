<div class="table-responsive">
<table class="table table-hover table-bordered" id="poa_periodo_3" aria-describedby="">
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
        $consult = "SELECT DISTINCT t1.idPoa, t5.nombre as mes, t4.nombre as municipio, t1.nuevo, t1.recurrente, (t1.nuevo + t1.recurrente) AS total,
        t1.observacion, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH, t2.autoPrueba, t2.reactivoE, t2.sifilis, t1.estado
        FROM poa t1
	    LEFT JOIN insumo t2 ON t2.poa_id = t1.idPoa
	    LEFT JOIN catalogo t3 ON t3.codigo = t1.departamento
	    LEFT JOIN catalogo t4 ON t4.codigo = t1.municipio
	    LEFT JOIN catalogo t5 ON t5.codigo = t1.mes
	    WHERE t1.subreceptor_id = $SUBRECEPTOR AND t1.periodo = 3";
        if ($res = $enlace->query($consult)) {
            while ($periodo_1 = $res->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $cont++; ?></td>
                    <td><?php echo $periodo_1['mes']; ?></td>
                    <td><?php echo $periodo_1['municipio']; ?></td>
                    <td><?php echo $periodo_1['nuevo']; ?></td>
                    <td><?php echo $periodo_1['recurrente']; ?></td>
                    <th scope=""><?php echo round($periodo_1['total'], 2); ?></th>
                    <td><?php echo $periodo_1['cnatural']; ?></td>
                    <td><?php echo $periodo_1['csabor']; ?></td>
                    <td><?php echo $periodo_1['cfemenino']; ?></td>
                    <td><?php echo $periodo_1['lubricante']; ?></td>
                    <td><?php echo $periodo_1['pruebaVIH']; ?></td>
                    <td><?php echo $periodo_1['reactivoE']; ?></td>
                    <td><?php echo $periodo_1['sifilis']; ?></td>
                    <td><?php echo $periodo_1['observacion']; ?></td>
                </tr>
        <?php }
            $res->close();
        }  ?>
    </tbody>
    <tfoot>
        <th scope="">#</th>
        <th scope="">Mes</th>
        <th scope="">Municipio</th>
        <td class="text-center"><strong id="tnuevos3">0</strong></td>
        <td class="text-center"><strong id="trecurrentes3">0</strong></td>
        <td class="text-center"><strong id="total3">0</strong></td>
        <td class="text-center"><strong id="tnatural3">0</strong></td>
        <td class="text-center"><strong id="tsabor3">0</strong></td>
        <td class="text-center"><strong id="tfemenino3">0</strong></td>
        <td class="text-center"><strong id="tlubricantes3">0</strong></td>
        <td class="text-center"><strong id="tpruebavih3">0</strong></td>
        <td class="text-center"><strong id="treactivos3">0</strong></td>
        <td class="text-center"><strong id="tsifilis3">0</strong></td>
        <th scope="">Observaciones</th>
    </tfoot>
</table>
</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="col-sm-6">
        <form action="../../php/excel/generarExcelPoa.php" method="POST">
            <input type="hidden" name="periodo" id="periodo" value="3">
            <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
            <button type="submit" class="btn btn-sm btn-success"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar </button>
        </form>
    </div>
</div>