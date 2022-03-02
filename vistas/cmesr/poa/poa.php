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
    <title> .:. POA .:. </title>
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <img src="../../../assets/images/vihinvertido.png" width="45" alt="">
                <a class="navbar-brand" href="#">.:. POA .:.</a>
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
                            <h4><?php echo $subr['nombre']; ?></h4>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="col-md-6">
                        <div class="card text-dark">
                            <div class="text-white text-center" style="background-color:darkblue;">DATOS PRINCIPALES</div>
                            <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                                <div class="row">
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Periodo:</label>
                                        <select name="periodo" id="periodo" class="form-select" style="font-size: 12px;" onchange="periodo_mes();" required>
                                            <option value="">Seleccionar ...</option>
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
                                        <input type="text" name="nuevo" id="nuevo" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Recurrentes</label>
                                        <input type="text" name="recurrente" id="recurrente" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Proyeccion</label>
                                        <button type="button" class="btn btn-outline-info" onclick="calcularProyeccionPOA();"><i class="bi bi-calculator-fill"></i> Calcular</button>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Total</label>
                                        <input type="text" name="total" id="total" class="form-control form-control-sm" disabled style="color:orangered;" required>
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
                            <div class="text-white text-center" style="background-color:darkblue;">PROYECCION DE INSUMOS</div>
                            <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                                <div class="row">
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Condon natural</label>
                                        <input type="text" name="cnatural" id="cnatural" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2" id="sabor">
                                        <label class="form-label">Condon sabor</label>
                                        <input type="text" name="csabor" id="csabor" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3" id="femenino">
                                        <label class="form-label">Condon femenino</label>
                                        <input type="text" name="cfemenino" id="cfemenino" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label" id="llubricante">Lubricante</label>
                                        <label class="form-label" id="tubo">Tubo Lubricante</label>
                                        <input type="text" name="lubricante" id="lubricante" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2" id="oprueba">
                                        <label class="form-label">Prueba VIH</label>
                                        <input type="text" step="0.0000" name="pruebaVIH" id="pruebaVIH" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2" id="auto">
                                        <label class="form-label">Autoprueba VIH</label>
                                        <input type="text" step="0.0000" name="autoPrueba" id="autoPrueba" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3" id="oreactivo">
                                        <label class="form-label">Reactivo esperado
                                        </label>
                                        <input type="hidden" name="reactivo" id="reactivo">
                                        <div class="position-relative">
                                            <input type="text" step="0.0000" step="0.01" name="reactivoEs" id="reactivoEs" class="form-control form-control-sm" disabled>
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="porcentaje">
                                        </div>
                                        </span>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2" id="osifilis">
                                        <label class="form-label">Prueba sifilis</label>
                                        <input type="text" name="sifilis" id="sifilis" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2 text-center">
                                        <br>
                                        <button type="submit" class="btn btn-outline-success" onclick="return confirm('¿Está seguro que desea guardar?')">
                                            <em class="bi bi-save-fill"></em> Guardar</button>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2 text-center">
                                        <br>
                                        <button type="reset" class="btn btn-sm btn-outline-danger"><em class="bi bi-x-square-fill"></em> Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                <?php include '../modal/estadosPoa.php'; ?>
                <?php include '../modal/cambiarEstadoPoa.php'; ?>
                <?php include '../modal/cambiarTodoEstadoPoa.php'; ?>
                <?php include '../modal/editarPoa.php'; ?>
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
        <script>
            $(document).ready(function() {
                var subreceptor = document.getElementById('subreceptor').value;
                if (subreceptor == '2') {
                    $('#oprueba').hide();
                    $('#oreactivo').hide();
                    $('#osifilis').hide();
                    $('#llubricante').hide();
                    $('#tubo').show();
                    $('#omes3').show();
                    $('#hsh3').hide();
                    $('#otrans3').hide();
                    $('#ppl3').hide();
                    $('#omes4').show();
                    $('#hsh4').hide();
                    $('#otrans4').hide();
                    $('#ppl4').hide();
                } else if (subreceptor == '3' || subreceptor == '6' || subreceptor == '7') {
                    $('#femenino').hide();
                    $('#sabor').hide();
                    $('#llubricante').show();
                    $('#tubo').hide();
                    $('#omes3').hide();
                    $('#hsh3').show();
                    $('#otrans3').hide();
                    $('#ppl3').hide();
                    $('#omes4').hide();
                    $('#hsh4').show();
                    $('#otrans4').hide();
                    $('#ppl4').hide();
                } else if (subreceptor == '5') {
                    $('#femenino').hide();
                    $('#sabor').hide();
                    $('#auto').hide()
                    $('#llubricante').show();
                    $('#tubo').hide();
                    $('#omes3').hide();
                    $('#hsh3').hide();
                    $('#otrans3').show();
                    $('#ppl3').hide();
                    $('#omes4').hide();
                    $('#hsh4').hide();
                    $('#otrans4').show();
                    $('#ppl4').hide();
                } else if (subreceptor == '4') {
                    $('#femenino').hide();
                    $('#sabor').hide();
                    $('#llubricante').show();
                    $('#tubo').hide();
                    $('#omes3').hide();
                    $('#hsh3').hide();
                    $('#otrans3').hide();
                    $('#ppl3').show();
                    $('#omes4').hide();
                    $('#hsh4').hide();
                    $('#otrans4').hide();
                    $('#ppl4').show();
                }
            });
        </script>
    </body>

</html>