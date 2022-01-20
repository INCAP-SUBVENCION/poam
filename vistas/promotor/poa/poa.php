<?php
include_once('../../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: ../error.php');
}
$ID = $_SESSION['idUsuario'];
$ROL = $_SESSION['rol'];
$SUBRECEPTOR = $_SESSION['subreceptor_id'];
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
    <link rel="stylesheet" href="../../../assets/vendors/datatable/jquery.dataTables.min.css">
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
            <img src="../../../assets/images/vihinvertido.png" width="45" alt="">

            <h2 class="text-white">PLAN OPERATIVO ANUAL -POA-</h2>
            <?php
            $consulta1 = "SELECT p.nombre, p.apellido,u.usuario,r.nombre as rol,s.nombre as subreceptor FROM usuario u
                LEFT JOIN subreceptor s ON u.subreceptor_id = s.idSubreceptor
                LEFT JOIN catalogo r ON u.rol=r.codigo
                LEFT JOIN persona p ON p.idPersona=u.Persona_id WHERE u.idUsuario = $ID";
            $res1 = $enlace->query($consulta1);
            while ($usuario = mysqli_fetch_assoc($res1)) {
            ?>
                <a class="navbar-brand" href="../promotor.php"><em class="bi bi-house-door-fill"></em> Inicio</a>
                <div class="dropdown">
                    <a class="btn-outline-secundary text-white" type="button" data-bs-toggle="dropdown">
                        <em class="bi bi-person-fill"></em> <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?>

                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../perfil.php"><em class="bi bi-file-earmark-person"></em> Perfil</a></li>
                        <li><a class="dropdown-item" href="../salir.php"><em class="bi bi-x-circle-fill"></em> Cerrar sesion</a></li>
                    </ul>
                </div>
            <?php }
            $res1->close(); ?>
            <img src="../../../assets/images/incap.png" width="75" alt="">
        </nav>


        <!-- Striped rows start -->
        <section class="section">

            <ul class="nav nav-pills" id="pills-tab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary active" id="pills-periodo_3-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_3" type="button">
                        <em class="bi bi-calendar-range-fill"></em> Periodo III</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary" id="pills-periodo_4-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_4" type="button">
                        <em class="bi bi-calendar-range-fill"></em> Periodo IV</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary" id="pills-periodo_5-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_5" type="button">
                        <em class="bi bi-calendar-range-fill"></em> Periodo V</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary" id="pills-periodo_6-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_6" type="button">
                        <em class="bi bi-calendar-range-fill"></em> Periodo VI</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-periodo_3">
                    <?php include 'periodo_3.php'; ?>
                </div>
                <div class="tab-pane fade" id="pills-periodo_4">
                    <?php include 'periodo_4.php'; ?>
                </div>
                <div class="tab-pane fade" id="pills-periodo_5">
                    <p>PERIODO 5 no habilitado</p>
                </div>
                <div class="tab-pane fade" id="pills-periodo_6">
                    <p>PERIODO 6 habilitado</p>
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
        <script src="../../../assets/vendors/datatable/jquery.dataTables.min.js"></script>
        <script src="../../js/poa.js"></script>
        <script src="../../js/utilidad.js"></script>
        <script src="../../js/estados.js"></script>
        <script src="../../js/tabla.js"></script>

    </body>

</html>