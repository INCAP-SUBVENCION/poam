<div id="sidebar" class="active">
    <div class="sidebar-wrapper">
        <div class="sidebar-header">
            <div class="text-center">

                <img src="../assets/images/vih.png" alt="">
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secundary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 11px;">
                        <?php
                        $sql1 = "SELECT p.nombre, p.apellido FROM usuario u LEFT JOIN persona p ON p.idPersona=u.Persona_id WHERE u.idUsuario = $ID";
                        $resultado1 = mysqli_query($enlace, $sql1);
                        while ($fila = mysqli_fetch_assoc($resultado1)) {
                            echo '<i class="bi bi-person-fill"></i> ' . $fila['nombre'] . ' ' . $fila['apellido'] . ' ';
                        }
                        ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="font-size: 13px;">
                        <li><a class="dropdown-item text-info" href="#"><i class="bi bi-file-earmark-person"></i> Perfil</a></li>
                        <li><a class="dropdown-item text-warning" href="#"><i class="bi bi-check2-square"></i> Permisos</a></li>
                        <li><a class="dropdown-item text-danger" href="salir.php"><i class="bi bi-x-circle-fill"></i> Cerrar sesion</a></li>
                    </ul>
                </div>
                <h4>POA & POM</h4>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item  ">
                    <a href="principal.php" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i><span>Principal</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="poa.php" class='sidebar-link'>
                        <i class="bi bi-calendar2-range-fill"></i><span>POA</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="pom.php" class='sidebar-link'>
                        <i class="bi bi-calendar2-range"></i><span>POM</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="subreceptor.php" class='sidebar-link'>
                        <i class="bi bi-diagram-2"></i><span>Subreceptor</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="usuario.php" class='sidebar-link'>
                    <i class="bi bi-person-plus-fill"></i><span>Usuarios</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="promotor.php" class='sidebar-link'>
                    <i class="bi bi-people-fill"></i><span>Promotores</span>
                    </a>
                </li>

            </ul>
            <footer>
                <div class="footer clearfix text-muted">
                    <div class="float-start">
                        <p>Subvencion 2021 &copy; incap.int</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>