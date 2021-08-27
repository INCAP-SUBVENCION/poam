<?php
header("Content-Type: text/html;charset=utf-8");
include_once('../../bd/conexion.php');
if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
}
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
}

if ($accion == "consultaPoa") {

    $poa_id = $_POST['id'];
    $sql = "SELECT t2.nombre AS mes, t3.nombre AS municipio, t1.nuevo, t1.recurrente, sum(t1.nuevo+t1.recurrente) AS total FROM poa t1
    LEFT JOIN catalogo t2 ON t2.codigo = t1.mes LEFT JOIN catalogo t3 ON t3.codigo = t1.municipio WHERE t1.idPoa = $poa_id";

    $consulta = $enlace->query($sql);
    $response = array();
    while ($poa = $consulta->fetch_assoc()) {
        $response = $poa;
    }
    echo json_encode($response);
}

if ($accion == "cambiarEstadoPoa") {

    $usuario = $_POST['usuario'];
    $poa = $_POST['poa'];
    $estado = $_POST['estado'];
    $descripcion = $_POST['descripcion'];

    if ($enlace->query("CALL cambiarEstadoPoa($usuario, $poa, '$estado', '$descripcion')") === TRUE) {
        echo "Exito";
    } else {
        echo "Error";
    }
}


if ($accion == "consultaPoM") {

    $pom_id = $_POST['id'];
    $sql = "SELECT DISTINCT t2.nombre AS mes, t3.nombre AS municipio, t1.lugar, t1.fecha, t1.horaInicio, t1.horaFin  FROM pom t1 
    LEFT JOIN catalogo t2 ON t2.codigo = t1.mes LEFT JOIN catalogo t3 ON t3.codigo =  t1.municipio WHERE t1.idPom = $pom_id";

    $consulta = $enlace->query($sql);
    $response = array();
    while ($poa = $consulta->fetch_assoc()) {
        $response = $poa;
    }
    echo json_encode($response);
}


if ($accion == "cambiarEstadoPom") {

    $usuario = $_POST['usuario'];
    $poa = $_POST['poa'];
    $estado = $_POST['estado'];
    $descripcion = $_POST['descripcion'];

    if ($enlace->query("CALL cambiarEstadoPom($usuario, $poa, '$estado', '$descripcion')") === TRUE) {
        echo "Exito";
    } else {
        echo "Error";
    }
}
