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
    $sql = "SELECT DISTINCT t2.nombre AS mes, t3.nombre AS municipio, t1.lugar, t1.fecha, t1.horaInicio, t1.horaFin, t1.pNuevo, t1.pRecurrente, 
    truncate(sum(t1.pNuevo + t1.pRecurrente), 2)  as total, t1.supervisor
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


if ($accion == "estadoPom") {
    
    $id = $_POST['id'];

    $sql = "SELECT DISTINCT t1.estado, t4.nombre as estados, t1.fecha, t3.nombre, t3.apellido, t5.nombre as roles, t1.descripcion FROM estado t1
    LEFT JOIN usuario t2 ON t2.idUsuario = t1.usuario_id
    LEFT JOIN persona t3 ON t3.idPersona = t2.persona_id
    LEFT JOIN catalogo t4 ON t4.codigo = t1.estado
    LEFT JOIN catalogo t5 ON t5.codigo = t2.rol
    WHERE t1.pom_id = $id ORDER BY t1.fecha DESC";

    $consulta = $enlace->query($sql);
  
    while ($pom = $consulta->fetch_assoc()) {
        $estado  = $pom['estado'];
        $estados = $pom['estados'];
        $fecha   = $pom['fecha'];
        $nombre  = $pom['nombre'];
        $apellido= $pom['apellido'];
        $descripcion = $pom['descripcion'];
        $response[] = array(
            "estado" => $estado,
            "estados" => $estados,
            "fecha" => $fecha,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "descripcion" => $descripcion
        );
    }
    echo json_encode($response);
}

if ($accion == "cambiarTodoEstadoPom") {
    $subreceptor = $_POST['subreceptor'];
    $periodo = $_POST['periodo'];
    $estadoA = $_POST['estadoA'];
    $usuario = $_POST['usuario'];
    $estadoN = $_POST['estadoN'];
    $descripcion = $_POST['descripcion'];

    if ($enlace->query("CALL cambiarTodoPom($subreceptor, $periodo, '$estadoA', $usuario, '$estadoN', '$descripcion')") === TRUE) {
        echo "Exito";
    } else {
        echo "Error";
    }
}

if ($accion == "cambiarTodoEstadoPoa") {
    $subreceptor = $_POST['subreceptor'];
    $periodo = $_POST['periodo'];
    $estadoA = $_POST['estadoA'];
    $usuario = $_POST['usuario'];
    $estadoN = $_POST['estadoN'];
    $descripcion = $_POST['descripcion'];

    if ($enlace->query("CALL cambiarTodoPoa($subreceptor, $periodo, '$estadoA', $usuario, '$estadoN', '$descripcion')") === TRUE) {
        echo "Exito";
    } else {
        echo "Error";
    }
}

if ($accion == "estadoPoa") {
    
    $id = $_POST['id'];

    $sql = "SELECT DISTINCT t1.estado, t4.nombre as estados, t1.fecha, t3.nombre, t3.apellido, t5.nombre as roles, t1.descripcion FROM estado t1
    LEFT JOIN usuario t2 ON t2.idUsuario = t1.usuario_id
    LEFT JOIN persona t3 ON t3.idPersona = t2.persona_id
    LEFT JOIN catalogo t4 ON t4.codigo = t1.estado
    LEFT JOIN catalogo t5 ON t5.codigo = t2.rol
    WHERE t1.poa_id = $id ORDER BY t1.fecha DESC";

    $consulta = $enlace->query($sql);
  
    while ($poa = $consulta->fetch_assoc()) {
        $estado  = $poa['estado'];
        $estados = $poa['estados'];
        $fecha   = $poa['fecha'];
        $nombre  = $poa['nombre'];
        $apellido= $poa['apellido'];
        $descripcion = $poa['descripcion'];
        $response[] = array(
            "estado" => $estado,
            "estados" => $estados,
            "fecha" => $fecha,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "descripcion" => $descripcion
        );
    }
    echo json_encode($response);
}
