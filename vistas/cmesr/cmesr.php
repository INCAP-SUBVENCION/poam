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
$tt = 1;
$cd = "SELECT CONCAT(t3.nombre,' - ',t2.lugar) AS titulo, 
CONCAT(t2.fecha,' ',t1.hora) AS inicia FROM supervision t1 
LEFT JOIN pom t2 ON t2.idPom=t1.pom_id 
LEFT JOIN catalogo t3 ON t3.codigo = t2.municipio
WHERE usuario_id = $ID";
$rd = $enlace->query($cd);
$pom  = mysqli_affected_rows($enlace);
if ($pom  > 0) {
    while ($pom = $rd->fetch_assoc()) {
        if ($tt <= 1) {
            $calendario = "{title: '" . $pom['titulo'] . "', start: '" . $pom['inicia'] . "'},";
            $tt = $tt + 1;
        } else {
            $calendario = $calendario . "{title: '" . $pom['titulo'] . "', start: '" . $pom['inicia'] . "'},";
        }
    }
}
$rd->close();
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
                        <div class="col-12 order-md-1 order-last">
                            <h3>Sistema de Planificación Operativa Anual y Mensual</h3>
                            <p class="text-subtitle text-muted">Pagina principal</p>
                        </div>
                    </div>
                </div>
            </div>
            <section class="section">
                    <div class="row">
                        <div class="col-md-4">
                            <?php
                            if ($SUBRECEPTOR != 4) {
                            ?>
                                <div class="col-sm-12">
                                    <div class="row g-0">
                                        <div class="col-md-3">
                                            <img src="../../assets/images/agenda.png" width="100" alt="">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <h6 class="card-title">Supervisiones</h6>
                                                <div class="d-grid gap-2">
                                                    <a href="supervision/supervision.php" class="btn btn-sm btn-success btn-lg"> Ver </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else {
                            ?>
                                <div class="col-sm-12">
                                    <div class="row g-0">
                                        <div class="col-md-3">
                                            <img src="../../assets/images/agenda.png" width="100" alt="">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <h6 class="card-title">Supervisiones</h6>
                                                <div class="d-grid gap-2">
                                                    <a href="supervision/supervisionPll.php" class="btn btn-sm btn-success btn-lg"> Ver </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } ?>
                            <br>
                            <div class="col-sm-12">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="../../assets/images/plan.png" width="100" alt="">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h6 class="card-title">Plan Operativo Mensual</h6>
                                            <div class="d-grid gap-2">
                                                <a href="pom/pom.php" class="btn btn-sm btn-info btn-lg"> POM</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-12">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="../../assets/images/plann.png" width="100" alt="">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h6 class="card-title">Plan Operativo Anual</h6>
                                            <div class="d-grid gap-2">
                                                <a href="poa/poa.php" class="btn btn-sm btn-primary btn-lg"> POA</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-12">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="../../assets/images/meta.png" width="100" alt="">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h6 class="card-title">Metas</h6>
                                            <div class="d-grid gap-2">
                                                <a href="poa/meta.php" class="btn btn-sm btn-warning btn-lg"> METAS</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($SUBRECEPTOR != 4) {
                        ?>
                            <div class="col-md-8">
                                <div class="text-center">
                                    <img src="../../assets/images/p.png" width="500" alt="">
                                </div>
                            </div>
                        <?php } else {
                        ?>
                            <div class="col-md-8">
                                <div id='calendar'></div>
                            </div>

                        <?php
                        } ?>
                    </div>
            </div>
            </section>
        </div>

    </div>
    <!------ JS ------>
    <script src="../../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
    <script src="../../assets/js/calendario.js"></script>
    <script src="../../assets/js/locales-all.js"></script>
    <script src="../js/utilidad.js"></script>
    <?php
    include 'menu.php';
    ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'listWeek',
                headerToolbar: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'listWeek, timeGridDay, dayGridMonth, timeGridWeek, listMonth'
                },
                locale: 'es',
                buttonIcons: false, // show the prev/next text
                weekNumbers: true,
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                dayMaxEvents: true,
                events: [<?php echo $calendario; ?>]

            });
            calendar.render();
            calendar.setOption('locale', 'es');
        });
    </script>
</body>

</html>