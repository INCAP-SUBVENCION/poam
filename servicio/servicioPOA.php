<?php
header("Content-Type: text/html;charset=utf-8");
include_once('../bd/conexion.php');

if (isset($_POST['accion'])) { $accion = $_POST['accion']; }
if (isset($_GET['accion'])) { $accion = $_GET['accion']; }

/**
 * Metodo que permite calcular la proyeccion de insumos del POA del semestre 1
 */
if ($accion == "calcularProyeccionPOA") {

    $subreceptor= $_POST['subreceptor'];
    $total      = $_POST['total'];

    $sqlp1 = "SELECT * FROM subreceptor WHERE idSubreceptor = '$subreceptor'";
    $resultadop1 = $enlace->query($sqlp1);
    while ($calculo = mysqli_fetch_assoc($resultadop1)) {
        echo    $calculo['enatural'] * $total      .",".
                $calculo['esabor'] * $total        .",".
                $calculo['efemenino'] * $total     .",".
                $calculo['elubricante'] * $total   .",".
                $calculo['ppvih'] * $total         .",".
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

    $consultap = "CALL agregarPoa($usuario, '$mes', '$departamento', '$municipio', $nuevo, $recurrente, $subreceptor, '$observacion', $periodo,
    $cnatural, $csabor, $cfemenino, $lubricante, $pruebaVIH, $autoPrueba, $reactivoEs, $sifilis)";
    $resultadop2 = mysqli_query($enlace, $consultap);
    $poa = mysqli_affected_rows($enlace);
    if ($poa > 0) {
        echo "Exito";
    } else {
        echo "Error";
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

    $sqlRes = "CALL agregarResumen($cobertura, $periodo, $meses, $metaNuevos, $metaRecurrentes)";
    $resultadoRes = mysqli_query($enlace, $sqlRes);
    $resumen = mysqli_affected_rows($enlace);
    if($resumen > 0){
        echo "Exito";
    } else {
        echo "Error";
    }
}
?>
