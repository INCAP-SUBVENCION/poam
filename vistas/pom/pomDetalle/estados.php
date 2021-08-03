<div class="card text-dark mb-3" style="max-width: 50rem;">
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                    <th rowspan="3">ESTADOS</th>
                </tr>
                <tr>
                    <th colspan="4">RESPONSABLE</th>
                </tr>
                <tr>
                    <th>Nombre y apellido</th>
                    <th>Rol</th>
                    <th>Observaciones</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlEstado = "SELECT t2.nombre as estado, t1.fecha, t4.nombre, t4.apellido, t4.nombre, t5.nombre as rol, t1.descripcion FROM estado t1
                            LEFT JOIN catalogo t2 ON t2.codigo = t1.estado
                            LEFT JOIN usuario t3 ON t3.idUsuario = t1.usuario_id
                            LEFT JOIN persona t4 ON t4.idPersona = t3.persona_id
                            LEFT JOIN catalogo t5 ON t5.codigo = t3.rol
                            WHERE t1.pom_id = $POM";
                $resultadoEstado = $enlace->query($sqlEstado);
                while ($estado = $resultadoEstado->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $estado['estado']; ?></td>

                        <td><?php echo $estado['nombre'] . ' ' . $estado['apellido']; ?></tdss>
                        <td><?php echo $estado['rol']; ?></td>
                        <td><?php echo $estado['descripcion']; ?></td>
                        <td><?php echo $estado['fecha']; ?></td>
                    </tr>
                <?php
                }
                $resultadoEstado->close();
                ?>
            </tbody>
        </table>
    </div>
</div>