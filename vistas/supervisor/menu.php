<div id="sidebar" class="active">
    <div class="sidebar-wrapper">
        <div class="sidebar-header">
            <div class="text-center">

                <img src="../assets/images/vihinvertido.png" alt="">
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secundary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="color:white; font-size: 13px;;">
                        <?php
                        $consultaUsuario = "SELECT p.nombre, p.apellido,r.nombre as roles FROM usuario u 
                        LEFT JOIN persona p ON p.idPersona = u.Persona_id 
                        LEFT JOIN catalogo r ON r.codigo = u.rol
                        WHERE u.idUsuario = $ID";
                        $resultadousuario = $enlace->query($consultaUsuario);
                        while ($usuario = $resultadousuario->fetch_assoc()) {
                            echo $usuario['nombre'] . ' ' . $usuario['apellido'];
                        ?>
                    </button>
                    <p class="text-white"><?php echo $usuario['roles'] ?></p>
                <?php
                        }
                ?>
                <ul class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item text-info" href="#"><i class="bi bi-file-earmark-person"></i> Perfil</a></li>
                    <li><a class="dropdown-item text-warning" href="#"><i class="bi bi-check2-square"></i> Permisos</a></li>
                    <li><a class="dropdown-item text-danger" href="salir.php"><i class="bi bi-x-circle-fill"></i> Cerrar sesion</a></li>
                </ul> 
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item  ">
                    <a href="principal.php" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i><span>Principal</span>
                    </a>
                </li>
                <li class="sidebar-item" data-bs-toggle="dropdown">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i> <span> Configuracion</span>
                    </a>
                </li>
                <ul class="dropdown-menu">
                    <li class="sidebar-item  ">
                        <a href="../vistas/configuracion/promotor.php" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i><span>Promotores</span>
                        </a>
                    </li>
                    <li class="sidebar-item  ">
                        <a href="../vistas/configuracion/usuario.php" class='sidebar-link'>
                            <i class="bi bi-person-plus-fill"></i><span>Usuarios</span>
                        </a>
                    </li>
                    <li class="sidebar-item  ">
                        <a href="../vistas/configuracion/cobertura.php" class='sidebar-link'>
                            <i class="bi bi-arrows-fullscreen"></i><span>Cobertura</span>
                        </a>
                    </li>
                    <li class="sidebar-item  ">
                        <a href="../vistas/configuracion/subreceptor.php" class='sidebar-link'>
                            <i class="bi bi-diagram-2"></i><span>Subreceptor</span>
                        </a>
                    </li>
                </ul>

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