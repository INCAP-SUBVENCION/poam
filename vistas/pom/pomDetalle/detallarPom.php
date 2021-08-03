<div class="row">
    <?php
    $sqlD = "SELECT DISTINCT t2.idPom, t2.periodo, t3.nombre AS mes, t4.nombre AS municipio, t2.lugar, t2.fecha, t2.horaInicio, t2.horaFin, t5.codigo,
            CONCAT(t6.nombre, ' ', t6.apellido) as nombres, t2.pNuevo, t2.pRecurrente, (t2.pNuevo + t2.pRecurrente) as total, t2.cnatural, t2.csabor,
            t2.cfemenino, t2.lubricante, t2.pruebaVIH, t2.autoprueba, t2.reactivo, t2.sifilis, t2.observacion, t1.estado FROM estado t1
            LEFT JOIN pom t2 ON t2.idPom = t1.pom_id
            LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
            LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
            LEFT JOIN promotor t5 ON t5.idPromotor = t2.promotor_id
            LEFT JOIN persona t6 ON t6.idPersona = t5.persona_id
            LEFT JOIN poa t7 ON t7.idPoa = t1.poa_id
            WHERE t2.periodo=1 AND t7.subreceptor_id = 1 AND t2.idPom =1";
    $detallar = $enlace->query($sqlD);
    while ($detalles = $detallar->fetch_assoc()) {
    ?>
        <div class="col-md-3">
            <table class="table table-bordered border-info">
                <tr class="text-center">
                    <th colspan="4">DATOS PRINCIPALES</th>
                </tr>
                <tr>
                    <th style="background-color:lightskyblue;">Periodo:</th>
                    <td><?php echo $detalles['periodo']; ?></td>
                    <th style="background-color:lightskyblue;">Mes:</th>
                    <td><?php echo $detalles['mes']; ?></td>
                </tr>
                <tr>
                    <th style="background-color:lightskyblue;">Municipio:</th>
                    <td><?php echo $detalles['municipio']; ?></td>
                    <th style="background-color:lightskyblue;">Fecha:</th>
                    <td><?php echo $detalles['fecha']; ?></td>
                </tr>
                <tr>
                    <th style="background-color:lightskyblue;">Lugar:</th>
                    <td colspan="3"><?php echo $detalles['lugar']; ?></td>
                </tr>
                <tr>
                    <th style="background-color:lightskyblue;">Inicio:</th>
                    <td><?php echo $detalles['horaInicio']; ?></td>
                    <th style="background-color:lightskyblue;">Fin:</th>
                    <td><?php echo $detalles['horaFin']; ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-9">
            <table class="table table-bordered border-info">
                <tr>
                    <th colspan="8" class="text-center">PROYECCION DE INSUMOS</th>
                </tr>
                <tr>
                    <th style="background-color:lightgray;">Nuevos</th>
                    <td><?php echo $detalles['pNuevo']; ?></td>
                    <th style="background-color:lightgray;">Recurrente</th>
                    <td><?php echo $detalles['pRecurrente']; ?></td>
                    <th style="background-color:lightgray;">Total</th>
                    <td><?php echo round($detalles['total'], 4); ?></td>
                    <th style="background-color:lightgray;">Condon natural</th>
                    <td><?php echo $detalles['cnatural']; ?></td>
                </tr>
                <tr>
                    <th style="background-color:lightgray;">Condon de sabor</th>
                    <td><?php echo $detalles['csabor']; ?></td>
                    <th style="background-color:lightgray;">Condon femenino</th>
                    <td><?php echo $detalles['cfemenino']; ?></td>
                    <th style="background-color:lightgray;">Lubricante</th>
                    <td><?php echo $detalles['lubricante']; ?></td>
                    <th style="background-color:lightgray;">Prueba VIH</th>
                    <td><?php echo $detalles['pruebaVIH']; ?></td>
                </tr>
                <tr>
                    <th style="background-color:lightgray;">Auto-prueba VIH</th>
                    <td><?php echo $detalles['autoprueba']; ?></td>
                    <th style="background-color:lightgray;">Reactivo experado</th>
                    <td><?php echo $detalles['reactivo']; ?></td>
                    <th style="background-color:lightgray;">Sifilis</th>
                    <td><?php echo $detalles['sifilis']; ?></td>
                    <th style="background-color:lightgray;">Codigo promotor</th>
                    <td><?php echo $detalles['codigo']; ?></td>

                </tr>
                <tr>
                    <th style="background-color:lightgray;">Promotor</th>
                    <td colspan="2"><?php echo $detalles['nombres']; ?></td>
                    <th style="background-color:lightgray;">Observaciones</th>
                    <td colspan="4"><?php echo $detalles['observacion']; ?></td>
                </tr>
            </table>
        </div>
    <?php } ?>
</div>