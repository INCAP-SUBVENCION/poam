<?php
include_once('../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: ../error.php');
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
    <link rel="stylesheet" href="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
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
                            <h3>BIENVENIDO AL SISTEMA POA & POM</h3>
                            <p class="text-subtitle text-muted">Pagina principal</p>
                        </div>

                    </div>
                </div>
                <section class="section">
                    <div class="row">
                        <?php
                        $sql = "SELECT idSubreceptor, codigo, nombre FROM subreceptor ORDER BY idSubreceptor";
                        $resultado = mysqli_query($enlace, $sql);
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                        ?>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="text-center">
                                        <img src="../../assets/images/p.png" width="200">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><?php echo $fila['nombre']; ?></h5>
                                        <div class="d-grid gap-2">
                                            <a class="btn btn-dark" href="pom/pom.php?id=<?php echo $fila['idSubreceptor'] ?>"> Plan Operativo Mensual</a>
                                            <a class="btn btn-info" href="poa/poa.php?id=<?php echo $fila['idSubreceptor'] ?>"> Plan Operativo Anual</a>
                                            <a class="btn btn-warning" href="poa/meta.php?id=<?php echo $fila['idSubreceptor'] ?>"> METAS</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </section>
            </div>
        </div>

    </div>
    <!------ JS ------>
    <script src="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/vendors/chartjs/Chart.min.js"></script>
    <script src="../../assets/js/pages/ui-chartjs.js"></script>

    <?php
    include 'menu.php';
    ?>

</body>

</html>