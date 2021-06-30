<?php
include_once('../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
$ID = $_SESSION['idUsuario'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: smaller;
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="main">
            <header class="mb-1">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3><i class="bi bi-person-plus"></i> USUARIOS</h3>
                            <p class="text-subtitle text-muted">Usuarios del sistema</p>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="row" id="table-striped">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#nuevoUsuario">Nuevo</button>
                                </div>
                                <div class="card-content">
                                    <!-- table striped -->
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="text-center">
                                                <th>#</th>
                                                <th>Nombre completo</th>
                                                <th>Usuario</th>
                                                <th>Rol</th>
                                                <th>Subreceptor</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </thead>
                                            <tbody class="text-center">
                                                <?php
                                                $cont = 0;
                                                $sql1 = "SELECT * FROM usuario u LEFT JOIN persona p ON p.idPersona=u.Persona_id";
                                                $resultado1 = mysqli_query($enlace, $sql1);
                                                while ($fila = mysqli_fetch_assoc($resultado1)) {
                                                    $cont ++;
                                                    echo '<tr>
                                                    <td>'.$cont.'</td>
                                                    <td>'.$fila['nombre'].' '.$fila['apellido'].'</td>
                                                    <td>'.$fila['usuario'].'</td>
                                                    <td>'.$fila['rol'].'</td>
                                                    <td>'.$fila['subreceptor_id'].'</td>';
                                                    if($fila['estado'] == 1){
                                                        echo  '<td class="text-success"><i class="bi bi-check-circle-fill"></i> Activo</td>';
                                                    } else {
                                                        echo '<td class="text-danger"><i class="bi bi-x-circle-fill"></i> Inactivo</td>';
                                                    }
                                                    echo ' <td> 
                                                    <a href="" class="btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a> 
                                                    <a href="" class="btn-danger btn-sm"><i class="bi bi-save-fill"></i></a>
                                                    </td>';
                                                    echo '</tr>';
                                                }
                                                ?>
                                            </tbody> 
                                        </table>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!------ JS ------>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/vendors/chartjs/Chart.min.js"></script>
    <script src="../assets/js/pages/ui-chartjs.js"></script>
    <?php
    include 'componente/menu.php';
    include 'modal/nuevoUsuario.php';
    ?>
</body>

</html>