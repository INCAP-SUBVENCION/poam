<?php
header('Content-Type: text/html; charset=ISO-8859-1'); 
include_once('../bd/conexion.php');

if (isset($_POST['accion'])) { $accion = $_POST['accion']; }
if (isset($_GET['accion'])) { $accion = $_GET['accion']; }

/**
 * Metodo que permite calcular la proyeccion de insumos del POA del semestre 1
 */
if ($accion == "calcularProyeccionPOA") {

    $subreceptor= $_POST['subreceptor'];
    $total      = $_POST['total'];

    $sql = "SELECT * FROM subreceptor WHERE idSubreceptor = '$subreceptor'";
    $resultado = mysqli_query($enlace, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo    $fila['enatural'] * $total      .",".
                $fila['esabor'] * $total        .",".
                $fila['efemenino'] * $total     .",".
                $fila['elubricante'] * $total   .",".
                $fila['ppvih'] * $total         .",".       
                $fila['pautoprueba'] * $total;
    }
}
/**
 * Metodo que permite agregar un nuevo POA
 */
if ($accion == "agregarPoa") {
    $usuario        = $_GET['usuario'];
    $mes            = $_GET['mes'];
    $departamento   = $_GET['departamento'];
    $municipio      = $_GET['municipio'];
    $nuevo          = $_GET['nuevo'];
    $recurrente     = $_GET['recurrente'];
    $subreceptor    = $_GET['subreceptor'];
    $observacion    = $_GET['observacion'];
    $cnatural       = $_GET['cnatural'];
    $csabor         = $_GET['csabor'];
    $cfemenino      = $_GET['cfemenino'];
    $lubricante     = $_GET['lubricante'];
    $pruebaVIH      = $_GET['pruebaVIH'];
    $autoPrueba     = $_GET['autoPrueba'];
    $reactivoEs     = $_GET['reactivoEs'];
    $sifilis        = $_GET['sifilis'];
    
    $sql = "CALL agregarPoa($usuario, $mes, $departamento, $municipio, $nuevo, $recurrente, $subreceptor, '$observacion', $cnatural, $csabor, $cfemenino, $lubricante, $pruebaVIH, $autoPrueba, $reactivoEs, $sifilis)";

    $resultado = mysqli_query($enlace, $sql);
    $filas = mysqli_affected_rows($enlace);
    if ($filas > 0) {
        echo "Exito";
    } else {
        echo "Error";
    }
}

?>