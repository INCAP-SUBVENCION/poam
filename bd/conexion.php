<?php
    $servidor   = "localhost";
    $usuario    = "root";
    $pass       = "";
    $bd         = "poam";
    $enlace = mysqli_connect($servidor, $usuario, $pass, $bd);
    $enlace ->set_charset("utf8");
    if (!$enlace) {
        $error = "No se pudo conectar a la Base de datos contacte a soporte";
        echo "<script type='text/javascript'> alert('$error'); window.location.href='error.php'; </script>";
        exit;
    }
?>