<?php
include_once('../../bd/conexion.php');
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
        <nav class="navbar navbar-dark" style="background-color:darkblue;">
            <img src="../../assets/images/vihinvertido.png" width="35">
            <h1 class="text-white"><i class="bi bi-fullscreen"></i> METAS</h1>
            <?php
            $consulta1 = "SELECT p.nombre, p.apellido,u.usuario,r.nombre as rol,s.nombre as subreceptor FROM usuario u
                LEFT JOIN subreceptor s ON u.subreceptor_id = s.idSubreceptor
                LEFT JOIN catalogo r ON u.rol=r.codigo
                LEFT JOIN persona p ON p.idPersona=u.Persona_id WHERE u.idUsuario =$ID";
            $res1 = $enlace->query($consulta1);
            while ($usuario = mysqli_fetch_assoc($res1)) {
            ?>
                <a class="navbar-brand" href="../poa.php"><i class="bi bi-house-door-fill"></i> Inicio</a>
                <div class="dropdown">
                    <a class="btn-outline-secundary" type="button" data-bs-toggle="dropdown" style="font-size: 11px;">
                        <i class="bi bi-person-fill text-white"></i> <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?>

                    </a>
                    <ul class="dropdown-menu" style="font-size: 13px;">
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
            <form name="agregarMeta" id="agregarMeta" action="javascript: agregarResumen();" method="POST">
                <input type="hidden" id="subreceptor" name="subreceptor" value="<?php echo $SUBRECEPTOR; ?>">
                <input type="hidden" name="cobertura" id="cobertura">
                <div class="card border-success">
                    <div class="text-white text-center" style="background-color:navy;">RESUMEN DE METAS</div>
                    <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                        <div class="row">
                            <div class="form-group input-group-sm col-sm-1">
                                <label class="form-label">Periodo</label>
                                <select name="periodo" id="periodo" class="form-control" style="font-size: 12px;" required>
                                    <option value="">Seleccionar ...</option>
                                    <option value="1">Periodo I</option>
                                    <option value="2">Periodo II</option>
                                    <option value="3">Periodo III</option>
                                    <option value="4">Periodo IV</option>
                                    <option value="5">Periodo V</option>
                                    <option value="6">Periodo VI</option>
                                </select>
                            </div>
                            <div class="form-group input-group-sm col-sm-2">
                                <label class="form-label">Municipio:</label>
                                <select name="municipio" id="municipio" onchange="obtenerMeta();" style="font-size: 12px;" class="form-select" required>
                                    <option value="">Seleccionar...</option>
                                    <?php
                                    $cm = "SELECT t1.municipio  as id, t2.nombre as municipio FROM cobertura t1
                                            LEFT JOIN catalogo t2 ON t2.codigo = t1.municipio WHERE t1.subreceptor_id = $SUBRECEPTOR";
                                    $rm = $enlace->query($cm);
                                    while ($municipio = $rm->fetch_assoc()) { ?>
                                        <option value="<?php echo $municipio['id'] ?>"><?php echo $municipio['municipio'] ?></option>
                                    <?php }
                                    $rm->close(); ?>
                                </select>
                            </div>

                            <div class="form-group input-group-sm col-sm-1">
                                <label class="form-label">Nuevos</label>
                                <input type="number" name="nuevo" id="nuevo" onchange="calcularMeta();" class="form-control form-control-sm" style="font-size: 12px;" disabled>
                            </div>
                            <div class="form-group input-group-sm col-sm-1">
                                <label class="form-label">Recurrentes</label>
                                <input type="number" min="0" name="recurrente" id="recurrente" onchange="calcularMeta();" class="form-control form-control-sm" style="font-size: 12px;" disabled>
                            </div>
                            <div class="form-group input-group-sm col-sm-1">
                                <label class="form-label"># Meses</label>
                                <input type="number" min="0" name="meses" id="meses" onchange="calcularMeta();" class="form-control form-control-sm" style="font-size: 12px;" required>
                            </div>
                            <div class="form-group input-group-sm col-sm-2">
                                <label class="form-label">Meta nuevo mensual</label>
                                <input type="text" name="metaNuevos" id="metaNuevos" class="form-control form-control-sm" style="font-size: 12px;" disabled>
                            </div>
                            <div class="form-group input-group-sm col-sm-2">
                                <label class="form-label">Meta recurrente mensual</label>
                                <input type="text" name="metaRecurrentes" id="metaRecurrentes" class="form-control form-control-sm" style="font-size: 12px;" disabled>
                            </div>
                            <div class="form-group input-group-sm col-sm-2">
                                <br>
                                <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('¿Está seguro que desea guardar?')"><i class="bi bi-plus-square-fill"></i> Guardar</button>
                                <button type="reset" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-square-fill"></i> Cancelar</button </div>
                            </div>
                        </div>
                    </div>
            </form>


            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary active" id="pills-semestre_1-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_1" type="button" role="tab" aria-controls="pills-semestre_1" aria-selected="true">
                        <i class="bi bi-fullscreen"></i> PERIODO I</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-info" id="pills-semestre_2-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_2" type="button" role="tab" aria-controls="pills-semestre_2" aria-selected="false">
                        <i class="bi bi-fullscreen"></i> PERIODO II</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-primary" id="pills-semestre_3-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_3" type="button" role="tab" aria-controls="pills-semestre_3" aria-selected="true">
                        <i class="bi bi-fullscreen"></i> PERIODO III</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-warning" id="pills-semestre_4-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_4" type="button" role="tab" aria-controls="pills-semestre_4" aria-selected="false">
                        <i class="bi bi-fullscreen"></i> PERIODO IV</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-success" id="pills-semestre_5-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_5" type="button" role="tab" aria-controls="pills-semestre_5" aria-selected="true">
                        <i class="bi bi-fullscreen"></i> PERIODO V</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-danger" id="pills-semestre_6-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_6" type="button" role="tab" aria-controls="pills-semestre_6" aria-selected="false">
                        <i class="bi bi-fullscreen"></i> PERIODO VI</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-semestre_1" role="tabpanel" aria-labelledby="pills-semestre_1-tab">
                    <table class="table table-hover table-bordered">
                        <thead class="text-center">
                            <th>#</th>
                            <th>Municipio</th>
                            <th>Periodo</th>
                            <th># Meses</th>
                            <th>Meta mensual Nuevos</th>
                            <th>Meta mensual Recurrentes</th>
                            <th>Opcion</th>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $contador1 = 1;
                            $consultaR = "SELECT t3.nombre as municipio, t1.periodo, t1.meses, t1.nuevo, t1.recurrente FROM resumen t1
                            LEFT JOIN cobertura t2 ON t2.idCobertura = t1.cobertura_id
                            LEFT JOIN catalogo t3 ON t3.codigo = t2.municipio WHERE t2.subreceptor_id = $SUBRECEPTOR AND t1.periodo = 1";
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
                <div class="tab-pane fade" id="pills-semestre_2" role="tabpanel" aria-labelledby="pills-semestre_2-tab">
                    <p>Periodo 2 aun no habilitado</p>
                </div>
                <div class="tab-pane fade" id="pills-semestre_3" role="tabpanel" aria-labelledby="pills-semestre_3-tab">
                    <p>Periodo 3 aun no habilitado</p>
                </div>
                <div class="tab-pane fade" id="pills-semestre_4" role="tabpanel" aria-labelledby="pills-semestre_4-tab">
                    <p>Periodo 4 aun no habilitado</p>
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
        <script src="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/vendors/jquery/jquery.min.js"></script>
        <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
        <script src="../../controlador/controladorPOA.js"></script>
        <script src="../../controlador/controladorUtilidad.js"></script>
    </body>

</html>