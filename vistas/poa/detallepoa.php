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
        <nav class="navbar navbar-dark" style="background-color:darkblue;">
            <img src="../../assets/images/vihinvertido.png" width="35">
            <h1 class="text-white">PLAN OPERATIVO ANUAL</h1>
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
                    <a class="btn-outline-secundary" type="button" data-bs-toggle="dropdown"style="font-size: 11px;">
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
            <form name="agregarPoas_1" id="agregarPoas_1" action="javascript: agregarPoa();" method="POST">

                <input type="hidden" name="subreceptor" id="subreceptor" value="<?php echo $SUBRECEPTOR; ?>">
                <input type="hidden" name="usuario" id="usuario" value="<?php echo $ID; ?>">

                <div class="row">
                    <?php
                    $sql = "SELECT idSubreceptor, codigo, nombre FROM subreceptor WHERE idSubreceptor = $SUBRECEPTOR";
                    $resultado = mysqli_query($enlace, $sql);
                    while ($subr = mysqli_fetch_assoc($resultado)) {
                    ?>
                        <div class="text-center">
                            <h5><?php echo $subr['nombre']; ?></h4>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="col-md-6">
                        <div class="card text-dark">
                            <div class="card-headertext-white text-center" style="background-color:darkblue; color:snow">DATOS PRINCIPALES</div>
                            <div class="card-body" style="font-size: 12px;">
                                <div class="row">
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Periodo:</label>
                                        <select name="periodo" id="periodo" class="form-select" style="font-size: 12px;" onchange="periodo_mes();" required>
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
                                        <label class="form-label">Mes:</label>
                                        <select name="mes" id="mes" class="form-select" style="font-size: 12px;" required>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Departamento:</label>
                                        <select name="departamento" id="departamento" onchange="llenarMunicipioCobertura();" class="form-select" style="font-size: 12px;" required>
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            $cd = "SELECT t2.codigo as id, t2.nombre as departamento FROM cobertura t1
                                                    LEFT JOIN catalogo t2 ON t2.codigo = t1.departamento
                                                    LEFT JOIN catalogo t3 ON t3.codigo = t1.municipio
                                                    LEFT JOIN subreceptor t4 ON t4.idSubreceptor = t1.subreceptor_id
                                                    WHERE t1.subreceptor_id = $SUBRECEPTOR GROUP BY t1.departamento";
                                            $rd = $enlace->query($cd);
                                            while ($departamento = $rd->fetch_assoc()) { ?>
                                                <option value="<?php echo $departamento['id'] ?>"><?php echo $departamento['departamento'] ?></option>
                                            <?php }
                                            $rd->close(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-4">
                                        <label class="form-label">Municipio:</label>
                                        <select id="municipio" name="municipio" class="form-select" onchange="calculos();" style="font-size: 12px;" required></select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Nuevos</label>
                                        <input type="text"  name="nuevo" id="nuevo" class="form-control form-control-sm" style="font-size: 12px;" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Recurrentes</label>
                                        <input type="text" name="recurrente" id="recurrente" class="form-control form-control-sm" style="font-size: 12px;" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Proyeccion</label>
                                        <button type="button" class="btn btn-outline-info" onclick="calcularProyeccionPOA();"><i class="bi bi-calculator-fill"></i> Calcular</button>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Total</label>
                                        <input type="text" name="total" id="total" class="form-control form-control-sm" disabled style="color:orangered;">
                                    </div>
                                    <div class="form-group input-group-sm col-sm-4">
                                        <label for="exampleFormControlTextarea1" class="form-label">Observaciones / otros</label>
                                        <input type="text" name="observacion" id="observacion" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-dark">
                            <div class="card-headertext-white text-center" style="background-color:darkblue; color:snow">PROYECCION DE INSUMOS</div>
                            <div class="card-body" style="font-size: 12px;">
                                <div class="row">
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Condon natural</label>
                                        <input type="text" name="cnatural" id="cnatural" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Condon sabor</label>
                                        <input type="text" name="csabor" id="csabor" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Condon femenino</label>
                                        <input type="text" name="cfemenino" id="cfemenino" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Lubricante</label>
                                        <input type="text" name="lubricante" id="lubricante" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Prueba VIH</label>
                                        <input type="text" step="0.0000" name="pruebaVIH" id="pruebaVIH" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Autoprueba VIH</label>
                                        <input type="text" step="0.0000" name="autoPrueba" id="autoPrueba" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Reactivo esperado
                                        </label>
                                        <input type="hidden" name="reactivo" id="reactivo">
                                        <div class="position-relative">
                                            <input type="text" step="0.0000" step="0.01" name="reactivoEs" id="reactivoEs" class="form-control form-control-sm" disabled>
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="porcentaje">
                                        </div>
                                        </span>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Prueba sifilis</label>
                                        <input type="text" name="sifilis" id="sifilis" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2 text-center">
                                        <label for="form-label">..::..</label>
                                        <button type="submit" class="btn btn-outline-success"><i class="bi bi-save-fill"></i> Guardar</button>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2 text-center">
                                        <label for="form-label">..::..</label>
                                        <button type="reset" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-square-fill"></i> Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary active" id="pills-semestre_1-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_1"
                    type="button" role="tab" aria-controls="pills-semestre_1" aria-selected="true"><i class="bi bi-calendar-range-fill"></i> Semestre 1</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-info" id="pills-semestre_2-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_2"
                    type="button" role="tab" aria-controls="pills-semestre_2" aria-selected="false"><i class="bi bi-calendar-range-fill"></i> Semestre 2</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-warning" id="pills-semestre_3-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_3"
                    type="button" role="tab" aria-controls="pills-semestre_3" aria-selected="true"><i class="bi bi-calendar-range-fill"></i> Semestre 3</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-success" id="pills-semestre_4-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_4"
                    type="button" role="tab" aria-controls="pills-semestre_4" aria-selected="false"><i class="bi bi-calendar-range-fill"></i> Semestre 4</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-primary" id="pills-semestre_5-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_5"
                    type="button" role="tab" aria-controls="pills-semestre_5" aria-selected="true"><i class="bi bi-calendar-range-fill"></i> Semestre 5</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-danger" id="pills-semestre_6-tab" data-bs-toggle="pill" data-bs-target="#pills-semestre_6"
                    type="button" role="tab" aria-controls="pills-semestre_6" aria-selected="false"><i class="bi bi-calendar-range-fill"></i> Semestre 6</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade" id="pills-semestre_1" role="tabpanel" aria-labelledby="pills-semestre_1-tab">
                    <?php include 'semestre1.php';?>
                </div>
                <div class="tab-pane fade show active" id="pills-semestre_2" role="tabpanel" aria-labelledby="pills-semestre_2-tab">
                    <?php include 'semestre2.php';?>
                </div>
                <div class="tab-pane fade" id="pills-semestre_3" role="tabpanel" aria-labelledby="pills-semestre_3-tab">
                    <p>Aun no habilitado</p>
                </div>
                <div class="tab-pane fade" id="pills-semestre_4" role="tabpanel" aria-labelledby="pills-semestre_4-tab">
                <p>Aun no habilitado</p>
                </div>
                <div class="tab-pane fade" id="pills-semestre_5" role="tabpanel" aria-labelledby="pills-semestre_5-tab">
                <p>Aun no habilitado</p>
                </div>
                <div class="tab-pane fade" id="pills-semestre_6" role="tabpanel" aria-labelledby="pills-semestre_6-tab">
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
        <script src="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/vendors/jquery/jquery.min.js"></script>
        <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
        <script src="../../controlador/controladorPOA.js"></script>
        <script src="../../controlador/controladorUtilidad.js"></script>
    </body>

</html>
