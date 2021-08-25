<?php
include_once('../../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
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
    <link rel="stylesheet" href="../../../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../../../assets/vendors/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="../../../assets/css/app.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: smaller;
        }
    </style>
</head>

<body>

    <body>
        <nav class="navbar navbar-dark" style="background-color:darkblue;">
            <img src="../../../assets/images/vihinvertido.png" width="35">
            <h1 class="text-white"><i class="bi bi-calendar4-week"></i> PLAN OPERATIVO MENSUAL -POM-</h1>
            <?php
            $consulta1 = "SELECT p.nombre, p.apellido,u.usuario,r.nombre as rol,s.nombre as subreceptor FROM usuario u
                LEFT JOIN subreceptor s ON u.subreceptor_id = s.idSubreceptor
                LEFT JOIN catalogo r ON u.rol=r.codigo
                LEFT JOIN persona p ON p.idPersona=u.Persona_id WHERE u.idUsuario =$ID";
            $res1 = $enlace->query($consulta1);
            while ($usuario = mysqli_fetch_assoc($res1)) {
            ?>
                <a class="navbar-brand" href="../enlacerp.php"><i class="bi bi-house-door-fill"></i> Inicio</a>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secundary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 11px;">
                        <i class="bi bi-person-fill"></i> <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?>

                    </button>
                    <ul class="dropdown-menu bg-warning" aria-labelledby="dropdownMenuButton1" style="font-size: 13px;">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-person"></i> Perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-check2-square"></i> Permisos</a></li>
                        <li><a class="dropdown-item" href="../salir.php"><i class="bi bi-x-circle-fill"></i> Cerrar sesion</a></li>
                    </ul>
                </div>
            <?php }
            $res1->close(); ?>
        </nav>

        <!-- Striped rows start -->
        <section class="section">
            <div class="row">
                <?php
                $sql = "SELECT idSubreceptor, codigo, nombre FROM subreceptor WHERE idSubreceptor = $SUBRECEPTOR";
                $resultado = mysqli_query($enlace, $sql);
                while ($subr = mysqli_fetch_assoc($resultado)) {
                ?>
                    <div class="text-center">
                        <h6><?php echo $subr['nombre']; ?></h6>
                    </div>
                <?php
                }
                ?>

            </div>


            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary active" id="pills-periodo_1-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_1" type="button" role="tab" aria-controls="pills-periodo_1" aria-selected="true"><i class="bi bi-calendar4-week"></i> Periodo I</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-info" id="pills-periodo_2-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_2" type="button" role="tab" aria-controls="pills-periodo_2" aria-selected="false"><i class="bi bi-calendar4-week"></i> Periodo II</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-primary" id="pills-periodo_3-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_3" type="button" role="tab" aria-controls="pills-periodo_3" aria-selected="true"><i class="bi bi-calendar4-week"></i> Periodo III</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-warning" id="pills-periodo_4-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_4" type="button" role="tab" aria-controls="pills-periodo_4" aria-selected="false"><i class="bi bi-calendar4-week"></i> Periodo IV</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-success" id="pills-periodo_5-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_5" type="button" role="tab" aria-controls="pills-periodo_5" aria-selected="true"><i class="bi bi-calendar4-week"></i> Periodo V</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-danger" id="pills-periodo_6-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_6" type="button" role="tab" aria-controls="pills-periodo_6" aria-selected="false"><i class="bi bi-calendar4-week"></i> periodo VI</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-periodo_1" role="tabpanel" aria-labelledby="pills-periodo_1-tab">
                    <?php include 'periodo_1.php'; ?>
                </div>
                <div class="tab-pane fade" id="pills-periodo_2" role="tabpanel" aria-labelledby="pills-periodo_2-tab">
                    <?php include 'periodo_2.php'; ?>
                </div>
                <div class="tab-pane fade" id="pills-periodo_3" role="tabpanel" aria-labelledby="pills-periodo_3-tab">
                    <p>Aun no habilitado</p>
                </div>
                <div class="tab-pane fade" id="pills-periodo_4" role="tabpanel" aria-labelledby="pills-periodo_4-tab">
                    <p>Aun no habilitado</p>
                </div>
                <div class="tab-pane fade" id="pills-periodo_5" role="tabpanel" aria-labelledby="pills-periodo_5-tab">
                    <p>Aun no habilitado</p>
                </div>
                <div class="tab-pane fade" id="pills-periodo_6" role="tabpanel" aria-labelledby="pills-periodo_6-tab">
                    <p>Aun no habilitado</p>
                </div>
            </div>

        </section>

        <footer>
            <div class="footer clearfix mb-10 text-muted">
                <div class="float-start">
                    <p>Subvencion 2021 &copy; incap.int</p>
                </div>
            </div>
        </footer>


        <!------ JS ------>
        <script src="../../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../../assets/vendors/jquery/jquery.min.js"></script>
        <script src="../../../assets/vendors/alertifyjs/alertify.js"></script>
        <script src="../../js/pom.js"></script>
        <script src="../../js/utilidad.js"></script>
    </body>

</html>