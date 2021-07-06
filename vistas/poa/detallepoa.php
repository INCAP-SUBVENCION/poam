<?php
include_once('../../bd/conexion.php');
header('Content-Type: text/html; charset=ISO-8859-1');
session_start();
$ID = $_SESSION['idUsuario'];
$SUBRECEPTOR = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Operativo Anual</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../../assets/vendors/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: smaller;

        }
    </style>
</head>

<body>


    <body>
        <nav class="navbar navbar-dark" style="background-color:coral">
            <img src="../../assets/images/vihinvertido.png" width="35">
            <h1>PLAN OPERATIVO ANUAL</h1>
            <?php
            $sql1 = "SELECT p.nombre, p.apellido,u.usuario,r.nombre as rol,s.nombre as subreceptor FROM usuario u 
                LEFT JOIN subreceptor s ON u.subreceptor_id = s.idSubreceptor
                LEFT JOIN catalogo r ON u.rol=r.idCatalogo
                LEFT JOIN persona p ON p.idPersona=u.Persona_id WHERE u.idUsuario =$ID";
            $query1 = mysqli_query($enlace, $sql1);
            while ($data1 = mysqli_fetch_assoc($query1)) {
            ?>
                <a class="navbar-brand" href="../poa.php">Inicio</a>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secundary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 11px;">
                        <i class="bi bi-person-fill"></i> <?php echo $data1['nombre'] . ' ' . $data1['apellido']; ?>

                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="font-size: 13px;">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-person"></i> Perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-check2-square"></i> Permisos</a></li>
                        <li><a class="dropdown-item" href="salir.php"><i class="bi bi-x-circle-fill"></i> Cerrar sesion</a></li>
                    </ul>
                </div>
            <?php } ?>
        </nav>


        <!-- Striped rows start -->
        <section class="section">

            <ul class="nav nav-tabs mb-1" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active btn btn-outline-primary" data-bs-toggle="pill" data-bs-target="#semestre_1" 
                    type="button" role="tab" aria-controls="semestre_1" aria-selected="true">
                    <i class="bi bi-briefcase"></i> Semestre 1</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn btn-outline-primary" 
                    data-bs-toggle="pill" data-bs-target="#semestre_2" type="button" role="tab" aria-controls="semestre_2" 
                    aria-selected="false">
                    <i class="bi bi-briefcase-fill"></i> Semestre 2</button>
                </li>
            </ul>
            <div class="tab-content" id="semenstres">
                <div class="tab-pane fade show active" id="semestre_1" role="tabpanel" aria-labelledby="sementre-1">
                <?php include'semestre_1.php';?>
                </div>

                <div class="tab-pane fade" id="semestre_2" role="tabpanel" aria-labelledby="pills-profile-tab">
                <?php include'semestre_2.php';?>
                </div>
            </div>

        </section>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>Subvencion 2021 &copy; incap.int</p>
                </div>
            </div>
        </footer>


        <!------ JS ------>
        <script src="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/vendors/jquery/jquery.min.js"></script>
        <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
        <script src="../../controlador/poa.js"></script>
        <script src="../../controlador/utilidad.js"></script>
        <?php
        include '../modal/nuevoPoas2.php';
        include '../modal/nuevoPoa.php';
        ?>
    </body>

</html>