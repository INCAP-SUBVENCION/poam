<?php
include_once('../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: ../../error.php');
} else if ($_SESSION['rol'] != 'R007') {
    header('Location: ../../error.php');
}
$ID = $_SESSION['idUsuario'];
$ROL = $_SESSION['rol'];
$SUBRECEPTOR = $_SESSION['subreceptor_id'];

$cd = "SELECT CONCAT(t2.nombre,' - ', t1.lugar) as titulo, CONCAT(t1.fecha,' ', t1.horaInicio) as inicia FROM pom t1
LEFT JOIN catalogo t2 ON t2.codigo = t1.municipio
LEFT JOIN promotor t3 ON t3.idPromotor = t1.promotor_id
LEFT JOIN persona t4 ON t4.idPersona = t3.persona_id
WHERE t1.periodo = 3 AND t1.subreceptor_id = $SUBRECEPTOR AND t3.persona_id = $ID";
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
                    <strong class="bi bi-justify fs-3"></strong>
                </a>
            </header>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 order-md-1 order-last">
                            <h3>Sistema de Planificación Operativa Anual y Mensual</h3>
                            <p class="text-subtitle text-muted">Mis actividades</p>
                        </div>
                    </div>
                </div>
                <section class="section">
                <div id='calendar'></div>
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