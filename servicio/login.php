<?php
    include_once('../bd/conexion.php');
    header('Content-Type: text/html; charset=ISO-8859-1'); 
    date_default_timezone_set("America/Guatemala");
	session_start();
    
    if (isset($_POST['accion'])) { $accion = $_POST['accion']; }
    if (isset($_GET['accion'])) { $accion = $_GET['accion'];}


    if( $accion == "login") {
        $usuario = $_POST['usuario'];
        $pass    = $_POST['pass'];

        $sql = "CALL login('$usuario','$pass')";
        $resultado = mysqli_query($enlace,$sql);

        if(mysqli_num_rows($resultado) > 0) {
            while($us = mysqli_fetch_assoc($resultado)){
                $_SESSION['idUsuario']  = $us['idUsuario'];
                $_SESSION['Persona_id'] = $us['Persona_id'];
                $_SESSION['rol']        = $us['rol'];
                $_SESSION['usuario']    = $us['usuario'];
                $_SESSION['subreceptor_id']= $us['subreceptor_id'];
            }
            echo "Exito";
        } else {
            echo "Error";
        }
        

    }
?>