<?php
include_once('../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
$ID =$_SESSION['idUsuario'];
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
    <link rel="stylesheet" href="../assets/css/app.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: smaller;
        }
    </style>
</head>

<body>
<div id="app">
        <div id="main">
            <header class="mb-1">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">

                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>POA</h3>
                            <p class="text-subtitle text-muted">Plan Operativo Anual</p>
                        </div>

                    </div>
                </div>
                <div class="row">
                <?php
                $sql = "SELECT codigo, nombre FROM subreceptor ORDER BY idSubreceptor";
                $resultado = mysqli_query($enlace, $sql);
                $filas = mysqli_affected_rows($enlace);
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="stats-icon blue" style="color:azure">'.$fila['codigo'].'</div>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted font-semibold">'.$fila['nombre'].'</p>
                                            <h6 class="font-extrabold mb-0">Plan Operativo Anual</h6>
                                            <a href="detallepoa.php">Ver detalles</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  
                        ';
                    }
                ?>
  </div>





            </div>


        </div>
    </div>

    <!------ JS ------>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <?php
    include 'componente/menu.php';
    ?>
</body>

</html>