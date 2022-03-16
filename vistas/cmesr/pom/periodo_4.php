<table class="table table-sm table-hover" id="pom_periodo_4" aria-describedby="pom del periodo 4">
    <thead style="font-size: 12px;">
    <tr>
    <th scope>#</th>
        <th scope>Periodo</th>
        <th scope>Mes</th>
        <th scope>Municipio</th>
        <th scope>Lugar</th>
        <th scope>Fecha</th>
        <th scope>Inicio</th>
        <th scope>Fin</th>
        <th scope>Promotor</th>
        <th class="text-center text-primary" scope>Nuevos</th>
        <th class="text-center text-primary" scope>Recurrentes</th>
        <th class="text-center text-danger" scope>Total</th>
        <th class="text-center text-info" scope>Reactivo</th>
        <th scope>Observacion</th>
        <th scope>Supervisado</th>
        <th scope>Supervisor</th>
        <th scope>Estado</th>
        <th scope>Opcion</th>
    </tr>
    </thead>
    <tbody style="font-size: 12px;">
        <?php
        $contap_4 = 1;
        $sqlp_4 = "SELECT DISTINCT t2.idPom, t2.periodo, t3.nombre AS mes, t4.nombre AS municipio, t2.lugar, t2.fecha, 
        t2.horaInicio, t2.horaFin, t6.codigo, CONCAT(t6.nombre, ' ', t6.apellido) as nombres, t2.pNuevo, t2.pRecurrente,
         (t2.pNuevo + t2.pRecurrente) as total, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH, 
         t2.autoprueba, t2.reactivo, t2.sifilis, t2.observacion, 
        t2.supervisado, t2.supervisor, t2.estado FROM pom t2
        LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
        LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
        LEFT JOIN promotor t5 ON t5.idPromotor = t2.promotor_id
        LEFT JOIN persona t6 ON t6.idPersona = t5.persona_id
        LEFT JOIN poa t7 ON t7.idPoa = t2.poa_id
        WHERE t2.periodo = 4 AND t7.subreceptor_id = $SUBRECEPTOR  
        AND t2.estado NOT IN (SELECT estado FROM pom HAVING estado IN ('PR01', 'PR02', 'PR03')) ORDER BY t2.estado";
        if ($resp_4 = $enlace->query($sqlp_4)) {
            while ($periodo_4 = $resp_4->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $contap_4++; ?></td>
                    <td><?php echo $periodo_4['periodo']; ?></td>
                    <td><?php echo $periodo_4['mes']; ?></td>
                    <td><?php echo $periodo_4['municipio']; ?></td>
                    <td><?php echo $periodo_4['lugar']; ?></td>
                    <td><?php echo $periodo_4['fecha']; ?></td>
                    <td><?php echo $periodo_4['horaInicio']; ?></td>
                    <td><?php echo $periodo_4['horaFin']; ?></td>
                    <td><?php echo $periodo_4['nombres']; ?></td>
                    <td class="text-center text-primary"><?php echo $periodo_4['pNuevo']; ?></td>
                    <td class="text-center text-primary"><?php echo $periodo_4['pRecurrente']; ?></td>
                    <th class="text-center text-danger" scope><?php echo round($periodo_4['total'], 2); ?></th>
                    <th class="text-center text-info" scope><?php echo round($periodo_4['reactivo'], 2); ?></th>
                    <td><?php echo $periodo_4['observacion']; ?></td>
                    <td><?php if ($periodo_4['supervisado'] == 1) {
                            echo 'Si';
                        } else {
                            echo 'No';
                        } ?></td>
                    <td><?php echo $periodo_4['supervisor']; ?></td>
                    <th scope style="font-size: 11px;" class="text-center">
                        <?php if ($periodo_4['estado'] == 'ES01') {
                            echo '<p class="text-white bg-info"><i class="bi bi-plus-circle-fill"></i><br>Creado</p>';
                        } elseif ($periodo_4['estado'] == 'ES02') {
                            echo '<p class="text-dark bg-warning"><i class="bi bi-hand-index-fill"></i><br> En revision </p>';
                        } elseif ($periodo_4['estado'] == 'ES03') {
                            echo '<p class="text-info"> Revisado por RP </p>';
                        } elseif ($periodo_4['estado'] == 'ES04') {
                            echo '<p class = "text-white bg-primary"><i class="bi bi-hand-thumbs-up-fill"></i><br>Actividad aprobada</p>';
                        } elseif ($periodo_4['estado'] == 'ES05') {
                            echo '<p class = "text-dark bg-info"><i class="bi bi-pencil-square"></i><br>Pendiente de correccion</p>';
                        } elseif ($periodo_4['estado'] == 'RE01') {
                            echo '<p class = "text-dark bg-warning"><i class="bi bi-front"></i><br>Reprogramacion solicitado</p>';
                        } elseif ($periodo_4['estado'] == 'RE02') {
                            echo '<p class = "text-white bg-success"><i class="bi bi-hand-thumbs-up-fill"></i><br>Solcitud aceptada </p>';
                        } elseif ($periodo_4['estado'] == 'RE03') {
                            echo '<p class = "text-white bg-danger"><i class="bi bi-hand-thumbs-down-fill"></i><br>Reprogramacion rechazada</p>';
                        } elseif ($periodo_4['estado'] == 'CA01') {
                            echo '<p class = "text-dark bg-info"><i class="bi bi-x-circle"></i><br>Cancelacion solicitado</p>';
                        } elseif ($periodo_4['estado'] == 'CA02') {
                            echo '<p class = "text-dark bg-warning"><i class="bi bi-x-circle"></i><br>Cancelacion rechzada</p>';
                        } elseif ($periodo_4['estado'] == 'ES06') {
                            echo '<p class = "text-dark bg-danger"><i class="bi bi-x-circle"></i><br>Actividad cancelada</p>';
                        } elseif ($periodo_4['estado'] == 'RP01') {
                            echo '<p class = "text-info"><i class="bi bi-reply-all-fill"></i><br>Reprogramacion Solicitado </p>';
                        } elseif ($periodo_4['estado'] == 'RP02') {
                            echo '<p class = "text-danger"><i class="bi bi-reply-all-fill"></i><br>Reprogramacion Rechazado </p>';
                        } elseif ($periodo_4['estado'] == 'ES08') {
                            echo '<p class = "text-primary"><i class="bi bi-reply-all-fill"></i><br>Actividad Reprogramada</p>';
                        } elseif ($periodo_4['estado'] == 'RC01') {
                            echo '<p class = "text-info"><i class="bi bi-calendar-fill"></i><br>Recalendarizacion Solicitado</p>';
                        } elseif ($periodo_4['estado'] == 'RC02') {
                            echo '<p class = "text-danger"><i class="bi bi-calendar-fill"></i><br>Recalendarizacion Rechazado</p>';
                        } elseif ($periodo_4['estado'] == 'ES07') {
                            echo '<p class = "text-warning"><i class="bi bi-calendar-fill"></i><br>Actividad Recalendarizado</p>';
                        }
                        ?>
                    </th>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-info" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                                <em class="bi bi-menu-button-wide-fill"></em>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button class="dropdown-item" onclick="modalEstadoPom(<?php echo $periodo_4['idPom']; ?>)">
                                        <em class="bi bi-stoplights-fill"></em> Estados </button>
                                </li>

                                <!----- HSH ---->
                                <?php if ($periodo_4['estado'] == 'ES01' && ($SUBRECEPTOR == '3' || $SUBRECEPTOR == '6' || $SUBRECEPTOR == '7')) { ?>
                                    <li>
                                        <button class="dropdown-item" onclick="modalCambiarTodoEstadoPom()">
                                            <em class="bi bi-arrow-clockwise"></em> Enviar al Enlace </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" onclick="modalCambiarEstadoPom(<?php echo $periodo_4['idPom']; ?>, <?php echo $ID; ?>, 'PR03')">
                                            <em class="bi bi-arrow-right-circle"></em> Corregir actividad</button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" onclick="modalEditarPom(<?php echo $SUBRECEPTOR; ?>, 4, <?php echo $periodo_4['idPom']; ?>)">
                                            <em class="bi bi-pencil-square"></em> Editar </button>
                                    </li>
                                <?php } ?>

                                <!---- OMES Y OTRANS  ---->
                                <?php if ($periodo_4['estado'] == 'ES01' && ($SUBRECEPTOR == '2' || $SUBRECEPTOR == '5')) { ?>
                                    <li>
                                        <button class="dropdown-item" onclick="modalCambiarTodoEstadoPom()">
                                            <em class="bi bi-arrow-clockwise"></em> Enviar todo al Enlace </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" onclick="modalEditarPom(<?php echo $SUBRECEPTOR; ?>, 4, <?php echo $periodo_4['idPom']; ?>)">
                                            <em class="bi bi-pencil-square"></em> Editar </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" onclick="modalCambiarEstadoPom(<?php echo $periodo_4['idPom']; ?>, <?php echo $ID; ?>, 'PR03')">
                                            <em class="bi bi-arrow-right-circle"></em> Corregir actividad</button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" onclick="modalAnularPom(<?php echo $SUBRECEPTOR; ?>, 4, <?php echo $periodo_4['idPom']; ?>)">
                                            <em class="bi bi-trash2-fill"></em> Anular actividad </button>
                                    </li>
                                <?php } ?>

                                <!---- PPL  ---->
                                <?php if ($periodo_4['estado'] == 'ES01' && $SUBRECEPTOR == '4') { ?>
                                    <li>
                                        <button class="dropdown-item" onclick="modalCambiarTodoEstadoPom()">
                                            <em class="bi bi-arrow-clockwise"></em> Enviar todo al Enlace </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" onclick="modalEditarPom(<?php echo $SUBRECEPTOR; ?>, 4, <?php echo $periodo_4['idPom']; ?>)">
                                            <em class="bi bi-pencil-square"></em> Editar </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" onclick="modalAnularPom(<?php echo $SUBRECEPTOR; ?>, 4, <?php echo $periodo_4['idPom']; ?>)">
                                            <em class="bi bi-trash2-fill"></em> Anular actividad </button>
                                    </li>

                                <?php } if ($periodo_4['estado'] == 'ES04') { ?>
                                    <li>
                                        <button class="dropdown-item" onclick="modalRecalendarizacionPom(<?php echo $periodo_4['idPom']; ?>, <?php echo $ID; ?>,'RC01')">
                                            <em class="bi bi-shuffle"></em> Recalendarización </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" onclick="modalReprogramacionPom(<?php echo $periodo_4['idPom']; ?>, <?php echo $ID; ?>,'RP01')">
                                            <em class="bi bi-reply-all-fill"></em> Reprogramacion </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" onclick="modalCancelarActividad(<?php echo $periodo_4['idPom']; ?>, <?php echo $ID; ?>, 'CA01')">
                                            <em class="bi bi-back"></em> Cancelar actividad </button>
                                    </li>
                                <?php } if ($periodo_4['estado'] == 'ES05') { ?>
                                    <li>
                                        <button class="dropdown-item" onclick="modalEditarPom(<?php echo $SUBRECEPTOR; ?>, 4, <?php echo $periodo_4['idPom']; ?>)">
                                            <em class="bi bi-pencil-square"></em> Editar </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" onclick="modalCambiarEstadoPom(<?php echo $periodo_4['idPom']; ?>, <?php echo $ID; ?>, 'ES02')">
                                            <em class="bi bi-arrow-right-circle"></em> Enviar correcciones </button>
                                    </li>
                                <?php } if ($periodo_4['estado'] == 'RE02') { ?>
                                    <li>
                                        <button class="dropdown-item" onclick="modalHistorialPom(<?php echo $periodo_4['idPom']; ?>)">
                                            <em class="bi bi-clock-history"></em> Historial </button>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a class="dropdown-item" href="detallePom.php?id=<?php echo $periodo_4['idPom']; ?>">
                                        <em class="bi bi-card-list"></em> Detalles</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
        <?php } $resp_4->close(); } ?>
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
        <th>Promotor</th>
        <td class="text-center text-primary"><strong id="tnuevo4">0</strong></td>
        <td class="text-center text-primary"><strong id="tnuevo4">0</strong></td>
        <td class="text-center text-danger"><strong id="ttotal4">0</strong></td>
        <td class="text-center text-info"><strong id="treactivo4">0</strong></td>
        <th>Observacion</th>
        <th>Supervisado</th>
        <th>Supervisor</th>
        <th>Estado</th>
        </tr>
    </tfoot>
</table>

<?php if ($SUBRECEPTOR == '2') { ?>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="col-sm-6">
            <form action="../../php/excel/generarExcelPomOmes.php" method="POST">
                <input type="hidden" name="periodo" id="periodo" value="4">
                <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
                <select name="meses" id="meses">
                    <?php
                    $cd = "SELECT t2.codigo, t2.nombre as mes FROM pom t1 LEFT JOIN  catalogo t2 ON t2.codigo = t1.mes  
                           WHERE t1.periodo = 4 AND t1.subreceptor_id = $SUBRECEPTOR group by t2.codigo";
                    $rd = $enlace->query($cd);
                    while ($mes = $rd->fetch_assoc()) { ?>
                        <option value="<?php echo $mes['codigo']; ?>"><?php echo $mes['mes']; ?></option>
                    <?php }
                    $rd->close();
                    ?>
                </select>
                <button type="submit" class="btn btn-sm btn-success"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar </button>
            </form>
        </div>
    </div>

<?php }
if ($SUBRECEPTOR == '3' || $SUBRECEPTOR == '4' || $SUBRECEPTOR == '6' || $SUBRECEPTOR == '7') { ?>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="col-sm-6">
            <form action="../../php/excel/generarExcelPomHsh.php" method="POST">
                <input type="hidden" name="periodo" id="periodo" value="4">
                <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
                <select name="meses" id="meses">
                    <?php
                    $cd = "SELECT t2.codigo, t2.nombre as mes FROM pom t1 LEFT JOIN  catalogo t2 ON t2.codigo = t1.mes  
                           WHERE t1.periodo = 4 AND t1.subreceptor_id = $SUBRECEPTOR group by t2.codigo";
                    $rd = $enlace->query($cd);
                    while ($mes = $rd->fetch_assoc()) { ?>
                        <option value="<?php echo $mes['codigo']; ?>"><?php echo $mes['mes']; ?></option>
                    <?php }
                    $rd->close();
                    ?>
                </select>
                <button type="submit" class="btn btn-sm btn-success"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar </button>
            </form>
        </div>
    </div>

    <?php } if ($SUBRECEPTOR == '5') { ?>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="col-sm-6">
                <form action="../../php/excel/generarExcelPomTrans.php" method="POST">
                    <input type="hidden" name="periodo" id="periodo" value="4">
                    <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
                    <select name="meses" id="meses">
                        <?php
                        $cd = "SELECT t2.codigo, t2.nombre as mes FROM pom t1 LEFT JOIN  catalogo t2 ON t2.codigo = t1.mes  
                               WHERE t1.periodo = 4 AND t1.subreceptor_id = $SUBRECEPTOR group by t2.codigo";
                        $rd = $enlace->query($cd);
                        while ($mes = $rd->fetch_assoc()) { ?>
                            <option value="<?php echo $mes['codigo']; ?>"><?php echo $mes['mes']; ?></option>
                        <?php }
                        $rd->close();
                        ?>
                    </select>
                    <button type="submit" class="btn btn-sm btn-success"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar </button>
                </form>
            </div>
        </div>
    <?php } ?>