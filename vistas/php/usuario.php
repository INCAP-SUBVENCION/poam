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
    $codigo     = $_POST['codigo'];
    $pnombre    = $_POST['pnombre'];
    $snombre    = $_POST['snombre'];
    $papellido  = $_POST['papellido'];
    $sapellido  = $_POST['sapellido'];
    $telefono   = $_POST['telefono'];
    $correo     = $_POST['correo'];
    $rol        = $_POST['rol'];
    $subreceptor = $_POST['subreceptor'];

    $_duplicado = $enlace->query("SELECT codigo FROM persona WHERE codigo = '$codigo'");
    if (mysqli_num_rows($_duplicado)) {
        echo "Duplicado";
    } else {
        $sql = "CALL agregarUsuario('$codigo','$pnombre','$snombre','$papellido','$sapellido','$telefono','$correo','$rol',$subreceptor)";
        $resultadou = mysqli_query($enlace, $sql);
        $usuarios = mysqli_affected_rows($enlace);
        if ($usuarios > 0) {
            echo "Exito";
        } else {
            echo "Error";
        }
    }
}


if ($accion == "cambiarPass") {
    $id     = $_POST['id'];
    $pass_2 = $_POST['pass_2'];
    $sql = "CALL cambiarPass($id, '$pass_2')";
    $resultadou = mysqli_query($enlace, $sql);
    $usuarios = mysqli_affected_rows($enlace);
    if ($usuarios > 0) {
        echo "Exito";
    } else {
        echo "Error";
    }
}
