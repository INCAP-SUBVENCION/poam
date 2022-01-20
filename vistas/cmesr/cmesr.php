<?php
include_once('../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: salir.php');
} 
$ID = $_SESSION['idUsuario'];
$ROL = $_SESSION['rol'];
$SUBRECEPTOR = $_SESSION['subreceptor_id'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

    <title>Principal</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../../assets/vendors/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
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
                    <em class="bi bi-justify fs-3"></em>
                </a>
            </header>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>BIENVENIDO AL SISTEMA POA & POM</h3>
                            <p class="text-subtitle text-muted">Pagina principal</p>
                        </div>

                    </div>
                </div>
                <section class="section">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="../../assets/images/plan.png" width="125" alt="">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h6 class="card-title">Plan Operativo Mensual</h6>
                                        <div class="d-grid gap-2">
                                            <a href="pom/pom.php" class="btn btn-sm btn-warning btn-lg"> POM</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="../../assets/images/plann.png" width="125" alt="">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h6 class="card-title">Plan Operativo Anual</h6>
                                        <div class="d-grid gap-2">
                                            <a href="poa/poa.php" class="btn btn-sm btn-primary btn-lg"> POA</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="../../assets/images/meta.png" width="150" alt="">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h6 class="card-title">Metas</h6>
                                        <div class="d-grid gap-2">
                                            <a href="poa/meta.php" class="btn btn-sm btn-info btn-lg"> METAS</a>
                                        </div>
                                    </div>
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
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
    <?php
    include 'menu.php';
    ?>

</body>

</html>