<?php
date_default_timezone_set("America/Guatemala");
include_once('../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");

session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: salir.php');
} else if (($_SESSION['rol'] != 'R006')) {
    header('Location: ../../error.php');
}

$ID = $_SESSION['idUsuario'];
$ROL = $_SESSION['rol'];
$SUBRECEPTOR = $_SESSION['subreceptor_id'];

$cd = "SELECT CONCAT(t3.nombre,' - ',t2.lugar) AS titulo, 
CONCAT(t2.fecha,' ',t1.hora) AS inicia FROM supervision t1 
LEFT JOIN pom t2 ON t2.idPom=t1.pom_id 
LEFT JOIN catalogo t3 ON t3.codigo = t2.municipio
WHERE usuario_id = $ID";
$rd = $enlace->query($cd);
$tt = 1;
while ($pom = $rd->fetch_assoc()) {
    if ($tt <= 1) {
        $calendario = "{title: '" . $pom['titulo'] . "', start: '" . $pom['inicia'] . "'},";
        $tt = $tt + 1;
    } else {
        $calendario = $calendario . "{title: '" . $pom['titulo'] . "', start: '" . $pom['inicia'] . "'},";
    }
}
$rd->close();
?>
<script>

</script>
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
    <script src="../../assets/js/calendario.js"></script>
    <script src="../../assets/js/locales-all.js"></script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: smaller;
        }
    </style>
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
                dayMaxEvents: true, // allow "more" link when too many events
                events: [<?php echo $calendario ?>]

            });

            calendar.render();
            calendar.setOption('locale', 'es');

        });
    </script>
</head>

<body>
    <div id="app">
        <div id="main">
            <header class="mb-1">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <em class="bi bi-justify fs-3"></em>
                </a>
            </header>
            <div class="page-title">
                <h3>[ Sistema de Planificación Operativa Anual y Mensual ]</h3>
                <p class="text-subtitle text-muted"><i class="bi bi-binoculars"></i> Supervisiones</p>
            </div>
            <section class="section">
                <a href="supervisiones/supervision.php" class="btn btn-sm btn-success btn-sm"> <i class="bi bi-card-checklist"></i> Detalles </a>
                <div id='calendar'></div>
            </section>
        </div>
    </div>

    </div>
    <!------ JS ------>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
    <?php
    include 'menu.php';
    ?>

</body>

</html>