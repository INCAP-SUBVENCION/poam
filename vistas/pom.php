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
    <title>Plan Operativo Mensual</title>

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
                            <h3> <i class="bi bi-calendar4-week"></i> POM</h3>
                            <p class="text-subtitle text-muted">Plan Operativo Mensual</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                   <li class="breadcrumb-item"><a href="principal.php">Inicio</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">POM</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row">
                <?php
                $sql = "SELECT idSubreceptor, codigo, nombre FROM subreceptor ORDER BY idSubreceptor";
                $resultado = mysqli_query($enlace, $sql);
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        ?>
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="stats-icon blue" style="color:azure"><?php echo $fila['codigo']?></div>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted font-semibold"><?php echo $fila['nombre']?></p>
                                            <h6 class="font-extrabold mb-0"><i class="bi bi-calendar4-week"></i> Plan Operativo Mensual</h6>
                                            <a href="pom/detallepom.php?id=<?php echo $fila['idSubreceptor']?>" enctype="multipart/form-data">Ver detalles</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
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