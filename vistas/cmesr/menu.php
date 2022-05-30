<div id="sidebar" class="active">
    <div class="sidebar-wrapper">
        <div class="sidebar-header">
            <div class="text-center">

                <img src="../../assets/images/vihinvertido.png" alt="">
                <?php
                $consultaUsuario = "SELECT p.nombre, p.apellido,r.nombre as roles FROM usuario u 
                        LEFT JOIN persona p ON p.idPersona = u.Persona_id 
                        LEFT JOIN catalogo r ON r.codigo = u.rol
                        WHERE u.idUsuario = $ID";
                $resultadousuario = $enlace->query($consultaUsuario);
                while ($usuario = $resultadousuario->fetch_assoc()) {
                ?>

                    <p class="text-warning"><?php echo $usuario['roles']; ?></p>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secundary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="color:white; font-size: 13px;;">
                            <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?>
                        </button>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item text-info" href="perfil.php"><em class="bi bi-file-earmark-person"></em> Perfil</a></li>
                            <li><a class="dropdown-item text-danger" href="salir.php"><em class="bi bi-x-circle-fill"></em> Cerrar sesion</a></li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item  ">
                    <a href="cmesr.php" class='sidebar-link'>
                        <i class="bi bi-house-door-fill"></i><span>Inicio</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="dash.php" class='sidebar-link'>
                        <i class="bi bi-speedometer"></i><span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    
                    <?php if ($SUBRECEPTOR == 4) { ?>
                        <a href="supervision/supervisionPll.php" class='sidebar-link'>
                    <?php } else { ?>
                        <a href="supervision/supervision.php" class='sidebar-link'>
                    <?php } ?>
                        <i class="bi bi-card-heading"></i><span>Supervisiones</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="pom/pom.php" class='sidebar-link'>
                        <i class="bi bi-calendar3-range"></i><span>POM</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="poa/poa.php" class='sidebar-link'>
                        <i class="bi bi-calendar4"></i><span>POA</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a  href="poa/meta.php" class='sidebar-link'>
                        <i class="bi bi-bullseye"></i><span>Metas</span>
                    </a>
                </li>
            </ul>
            <footer>
                <img src="../../assets/images/logo.png" width="200" alt="">
                <div class="footer clearfix text-muted">
                    <div class="float-start">
                        <p>Subvencion 2021 &copy; incap.int</p>
                    </div>
                </div>


            </footer>
        </div>
    </div>
</div>