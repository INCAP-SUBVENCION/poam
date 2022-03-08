<?php
include_once('../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: salir.php');
} else if (($_SESSION['rol'] != 'R003')) {
    header('Location: ../../error.php');
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
                        <div class="col-12 order-last">
                            <h3>Sistema de Planificación Operativo Anual y Mensual</h3>
                            <p class="text-subtitle text-muted">Pagina principal</p>
                        </div>

                    </div>
                </div>
                <section class="section">
                    <div class="row">
                        <?php
                        $sql = "SELECT idSubreceptor, codigo, nombre FROM subreceptor WHERE idSubreceptor NOT IN(SELECT idSubreceptor FROM subreceptor WHERE idSubreceptor=1)";
                        $resultado = mysqli_query($enlace, $sql);
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                        ?>
                            <div class="col-md-4">
                                <div class="card text-dark bg-info mb-4" style="max-width: 20rem;">
                                    <div class="text-center">
                                        <img src="../../assets/images/vihinvertido.png" width="60" alt="...">
                                    </div>
                                    <h5 class="card-title text-center text-white"><?php echo $fila['codigo']; ?></h5>
                                    <div class="card-body">
                                        <h6 class="text-center"> <?php echo $fila['nombre']; ?> </h6>
                                        <ul class="list-group list-group-flush">
                                            <a class="list-group-item" href="pom/pom.php?id=<?php echo $fila['idSubreceptor'] ?>"><i class="bi bi-calendar3-range"></i> Plan Operativo Mensual</a>
                                            <a class="list-group-item" href="poa/poa.php?id=<?php echo $fila['idSubreceptor'] ?>"><i class="bi bi-calendar3-range-fill"></i> Plan Operativo Anual</a>
                                            <a class="list-group-item" href="poa/meta.php?id=<?php echo $fila['idSubreceptor'] ?>"><i class="bi bi-bullseye"></i> METAS</a>
                                        </ul>
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
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/main.js"></script>

    <?php
    include 'menu.php';
    ?>

</body>

</html>