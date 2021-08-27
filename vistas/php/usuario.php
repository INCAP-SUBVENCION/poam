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
 * Metodo que permite agregar nuevo usuario
 */
if ($accion == "agregarUsuario") {
    $documento  = $_POST['documento'];
    $numero     = $_POST['numero'];
    $pnombre    = $_POST['pnombre'];
    $snombre    = $_POST['snombre'];
    $papellido  = $_POST['papellido'];
    $sapellido  = $_POST['sapellido'];
    $direccion  = $_POST['direccion'];
    $telefono   = $_POST['telefono'];
    $correo     = $_POST['correo'];
    $rol        = $_POST['rol'];
    $subreceptor= $_POST['subreceptor'];


    $_duplicado =$enlace->query("SELECT (SELECT idPersona FROM persona WHERE numero = '$numero') AS persona FROM usuario WHERE rol='$rol'");
    if(mysqli_num_rows($_duplicado)){
        echo "Duplicado";
    } else {
        $sql = "CALL agregarUsuario($documento,'$numero','$pnombre','$snombre','$papellido','$sapellido','$direccion','$telefono','$correo','$rol',$subreceptor)";
        $resultadou = mysqli_query($enlace, $sql);
        $usuarios = mysqli_affected_rows($enlace);
        if ($usuarios > 0) {
            echo "Exito";
        } else {
            echo "Error";
        }
    }
}
