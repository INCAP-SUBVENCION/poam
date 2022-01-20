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
 * Metodo que devuelve el POA segun sega el periodo y municipio
 */
if ($accion == "consultaPoa") {

    $subreceptor = $_POST['subreceptor'];
    $periodo    = $_POST['periodo'];
    $municipio  = $_POST['municipio'];
    $mes        = $_POST['mes'];
    $promotor   = $_POST['promotor'];
    $dias       = $_POST['dias'];
    if ($municipio == "") {
        $municipio = 0;
    }
    $contador = 1;

    $sqlPoa = "SELECT DISTINCT t1.idPoa, t5.nombre as mes, t4.codigo, t4.nombre as municipio, t1.nuevo, t1.recurrente,
    (t1.nuevo + t1.recurrente) AS total, t1.observacion, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH,
    t2.autoPrueba, t2.reactivoE, t2.sifilis, t1.subreceptor_id FROM poa t1
    LEFT JOIN insumo t2 ON t2.poa_id = t1.idPoa LEFT JOIN catalogo t3 ON t3.codigo = t1.departamento
	  LEFT JOIN catalogo t4 ON t4.codigo = t1.municipio LEFT JOIN catalogo t5 ON t5.codigo = t1.mes
    WHERE t1.subreceptor_id = $subreceptor AND t1.periodo = $periodo AND t1.municipio = $municipio AND t5.codigo = '$mes'";
    $resultadoPoa = $enlace->query($sqlPoa);
    if (mysqli_num_rows($resultadoPoa) != 0) {
        echo                     "<table class='table table-bordered'>
        <thead class='text-center'>
            <tr style='font-size: 10px;''>
                <th>#</th>
                <th>Mes</th>
                <th>Municipio</th>
                <th>Nuevos</th>
                <th>Recurrentes</th>
                <th>Total</th>
                <th>Condon natural</th>
                <th>Condon sabor</th>
                <th>Condon femenino</th>
                <th>Lubricantes</th>
                <th>Prueba VIH</th>
                <th>Auto prueba VIH</th>
                <th>Reactivos esperados</th>
                <th>Prueba Sifilis</th>
                <th>ACTION</th>
            </tr>
        </thead>";
        while ($poa = $resultadoPoa->fetch_assoc()) {
            echo "
        <tr>
            <td>" . $contador++ . "</td>
            <td>" . $poa['mes'] . "</td>
            <td>" . $poa['municipio'] . "</td>
            <td>" . $poa['nuevo'] . "</td>
            <td>" . $poa['recurrente'] . "</td>
            <td>" . $poa['total'] . "</td>
            <td>" . $poa['cnatural'] . "</td>
            <td>" . $poa['csabor'] . "</td>
            <td>" . $poa['cfemenino'] . "</td>
            <td>" . $poa['lubricante'] . "</td>
            <td>" . $poa['pruebaVIH'] . "</td>
            <td>" . $poa['autoPrueba'] . "</td>
            <td>" . $poa['reactivoE'] . "</td>
            <td>" . $poa['sifilis'] . "</td>
            <td><a href='#' class='btn-sm btn-outline-info' onclick='cargarPoa(" . $poa['idPoa'] . ", $promotor, $dias); llenarReactivo();'>
            <i class='bi bi-file-arrow-down-fill'></i> Cargar datos </a></td>
        </tr>
        ";
        }
    } else {
        echo "Sin datos";
    }
    $resultadoPoa->close();
}
/**
 * Metodo que permite cargar los datos del POA
 */
if ($accion == "cargarPoa") {

    $ID = $_POST['id'];

    $consulPoa =
        "SELECT  t1.idPoa, t1.periodo,t2.codigo as id, t2.nombre as mes,
    t3.codigo as idm, t3.nombre as municipio, t1.nuevo, t1.recurrente FROM poa t1
    LEFT JOIN catalogo t2 ON t2.codigo = t1.mes LEFT JOIN catalogo t3 ON t3.codigo = t1.municipio
        WHERE t1.idPoa = $ID";

    $resPoa = $enlace->query($consulPoa);
    while ($fila = $resPoa->fetch_assoc()) {
        echo $fila['idPoa']   . "," .
            $fila['periodo']  . "," .
            $fila['id']       . "," .
            $fila['mes']      . "," .
            $fila['idm']      . "," .
            $fila['municipio'] . "," .
            $fila['nuevo']    . "," .
            $fila['recurrente'];
    }
    $resPoa->close();
}
/**
 * Metodo que permite cargar los datos del POM
 */
if ($accion == "calcularPom") {

    $subreceptor = $_POST['subreceptor'];
    $total       = $_POST['total'];

    $sqlp1 = "SELECT * FROM subreceptor WHERE idSubreceptor = '$subreceptor'";
    $resultadop1 = $enlace->query($sqlp1);
    while ($calculo = mysqli_fetch_assoc($resultadop1)) {
        echo    $calculo['enatural'] * $total      . "," .
            $calculo['esabor'] * $total        . "," .
            $calculo['efemenino'] * $total     . "," .
            $calculo['elubricante'] * $total   . "," .
            $calculo['ppvih'] * $total         . "," .
            $calculo['pautoprueba'] * $total;
    }
    $resultadop1->close();
}
/**
 * Metodo que permite obtener el reactivo segun el subreceptor y municipio
 */
if ($accion == "llenarReactivo") {

    $subreceptor    = $_POST['subreceptor'];
    $municipio      = $_POST['municipio'];

    $sql3 = "SELECT DISTINCT porcentaje FROM cobertura WHERE subreceptor_id = $subreceptor AND municipio = $municipio";
    $resultador = $enlace->query($sql3);
    while ($cobertura = mysqli_fetch_assoc($resultador)) {
        echo $cobertura['porcentaje'];
    }
    $resultador->close();
}
/**
 * Metodo que permite obtener la cantidad de promotes segun sea el subreceptor
 */
if ($accion == "obtenerCantidadPromotor") {

    $subreceptor    = $_POST['subreceptor'];
    $municipio      = $_POST['municipio'];

    $consultaPromotor = "SELECT COUNT(t2.idPromotor) AS nPromotor, t2.dias FROM asignacion t1
    LEFT JOIN promotor t2 ON t2.idPromotor = t1.promotor_id
    LEFT JOIN cobertura t3 ON t3.idCobertura = t1.cobertura_id
    WHERE t3.subreceptor_id = $subreceptor AND t3.municipio = '$municipio'
    GROUP BY t2.idPromotor";
    $resultadoPromotor = $enlace->query($consultaPromotor);
    while ($promotor =  $resultadoPromotor->fetch_assoc()) {
        echo $promotor['nPromotor'] . "," . $promotor['dias'];
    }
}
/**
 * Metodo que permite obtener los nuevos y recurrentes segun sea el subreceptor y municipio
 */
if ($accion == "obtnerNuevoRecurrente") {

    $subreceptor    = $_POST['subreceptor'];
    $municipio      = $_POST['municipio'];

    $consultaNR = "SELECT nuevo, recurrente FROM poa WHERE municipio = $municipio AND subreceptor_id = $subreceptor";
    $resultadoNR = $enlace->query($consultaNR);
    while ($NR =  $resultadoNR->fetch_assoc()) {
        echo $NR['nuevo'] . "," . $NR['recurrente'];
    }
}

/**
 * Metodo que permite agregar nuevo POM
 */
if ($accion == "agregarPOM") {

    $poa          = $_POST['poa'];
    $usuario      = $_POST['usuario'];
    $periodo      = $_POST['periodo'];
    $mes          = $_POST['mes'];
    $municipio    = $_POST['municipio'];
    $fecha        = $_POST['fecha'];
    $inicio       = $_POST['inicio'];
    $fin          = $_POST['fin'];
    $lugar        = $_POST['lugar'];
    $promotores   = $_POST['promotores'];
    $nuevo        = $_POST['nuevo'];
    $recurrente   = $_POST['recurrente'];
    $cnatural     = $_POST['cnatural'];
    $csabor       = $_POST['csabor'];
    $cfemenino    = $_POST['cfemenino'];
    $lubricante   = $_POST['lubricante'];
    $pruebaVIH    = $_POST['pruebaVIH'];
    $autoPrueba   = $_POST['autoPrueba'];
    $reactivoEs   = $_POST['reactivoEs'];
    $sifilis      = $_POST['sifilis'];
    $observacion  = $_POST['observacion'];
    $subreceptor  = $_POST['subreceptor'];
    $movil        = $_POST['movil'];
    $supervisado  = $_POST['supervisado'];
    $supervisor   = $_POST['supervisor'];
    $estado       = $_POST['estado'];         

    $sql = "CALL agregarPom($poa, $usuario, $periodo, '$mes', '$municipio', '$fecha', '$inicio', '$fin', '$lugar', $promotores, $nuevo, $recurrente, $cnatural, $csabor, $cfemenino, $lubricante, $pruebaVIH, $autoPrueba, $reactivoEs, $sifilis, '$observacion', $subreceptor, $movil,$supervisado,'$supervisor', '$estado')";
        $resultado = mysqli_query($enlace, $sql);
        $pom = mysqli_affected_rows($enlace);
        if ($pom > 0) {
            echo "Exito";
        } else {
            echo "Error";
        }
    
}

/**
 * Metodo que permite enviar todo
 */
if ($accion == "enviarTodoPom") {
    $subreceptor  = $_POST['subreceptor'];
    $periodo      = $_POST['periodo'];
    $estado       = $_POST['estado'];
    $estadoActual = $_POST['estadoActual'];
    if ($enlace->query("UPDATE pom SET estado = '$estado' WHERE subreceptor_id = $subreceptor AND periodo = $periodo AND estado = '$estadoActual'") === TRUE) {
        echo "Exito";
    } else {
        echo "Error";
    }
}








/////////////// EDITAR ///////////////////
if ($accion == "consultaEditar") {
    
    $subreceptor = $_POST['subreceptor'];
    $periodo = $_POST['periodo'];
    $pom = $_POST['pom'];

    $sql = "SELECT DISTINCT t2.idPom, t7.idPoa, t2.periodo, t3.codigo as cmes, t3.nombre AS mes, t4.codigo as cmunicipio, t4.nombre AS municipio,
    t2.lugar, t2.fecha, t2.horaInicio, t2.horaFin, t6.codigo, CONCAT(t6.nombre, ' ', t6.apellido) as nombres,t2.pNuevo, t2.pRecurrente, 
    (t2.pNuevo + t2.pRecurrente) as total, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH, t2.autoprueba, t2.reactivo, 
    t2.sifilis, t2.observacion, t2.supervisado, t2.supervisor, t2.estado FROM pom t2
    LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
    LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
    LEFT JOIN promotor t5 ON t5.idPromotor = t2.promotor_id
    LEFT JOIN persona t6 ON t6.idPersona = t5.persona_id
    LEFT JOIN poa t7 ON t7.idPoa = t2.poa_id
    WHERE t7.subreceptor_id = $subreceptor AND t2.periodo =  $periodo AND t2.idPom= $pom";

    $consulta = $enlace->query($sql);
    $response = array();
    while ($pom = $consulta->fetch_assoc()) {
        $response = $pom;
    }
    echo json_encode($response);
}

/**
 * Metodo que permite editar POM
 */
if ($accion == "editarPOM") {

    $pom          = $_POST['pom'];
    $subreceptor  = $_POST['subreceptor'];
    $periodo      = $_POST['periodo'];
    $mes          = $_POST['mes'];
    $municipio    = $_POST['municipio'];
    $fecha        = $_POST['fecha'];
    $inicio       = $_POST['inicio'];
    $fin          = $_POST['fin'];
    $lugar        = $_POST['lugar'];
    $promotores   = $_POST['promotores'];
    $nuevo        = $_POST['nuevo'];
    $recurrente   = $_POST['recurrente'];
    $cnatural     = $_POST['cnatural'];
    $csabor       = $_POST['csabor'];
    $cfemenino    = $_POST['cfemenino'];
    $lubricante   = $_POST['lubricante'];
    $pruebaVIH    = $_POST['pruebaVIH'];
    $autoPrueba   = $_POST['autoPrueba'];
    $reactivoEs   = $_POST['reactivoEs'];
    $sifilis      = $_POST['sifilis'];
    $observacion  = $_POST['observacion'];
    $movil        = $_POST['movil'];
    $supervisado  = $_POST['supervisado'];
    $supervisor   = $_POST['supervisor'];

    $sql = "CALL editarPom($pom, $subreceptor, $periodo, '$mes', '$municipio', '$fecha', '$inicio', '$fin', '$lugar', $promotores, 
    $nuevo, $recurrente, $cnatural, $csabor, $cfemenino, $lubricante, $pruebaVIH, $autoPrueba, $reactivoEs, $sifilis, '$observacion',
    $movil, $supervisado,'$supervisor')";
    $resultado = mysqli_query($enlace, $sql);
    $pom = mysqli_affected_rows($enlace);
    if ($pom > 0) {
        echo "Exito";
    } else {
        echo "Error";
    }
}
/**
 * Metodo que permite anular un POM
 */
if ($accion == "anularPOM") {

    $subreceptor  = $_POST['subreceptor'];
    $pom = $_POST['pom'];

    if ($enlace->query("DELETE FROM pom WHERE idPom = $pom AND subreceptor_id = $subreceptor") === TRUE) {
        echo "Exito";
    } else {
        echo "Error";
    }
}
