<?php
include_once('../bd/conexion.php');
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
    if ($municipio == "") {
        $municipio = 0;
    }
    $contador = 1;

    $sqlPoa =
        "SELECT DISTINCT t1.idPoa, t5.nombre as mes, t4.codigo, t4.nombre as municipio, t1.nuevo, t1.recurrente, (t1.nuevo + t1.recurrente) AS total,
    t1.observacion, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH, t2.autoPrueba, t2.reactivoE, t2.sifilis, t1.subreceptor_id
    FROM poa t1 LEFT JOIN insumo t2 ON t2.poa_id = t1.idPoa LEFT JOIN catalogo t3 ON t3.codigo = t1.departamento
	LEFT JOIN catalogo t4 ON t4.codigo = t1.municipio LEFT JOIN catalogo t5 ON t5.codigo = t1.mes
    WHERE t1.subreceptor_id = $subreceptor AND t1.anio = YEAR(NOW()) AND t1.periodo = $periodo AND estado = 1 AND t1.municipio = $municipio AND t5.codigo = '$mes'";
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
            <td><a href='#' class='btn-sm btn-outline-info' onclick='cargarPoa(" . $poa['idPoa'] . ", $promotor); llenarReactivo();'>
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

    $sql3 = "SELECT porcentaje FROM cobertura WHERE subreceptor_id = $subreceptor AND municipio = $municipio";
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

    $consultaPromotor = "SELECT COUNT(idPromotor) as nPromotor FROM promotor p LEFT JOIN cobertura c ON c.idCobertura=p.cobertura_id
    WHERE c.subreceptor_id = $subreceptor AND c.municipio = $municipio";
    $resultadoPromotor = $enlace->query($consultaPromotor);
    while ($promotor =  $resultadoPromotor->fetch_assoc()) {
        echo $promotor['nPromotor'];
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
        echo $NR['nuevo'] . "," .
            $NR['recurrente'];
    }
}
/**
 * 
 */
if ($accion == "agregarPOM") {

    $poa            = $_POST['poa'];
    $estado         = $_POST['estado'];
    $usuario        = $_POST['usuario'];
    $descripcion    = $_POST['descripcion'];
    $periodo        = $_POST['periodo'];
    $mes            = $_POST['mes'];
    $municipio      = $_POST['municipio'];
    $fecha          = $_POST['fecha'];
    $inicio         = $_POST['inicio'];
    $fin            = $_POST['fin'];
    $lugar          = $_POST['lugar'];
    $promotor       = $_POST['promotor'];
    $nuevo          = $_POST['nuevo'];
    $recurrente     = $_POST['recurrente'];
    $cnatural       = $_POST['cnatural'];
    $csabor         = $_POST['csabor'];
    $cfemenino      = $_POST['cfemenino'];
    $lubricante     = $_POST['lubricante'];
    $pruebaVIH      = $_POST['pruebaVIH'];
    $autoPrueba     = $_POST['autoPrueba'];
    $reactivoEs     = $_POST['reactivoEs'];
    $sifilis        = $_POST['sifilis'];
    $observacion    = $_POST['observacion'];

    $_duplicado = $enlace->query("SELECT * FROM pom WHERE periodo = $periodo AND mes = '$mes' AND municipio = '$municipio' AND horaInicio = '$inicio' AND horaFin = '$fin'");
    if (mysqli_num_rows($_duplicado)) {
        echo "Duplicado";
    } else {
        $sql = "CALL agregarPom($poa, '$estado', $usuario, '$descripcion', $periodo, '$mes', '$municipio', '$fecha', '$inicio', '$fin', '$lugar', $promotor, $nuevo, 
        $recurrente, $cnatural, $csabor, $cfemenino, $lubricante, $pruebaVIH, $autoPrueba, $reactivoEs, $sifilis, '$observacion')";
        $resultado = mysqli_query($enlace, $sql);
        $pom = mysqli_affected_rows($enlace);
        if ($pom > 0) {
            echo "Exito";
        } else {
            echo "Error";
        }
    }
}
