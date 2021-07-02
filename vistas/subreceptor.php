<?php
include_once('../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
$ID = $_SESSION['idUsuario'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subreceptor</title>

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

                            <h3><i class="bi bi-diagram-2-fill"></i> SUBRECEPTORES</h3>
                            <p class="text-subtitle text-muted">Registro de subreceptores</p>
                        </div>

                    </div>
                </div>
                <section class="section">
                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#nuevoSub"><i class="bi bi-plus-circle"></i> Nuevo</button>
                    <table class="table table-striped table-light table-bordered">
                        <thead class="table-dark text-center">
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th># Condon natural</th>
                            <th># Condon sabor</th>
                            <th># Condon femenino</th>
                            <th># Lubricante</th>
                            <th>% Prueba VIH</th>
                            <th>% Auto-prueba VIH</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $contador = 1;
                            $sql = "SELECT * FROM subreceptor";
                            $consulta = mysqli_query($enlace, $sql);
                            while ($data = mysqli_fetch_assoc($consulta)) {
                            ?>
                                <tr>
                                    <td><?php echo $contador++; ?></td>
                                    <td><?php echo $data['codigo']; ?></td>
                                    <td><?php echo $data['nombre']; ?></td>
                                    <td><?php echo $data['enatural']; ?></td>
                                    <td><?php echo $data['esabor']; ?></td>
                                    <td><?php echo $data['efemenino']; ?></td>
                                    <td><?php echo $data['elubricante']; ?></td>
                                    <td><?php echo $data['ppvih']; ?></td>
                                    <td><?php echo $data['pautoprueba']; ?></td>
                                    <td>
                                        <a class="btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarSub<?php echo $data['idSubreceptor']; ?>"><i class="bi bi-pencil-fill"></i> Editar</a>
                                    </td>
                                </tr>
                                <?php
                                include 'modal/editarSubreceptor.php';
                                ?>
                            <?php
                            }
                            ?>
                        </tbody>

                    </table>

                </section>

            </div>
        </div>
    </div>

    <!------ JS ------>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../assets/vendors/alertifyjs/alertify.js"></script>
    <script src="../controlador/subreceptor.js"></script>

    <!---- ARCHIVOS EXTERNOS--->
    <?php
    include 'componente/menu.php';
    include 'modal/nuevoSubreceptor.php';
    ?>
</body>

</html>