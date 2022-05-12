<?php
include_once('../../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
$ID = $_SESSION['idUsuario'];
$SUBRECEPTOR = $_SESSION['subreceptor_id'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metas</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../../../assets/vendors/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="../../../assets/css/app.css">
    <link rel="stylesheet" href="../../../assets/vendors/datatable/jquery.dataTables.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: smaller;

        }
    </style>
</head>

<body>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <div class="container-fluid">
                <img src="../../../assets/images/vihinvertido.png" width="45" alt="">
                <a class="navbar-brand" href="#">.:. SUPERVISIONES .:.</a>
                <button class="navbar-toggler btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <?php
                        $consulta1 = "SELECT p.nombre, p.apellido,u.usuario,r.nombre as rol,s.nombre as subreceptor FROM usuario u
                LEFT JOIN subreceptor s ON u.subreceptor_id = s.idSubreceptor
                LEFT JOIN catalogo r ON u.rol=r.codigo
                LEFT JOIN persona p ON p.idPersona=u.Persona_id WHERE u.idUsuario =$ID";
                        $res1 = $enlace->query($consulta1);
                        while ($usuario = mysqli_fetch_assoc($res1)) {
                        ?>

                            <a class="navbar-brand" href="../cmesr.php"><em class="bi bi-house-door-fill"></em> Inicio</a>
                            <div class="dropdown">
                                <a class="btn-outline-secundary text-white" type="button" data-bs-toggle="dropdown">
                                    <em class="bi bi-person-fill"></em> <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../perfil.php"><i class="bi bi-file-earmark-person"></i> Perfil</a></li>
                                    <li><a class="dropdown-item" href="../salir.php"><i class="bi bi-x-circle-fill"></i> Cerrar sesion</a></li>
                                </ul>
                            </div>
                    </div>
                <?php }
                        $res1->close(); ?>
                </div>
            </div>
        </nav>

        <!-- Striped rows start -->
        <section class="section">
            <?php
            $sql = "SELECT idSubreceptor, codigo, nombre FROM subreceptor WHERE idSubreceptor = $SUBRECEPTOR";
            $resultado = mysqli_query($enlace, $sql);
            while ($subr = mysqli_fetch_assoc($resultado)) {
            ?>
                <div class="text-center">
                    <h4><?php echo $subr['nombre']; ?></h4>
                </div>
            <?php
            }
            ?>


            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary active" id="pills-semestre_3-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_3" type="button" role="tab" aria-controls="pills-semestre_3" aria-selected="true">
                        <i class="bi bi-fullscreen"></i> PERIODO III</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary" id="pills-semestre_4-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_4" type="button" role="tab" aria-controls="pills-semestre_4" aria-selected="false">
                        <i class="bi bi-fullscreen"></i> PERIODO IV</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary" id="pills-semestre_5-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_5" type="button" role="tab" aria-controls="pills-semestre_5" aria-selected="true">
                        <i class="bi bi-fullscreen"></i> PERIODO V</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary" id="pills-semestre_6-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_6" type="button" role="tab" aria-controls="pills-semestre_6" aria-selected="false">
                        <i class="bi bi-fullscreen"></i> PERIODO VI</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!--- PERIODO III--->
                <div class="tab-pane fade show active" id="pills-semestre_3" role="tabpanel" aria-labelledby="pills-semestre_3-tab">
                    <select id="" class="form-select">
                        <option value="">Seleccionar ... </option>
                        <?php
                        $sql = "SELECT u.idUsuario, CONCAT(p.nombre,' ',p.apellido) as supervisor FROM usuario u
                                LEFT JOIN persona p ON p.idPersona=u.persona_id
                                WHERE subreceptor_id=$SUBRECEPTOR AND rol='R006'";
                        $resultado = $enlace->query($sql);
                        while ($supervisores = $resultado->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $supervisores['idUsuario']; ?>" onclick="supervisor(3, <?php echo $supervisores['idUsuario']; ?>)"><?php echo $supervisores['supervisor']; ?></option>
                        <?php } ?>
                    </select>
                    <table class="table table-bordered" aria-describedby="">
                        <thead class='text-center'>
                            <th>PERIODO</th>
                            <th>MES</th>
                            <th>MUNICIPIO</th>
                            <th>LUGAR</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>NUEVOS</th>
                            <th>RECURRENTES</th>
                            <th>TOTAL</th>
                            <th>PROMOTOR</th>
                            <th>OBSERVACION</th>
                            <th>OPCION</th>
                        </thead>
                        <tbody class="text-center" style="font-size: 11px;" id="resultadoSupervisor">

                        </tbody>
                    </table>
                </div>
                <!--- PERIODO IV--->
                <div class="tab-pane fade" id="pills-semestre_4" role="tabpanel" aria-labelledby="pills-semestre_4-tab">

                </div>
                <!--- PERIODO V--->
                <div class="tab-pane fade" id="pills-semestre_5" role="tabpanel" aria-labelledby="pills-semestre_5-tab">
                    <p>Periodo 5 aun no habilitado</p>
                </div>
                <!--- PERIODO VI--->
                <div class="tab-pane fade" id="pills-semestre_6" role="tabpanel" aria-labelledby="pills-semestre_6-tab">
                    <p>Periodo 6 aun no habilitado</p>
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
        <script src="../../js/utilidad.js"></script>
        <script src="../../../assets/vendors/datatable/jquery.dataTables.min.js"></script>
        <script src="../../js/otrasTablas.js"></script>
    </body>

</html>