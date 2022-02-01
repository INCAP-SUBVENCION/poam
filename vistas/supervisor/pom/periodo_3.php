<table class="table table-sm table-hover" id="pom_periodo_3" aria-describedby="pom del periodo 3">
    <thead style="font-size: 11px;">
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
            <th scope>Promotor</th>
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
        $contap_3 = 1;
        $sqlp_3 = "SELECT DISTINCT t2.subreceptor_id, t2.idPom, t2.periodo, t3.nombre AS mes, t4.nombre AS municipio, 
        t2.lugar, t2.fecha, t2.horaInicio, t2.horaFin, t6.codigo, CONCAT(t6.nombre, ' ', t6.apellido) as nombres, t2.pNuevo, 
        t2.pRecurrente, (t2.pNuevo + t2.pRecurrente) as total, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH, 
        t2.autoprueba, t2.reactivo, t2.sifilis, t2.observacion, t2.supervisado, t2.supervisor, t2.estado FROM pom t2
        LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
        LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
        LEFT JOIN promotor t5 ON t5.idPromotor = t2.promotor_id
        LEFT JOIN persona t6 ON t6.idPersona = t5.persona_id
        LEFT JOIN poa t7 ON t7.idPoa = t2.poa_id
        WHERE t2.periodo=3 AND t2.subreceptor_id = $SUBRECEPTOR
        AND t2.estado NOT IN(SELECT estado FROM pom WHERE estado = 'PR01')";
        if ($resp_3 = $enlace->query($sqlp_3)) {
            while ($periodo_3 = $resp_3->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $contap_3++; ?></td>
                    <td><?php echo $periodo_3['periodo']; ?></td>
                    <td><?php echo $periodo_3['mes']; ?></td>
                    <td><?php echo $periodo_3['municipio']; ?></td>
                    <td><?php echo $periodo_3['lugar']; ?></td>
                    <td><?php echo $periodo_3['fecha']; ?></td>
                    <td><?php echo $periodo_3['horaInicio']; ?></td>
                    <td><?php echo $periodo_3['horaFin']; ?></td>
                    <td><?php echo $periodo_3['codigo']; ?></td>
                    <td><?php echo $periodo_3['nombres']; ?></td>
                    <td><?php echo $periodo_3['pNuevo']; ?></td>
                    <td><?php echo $periodo_3['pRecurrente']; ?></td>
                    <th scope><?php echo round($periodo_3['total'], 2); ?></th>
                    <td><?php echo $periodo_3['observacion']; ?></td>
                    <th scope style="font-size: 11px;">
                        <?php
                        if ($periodo_3['estado'] == 'PR02') {
                            echo '<p class="text-primary"> Revisar </p>';
                        } elseif ($periodo_3['estado'] == 'PR03') {
                            echo '<p class="text-danger"> En correccion </p>';
                        } elseif ($periodo_3['estado'] == 'ES01') {
                            echo '<p class="text-info"> Creado o revisado </p>';
                        } elseif ($periodo_3['estado'] == 'ES02') {
                            echo '<p class="text-warning"> Enviado al RP </p>';
                        } elseif ($periodo_3['estado'] == 'ES03') {
                            echo '<p class="text-primary"> Revisado por RP </p>';
                        } elseif ($periodo_3['estado'] == 'ES04') {
                            echo '<p class = "text-success"> Aprobado por RP</p>';
                        } elseif ($periodo_3['estado'] == 'ES05') {
                            echo '<p class = "text-danger"> Correccion </p>';
                        } elseif ($periodo_3['estado'] == 'ES06') {
                            echo '<p class = "text-danger"> Actividad cancelada </p>';
                        } ?>
                    </th>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                                <em class="bi bi-grid"></em>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button class="dropdown-item" onclick="modalEstadoPom(<?php echo $periodo_3['idPom']; ?>)">
                                        <em class="bi bi-stoplights-fill"></em> Estados </button>
                                </li>
                                <?php
                                if ($SUBRECEPTOR == '3' || $SUBRECEPTOR == '6' || $SUBRECEPTOR == '7') {
                                    if ($periodo_3['estado'] == 'PR02') {
                                ?>
                                        <li>
                                            <div class="d-grid gap-2">
                                                <button class="dropdown-item" onclick="modalCambiarTodoEstadoPom()">
                                                    <em class="bi bi-arrow-clockwise"></em> Enviar al M&E </button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-grid gap-2">
                                                <button class="dropdown-item" onclick="modalCambiarEstadoPom(<?php echo $periodo_3['idPom']; ?>, <?php echo $ID; ?>, 'PR03')">
                                                    <em class="bi bi-arrow-right-circle"></em> Corregir actividad</button>
                                            </div>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" onclick="modalEditarPom(<?php echo $SUBRECEPTOR; ?>, 3, <?php echo $periodo_3['idPom']; ?>)">
                                                <em class="bi bi-pencil-square"></em> Editar </button>
                                        </li>

                                    <?php
                                    }
                                } else {
                                    ?>
                                    <li>
                                        <button class="dropdown-item" onclick="modalEditarPom(<?php echo $SUBRECEPTOR; ?>, 3, <?php echo $periodo_3['idPom']; ?>)">
                                            <em class="bi bi-pencil-square"></em> Editar </button>
                                    </li>
                                <?php
                                }
                                ?>
                                <li><a class="dropdown-item" href="detallePom.php?id=<?php echo $periodo_3['idPom']; ?>">
                                        <em class="bi bi-card-list"></em> Detalles</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
        <?php }
            $resp_3->close();
        }
        ?>
    </tbody>
    <tfoot>
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
            <td class="text-center"><strong id="tnuevo3">0</strong></td>
            <td class="text-center"><strong id="tnuevo3">0</strong></td>
            <td class="text-center"><strong id="ttotal3">0</strong></td>
            <th>Observacion</th>
            <th>Estado</th>
        </tr>
    </tfoot>
</table>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="col-sm-6">
        <form action="../../php/excel/generarExcelPom.php" method="POST">
            <input type="hidden" name="periodo" id="periodo" value="3">
            <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
            <button type="submit" class="btn btn-sm btn-success"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar </button>
        </form>
    </div>
</div>