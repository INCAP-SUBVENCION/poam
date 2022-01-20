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
        <th class="tprueba" scope="">Prueba VIH</th>
        <th scope="">Auto prueba VIH</th>
        <th class="treactivo" scope="">Reactivos esperados</th>
        <th class="tsifilis" scope="">Prueba Sifilis</th>
        <th scope="">Observaciones</th>
        <th scope="">Estado</th>
        <th scope="">Opciones</th>
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
                    <td class="tprueba"><?php echo $periodo_4['pruebaVIH']; ?></td>
                    <td><?php echo $periodo_4['autoPrueba']; ?></td>
                    <td class="treactivo"><?php echo $periodo_4['reactivoE']; ?></td>
                    <td class="tsifilis"><?php echo $periodo_4['sifilis']; ?></td>
                    <td><?php echo $periodo_4['observacion']; ?></td>
                    <th scope="">
                        <?php if ($periodo_4['estado'] == 'ES01') {
                            echo '<p style="color: dodgerblue;">Creado</p>';
                        } else if ($periodo_4['estado'] == 'ES02') {
                            echo '<p style="color: orange;">Enviado al RP </p>';
                        } else if ($periodo_4['estado'] == 'ES03') {
                            echo '<p style="color: limegreen;">Revisado por el RP</p>';
                        } else if ($periodo_4['estado'] == 'ES04') {
                            echo '<p style="color: limegreen;"> Aprobado por el RP</p>';
                        }
                        ?>
                    </th>
                    <td>
                        <div class="dropdown">
                            <a class="btn-sm btn-outline-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" style="font-size: 11px;">
                                <em class="bi bi-grid"></em>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <button class="dropdown-item" onclick="modalEstadoPoa(<?php echo $periodo_4['idPoa']; ?>)">
                                        <em class="bi bi-stoplights-fill"></em> Estados </button>
                                </li>
                                <?php
                                if ($periodo_4['estado'] == 'ES01') {
                                ?>
                                    <li>
                                        <div class="d-grid gap-2">
                                            <button class="dropdown-item" onclick="modalCambiarEstadoPoa(<?php echo $periodo_4['idPoa']; ?>,<?php echo $ID; ?>, 'ES02')">
                                                <em class="bi bi-arrow-right-circle"></em> Enviar al Enlace</button>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-grid gap-2">
                                            <button class="dropdown-item" onclick="modalCambiarTodoEstadoPoa()">
                                                <em class="bi bi-arrow-clockwise"></em> Enviar todo al Enlace </button>
                                        </div>
                                    </li>
                                    <button class="dropdown-item" onclick="modalEditarPoa(<?php echo $SUBRECEPTOR; ?>, 4, <?php echo $periodo_4['idPoa']; ?>)">
                                        <em class="bi bi-pencil-square"></em> Editar </button>
                                <?php } ?>
                            </ul>
                        </div>
                    </td>

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
        <td class="text-center tprueba"><strong id="tpruebavih3">0</strong></td>
        <td class="text-center"><strong id="tautoprueba3">0</strong></td>
        <td class="text-center treactivo"><strong id="treactivos3">0</strong></td>
        <td class="text-center tsifilis"><strong id="tsifilis3">0</strong></td>
        <th scope="">Observaciones</th>
        <th scope="">Estado</th>
    </tfoot>
</table>
<a class="btn btn-success" href="../../php/excel/generarExcelPoa.php?periodo=4" role="button"><em class="bi bi-file-earmark-spreadsheet-fill"></em> Descargar</a>