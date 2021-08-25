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
            <h2 class="text-white"> PLAN OPERATIVO MENSUAL -POM-</h2>
            <?php
            $consulta1 = "SELECT p.nombre, p.apellido,u.usuario,r.nombre as rol,s.nombre as subreceptor FROM usuario u
                LEFT JOIN subreceptor s ON u.subreceptor_id = s.idSubreceptor
                LEFT JOIN catalogo r ON u.rol=r.codigo
                LEFT JOIN persona p ON p.idPersona=u.Persona_id WHERE u.idUsuario =$ID";
            $res1 = $enlace->query($consulta1);
            while ($usuario = mysqli_fetch_assoc($res1)) {
            ?>
                <a class="navbar-brand" href="../promotor.php"><i class="bi bi-house-door-fill"></i> Inicio</a>
                <div class="dropdown">
                    <a class="btn-outline-secundary text-white" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-fill"></i> <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?>

                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-person"></i> Perfil</a></li>
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
                <div class="col-md-12">
                    <div class="row">

                        <div class="form-group input-group-sm col-sm-2">
                            <select name="cperiodo" id="cperiodo" class="form-select" style="font-size: 12px;">
                                <option value="">Seleccionar periodo</option>
                                <option value="1">Periodo I</option>
                                <option value="2">Periodo II</option>
                                <option value="3">Periodo III</option>
                                <option value="4">Periodo IV</option>
                                <option value="5">Periodo V</option>
                                <option value="6">Periodo VI</option>
                            </select>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <select name="cmunicipio" id="cmunicipio" class="form-control" onchange="obtenerMesPom(); obtenerCantidadPromotor();" style="font-size: 11px;">
                                <option value="">Seleccionar municipio</option>
                                <?php
                                $cd = "SELECT t1.municipio  as id, t2.nombre as municipio FROM cobertura t1
                                        LEFT JOIN catalogo t2 ON t2.codigo = t1.municipio
                                        WHERE t1.subreceptor_id =  $SUBRECEPTOR";
                                $rd = $enlace->query($cd);
                                while ($municipio = $rd->fetch_assoc()) { ?>
                                    <option value="<?php echo $municipio['id'] ?>"><?php echo $municipio['municipio'] ?></option>
                                <?php }
                                $rd->close(); ?>
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
                    <table class="table table-bordered">

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
                        <div class="text-white text-center" style="background-color:navy;">DATOS PRINCIPALES</div>
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
                                        <input type="text" name="lugar" id="lugar" class="form-control form-control-sm" style="font-size:12px;" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-8">
                    <div class="card text-dark">
                    <div class="text-white text-center" style="background-color:navy;">PROYECCIÓN DE INSUMOS</div>
                        <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                            <div class="row">
                                <div class="form-group input-group-sm col-sm-4">
                                    <label for="exampleFormControlTextarea1" class="form-label" style="font-size: 12px;">Promotor responsable:</label>
                                    
                                        <?php
                                        $consultaPro = "SELECT DISTINCT t2.nombre AS nombres, t2.apellido AS apellidos, t3.idPromotor FROM usuario t1 
                                        LEFT JOIN persona t2 ON t2.idPersona = t1.persona_id 
                                        LEFT JOIN promotor t3 ON t3.persona_id = t1.persona_id
                                        WHERE t1.idUsuario = $ID";
                                        $resultadoPro = $enlace->query($consultaPro);
                                        while ($promotor = $resultadoPro->fetch_assoc()) {
                                        ?>
                                        <input type="hidden" name="promotor" id="promotor" value="<?php echo $promotor['idPromotor'];?>">
                                        <input type="text" value="<?php echo $promotor['nombres'].' '.$promotor['apellidos'];?>" class="form-control form-control-sm" disabled>
                                        <?php } $resultadoPro->close(); ?>
                                </div>

                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Nuevos</label>
                                    <input type="number" min="0.00" step="0.0001" name="nuevo" id="nuevo" oninput="sumarPom();" class="form-control form-control-sm" style="font-size: 12px;" required>
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Recurrentes</label>
                                    <input type="number" min="0" step="0.0001" name="recurrente" id="recurrente" oninput="sumarPom();" class="form-control form-control-sm" style="font-size: 12px;" required>
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Total</label>
                                    <input type="text" name="total" id="total" class="form-control form-control-sm" disabled style="color:orangered;">
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Proyeccion</label>
                                    <button type="button" class="btn btn-outline-info" onclick="calcularPom();"><i class="bi bi-calculator-fill"></i> Calcular</button>
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
                                    <label class="form-label">Lubricante</label>
                                    <input type="text" name="lubricante" id="lubricante" class="form-control form-control-sm" style="color:blue" disabled>
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Prueba VIH</label>
                                    <input type="text" name="pruebaVIH" id="pruebaVIH" class="form-control form-control-sm" style="color:blue" disabled>
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Autoprueba VIH</label>
                                    <input type="text" name="autoPrueba" id="autoPrueba" class="form-control form-control-sm" style="color:blue" disabled>
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Reactivo esperado
                                    </label>
                                    <input type="hidden" name="reactivo" id="reactivo">
                                    <div class="position-relative">
                                        <input type="text" name="reactivoEs" id="reactivoEs" class="form-control form-control-sm" style="color:blue" disabled>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="porcentaje">
                                    </div>
                                    </span>
                                </div>
                                <div class="form-group input-group-sm col-sm-2">
                                    <label class="form-label">Prueba sifilis</label>
                                    <input type="text" name="sifilis" id="sifilis" class="form-control form-control-sm" style="color:blue" disabled>
                                </div>
                                <div class="form-group input-group-sm col-sm-5">
                                    <label class="form-label">Observaciones / otros</label>
                                    <input type="text" name="observacion" id="observacion" class="form-control form-control-sm">
                                </div>
                                <div class="form-group input-group-sm col-sm-3">
                                    <br>
                                    <button type="submit" class="btn btn-outline-success" onclick="return confirm('¿Está seguro que desea guardar?')">
                                        <i class="bi bi-check-square-fill"></i> Guardar</button>
                                    <button type="reset" class="btn btn-outline-danger"> <i class="bi bi-x-square-fill"></i> Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </form>
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