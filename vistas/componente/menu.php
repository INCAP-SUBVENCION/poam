<div id="sidebar" class="active">
    <div class="sidebar-wrapper">
        <div class="sidebar-header">
            <div class="text-center">

                <img src="../assets/images/vih.png" alt="">
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                        <?php
                        $sql1 = "SELECT p.nombre, p.apellido FROM usuario u LEFT JOIN persona p ON p.idPersona=u.Persona_id WHERE u.idUsuario = $ID";
                        $resultado1 = mysqli_query($enlace, $sql1);
                        while ($fila = mysqli_fetch_assoc($resultado1)) {
                            echo '<i class="bi bi-person-fill"></i> ' . $fila['nombre'] . ' ' . $fila['apellido'] . ' ';
                        }
                        ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-person"></i> Perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-check2-square"></i> Permisos</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-x-circle-fill"></i> Salir</a></li>
                    </ul>
                </div>
                <h3>POA & POM</h3>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item  ">
                    <a href="principal.php" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Principal</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="poa.php" class='sidebar-link'>
                        <i class="bi bi-calendar2-range-fill"></i>
                        <span>POA</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="pom.php" class='sidebar-link'>
                        <i class="bi bi-calendar2-range"></i>
                        <span>POM</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="subreceptor.php" class='sidebar-link'>
                        <i class="bi bi-diagram-2"></i>
                        <span>Subreceptor</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="usuario.php" class='sidebar-link'>
                    <i class="bi bi-person-plus-fill"></i>
                        <span>Usuarios</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="promotor.php" class='sidebar-link'>
                    <i class="bi bi-people-fill"></i>
                        <span>Promotores</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>