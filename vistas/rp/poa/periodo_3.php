<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="col-sm-5">
        <div class="input-group input-group-sm">
            <span class="input-group-text" id="inputGroup-sizing-sm"><em class="bi bi-search"></em></span>
            <input class="form-control" type="text" id="buscador_1" placeholder="Buscar..." />
            <a class="btn btn-success" href="../../php/excel/generarExcelPoa.php?periodo=1" role="button"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar</a>

        </div>
    </div>
</div>

<table class="table table-hover table-bordered" id="poa_periodo_1" aria-describedby="">
    <thead class="text-center" style="font-size: 12px;">
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
        <th scope="">Auto prueba VIH</th>
        <th scope="">Reactivos esperados</th>
        <th scope="">Prueba Sifilis</th>
        <th scope="">Observaciones</th>
        <th scope="">Estado</th>
        <th scope="">ACTION</th>
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
	    WHERE t1.subreceptor_id = $SUBRECEPTOR AND t1.anio = YEAR(NOW()) AND t1.periodo = 3 AND t1.estado='ES04' OR t1.estado='ES05' ORDER BY mes";
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
                    <td><?php echo $periodo_1['autoPrueba']; ?></td>
                    <td><?php echo $periodo_1['reactivoE']; ?></td>
                    <td><?php echo $periodo_1['sifilis']; ?></td>
                    <td><?php echo $periodo_1['observacion']; ?></td>
                    <th scope="">
                        <?php if ($periodo_1['estado'] == 'ES04') {
                            echo '<p style="color: dodgerblue;">Revisar</p>';
                        } else if ($periodo_1['estado'] == 'ES05') {
                            echo '<p style="color: orange;">Aprobado </p>';
                        }
                        ?>
                    </th>
                
                    <td>
                        <div class="dropdown">
                            <a class="btn-sm btn-outline-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" style="font-size: 11px;">
                                <em class="bi bi-grid"></em> Opciones
                            </a>
                            <?php
                            if ($periodo_1['estado'] == 'ES04') {
                            ?>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="d-grid gap-2">
                                            <button class="dropdown-item" onclick="modalCambiarEstadoPoa(<?php echo $periodo_1['idPoa']; ?>,<?php echo $ID; ?>, 'ES05')">
                                                <em class="bi bi-arrow-right-circle"></em> Aprobar </button>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-grid gap-2">
                                        <button class="dropdown-item" onclick="cambiarTodo(<?php echo $SUBRECEPTOR; ?>, 3, 'ES05', 'ES04')">
                                                <em class="bi bi-arrow-clockwise"></em> Aprobar todo </button>
                                        </div>
                                    </li>
                                    <li><a class="dropdown-item" href="#"><em class="bi bi-pencil-square"></em> Editar</a></li>
                                </ul>
                            <?php } ?>
                        </div>
                    </td>

                </tr>
        <?php }
            $res->close();
        }  ?>
    </tbody>
</table>
<?php include '../modal/cambiarEstadoPoa.php'; ?>