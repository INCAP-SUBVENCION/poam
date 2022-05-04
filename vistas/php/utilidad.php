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

    $sql2 = "SELECT DISTINCT t3.codigo as id, t3.nombre as municipio FROM cobertura t1
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

    $sql3 = "SELECT DISTINCT porcentaje FROM cobertura WHERE subreceptor_id = $subreceptor AND departamento = $departamento AND municipio = $municipio";
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
  $cCobertura   = "SELECT c.idCobertura as id, m.nombre as municipio FROM cobertura c LEFT JOIN catalogo m ON m.codigo = c.municipio WHERE c.subreceptor_id = $subreceptor AND c.periodo = 3";
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
////////////////////////////EDITAR POM/////////////////////////////

/**
 * Metodo que permite llenar reactivo en el combo segun sea el departamento y subreceptor
 */
if ($accion == "obtenerReactivoEditar") {

    $subreceptor    = $_POST['subreceptor'];
    $municipio      = $_POST['municipio'];

    $sql3 = "SELECT DISTINCT porcentaje FROM cobertura WHERE subreceptor_id = $subreceptor AND municipio = $municipio";
    $resultador = $enlace->query($sql3);
    while ($cobertura = mysqli_fetch_assoc($resultador)) {
        echo $cobertura['porcentaje'];
    }
    $resultador->close();
}

if ($accion == "supervisor") {

    $id       = $_POST['supervisor'];
    $periodo  = $_POST['periodo'];
    $contador = 1;

    $sqlPoa = "SELECT t4.idPom, t4.periodo, t5.nombre AS mess, t6.nombre AS municipios, t4.lugar, t4.fecha, t1.hora, 
    t4.pNuevo, t4.pRecurrente, ROUND((t4.pNuevo + t4.pRecurrente), 2) AS total, t1.observacion FROM supervision t1
    LEFT JOIN usuario t2 ON t2.idUsuario=t1.usuario_id LEFT JOIN persona t3 ON t3.idPersona=t2.persona_id 
    LEFT JOIN pom t4 ON t4.idPom=t1.pom_id LEFT JOIN catalogo t5 ON t5.codigo=t4.mes
    LEFT JOIN catalogo t6 ON t6.codigo=t4.municipio WHERE t2.idUsuario = $id AND t4.periodo = $periodo";
    $resultadoPoa = $enlace->query($sqlPoa);
    if (mysqli_num_rows($resultadoPoa) != 0) {
        while ($poa = $resultadoPoa->fetch_assoc()) {
            echo "
        <tr>
            <td>" . $poa['periodo'] . "</td>
            <td>" . $poa['mess'] . "</td>
            <td>" . $poa['municipios'] . "</td>
            <td>" . $poa['lugar'] . "</td>
            <td>" . $poa['fecha'] . "</td>
            <td>" . $poa['hora'] . "</td>
            <td>" . $poa['pNuevo'] . "</td>
            <td>" . $poa['pRecurrente'] . "</td>
            <td>" . $poa['total'] . "</td>
            <td>" . $poa['observacion'] . "</td>
            <td><a href='detallePomSuper.php?id=".$poa['idPom']."' class='btn-sm btn-outline-info' >
            <i class='bi bi-file-arrow-down-fill'></i> Detalle </a></td>
        </tr>
        "; 
        }
    } else {
        echo "Sin datos";
    }
    $resultadoPoa->close();
}

if ($accion == "supervisores") {

    $id           = $_POST['supervisor'];
    $periodo      = $_POST['periodo'];
    $subreceptor  = $_POST['subreceptor'];
    $contador = 1;

    $sqlSuper = "SELECT DISTINCT t4.idPom, CONCAT(t7.nombre,' ',t7.apellido) AS supervisor, t4.periodo, t5.nombre AS mess, t6.nombre AS municipios, t4.lugar, t4.fecha, t1.hora, 
    t4.pNuevo, t4.pRecurrente, ROUND((t4.pNuevo + t4.pRecurrente), 2) AS total, t1.observacion, CONCAT(t9.nombre,' ',t9.apellido) AS promotor FROM supervision t1
    LEFT JOIN usuario t2 ON t2.idUsuario=t1.usuario_id LEFT JOIN persona t3 ON t3.idPersona=t2.persona_id 
    LEFT JOIN pom t4 ON t4.idPom=t1.pom_id LEFT JOIN catalogo t5 ON t5.codigo=t4.mes
    LEFT JOIN catalogo t6 ON t6.codigo=t4.municipio 
    LEFT JOIN persona t7 ON t7.idPersona=t2.persona_id
    LEFT JOIN promotor t8 ON t8.idPromotor=t4.promotor_id
    LEFT JOIN persona t9 ON t9.idPersona=t8.persona_id
    WHERE t2.idUsuario = $id AND t4.periodo = $periodo";
    $resultadoSuper = $enlace->query($sqlSuper);
    if (mysqli_num_rows($resultadoSuper) != 0) {
        while ($super = $resultadoSuper->fetch_assoc()) {
            echo "
        <tr>
            <td>" . $super['supervisor'] . "</td>
            <td>" . $super['periodo'] . "</td>
            <td>" . $super['mess'] . "</td>
            <td>" . $super['municipios'] . "</td>
            <td>" . $super['lugar'] . "</td>
            <td>" . $super['fecha'] . "</td>
            <td>" . $super['hora'] . "</td>
            <td>" . $super['pNuevo'] . "</td>
            <td>" . $super['pRecurrente'] . "</td>
            <td>" . $super['total'] . "</td>
            <td>" . $super['promotor'] . "</td>
            <td>" . $super['observacion'] . "</td>
            <td><a href='detallePomSuper.php?sub=$subreceptor&id=".$super['idPom']."' class='btn-sm btn-outline-info' >
            <i class='bi bi-file-arrow-down-fill'></i> Detalle </a></td>
        </tr>
        "; 
        }
    } else {
        echo "Sin datos";
    }
    $resultadoSuper->close();
}