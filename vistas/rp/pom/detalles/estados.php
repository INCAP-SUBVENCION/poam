<div class="card text-dark mb-3" style="max-width: 65rem;">
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="text-center text-white" style="background-color:darkslategrey;">
                <tr>
                    <th rowspan="3">ESTADO</th>
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
                $sqlEstado = "SELECT DISTINCT t1.estado, t4.nombre as estados, t1.fecha, t3.nombre, t3.apellido, t5.nombre as roles, t1.descripcion FROM estado t1
                LEFT JOIN usuario t2 ON t2.idUsuario = t1.usuario_id
                LEFT JOIN persona t3 ON t3.idPersona = t2.persona_id
                LEFT JOIN catalogo t4 ON t4.codigo = t1.estado
                LEFT JOIN catalogo t5 ON t5.codigo = t2.rol
                WHERE t1.pom_id = $POM AND t2.subreceptor_id = $SUBRECEPTOR";
                $resultadoEstado = $enlace->query($sqlEstado);
                while ($estado = $resultadoEstado->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $estado['estados']; ?></td>

                        <td><?php echo $estado['nombre'] . ' ' . $estado['apellido']; ?></tdss>
                        <td><?php echo $estado['roles']; ?></td>
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
