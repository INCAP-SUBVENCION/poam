<?php
include_once('../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
$ID =$_SESSION['idUsuario'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subreceptor</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../assets/vendors/alertifyjs/css/themes/default.css">
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
                        
                            <h3><i class="bi bi-diagram-2-fill"></i> SUBRECEPTORES</h3>
                            <p class="text-subtitle text-muted">Registro de subreceptores</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-fill"></i> Nombre del usuario
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-person"></i> Perfil</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-check2-square"></i> Permisos</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-x-circle-fill"></i> Salir</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="row" id="table-striped">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#nuevoSub">Nuevo</button>
                                </div>
                                <div class="card-content">
                                    <!-- table striped -->
                                    <div class="table-responsive">
                                        <table class="table table-striped" style="font-size: 12px;">
                                            <thead class="text-center">
                                                <th>#</th>
                                                <th>Codigo</th>
                                                <th>Nombre</th>
                                                <th># Condon natural</th>
                                                <th># Condon sabor</th>
                                                <th># Condon femenino</th>
                                                <th># Lubricante</th>
                                                <th>% Prueba VIH</th>
                                                <th>% Auto-prueba VIH</th>
                                                <th>Opciones</th>
                                            </thead>
                                            <tbody class="text-center">
                                                <?php
                                                $contador = 0;
                                                $sql = "SELECT * FROM subreceptor;";
                                                $resultado = mysqli_query($enlace, $sql);
                                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                                    $contador++;
                                                    echo '
                                                        <tr>
                                                        <td>' . $contador . '</td>
                                                        <td>' . $fila['codigo'] . '</td>
                                                        <td>' . $fila['nombre'] . '</td>
                                                        <td>' . $fila['enatural'] . '</td>
                                                        <td>' . $fila['esabor'] . '</td>
                                                        <td>' . $fila['efemenino'] . '</td>
                                                        <td>' . $fila['elubricante'] . '</td>
                                                        <td>' . $fila['ppvih'] . '</td>
                                                        <td>' . $fila['pautoprueba'] . '</td>
                                                        </tr>';
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
    <script src="../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../assets/vendors/alertifyjs/alertify.js"></script>
    <script src="../controlador/subreceptor.js"></script>
    <!---- ARCHIVOS EXTERNOS--->
    <?php
    include 'componente/menu.php';
    include 'modal/nuevoSubreceptor.php';
    ?>
</body>

</html>