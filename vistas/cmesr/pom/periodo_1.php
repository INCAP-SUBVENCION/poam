<table class="table table-hover table-bordered">
    <thead style="font-size: 12px;" class="table-dark">

        <tr>
            <th>#</th>
            <th>Periodo</th>
            <th>Mes</th>
            <th>Municipio</th>
            <th>Lugar</th>
            <th>Fecha</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Codigo</th>
            <th>Subreceptor</th>
            <th>Nuevos</th>
            <th>Recurrentes</th>
            <th>Total</th>
            <th>Observacion</th>
            <th>Estado</th>
            <th>Opcion</th>

        </tr>
    </thead>
    <tbody class="text-center bg-light" style="font-size: 12px;">
        <?php
        $contap_1 = 1;
        $sqlp_1 = "SELECT DISTINCT t2.idPom, t2.periodo, t3.nombre AS mes, t4.nombre AS municipio, t2.lugar, t2.fecha, t2.horaInicio, t2.horaFin, t5.codigo, CONCAT(t6.nombre, ' ', t6.apellido) as nombres,
        t2.pNuevo, t2.pRecurrente, (t2.pNuevo + t2.pRecurrente) as total, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH, t2.autoprueba, t2.reactivo, t2.sifilis, t2.observacion, t2.estado FROM pom t2
        LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
        LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
        LEFT JOIN promotor t5 ON t5.idPromotor = t2.promotor_id
        LEFT JOIN persona t6 ON t6.idPersona = t5.persona_id
        LEFT JOIN poa t7 ON t7.idPoa = t2.poa_id
        WHERE t2.periodo=1 AND t7.subreceptor_id = $SUBRECEPTOR AND t2.estado NOT IN ('ES01')";
        if ($resp_1 = $enlace->query($sqlp_1)) {
            while ($periodo_1 = $resp_1->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $contap_1++; ?></td>
                    <td><?php echo $periodo_1['periodo']; ?></td>
                    <td><?php echo $periodo_1['mes']; ?></td>
                    <td><?php echo $periodo_1['municipio']; ?></td>
                    <td><?php echo $periodo_1['lugar']; ?></td>
                    <td><?php echo $periodo_1['fecha']; ?></td>
                    <td><?php echo $periodo_1['horaInicio']; ?></td>
                    <td><?php echo $periodo_1['horaFin']; ?></td>
                    <td><?php echo $periodo_1['codigo']; ?></td>
                    <td><?php echo $periodo_1['nombres']; ?></td>
                    <td><?php echo $periodo_1['pNuevo']; ?></td>
                    <td><?php echo $periodo_1['pRecurrente']; ?></td>
                    <th><?php echo round($periodo_1['total'], 2); ?></th>
                    <td><?php echo $periodo_1['observacion']; ?></td>
                    <p style="color:orange;"></p>

                    <th><?php if ($periodo_1['estado'] == 'ES02') {
                            echo '<p style="color: orange;"><i class="bi bi-search"></i> Revisar </p>';
                        } else if ($periodo_1['estado'] == 'ES03') {
                            echo '<p style="color: limegreen;"><i class="bi bi-check-square-fill"></i> Autorizado</p>';
                        }
                        ?>
                    </th>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                                <i class="bi bi-gear"></i> Opcion
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="detalle.php?id=<?php echo $periodo_1['idPom']; ?>">Detalles</a></li>
                                <li> <div class="d-grid gap-2"><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#revision<?php echo $periodo_1['idPom']; ?>">
                                <i class="bi bi-check-square-fill"></i> Autorizar</button></div> </li>
                                <li><a class="dropdown-item" href="#">Rechazado</a></li>
                            </ul>
                        </div>
                    </td>
                    <?php include 'modal/revision.php';?>
                </tr>
        <?php }
            $resp_1->close();
        }  ?>
    </tbody>
</table>