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
 * Metodo que permite agregar nuevo promotor
 */
if ($accion == "agregarPromotor") {
    $subreceptor= $_POST['subreceptor'];
    $codigo     = $_POST['codigo'];
    $pnombre    = $_POST['pnombre'];
    $snombre    = $_POST['snombre'];
    $papellido  = $_POST['papellido'];
    $sapellido  = $_POST['sapellido'];
    $telefono   = $_POST['telefono'];
    $email      = $_POST['correo'];
    $usuario    = $_POST['usuario'];
    $rol        = $_POST['rol'];
    $dias       = $_POST['dias'];
    $cobertura  = $_POST['cobertura'];
    //Validacion de duplicado
    $consultar = "SELECT t1.usuario,t3.codigo, t2.numero FROM usuario t1  
    LEFT JOIN persona t2 ON t2.idPersona=t1.persona_id 
    RIGHT JOIN promotor t3 ON t3.persona_id = t2.idPersona  
    WHERE t1.usuario= '$usuario' AND t3.codigo = '$codigo' AND t2.numero = '$numero'";
    if (mysqli_num_rows($enlace->query($consultar))) {
        echo "Duplicado";
    } else {
        $promotor = "CALL agregarPromotor($subreceptor, '$codigo', '$pnombre', '$snombre', 
        '$papellido', '$sapellido', '$telefono', '$email', '$usuario', '$rol', $dias)";
        $resultado = mysqli_query($enlace, $promotor);
        $prom = mysqli_affected_rows($enlace);
        if ($prom > 0) {
            echo "Exito";
        } else {
            echo "Error";
        }
        $rs = mysqli_query($enlace, "SELECT MAX(idPromotor) AS id FROM promotor");
            if ($row = mysqli_fetch_row($rs)) {
                $id = trim($row[0]);
                foreach ($cobertura as $idCobertura) 
                {
                    mysqli_query($enlace,"INSERT INTO asignacion (promotor_id, cobertura_id) VALUES ($id, $idCobertura)");
                }
            }
        }
}
