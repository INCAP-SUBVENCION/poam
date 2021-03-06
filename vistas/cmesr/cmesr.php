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
    <link rel="stylesheet" href="../../assets/css/calendario.css">
    <script src="../../assets/vendors/jquery/jquery.min.js"></script>
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
            <?php
            $sql = "SELECT idSubreceptor, codigo, nombre FROM subreceptor WHERE idSubreceptor = $SUBRECEPTOR";
            $resultado = mysqli_query($enlace, $sql);
            while ($subr = mysqli_fetch_assoc($resultado)) { ?>
                <div class="text-center">
                    <h3><?php echo $subr['nombre']; ?></h3>
                </div>
            <?php } ?>
            <section class="section">

            </section>

        </div>

    </div>
    <!------ JS ------>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
    <script src="../../assets/vendors/datatable/jquery.dataTables.min.js"></script>
    <script src="../../assets/js/select2.full.min.js"></script>
    <script src="../js/pom.js"></script>
    <script src="../js/utilidad.js"></script>
    <script src="../js/estados.js"></script>
    <script src="../js/tabla.js"></script>

    <?php include 'menu.php'; ?>

</body>

</html>