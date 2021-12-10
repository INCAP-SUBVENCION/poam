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
 * Metodo que permite llenar muncipio en el combo segun sea el departamento
 */
if ($accion == "llenarMunicipio") {

    $departamento = $_POST['departamento'];

    $sql1 = "SELECT * FROM catalogo WHERE categoria = 'municipio' AND descripcion = '$departamento' ORDER BY codigo";
    $resultadom = $enlace->query($sql1);
    echo '<option value="">Seleccionar...</option>';
    while ($municipio = mysqli_fetch_assoc($resultadom)) {
        echo '<option value="'.$municipio['codigo'].'">'.$municipio['nombre'].'</option>';
    }
    $resultadom->close();
}
/**
 * Metodo que permite llenar muncipio en el combo segun sea el area de cobertura
 */
if ($accion == "municipioCobertura") {
    $subreceptor    = $_POST['subreceptor'];
    $departamento   = $_POST['departamento'];

    $sql2 = "SELECT t3.codigo as id, t3.nombre as municipio FROM cobertura t1
    LEFT JOIN catalogo t2 ON t2.codigo = t1.departamento
    LEFT JOIN catalogo t3 ON t3.codigo = t1.municipio
    LEFT JOIN subreceptor t4 ON t4.idSubreceptor = t1.subreceptor_id
	WHERE t2.codigo = $departamento AND t1.subreceptor_id = $subreceptor";
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
if ($accion == "obtenerReactivo") {

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
    $subreceptor = $_POST['subreceptor'];

    $sqlResumen = "SELECT t1.nuevo, t1.recurrente FROM resumen t1
    LEFT JOIN cobertura t2 ON t2.idCobertura = t1.cobertura_id
    WHERE t2.subreceptor_id = $subreceptor AND t2.municipio = $municipio AND t1.periodo = $periodo";
    $resultadoResumen = $enlace->query($sqlResumen);
    while ($resumen = mysqli_fetch_assoc($resultadoResumen)) {
        echo $resumen['nuevo'] . "," . $resumen['recurrente'];
    }
    $resultadoResumen->close();
}
/**
 * Metodo que permite mostrar los nuevos y recurrentes segun sea el municipio y subreceptor
 */
if ($accion == "obtenerMeta") {

    $municipio   = $_POST['municipio'];
    $subreceptor = $_POST['subreceptor'];
    $periodo     = $_POST['periodo'];

    $sqlRecurrente = "SELECT idCobertura, nuevo, recurrente FROM cobertura WHERE subreceptor_id = $subreceptor AND municipio = $municipio AND periodo = $periodo";
    $resultadoRecurrente = $enlace->query($sqlRecurrente);
    while ($recurrente = mysqli_fetch_assoc($resultadoRecurrente)) {
        echo $recurrente['nuevo'] . "," . $recurrente['recurrente'] . "," . $recurrente['idCobertura'];
    }
    $resultadoRecurrente->close();
}
/**
 * Metodo que permite obtener los muncipios cubiertos por el subreceptor para registrar los promotores
 */
if ($accion == "obtenerCobertura") {

  $subreceptor  = $_POST['subreceptor'];
  $cCobertura   = "SELECT c.idCobertura as id, m.nombre as municipio FROM cobertura c LEFT JOIN catalogo m ON m.codigo = c.municipio WHERE c.subreceptor_id = $subreceptor";
  $rCobertura   = $enlace->query($cCobertura);
  while ($municipio = mysqli_fetch_assoc($rCobertura)) {
      echo '<option value="'.$municipio['id'].'">'.$municipio['municipio'].'</option>';
  }
  $rCobertura->close();
}
/**
 * Metodo que permite obtener los meses segun sea el subrecetpor, municipio y periodo
 */
if ($accion == "obtenerMesPom") {

    $subreceptor    = $_POST['subreceptor'];
    $periodo        = $_POST['periodo'];
    $municipio      = $_POST['municipio'];

    $consultaMes   = "SELECT m.codigo as id, m.nombre as mes FROM poa p LEFT JOIN catalogo m ON m.codigo = p.mes
                    WHERE p.subreceptor_id = $subreceptor AND p.municipio = $municipio AND m.descripcion = $periodo";
    $resultadoMes  = $enlace->query($consultaMes);
    echo "<option value=''>Seleccionar mes</option>";
    while ($mes = mysqli_fetch_assoc($resultadoMes)) {
        echo '<option value="' . $mes['id'] . '">' . $mes['mes'] . '</option>';
    }
    $resultadoMes->close();
  }
////////////////////////////EDITAR POA/////////////////////////////

