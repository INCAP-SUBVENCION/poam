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
    <title>Metas</title>

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
            <img src="../../../assets/images/vihinvertido.png" width="35" alt="">
            <h1 class="text-white"><em class="bi bi-fullscreen"></em> METAS</h1>
            <?php
            $consulta1 = "SELECT p.nombre, p.apellido,u.usuario,r.nombre as rol,s.nombre as subreceptor FROM usuario u
                LEFT JOIN subreceptor s ON u.subreceptor_id = s.idSubreceptor
                LEFT JOIN catalogo r ON u.rol=r.codigo
                LEFT JOIN persona p ON p.idPersona=u.Persona_id WHERE u.idUsuario =$ID";
            $res1 = $enlace->query($consulta1);
            while ($usuario = mysqli_fetch_assoc($res1)) {
            ?>
                <a class="navbar-brand" href="../enlacerp.php"><em class="bi bi-house-door-fill"></em> Inicio</a>
                <div class="dropdown">
                    <a class="btn-outline-secundary" type="button" data-bs-toggle="dropdown" style="font-size: 11px;">
                        <em class="bi bi-person-fill text-white"></em> <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?>

                    </a>
                    <ul class="dropdown-menu" style="font-size: 13px;">
                        <li><a class="dropdown-item" href="#"><em class="bi bi-file-earmark-person"></em> Perfil</a></li>
                        <li><a class="dropdown-item" href="#"><em class="bi bi-check2-square"></em> Permisos</a></li>
                        <li><a class="dropdown-item" href="../salir.php"><em class="bi bi-x-circle-fill"></em> Cerrar sesion</a></li>
                    </ul>
                </div>
            <?php }
            $res1->close(); ?>
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

                <div class="tab-pane fade show active" id="pills-semestre_3" role="tabpanel" aria-labelledby="pills-semestre_3-tab">
                    <table class="table table-hover table-bordered">
                        <thead class="text-center">
                            <th>#</th>
                            <th>Municipio</th>
                            <th>Periodo</th>
                            <th># Meses</th>
                            <th>Meta mensual Nuevos</th>
                            <th>Meta mensual Recurrentes</th>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $contador1 = 1;
                            $consultaR = "SELECT t3.nombre as municipio, t1.periodo, t1.meses, t1.nuevo, t1.recurrente FROM resumen t1
                            LEFT JOIN cobertura t2 ON t2.idCobertura = t1.cobertura_id
                            LEFT JOIN catalogo t3 ON t3.codigo = t2.municipio WHERE t2.subreceptor_id = $SUBRECEPTOR AND t1.periodo = 3";
                            $resultadoR = $enlace->query($consultaR);
                            while ($resumen = $resultadoR->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $contador1++; ?></td>
                                    <td><?php echo $resumen['municipio']; ?></td>
                                    <td><?php echo $resumen['periodo']; ?></td>
                                    <td><?php echo $resumen['meses']; ?></td>
                                    <td style="background-color:lightgreen;"><?php echo $resumen['nuevo']; ?></td>
                                    <td style="background-color:lightsalmon;"><?php echo $resumen['recurrente']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-semestre_4" role="tabpanel" aria-labelledby="pills-semestre_4-tab">
                    <table class="table table-hover table-bordered" aria-describedby="">
                        <thead class="text-center">
                            <th>#</th>
                            <th>Municipio</th>
                            <th>Periodo</th>
                            <th># Meses</th>
                            <th>Meta mensual Nuevos</th>
                            <th>Meta mensual Recurrentes</th>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $contador1 = 1;
                            $consultaR = "SELECT t3.nombre as municipio, t1.periodo, t1.meses, t1.nuevo, t1.recurrente FROM resumen t1
                            LEFT JOIN cobertura t2 ON t2.idCobertura = t1.cobertura_id
                            LEFT JOIN catalogo t3 ON t3.codigo = t2.municipio WHERE t2.subreceptor_id = $SUBRECEPTOR AND t1.periodo = 4";
                            $resultadoR = $enlace->query($consultaR);
                            while ($resumen = $resultadoR->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $contador1++; ?></td>
                                    <td><?php echo $resumen['municipio']; ?></td>
                                    <td><?php echo $resumen['periodo']; ?></td>
                                    <td><?php echo $resumen['meses']; ?></td>
                                    <td style="background-color:lightgreen;"><?php echo $resumen['nuevo']; ?></td>
                                    <td style="background-color:lightsalmon;"><?php echo $resumen['recurrente']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-semestre_5" role="tabpanel" aria-labelledby="pills-semestre_5-tab">
                    <p>Periodo 5 aun no habilitado</p>
                </div>
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
        <script src="../../js/poa.js"></script>
        <script src="../../js/utilidad.js"></script>
    </body>

</html>