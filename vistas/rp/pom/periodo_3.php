<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="col-sm-4">

        <div class="input-group input-group-sm">
            <a class="btn btn-success" href="../../php/excel/generarExcelPom.php?periodo=3" role="button"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar</a>
            <span class="input-group-text" id="inputGroup-sizing-sm"><em class="bi bi-search"></em></span>
            <input class="form-control" type="text" id="buscador" placeholder="Buscar..." />
        </div>
    </div>
</div>
<table class="table table-hover table-bordered" id="pom_periodo_1" aria-describedby="pom del periodo 1">
    <thead style="font-size: 12px;" class="table-info">
        <tr>
            <th scope>#</th>
            <th scope>Periodo</th>
            <th scope>Mes</th>
            <th scope>Municipio</th>
            <th scope>Lugar</th>
            <th scope>Fecha</th>
            <th scope>Inicio</th>
            <th scope>Fin</th>
            <th scope>Codigo</th>
            <th scope>Subreceptor</th>
            <th scope>Nuevos</th>
            <th scope>Recurrentes</th>
            <th scope>Total</th>
            <th scope>Observacion</th>
            <th scope>Estado</th>
            <th scope>Opcion</th>

        </tr>
    </thead>
    <tbody style="font-size: 12px;">
        <?php
        $contap_1 = 1;
        $sqlp_1 = "SELECT DISTINCT t2.idPom, t2.periodo, t3.nombre AS mes, t4.nombre AS municipio, 
        t2.lugar, t2.fecha, t2.horaInicio, t2.horaFin, t5.codigo, CONCAT(t6.nombre, ' ', 
        t6.apellido) as nombres,t2.pNuevo, t2.pRecurrente, (t2.pNuevo + t2.pRecurrente) as total,
        t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH, t2.autoprueba, 
        t2.reactivo, t2.sifilis, t2.observacion, t2.estado FROM pom t2
        LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
        LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
        LEFT JOIN promotor t5 ON t5.idPromotor = t2.promotor_id
        LEFT JOIN persona t6 ON t6.idPersona = t5.persona_id
        LEFT JOIN poa t7 ON t7.idPoa = t2.poa_id
        WHERE t2.periodo=3 AND t7.subreceptor_id = $SUBRECEPTOR 
        AND t2.estado = 'ES04' OR t2.estado = 'ES05'";
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
                    <th scope><?php echo round($periodo_1['total'], 2); ?></th>
                    <td><?php echo $periodo_1['observacion']; ?></td>
                    <th scope><?php if ($periodo_1['estado'] == 'ES04') {
                                    echo '<p class="text-primary">Revisar</p>';
                                } else if ($periodo_1['estado'] == 'ES05') {
                                    echo '<p class="text-warning">Aprobado</p>';
                                }
                                ?>
                    </th>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                                <em class="bi bi-gear"></em> Opcion
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="detallePom.php?id=<?php echo $periodo_1['idPom']; ?>">
                                        <em class="bi bi-card-list"></em> Detalles</a>
                                </li>
                                <?php
                                if ($periodo_1['estado'] == 'ES04') {
                                ?>

                                    <li>
                                        <div class="d-grid gap-2">
                                            <button class="dropdown-item" onclick="modalCambiarEstadoPom(<?php echo $periodo_1['idPom']; ?>, <?php echo $ID; ?>, 'ES05')">
                                            <em class="bi bi-arrow-right-circle"></em> Revisar y autorizar  </button>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-grid gap-2">
                                            <button class="dropdown-item" onclick="enviarTodoPom(<?php echo $SUBRECEPTOR; ?>, 3, 'ES05', 'ES04')">
                                                <em class="bi bi-arrow-clockwise"></em> Revisar y autorizar todo </button>
                                        </div>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </td>
                </tr>
        <?php }
            $resp_1->close();
        }  ?>
    </tbody>
</table>
<?php include '../modal/cambiarEstadoPom.php'; ?>