<?php
include_once('../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: ../error.php');
}
$ID = $_SESSION['idUsuario'];
$ROL = $_SESSION['rol'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title></title>
</head>

<body>

    <?php 
    if ($ROL == "R001") {
        header('Location: configuracion/configuracion.php');
    } else if ($ROL == "R002") {
        header('Location: rp/rp.php');
    } else if ($ROL == "R003" || $ROL == "R004") {
        header('Location: enlacerp/enlacerp.php');
    } else if ($ROL == "R005") {
        header('Location: cmesr/cmesr.php');
    } else if ($ROL == "R006") {
        header('Location: supervisor/supervisor.php');
    } else if ($ROL == "R007") {
        header('Location: promotor/promotor.php');
    } else if ($ROL == "R008") {
        header('Location: finaciero/financiero.php');
    }
    ?>

</body>

</html>