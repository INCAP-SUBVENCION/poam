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
 * Metodo que permite calcular la proyeccion de insumos del POA del semestre 1
 */
if ($accion == "calcularProyeccionPOA") {

    $subreceptor = $_POST['subreceptor'];
    $total      = $_POST['total'];

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
 * Metodo que permite agregar un nuevo POA
 */
if ($accion == "agregarPoa") {

    $usuario        = $_POST['usuario'];
    $mes            = $_POST['mes'];
    $departamento   = $_POST['departamento'];
    $municipio      = $_POST['municipio'];
    $nuevo          = $_POST['nuevo'];
    $recurrente     = $_POST['recurrente'];
    $subreceptor    = $_POST['subreceptor'];
    $observacion    = $_POST['observacion'];
    $periodo        = $_POST['periodo'];
    $cnatural       = $_POST['cnatural'];
    $csabor         = $_POST['csabor'];
    $cfemenino      = $_POST['cfemenino'];
    $lubricante     = $_POST['lubricante'];
    $pruebaVIH      = $_POST['pruebaVIH'];
    $autoPrueba     = $_POST['autoPrueba'];
    $reactivoEs     = $_POST['reactivoEs'];
    $sifilis        = $_POST['sifilis'];

    $_duplicado = $enlace->query("SELECT * FROM poa  WHERE mes = '$mes' AND subreceptor_id = $subreceptor AND periodo = $periodo AND departamento = '$departamento' AND municipio = '$municipio'");
    if (mysqli_num_rows($_duplicado)) {
        echo "Duplicado";
    } else {

        $sqlPoa = "CALL agregarPoa($usuario, '$mes', '$departamento', '$municipio', $nuevo, $recurrente, $subreceptor,
        '$observacion', $periodo, $cnatural, $csabor, $cfemenino, $lubricante, $pruebaVIH, $autoPrueba, $reactivoEs, $sifilis)";

        if ($enlace->query($sqlPoa) === TRUE) {
            echo "Exito";
        } else {
            echo "Error";
        }
    }
}

/**
 * Metodo que permite agregar nueva meta para calcular el POA
 */
if ($accion == "agregarResumen") {

    $cobertura      = $_POST['cobertura'];
    $periodo        = $_POST['periodo'];
    $meses          = $_POST['meses'];
    $metaNuevos     = $_POST['metaNuevos'];
    $metaRecurrentes = $_POST['metaRecurrentes'];

    $_duplicado = $enlace->query("SELECT * FROM resumen WHERE cobertura_id = $cobertura AND periodo = $periodo");
    if (mysqli_num_rows($_duplicado)) {
        echo "Duplicado";
    } else {

        $sqlRes = "CALL agregarResumen($cobertura, $periodo, $meses, $metaNuevos, $metaRecurrentes)";

        if ($enlace->query($sqlRes) === TRUE) {
            echo "Exito";
        } else {
            echo "Error";
        }
    }
}
/**
 * Metodo que permite enviar todo
 */
if ($accion == "cambiarTodo") {
    $subreceptor  = $_POST['subreceptor'];
    $periodo      = $_POST['periodo'];
    $estado       = $_POST['estado'];
    $estadoActual = $_POST['estadoActual'];
    if ($enlace->query("UPDATE poa SET estado = '$estado' WHERE subreceptor_id = $subreceptor AND periodo = $periodo AND estado = '$estadoActual'") === TRUE) {
        echo "Exito";
    } else {
        echo "Error";
    }
}
////////////////////////////////////////EDITAR///////////////////////
if ($accion == "consultaEditar") {
    $subreceptor = $_POST['subreceptor'];
    $periodo = $_POST['periodo'];
    $poa = $_POST['poa'];
    $sql = "SELECT DISTINCT t1.idPoa, t2.idInsumo, t5.codigo as codigoM, t5.nombre as mes, t3.codigo as codigoD, 
    t3.nombre as departamento,t4.codigo as codigoMuni, t4.nombre as municipio, t1.nuevo, 
    t1.recurrente, round((t1.nuevo+t1.recurrente),2) as total,t1.observacion, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, 
    t2.pruebaVIH, t2.autoPrueba, t2.reactivoE, t2.sifilis FROM poa t1
    LEFT JOIN insumo t2 ON t2.poa_id = t1.idPoa
    LEFT JOIN catalogo t3 ON t3.codigo = t1.departamento
    LEFT JOIN catalogo t4 ON t4.codigo = t1.municipio
    LEFT JOIN catalogo t5 ON t5.codigo = t1.mes
    WHERE t1.subreceptor_id = $subreceptor AND t1.anio = YEAR(NOW()) AND t1.periodo = $periodo AND t1.idPoa=$poa";

    $consulta = $enlace->query($sql);
    $response = array();
    while ($poa = $consulta->fetch_assoc()) {
        $response = $poa;
    }
    echo json_encode($response);
}

/**
 * 
 */
if ($accion == "editarPoa") {

    $poa            = $_POST['poa'];
    $insumo         = $_POST['insumo'];
    $usuario        = $_POST['eusuario'];
    $mes            = $_POST['emes'];
    $departamento   = $_POST['edepartamento'];
    $municipio      = $_POST['emunicipio'];
    $nuevo          = $_POST['enuevo'];
    $recurrente     = $_POST['erecurrente'];
    $subreceptor    = $_POST['esubreceptor'];
    $observacion    = $_POST['eobservacion'];
    $periodo        = $_POST['eperiodo'];
    $cnatural       = $_POST['ecnatural'];
    $csabor         = $_POST['ecsabor'];
    $cfemenino      = $_POST['ecfemenino'];
    $lubricante     = $_POST['elubricante'];
    $pruebaVIH      = $_POST['epruebaVIH'];
    $autoPrueba     = $_POST['eautoPrueba'];
    $reactivoEs     = $_POST['ereactivoEs'];
    $sifilis        = $_POST['esifilis'];

    $sqlPoa = "CALL editarPoa($poa, $insumo, '$mes', '$departamento', '$municipio', $nuevo, $recurrente, $subreceptor,
        '$observacion', $periodo, $cnatural, $csabor, $cfemenino, $lubricante, $pruebaVIH, $autoPrueba, $reactivoEs, $sifilis)";

    if ($enlace->query($sqlPoa) === TRUE) {
        echo "Exito";
    } else {
        echo "Error";
    }
}
