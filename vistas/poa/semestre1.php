<table class="table table-bordered border-primary">
    <thead class="text-center border-light bg-primary">
        <tr>
            <td colspan="6" class="text-white">DATOS PRINCIPALES </td>
            <td colspan="10" class="text-white">INSUMOS PROYECTADOS POR MES</td>
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
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody class="text-center bg-light" style="font-size: 12px;">
        <?php
        $cont = 1;
        $consult = "SELECT DISTINCT t1.idPoa, t5.nombre as mes, t4.nombre as municipio, t1.nuevo, t1.recurrente, (t1.nuevo + t1.recurrente) AS total, 
    t1.observacion, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH, t2.autoPrueba, t2.reactivoE, t2.sifilis FROM poa t1 
	LEFT JOIN insumo t2 ON t2.poa_id = t1.idPoa
	LEFT JOIN catalogo t3 ON t3.codigo = t1.departamento
	LEFT JOIN catalogo t4 ON t4.codigo = t1.municipio 
	LEFT JOIN catalogo t5 ON t5.codigo = t1.mes
	WHERE t1.subreceptor_id = $SUBRECEPTOR AND t1.anio = YEAR(NOW()) AND t1.periodo = 1 AND estado = 1";
        if ($res = $enlace->query($consult)) {
            while ($semestre = $res->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $cont++; ?></td>
                    <td><?php echo $semestre['mes']; ?></td>
                    <td><?php echo $semestre['municipio']; ?></td>
                    <td><?php echo $semestre['nuevo']; ?></td>
                    <td><?php echo $semestre['recurrente']; ?></td>
                    <th><?php echo round($semestre['total'],2); ?></th>
                    <td><?php echo $semestre['cnatural']; ?></td>
                    <td><?php echo $semestre['csabor']; ?></td>
                    <td><?php echo $semestre['cfemenino']; ?></td>
                    <td><?php echo $semestre['lubricante']; ?></td>
                    <td><?php echo $semestre['pruebaVIH']; ?></td>
                    <td><?php echo $semestre['autoPrueba']; ?></td>
                    <td><?php echo $semestre['reactivoE']; ?></td>
                    <td><?php echo $semestre['sifilis']; ?></td>
                    <td><?php echo $semestre['observacion']; ?></td>
                    <td>
                        <div class="dropdown">
                            <a class="btn-sm btn-outline-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" style="font-size: 12px;">
                                <i class="bi bi-grid"></i> Opcion
                            </a>
                            <ul class="dropdown-menu" style="font-size: 13px;">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-ui-checks-grid"></i> Crear POM</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-square"></i> Editar</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
        <?php }
            $res->close();
        }  ?>
    </tbody>
</table>