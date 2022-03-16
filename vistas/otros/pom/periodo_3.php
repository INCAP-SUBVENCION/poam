<table class="table table-sm table-hover" id="pom_periodo_3" aria-describedby="pom del periodo 3">
    <thead style="font-size: 11px;">
            <th scope>#</th>
            <th scope>Periodo</th>
            <th scope>Mes</th>
            <th scope>Municipio</th>
            <th scope>Lugar</th>
            <th scope>Fecha</th>
            <th scope>Inicio</th>
            <th scope>Fin</th>
            <th scope>Promotor</th>
            <th scope>Nuevos</th>
            <th scope>Recurrentes</th>
            <th scope>Total</th>
            <th scope>Observacion</th>
            <th scope>Supervisado</th>
            <th scope>Supervisor</th>
            <th scope>Estado</th>
            <th scope>Opcion</th>
    </thead>
    <tbody style="font-size: 12px;" class="text-center">
        <?php
        $contap_3 = 1;
        $sqlp_3 = "SELECT DISTINCT t2.subreceptor_id, t2.idPom, t2.periodo, t3.nombre AS mes, t4.nombre AS municipio, t2.lugar, t2.fecha, 
        t2.horaInicio, t2.horaFin, t6.codigo, CONCAT(t6.nombre, ' ', t6.apellido) as nombres, t2.pNuevo, t2.pRecurrente,
         (t2.pNuevo + t2.pRecurrente) as total, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH, 
         t2.autoprueba, t2.reactivo, t2.sifilis, t2.observacion, 
        t2.supervisado, t2.supervisor, t2.estado FROM pom t2
        LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
        LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
        LEFT JOIN promotor t5 ON t5.idPromotor = t2.promotor_id
        LEFT JOIN persona t6 ON t6.idPersona = t5.persona_id
        LEFT JOIN poa t7 ON t7.idPoa = t2.poa_id
        WHERE t2.periodo = 3 AND t7.subreceptor_id = $SUBRECEPTOR  
        AND t2.estado NOT IN (SELECT estado FROM pom HAVING estado IN ('PR01', 'PR02', 'PR03','ES01','ES02','ES03','ES05','CA01','CA02','RC01','RC02','RP01','RP02')) ORDER BY t2.estado";
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
                    <td><?php echo $periodo_3['nombres']; ?></td>
                    <td><?php echo $periodo_3['pNuevo']; ?></td>
                    <td><?php echo $periodo_3['pRecurrente']; ?></td>
                    <th scope><?php echo round($periodo_3['total'], 2); ?></th>
                    <td><?php echo $periodo_3['observacion']; ?></td>
                    <td><?php if ($periodo_3['supervisado'] == 1) { echo 'Si'; } else { echo 'No'; } ?></td>
                    <td><?php echo $periodo_3['supervisor']; ?></td>
                    <th scope style="font-size: 11px;">
                        <?php if ($periodo_3['estado'] == 'ES04') {
                            echo '<p class="text-white bg-success"> Aprobado</p>';
                        } elseif ($periodo_3['estado'] == 'ES05') {
                            echo '<p class = "text-white bg-danger"> En correccion</p>';
                        } elseif ($periodo_3['estado'] == 'ES06') {
                            echo '<p class = "text-danger"> Actividad Cancelada </p>';
                        } elseif ($periodo_3['estado'] == 'ES07') {
                            echo '<p class = "text-danger"> Actividad Recalendarizada </p>';
                        } elseif ($periodo_3['estado'] == 'ES08') {
                            echo '<p class = "text-danger"> Actividad Reprogramada </p>';
                        }  ?>
                    </th>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                                <em class="bi bi-grid"></em>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="detallePom.php?id=<?php echo $periodo_3['idPom']; ?>&sub=<?php echo $periodo_3['subreceptor_id']; ?>">
                                        <em class="bi bi-card-list"></em> Detalles</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
        <?php } $resp_3->close(); } ?>
    </tbody>
    <tfoot>
            <th>#</th>
            <th>Periodo</th>
            <th>Mes</th>
            <th>Municipio</th>
            <th>Lugar</th>
            <th>Fecha</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Promotor</th>
            <td class="text-center"><strong id="tnuevo3">0</strong></td>
            <td class="text-center"><strong id="tnuevo3">0</strong></td>
            <td class="text-center"><strong id="ttotal3">0</strong></td>
            <th>Observacion</th>
            <th>Estado</th>
    </tfoot>
</table>

<?php if ($SUBRECEPTOR == '2') { ?>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="col-sm-6">
            <form action="../../php/excel/generarExcelPomOmes.php" method="POST">
                <input type="hidden" name="periodo" id="periodo" value="3">
                <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
                <select name="meses" id="meses">
                    <?php
                    $cd = "SELECT t2.codigo, t2.nombre as mes FROM pom t1 LEFT JOIN  catalogo t2 ON t2.codigo = t1.mes  
                    WHERE t1.periodo = 3 AND t1.subreceptor_id = $SUBRECEPTOR group by t2.codigo";
                    $rd = $enlace->query($cd);
                    while ($mes = $rd->fetch_assoc()) { ?>
                        <option value="<?php echo $mes['codigo']; ?>"><?php echo $mes['mes']; ?></option>
                    <?php } $rd->close(); ?>
                </select>
                <button type="submit" class="btn btn-sm btn-success"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar </button>
            </form>
        </div>
    </div>
<?php } if ($SUBRECEPTOR == '3' || $SUBRECEPTOR == '4' || $SUBRECEPTOR == '6' || $SUBRECEPTOR == '7') { ?>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="col-sm-6">
            <form action="../../php/excel/generarExcelPomHsh.php" method="POST">
                <input type="hidden" name="periodo" id="periodo" value="3">
                <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
                <select name="meses" id="meses">
                    <?php
                    $cd = "SELECT t2.codigo, t2.nombre as mes FROM pom t1 LEFT JOIN  catalogo t2 ON t2.codigo = t1.mes  
                    WHERE t1.periodo = 3 AND t1.subreceptor_id = $SUBRECEPTOR group by t2.codigo";
                    $rd = $enlace->query($cd);
                    while ($mes = $rd->fetch_assoc()) { ?>
                        <option value="<?php echo $mes['codigo']; ?>"><?php echo $mes['mes']; ?></option>
                    <?php } $rd->close(); ?>
                </select>
                <button type="submit" class="btn btn-sm btn-success"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar </button>
            </form>
        </div>
    </div>
<?php } if ($SUBRECEPTOR == '5') { ?>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="col-sm-6">
            <form action="../../php/excel/generarExcelPomTrans.php" method="POST">
                <input type="hidden" name="periodo" id="periodo" value="3">
                <input type="hidden" name="sub" id="sub" value="<?php echo $SUBRECEPTOR; ?>">
                <select name="meses" id="meses">
                    <?php
                    $cd = "SELECT t2.codigo, t2.nombre as mes FROM pom t1 LEFT JOIN  catalogo t2 ON t2.codigo = t1.mes  
                    WHERE t1.periodo = 3 AND t1.subreceptor_id = $SUBRECEPTOR group by t2.codigo";
                    $rd = $enlace->query($cd);
                    while ($mes = $rd->fetch_assoc()) { ?>
                        <option value="<?php echo $mes['codigo']; ?>"><?php echo $mes['mes']; ?></option>
                    <?php } $rd->close(); ?>
                </select>
                <button type="submit" class="btn btn-sm btn-success"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar </button>
            </form>
        </div>
    </div>
<?php } ?>