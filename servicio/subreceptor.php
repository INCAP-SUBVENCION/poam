<?php
    include_once('../bd/conexion.php');
    header('Content-Type: text/html; charset=ISO-8859-1'); 
    date_default_timezone_set("America/Guatemala");
	session_start();
    
    if (isset($_POST['accion'])) { $accion = $_POST['accion']; }
    if (isset($_GET['accion'])) { $accion = $_GET['accion'];}


    if ($accion == "agregarSubreceptor") {
    
        $codigo     = $_GET['codigo'];
        $nombre     = $_GET['nombre'];
        $cnatural   = $_GET['cnatural'];
        $csabor     = $_GET['csabor'];
        $cfemenino  = $_GET['cfemenino'];
        $lubricante = $_GET['lubricante'];
        $pruebavih  = $_GET['pruebavih'];
        $autoprueba = $_GET['autoprueba'];
    
            $sql = "CALL agregarSubreceptor('$codigo', '$nombre', $cnatural, $csabor, $cfemenino, $lubricante, $pruebavih, $autoprueba)";
            $resultado = mysqli_query($enlace, $sql);
            $filas = mysqli_affected_rows($enlace);
            if ($filas > 0) {
                echo "Exito";
            } else {
                echo "Error";
            }
    
        
    }
