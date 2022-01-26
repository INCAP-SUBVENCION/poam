<div class="row">
    <?php
    $sqlD = "SELECT DISTINCT t2.idPom, t2.periodo, t3.nombre AS mes, t4.nombre AS municipio, t2.lugar, t2.fecha, t2.horaInicio, t2.horaFin, t6.codigo, CONCAT(t6.nombre, ' ', t6.apellido) as nombres,
    t2.pNuevo, t2.pRecurrente, (t2.pNuevo + t2.pRecurrente) as total, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH, t2.autoprueba, t2.reactivo, t2.sifilis, t2.observacion, t2.estado FROM pom t2
    LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
    LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
    LEFT JOIN promotor t5 ON t5.idPromotor = t2.promotor_id
    LEFT JOIN persona t6 ON t6.idPersona = t5.persona_id
    LEFT JOIN poa t7 ON t7.idPoa = t2.poa_id
    WHERE t2.idPom = $POM";
    $detallar = $enlace->query($sqlD);
    while ($detalles = $detallar->fetch_assoc()) {
    ?>
        <div class="col-md-3">
            <table class="table table-bordered border-info" style="font-size: 12px;" aria-describedby="Descripcion del pom">
                <tr class="text-center">
                    <th scope="" colspan="4">DATOS PRINCIPALES</th>
                </tr>
                <tr>
                    <th scope="" style="background-color:lightskyblue;">Periodo:</th>
                    <td><?php echo $detalles['periodo']; ?></td>
                    <th scope="" style="background-color:lightskyblue;">Mes:</th>
                    <td><?php echo $detalles['mes']; ?></td>
                </tr>
                <tr>
                    <th scope="" style="background-color:lightskyblue;">Municipio:</th>
                    <td><?php echo $detalles['municipio']; ?></td>
                    <th scope="" style="background-color:lightskyblue;">Fecha:</th>
                    <td><?php echo $detalles['fecha']; ?></td>
                </tr>
                <tr>
                    <th scope="" style="background-color:lightskyblue;">Lugar:</th>
                    <td colspan="3"><?php echo $detalles['lugar']; ?></td>
                </tr>
                <tr>
                    <th scope="" style="background-color:lightskyblue;">Inicio:</th>
                    <td><?php echo $detalles['horaInicio']; ?></td>
                    <th scope="" style="background-color:lightskyblue;">Fin:</th>
                    <td><?php echo $detalles['horaFin']; ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-9">
            <table class="table table-bordered border-info" style="font-size: 12px;" aria-describedby="">
                <tr>
                    <th scope="" colspan="8" class="text-center">PROYECCION DE INSUMOS</th>
                </tr>
                <tr>
                    <th scope="" style="background-color:lightskyblue;">Nuevos</th>
                    <td><?php echo $detalles['pNuevo']; ?></td>
                    <th scope="" style="background-color:lightskyblue;">Recurrente</th>
                    <td><?php echo $detalles['pRecurrente']; ?></td>
                    <th scope="" style="background-color:lightskyblue;">Total</th>
                    <td><?php echo round($detalles['total'], 4); ?></td>
                    <th scope="" style="background-color:lightskyblue;">Condon natural</th>
                    <td><?php echo $detalles['cnatural']; ?></td>
                </tr>
                <tr>
                    <th scope="" style="background-color:lightskyblue;">Condon de sabor</th>
                    <td><?php echo $detalles['csabor']; ?></td>
                    <th scope="" style="background-color:lightskyblue;">Condon femenino</th>
                    <td><?php echo $detalles['cfemenino']; ?></td>
                    <th scope="" style="background-color:lightskyblue;">Lubricante</th>
                    <td><?php echo $detalles['lubricante']; ?></td>
                    <th class="tprueba" scope="" style="background-color:lightskyblue;">Prueba VIH</th>
                    <td><?php echo $detalles['pruebaVIH']; ?></td>
                </tr>
                <tr>
                    <th scope="" style="background-color:lightskyblue;">Auto-prueba VIH</th>
                    <td><?php echo $detalles['autoprueba']; ?></td>
                    <th class="treactivo" scope="" style="background-color:lightskyblue;">Reactivo experado</th>
                    <td><?php echo $detalles['reactivo']; ?></td>
                    <th class="tsifilis" scope="" style="background-color:lightskyblue;">Sifilis</th>
                    <td><?php echo $detalles['sifilis']; ?></td>
                    <th scope="" style="background-color:lightskyblue;">Codigo promotor</th>
                    <td><?php echo $detalles['codigo']; ?></td>

                </tr>
                <tr>
                    <th scope="" style="background-color:lightskyblue;">Promotor</th>
                    <td colspan="2"><?php echo $detalles['nombres']; ?></td>
                    <th scope="" style="background-color:lightskyblue;">Observaciones</th>
                    <td colspan="4"><?php echo $detalles['observacion']; ?></td>
                </tr>
            </table>
        </div>
    <?php } ?>
</div>