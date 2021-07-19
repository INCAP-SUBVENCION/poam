<?php
header("Content-Type: text/html;charset=utf-8");
include_once('../bd/conexion.php');

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
}
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
}

/**
 * Metodo que permite llenar muncipio en el combo segun sea el departamento
 */
if ($accion == "llenarMunicipio") {

    $departamento = $_POST['departamento'];

    $sql1 = "SELECT * FROM catalogo WHERE categoria = 'municipio' AND descripcion = '$departamento' ORDER BY codigo";
    $resultadom = $enlace->query($sql1);
    echo "<option value=''>Seleccionar...</option>";
    while ($municipio = mysqli_fetch_assoc($resultadom)) {
        echo '<option value="' . $municipio['codigo'] . '">' . $municipio['nombre'] . '</option>';
    }
    $resultadom->close();
}
/**
 * Metodo que permite llenar muncipio en el combo segun sea el area de cobertura
 */
if ($accion == "municipioCobertura") {
    $subreceptor    = $_POST['subreceptor'];
    $departamento   = $_POST['departamento'];

    $sql2 = "CALL listarMunicipio($subreceptor, $departamento)";
    $resultadoc = $enlace->query($sql2);
    echo "<option value=''>Seleccionar...</option>";
    while ($cubertura = mysqli_fetch_assoc($resultadoc)) {
        echo '<option value="' . $cubertura['id'] . '">' . $cubertura['municipio'] . '</option>';
    }
    $resultadoc->close();
}


/**
 * Metodo que permite llenar reactivo en el combo segun sea el departamento y subreceptor
 */
if ($accion == "llenarReactivo") {

    $subreceptor    = $_POST['subreceptor'];
    $departamento   = $_POST['departamento'];
    $municipio      = $_POST['municipio'];

    $sql3 = "SELECT porcentaje FROM cobertura WHERE subreceptor_id = $subreceptor AND departamento = $departamento AND municipio = $municipio";
    $resultador = $enlace->query($sql3);
    while ($cobertura = mysqli_fetch_assoc($resultador)) {
        echo $cobertura['porcentaje'];
    }
    $resultador->close();
}


/**
 * Metodo que permite llenar mes en el combo segun sea el semestre
 */
if ($accion == "periodo_mes") {

    $periodo = $_POST['periodo'];

    $sql1 = "SELECT *FROM catalogo WHERE categoria = 'mes' AND descripcion = $periodo";
    $resultadom = $enlace->query($sql1);
    echo "<option value=''>Seleccionar...</option>";
    while ($municipio = mysqli_fetch_assoc($resultadom)) {
        echo '<option value="' . $municipio['codigo'] . '">' . $municipio['nombre'] . '</option>';
    }
    $resultadom->close();
}


/**
 * Metodo que permite llenar los nuevos segun sea el municipio
 */
if ($accion == "obtenerResumen") {

    $periodo   = $_POST['periodo'];
    $municipio  = $_POST['municipio'];
    $subreceptor= $_POST['subreceptor'];

    $sqlResumen = "SELECT t1.nuevo, t1.recurrente FROM resumen t1 
    LEFT JOIN cobertura t2 ON t2.idCobertura = t1.cobertura_id 
    WHERE t2.subreceptor_id = $subreceptor AND t2.municipio = $municipio AND t1.periodo = $periodo";
    $resultadoResumen = $enlace->query($sqlResumen);
    while ($resumen = mysqli_fetch_assoc($resultadoResumen)) {
        echo $resumen['nuevo'] .",".$resumen['recurrente'];
    }
    $resultadoResumen->close();
}
/**
 * Metodo que permite mostrar los nuevos y recurrentes segun sea el municipio y subreceptor
 */
if ($accion == "obtenerMeta") {

    $municipio  = $_POST['municipio'];
    $subreceptor= $_POST['subreceptor'];

    $sqlRecurrente = "SELECT idCobertura, nuevo, recurrente FROM cobertura WHERE subreceptor_id = $subreceptor AND municipio = $municipio";
    $resultadoRecurrente = $enlace->query($sqlRecurrente);
    while ($recurrente = mysqli_fetch_assoc($resultadoRecurrente)) {
        echo $recurrente['nuevo'] .",".$recurrente['recurrente'].",".$recurrente['idCobertura'];
    }
    $resultadoRecurrente->close();
}
