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
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-III-tab" data-bs-toggle="tab" data-bs-target="#nav-III" type="button" role="tab" aria-controls="nav-III" aria-selected="true">III</button>
                        <button class="nav-link" id="nav-IV-tab" data-bs-toggle="tab" data-bs-target="#nav-IV" type="button" role="tab" aria-controls="nav-IV" aria-selected="false">IV</button>
                        <button class="nav-link" id="nav-V-tab" data-bs-toggle="tab" data-bs-target="#nav-V" type="button" role="tab" aria-controls="nav-V" aria-selected="false">V</button>
                        <button class="nav-link" id="nav-VI-tab" data-bs-toggle="tab" data-bs-target="#nav-VI" type="button" role="tab" aria-controls="nav-VI" aria-selected="false">VI</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-III" role="tabpanel" aria-labelledby="nav-III-tab" tabindex="0">
                        <?php include 'dash/periodo_3.php'; ?>
                    </div>
                    <div class="tab-pane fade" id="nav-IV" role="tabpanel" aria-labelledby="nav-IV-tab" tabindex="0">4...</div>
                    <div class="tab-pane fade" id="nav-V" role="tabpanel" aria-labelledby="nav-V-tab" tabindex="0">5...</div>
                    <div class="tab-pane fade" id="nav-VI" role="tabpanel" aria-labelledby="nav-VI-tab" tabindex="0">6...</div>
                </div>


        </div>
    </div>
    </section>
    </div>

    </div>
    <!------ JS ------>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
    <script src="../../assets/js/calendario.js"></script>
    <script src="../../assets/js/locales-all.js"></script>
    <script src="../../assets/js/plotly-2.12.1.min.js"></script>
    <script src="../js/utilidad.js"></script>


    <?php include 'menu.php'; ?>

</body>

</html>