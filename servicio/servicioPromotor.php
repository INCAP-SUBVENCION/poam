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
 * Metodo que permite agregar nuevo promotor
 */
if ($accion == "agregarPromotor") {

    $codigo     = $_POST['codigo'];
    $cobertura  = $_POST['cobertura'];
    $documento  = $_POST['documento'];
    $numero     = $_POST['numero'];
    $pnombre    = $_POST['pnombre'];
    $snombre    = $_POST['snombre'];
    $papellido  = $_POST['papellido'];
    $sapellido  = $_POST['sapellido'];
    $direccion  = $_POST['direccion'];
    $telefono   = $_POST['telefono'];
    $correo     = $_POST['correo'];
    $usuario    = $_POST['usuario'];
    $rol        = $_POST['rol'];

    if (mysqli_num_rows($enlace->query("SELECT * FROM promotor WHERE codigo = '$codigo' AND cobertura_id = $cobertura"))) {
        echo "Duplicado";
    } else {
        $promotor = "CALL agregarPromotor($documento, '$numero', '$pnombre', '$snombre', '$papellido', '$sapellido', '$direccion', '$telefono', '$correo', '$codigo', $cobertura, '$usuario', '$rol')";
        $resultado = mysqli_query($enlace, $promotor);
        $prom = mysqli_affected_rows($enlace);
        if ($prom > 0) {
            echo "Exito";
        } else {
            echo "Error";
        }
    }
}