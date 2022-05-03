<?php
include_once('../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: salir.php');
} else if (($_SESSION['rol'] != 'R001')) {
    header('Location: ../../error.php');
}
$ID = $_SESSION['idUsuario'];
$ROL = $_SESSION['rol'];
$SUBRECEPTOR = $_SESSION['subreceptor_id'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../../assets/vendors/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
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
                            <h3><i class="bi bi-person-plus"></i> CONFIGURACION</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="configuracion.php">Configuracion</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="row">
                        <div class="col-md-3">
                        <div class="card text-white bg-secondary mb-3">
                            <div class="card-header bg-secondary text-center"><h1><i class="bi bi-people-fill"></i></h1></div>
                            <div class="card-body">
                                <h5 class="card-title text-center text"> <a href="promotor.php" class="text-white">Promotores</a> </h5>
                                
                            </div>
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-header bg-danger text-center"><h1><i class="bi bi-person-bounding-box"></i></h1></div>
                            <div class="card-body">
                                <h5 class="card-title text-center text"> <a href="usuario.php" class="text-white">Usuarios</a> </h5>
                                
                            </div>
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-header bg-warning text-center"><h1><i class="bi bi-arrows-fullscreen"></i></h1></div>
                            <div class="card-body">
                                <h5 class="card-title text-center text"> <a href="cobertura.php" class="text-white">Cobertura</a> </h5>
                                
                            </div>
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-header bg-info text-center"><h1><i class="bi bi-diagram-2"></i></h1></div>
                            <div class="card-body">
                                <h5 class="card-title text-center text"> <a href="subreceptor.php" class="text-white">Subreceptores</a> </h5>
                                
                            </div>
                        </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>

    <!------ JS ------>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
    <?php
    include 'menu.php';
    ?>
</body>

</html>