<table class="table table-bordered border-primary">
    <thead class="text-center border-light" style="background-color:dimgray;">
        <tr>
            <td colspan="6" class="text-white">DATOS PRINCIPALES </td>
            <td colspan="11" class="text-white">INSUMOS PROYECTADOS POR MES</td>
        </tr>
        <tr style="font-size: 11px; color:azure;">
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
            <th>Estado</th>
            <th>ACTION</th>
        </tr>
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
	    WHERE t1.subreceptor_id = $SUBRECEPTOR AND t1.anio = YEAR(NOW()) AND t1.periodo = 1 ORDER BY mes";
        if ($res = $enlace->query($consult)) {
            while ($periodo_1 = $res->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $cont++; ?></td>
                    <td><?php echo $periodo_1['mes']; ?></td>
                    <td><?php echo $periodo_1['municipio']; ?></td>
                    <td><?php echo $periodo_1['nuevo']; ?></td>
                    <td><?php echo $periodo_1['recurrente']; ?></td>
                    <th><?php echo round($periodo_1['total'], 2); ?></th>
                    <td><?php echo $periodo_1['cnatural']; ?></td>
                    <td><?php echo $periodo_1['csabor']; ?></td>
                    <td><?php echo $periodo_1['cfemenino']; ?></td>
                    <td><?php echo $periodo_1['lubricante']; ?></td>
                    <td><?php echo $periodo_1['pruebaVIH']; ?></td>
                    <td><?php echo $periodo_1['autoPrueba']; ?></td>
                    <td><?php echo $periodo_1['reactivoE']; ?></td>
                    <td><?php echo $periodo_1['sifilis']; ?></td>
                    <td><?php echo $periodo_1['observacion']; ?></td>
                    <th><?php if ($periodo_1['estado'] == 'ES01') {
                            echo '<p style="color: dodgerblue;"><i class="bi bi-node-plus-fill"></i> Creado</p>';
                        } else if ($periodo_1['estado'] == 'ES02') {
                            echo '<p style="color: orange;"><i class="bi bi-search"></i> En revision </p>';
                        } else if ($periodo_1['estado'] == 'ES03') {
                            echo '<p style="color: limegreen;"><i class="bi bi-check-square-fill"></i> Autorizado</p>';
                        }
                        ?>
                    </th>
                    <td>
                        <div class="dropdown">
                            <a class="btn-sm btn-outline-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" style="font-size: 12px;">
                                <i class="bi bi-grid"></i> Opciones
                            </a>
                            <?php
                                if ($periodo_1['estado'] == 'ES01') {
                            ?>
                            <ul class="dropdown-menu" style="font-size: 13px;">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-square"></i> Editar</a></li>
                                <li>
                                    <div class="d-grid gap-2"><button onclick="modalCambiarEstadoPoa(<?php echo $periodo_1['idPoa']; ?>,<?php echo $ID; ?>)" class="btn btn-primary" type="button">Enviar a revision</button> </div>
                                </li>
                            </ul>
                            <?php }?>
                        </div>
                    </td>

                </tr>
        <?php }
            $res->close();
        }  ?>
    </tbody>
</table>
<?php include '../modal/cambiarEstadoPoa.php'; ?>
