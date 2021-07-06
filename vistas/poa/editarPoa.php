<?php
include_once('../../bd/conexion.php');
header('Content-Type: text/html; charset=ISO-8859-1');
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Operativo Anual</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../assets/vendors/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: smaller;

        }
    </style>
</head>

<body>


    <body>
        <nav class="navbar navbar-dark bg-warning">
            <img src="../assets/images/vihinvertido.png" width="35">
            <a class="navbar-brand" href="poa.php">Inicio</a>
            <a href="">Faustino Lopez Ramos</a>
        </nav>


        <!-- Striped rows start -->
        <section class="section">


        </section>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>Subvencion 2021 &copy; incap.int</p>
                </div>
            </div>
        </footer>


        <!------ JS ------>
        <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/vendors/jquery/jquery.min.js"></script>
        <script src="../assets/vendors/alertifyjs/alertify.js"></script>
        <script src="../controlador/poa.js"></script>
        <script src="../controlador/utilidad.js"></script>
        <!-- Archivos externos --->
        <?php
        include 'modal/nuevoPoa.php';
        ?>
    </body>

</html>