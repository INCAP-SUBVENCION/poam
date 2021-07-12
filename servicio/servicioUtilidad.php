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
        echo '<option value="' . $municipio['idCatalogo'] . '">' . $municipio['nombre'] . '</option>';
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
