<?php
include_once '../../../bd/conexion.php';
header('Content-Type: text/html;charset=utf-8');
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: ../salir.php');
}
$ID = $_SESSION['idUsuario'];
$SUBRECEPTOR = $_SESSION['subreceptor_id'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.:. POM .:.</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../../../assets/vendors/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="../../../assets/css/app.css">
    <link rel="stylesheet" href="../../../assets/vendors/datatable/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../../../assets/css/select2.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: smaller;
        }
    </style>
</head>

<body>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <div class="container-fluid">
                <img src="../../../assets/images/vihinvertido.png" width="45" alt="">
                <a class="navbar-brand" href="#">.:. POM .:.</a>
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
            while ($subr = mysqli_fetch_assoc($resultado)) { ?>
                <div class="text-center">
                    <h6><?php echo $subr['nombre']; ?></h6>
                </div>
            <?php }
            ?>
            <div class="row" id="nuevoPom">
                <div class="col-md-12">
                    <div class="row">

                        <div class="form-group input-group-sm col-sm-1">
                            <select name="cperiodo" id="cperiodo" class="form-select" style="font-size: 11px;">
                                <option value="">Seleccionar...</option>
                                <option value="3">Periodo III</option>
                                <option value="4">Periodo IV</option>
                                <option value="5">Periodo V</option>
                                <option value="6">Periodo VI</option>
                            </select>
                        </div>
                        <div class="form-group input-group-sm col-sm-3">
                            <select name="cmunicipio" id="cmunicipio" class="form-control" onchange="obtenerMesPom(); obtenerCantidadPromotor();" style="font-size: 11px;">
                                <option value="">Seleccionar municipio</option>
                                <?php
                                $cd = "SELECT t1.municipio  as id, t2.nombre as municipio FROM cobertura t1
                                        LEFT JOIN catalogo t2 ON t2.codigo = t1.municipio
                                        WHERE t1.subreceptor_id =  $SUBRECEPTOR AND t1.periodo = 3";
                                $rd = $enlace->query($cd);
                                while ($municipio = $rd->fetch_assoc()) { ?>
                                    <option value="<?php echo $municipio['id']; ?>"><?php echo $municipio['municipio']; ?></option>
                                <?php }
                                $rd->close();
                                ?>
                            </select>
                        </div>
                        <!--Resultado de obtenerCantidadPromotor() -->
                        <input type="hidden" name="promotor" id="promotor">
                        <input type="hidden" name="dias" id="dias">

                        <div class="form-group input-group-sm col-sm-2">
                            <select name="cmes" id="cmes" class="form-control" style="font-size: 11px;" onchange="consultaPoa();">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered" aria-describedby="">
                        <thead>
                            <th id=""></th>
                        </thead>
                        <tbody class="text-center" style="font-size: 10px;" id="resultadoPOA">

                        </tbody>
                    </table>
                </div>


                <div class="col-md-4">
                    <form name="agregarPom" id="agregarPom" action="javascript: agregarPOM();" method="POST">

                        <input type="hidden" name="subreceptor" id="subreceptor" value="<?php echo $SUBRECEPTOR; ?>">
                        <input type="hidden" name="usuario" id="usuario" value="<?php echo $ID; ?>">
                        <input type="hidden" name="poa" id="poa">

                        <div class="card text-dark">
                            <div class="text-white text-center" style="background-color:dodgerblue; font-weight: bold">DATOS PRINCIPALES</div>
                            <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                                <div class="row">
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Periodo:</label>
                                        <input type="text" name="periodo" id="periodo" class="form-control" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Mes:</label>
                                        <input type="text" name="nombreMes" id="nombreMes" class="form-control" disabled>
                                        <input type="hidden" name="mes" id="mes">
                                    </div>
                                    <div class="form-group input-group-sm col-sm-6">
                                        <label class="form-label">Municipio:</label>
                                        <input type="text" name="nombreMunicipio" id="nombreMunicipio" class="form-control" disabled>
                                        <input type="hidden" name="municipio" id="municipio">
                                    </div>
                                    <div class="form-group input-group-sm col-sm-6">
                                        <label class="form-label">Fecha:</label>
                                        <input type="date" name="fecha" id="fecha" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Inicio:</label>
                                        <input type="time" name="inicio" id="inicio" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Fin:</label>
                                        <input type="time" name="fin" id="fin" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-12">
                                        <label class="form-label">Lugar:</label>
                                        <select class="js-lugar form-control" id="lugar">
                                            <option value=""></option>
                                            <?php
                                            $rlugar = $enlace->query("SELECT lugar FROM pom WHERE subreceptor_id = $SUBRECEPTOR GROUP BY lugar");
                                            while ($lugar = $rlugar->fetch_assoc()) { ?>
                                                <option value="<?php echo $lugar['lugar']; ?>"><?php echo $lugar['lugar']; ?></option>
                                            <?php }
                                            $rd->close();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-md-8">
                    <div class="card text-dark">
                        <div class="text-white text-center" style="background-color:dodgerblue; font-weight: bold">PROYECCIÓN DE INSUMOS</div>
                        <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                            <div class="row">
                                <div class="form-group input-group-sm col-sm-3">
                                    <label class="form-label">Promotor responsable:</label>
                                    <select name="promotores" id="promotores" class="form-control form-control-sm" style="font-size: 12px;" required>
                                        <option value="">Seleccionar..</option>
                                        <?php
                                        $resultado = $enlace->query("SELECT DISTINCT t3.idPromotor, t4.nombre, t4.apellido FROM asignacion t1 
                                                LEFT JOIN cobertura t2 ON t2.idCobertura=t1.cobertura_id 
                                                LEFT JOIN promotor t3 ON t3.idPromotor=t1.promotor_id
                                                LEFT JOIN persona t4 ON t4.idPersona=t3.persona_id 
                                                WHERE t2.subreceptor_id = $SUBRECEPTOR 
                                                GROUP BY t3.idPromotor, t4.nombre, t4.apellido");
                                        while ($prom = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $prom['idPromotor']; ?>"><?php echo $prom['nombre'] . ' ' . $prom['apellido']; ?></option>
                                        <?php }
                                        $resultado->close();
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Nuevos</label>
                                    <input type="number" min="0.00" step="0.01" name="nuevo" id="nuevo" oninput="sumarPom();" class="form-control form-control-sm" style="font-size: 12px;" required>
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Recurrentes</label>
                                    <input type="number" min="0.00" step="0.01" name="recurrente" id="recurrente" oninput="sumarPom();" class="form-control form-control-sm" style="font-size: 12px;" required>
                                </div>
                                <div class="form-group input-group-sm col-sm-1">
                                    <label class="form-label">Total</label>
                                    <input type="text" name="total" id="total" class="form-control form-control-sm" disabled style="color:orangered; font-size: 12px; font-weight: bold;">
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Proyeccion</label> <br>
                                    <button type="button" class="btn btn-outline-info" onclick="calcularPom();"><em class="bi bi-calculator-fill"></em> Calcular</button>
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Condon natural</label>
                                    <input type="text" name="cnatural" id="cnatural" class="form-control form-control-sm" style="color:blue" disabled>
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Condon sabor</label>
                                    <input type="text" name="csabor" id="csabor" class="form-control form-control-sm" style="color:blue" disabled>
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Condon femenino</label>
                                    <input type="text" name="cfemenino" id="cfemenino" class="form-control form-control-sm" style="color:blue" disabled>
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label" id="llubricante">Lubricante</label>
                                    <label class="form-label" id="tubo">Tubo Lubricante</label>
                                    <input type="text" name="lubricante" id="lubricante" class="form-control form-control-sm" style="color:blue" disabled>
                                </div>
                                <div class="form-group input-group-sm col-sm-2" id="lpruebaVIH">
                                    <label class="form-label">Prueba VIH</label>
                                    <input type="text" name="pruebaVIH" id="pruebaVIH" class="form-control form-control-sm" style="color:blue" disabled>
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Autoprueba VIH</label>
                                    <input type="text" name="autoPrueba" id="autoPrueba" class="form-control form-control-sm" style="color:blue" disabled>
                                </div>
                                <div id="reactivoOMES" class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Reactivo esperado
                                    </label>
                                    <input type="hidden" name="reactivo" id="reactivo">
                                    <div class="position-relative">
                                        <input type="text" name="reactivoEs" id="reactivoEs" class="form-control form-control-sm" style="color:blue" disabled>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="porcentaje">
                                    </div>
                                    </span>
                                </div>
                                <div class="form-group input-group-sm col-sm-2" id="lsifilis">
                                    <label class="form-label">Prueba sifilis</label>
                                    <input type="text" name="sifilis" id="sifilis" class="form-control form-control-sm" style="color:blue" disabled>
                                </div>
                                <div class="form-group input-group-sm col-sm-4">
                                    <label class="form-label">Observaciones / otros</label>
                                    <input type="text" name="observacion" id="observacion" class="form-control form-control-sm">
                                </div>
                                <div class="form-group input-group-sm col-sm-1 text-center">
                                    <label class="form-label" style="font-size: 10px;">Supervisado</label>
                                    <select name="supervisado" id="supervisado" class="form-select" style="font-size: 12px;">
                                        <option value="0">NO</option>
                                        <option value="1">SI</option>
                                    </select>
                                </div>
                                <div class="form-group input-group-sm col-sm-3">
                                    <label class="form-label">Nombre del Supervisor:</label>
                                    <input type="text" name="supervisor" id="supervisor" style="font-size: 12px;" class="form-control form-control-sm">
                                </div>
                                <div class="form-group input-group-sm col-sm-1 text-center" id="unidad">
                                    <label class="form-label" style="font-size: 10px;">Unidad Movil</label>
                                    <select name="movil" id="movil" class="form-select" style="font-size: 12px;">
                                        <option value="0">NO</option>
                                        <option value="1">SI</option>
                                    </select>
                                </div>
                                <input type="hidden" name="creado" id="creado" value="ES01">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('¿Está seguro que desea guardar?')">
                        <em class="bi bi-check-square-fill"></em> Guardar</button>
                    <button type="reset" class="btn btn-sm btn-outline-danger"> <em class="bi bi-x-square-fill"></em> Cancelar</button>
                </div>
                </form>
            </div>


            <ul class="nav nav-pills" id="pills-tab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary active" id="pills-periodo_3-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_3" type="button">
                        <em class="bi bi-calendar4-week"></em> Periodo III</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary" id="pills-periodo_4-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_4" type="button">
                        <em class="bi bi-calendar4-week"></em> Periodo IV</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary" id="pills-periodo_5-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_5" type="button">
                        <em class="bi bi-calendar4-week"></em> Periodo V</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm btn-secundary" id="pills-periodo_6-tab" data-bs-toggle="pill" data-bs-target="#pills-periodo_6" type="button">
                        <em class="bi bi-calendar4-week"></em> periodo VI</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-periodo_3" role="tabpanel" aria-labelledby="pills-periodo_3-tab">
                    <?php include 'periodo_3.php'; ?>
                </div>
                <div class="tab-pane fade" id="pills-periodo_4" role="tabpanel" aria-labelledby="pills-periodo_4-tab">
                    <?php include 'periodo_4.php'; ?>
                </div>
                <div class="tab-pane fade" id="pills-periodo_5" role="tabpanel" aria-labelledby="pills-periodo_5-tab">
                    <p>Aun no habilitado</p>
                </div>
                <div class="tab-pane fade" id="pills-periodo_6" role="tabpanel" aria-labelledby="pills-periodo_6-tab">
                    <p>Aun no habilitado</p>
                </div>
            </div>

        </section>
        <?php include '../modal/cancelarActividad.php'; ?>
        <?php include '../modal/historial.php'; ?>
        <?php include '../modal/recalendarizacionPom.php'; ?>
        <?php include '../modal/estadosPom.php'; ?>
        <?php include '../modal/cambiarEstadoPom.php'; ?>
        <?php include '../modal/cambiarTodoEstadoPom.php'; ?>
        <?php include '../modal/editarPom.php'; ?>
        <?php include '../modal/anularPom.php'; ?>


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
        <script src="../../js/estados.js"></script>
        <script src="../../../assets/vendors/datatable/jquery.dataTables.min.js"></script>
        <script src="../../../assets/js/select2.full.min.js"></script>
        <script src="../../js/tabla.js"></script>

        <script>
            $(document).ready(function() {
                $(".js-lugar").select2({

                    placeholder: "Buscar o escribir el lugar",
                    allowClear: true,
                    tags: true,
                    newTag: true
                });
                var subreceptor = document.getElementById('subreceptor').value;
                if (subreceptor == '2') {
                    $('#lsifilis').hide();
                    $('#lpruebaVIH').hide();
                    $('#reactivoOMES').hide();
                    $('#llubricante').hide();
                    $('#unidad').hide();
                } else if (subreceptor == '3' || subreceptor == '6' || subreceptor == '7') {
                    $('#nuevoPom').hide();
                } else {
                    $('#tubo').hide();
                }
            });
        </script>

    </body>

</html>