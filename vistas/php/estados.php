<?php
include_once('../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set("America/Guatemala");
session_start();
if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
}
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
}

/**
 * Metodo que permite consultar los datos del POA para cambiar el estado
 */
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
/**
 * Metodo que permite cambiar el estado del POA
 */
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

/**
 * Metodo que permite consultar los datos del POM para cambiar el estado
 */
if ($accion == "consultaPoM") {

    $pom_id = $_POST['id'];
    $sql = "SELECT DISTINCT t2.nombre AS mes, t3.nombre AS municipio, t1.lugar, t1.fecha, t1.horaInicio, t1.horaFin, t1.pNuevo, t1.pRecurrente, truncate(sum(t1.pNuevo + t1.pRecurrente), 2)  as total 
    FROM pom t1 LEFT JOIN catalogo t2 ON t2.codigo = t1.mes LEFT JOIN catalogo t3 ON t3.codigo =  t1.municipio WHERE t1.idPom = $pom_id";

    $consulta = $enlace->query($sql);
    $response = array();
    while ($poa = $consulta->fetch_assoc()) {
        $response = $poa;
    }
    echo json_encode($response);
}

/**
 * Metodo que permite cambiar el estado de POM
 */
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
