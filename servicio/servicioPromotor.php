<?php
     include_once('../bd/conexion.php');
     header("Content-Type: text/html;charset=utf-8");
     date_default_timezone_set("America/Guatemala");
       session_start();
     
     if (isset($_POST['accion'])) { $accion = $_POST['accion']; }
     if (isset($_GET['accion'])) { $accion = $_GET['accion'];}


     if($accion == "agregarPromotor") {

        $codigo     = $_POST['codigo'];
        $cobertura  = $_POST['cobertura'];
        $documento  = $_POST['documento'];
        $numero     = $_POST['documento'];
        $nombre     = $_POST['nombre'];
        $apellido   = $_POST['apellido'];
        $direccion  = $_POST['direccion'];
        $telefono   = $_POST['telefono'];
        $correo     = $_POST['correo'];

         $promotor = "CALL agregarPromotor($documento, '$numero',' $nombre', '$apellido', '$direccion', '$telefono', '$correo', '$codigo', $cobertura)";
         $resultado = mysqli_query($enlace, $promotor);
         $prom = mysqli_affected_rows($enlace);
         if($prom > 0) {
             echo "Exito";
         } else {
             echo "Error";
         }

     }
