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
    truncate(sum(t1.pNuevo + t1.pRecurrente), 2)  as total, t1.supervisado, t1.supervisor
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
/**
 * Metodo que permite cambiar el estado de la actividad
 */
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
        $apellido = $pom['apellido'];
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
/**
 * Metodo que permite cabiar el estado de las actividades del POM
 */
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
/**
 * Metodo que permite cambiar todo los estados del POA
 */
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
/**
 * Metodo que permite cambiar el estado del POA
 */
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
        $apellido = $poa['apellido'];
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
/**
 * Metodo que permite cambiar la fecha de la actividad 
 */
if ($accion == "recalendarizacionPom") {
    $usuario    = $_POST['usuario'];
    $pom        = $_POST['pom'];
    $estado     = $_POST['estado'];
    $afecha     = $_POST['afecha'];
    $alugar     = $_POST['alugar'];
    $ainicia    = $_POST['ainicia'];
    $afinaliza  = $_POST['afinaliza'];
    $asupervisado = $_POST['asupervisado'];
    $asupervisor = $_POST['asupervisor'];
    $nfecha     = $_POST['nfecha'];
    $nlugar     = $_POST['nlugar'];
    $ninicio    = $_POST['ninicio'];
    $nfin       = $_POST['nfin'];
    $nsupervisado = $_POST['nsupervisado'];
    $nsupervisor = $_POST['nsupervisor'];
    $descripcion = $_POST['descripcion'];

    if ($enlace->query("CALL reprogramacion($pom, $usuario, '$afecha', '$ainicia', '$afinaliza', '$alugar', $asupervisado, '$asupervisor', '$nfecha', '$ninicio', '$nfin', '$nlugar', $nsupervisado, '$nsupervisor', '$estado', '$descripcion')") === TRUE) {
        echo "Exito";
    } else {
        echo "Error";
    }
}
/**
 * Metodo que permite consultar los datos de la actividad para recalendarizar
 */
if ($accion == "consultaCambio") {

    $pom_id = $_POST['id'];
    $sql = "SELECT t2.periodo, t3.nombre as mess, t4.nombre as municipios,
    t1.fecha as fechaa, t1.lugar as lugara, t1.inicio as inicioa, t1.fin as fina, t1.supervisado as supervisadoa, t1.supervisor as supervisora,  
    t2.fecha as fechan, t2.lugar as lugarn, t2.horaInicio as inicion, t2.horaFin as finn, t2.supervisado as supervisadon, t2.supervisor as supervisorn  
    FROM historial t1 
    LEFT JOIN pom t2 ON t1.pom_id = t2.idPom 
    LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
    LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
    WHERE t2.idPom = $pom_id";
    $consulta = $enlace->query($sql);
    $response = array();
    while ($poa = $consulta->fetch_assoc()) {
        $response = $poa;
    }
    echo json_encode($response);
}


/**
 * Metodo que permite consultar los datos del POM para aceptar la recalendarizacion
 */
if ($accion == "consultaAceptar") {

    $pom_id = $_POST['id'];
    $sql = "SELECT t5.descripcion, t2.periodo, t3.nombre as mess, t4.nombre as municipios, t2.pNuevo, t2.pRecurrente, (t2.pNuevo + t2.pRecurrente) as total,
    t1.fecha as fechaa, t1.lugar as lugara, t1.inicio as inicioa, t1.fin as fina, t1.supervisado as supervisadoa, t1.supervisor as supervisora,  
    t2.fecha as fechan, t2.lugar as lugarn, t2.horaInicio as inicion, t2.horaFin as finn, t2.supervisado as supervisadon, t2.supervisor as supervisorn  
    FROM historial t1 
    LEFT JOIN pom t2 ON t1.pom_id = t2.idPom 
    LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
    LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
    LEFT JOIN estado t5 ON t5.pom_id= t2.idPom
    WHERE t2.idPom = $pom_id AND t5.estado = 'RE01'";

    $consulta = $enlace->query($sql);
    $response = array();
    while ($poa = $consulta->fetch_assoc()) {
        $response = $poa;
    }
    echo json_encode($response);
}

if ($accion == "rechazarRecalendarizacion") {
    $usuario    = $_POST['usuario'];
    $pom        = $_POST['pom'];
    $estado     = $_POST['estado'];
    $afecha     = $_POST['afecha'];
    $alugar     = $_POST['alugar'];
    $ainicia    = $_POST['ainicia'];
    $afinaliza  = $_POST['afinaliza'];
    $asupervisado = $_POST['asupervisado'];
    $asupervisor = $_POST['asupervisor'];
    $nfecha     = $_POST['nfecha'];
    $nlugar     = $_POST['nlugar'];
    $ninicio    = $_POST['ninicio'];
    $nfin       = $_POST['nfin'];
    $nsupervisado = $_POST['nsupervisado'];
    $nsupervisor = $_POST['nsupervisor'];
    $descripcion = $_POST['descripcion'];

    if ($enlace->query("CALL reprogramacion($pom, $usuario, 
    '$nfecha', '$ninicio', '$nfin', '$nlugar', $nsupervisado, '$nsupervisor', 
    '$afecha', '$ainicia', '$afinaliza', '$alugar', $asupervisado, '$asupervisor', 
    '$estado', '$descripcion')") === TRUE) {
        echo "Exito";
    } else {
        echo "Error";
    }
}


if ($accion == "consultaCancelar") {

    $pom_id = $_POST['id'];
    $sql = "SELECT DISTINCT t2.nombre AS mes, t3.nombre AS municipio, t1.lugar, t1.fecha, t1.horaInicio, 
    t1.horaFin, t1.pNuevo, t1.pRecurrente, truncate(sum(t1.pNuevo + t1.pRecurrente), 2)  as total, 
    t1.supervisado, t1.supervisor, t4.descripcion FROM pom t1 
    LEFT JOIN catalogo t2 ON t2.codigo = t1.mes 
    LEFT JOIN catalogo t3 ON t3.codigo =  t1.municipio 
    LEFT JOIN estado t4 ON t4.estado = t1.estado
    WHERE t1.idPom = $pom_id AND t4.estado='CA01' GROUP BY t4.descripcion";

    $consulta = $enlace->query($sql);
    $response = array();
    while ($poa = $consulta->fetch_assoc()) {
        $response = $poa;
    }
    echo json_encode($response);
}