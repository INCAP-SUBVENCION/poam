<?php
include_once('../../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
$USUARIO = $_SESSION['idUsuario'];
$SUBRECEPTOR = $_SESSION['subreceptor_id'];
$POM = $_GET['id'];
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
            <img src="../../../assets/images/vihinvertido.png" width="35" alt="">
            <h2 class="text-white"><em class="bi bi-calendar4-week"></em> PLAN OPERATIVO MENSUAL -POM-</h2>
            <?php
            $consulta1 = "SELECT p.nombre, p.apellido,u.usuario,r.nombre as rol,s.nombre as subreceptor FROM usuario u
                LEFT JOIN subreceptor s ON u.subreceptor_id = s.idSubreceptor
                LEFT JOIN catalogo r ON u.rol=r.codigo
                LEFT JOIN persona p ON p.idPersona=u.Persona_id WHERE u.idUsuario =$USUARIO";
            $res1 = $enlace->query($consulta1);
            while ($usuario = mysqli_fetch_assoc($res1)) {
            ?>
                <a class="navbar-brand" href="../promotor.php"><em class="bi bi-house-door-fill"></em> Inicio</a>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secundary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 11px;">
                        <em class="bi bi-person-fill"></em> <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?>

                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="font-size: 13px;">
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
        <div class="row">
    <?php
    $sqlD = "SELECT DISTINCT t2.idPom, t2.periodo, t3.nombre AS mes, t4.nombre AS municipio, t2.lugar, t2.fecha, t2.horaInicio, t2.horaFin, t5.codigo, CONCAT(t6.nombre, ' ', t6.apellido) as nombres,
    t2.pNuevo, t2.pRecurrente, (t2.pNuevo + t2.pRecurrente) as total, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH, t2.autoprueba, t2.reactivo, t2.sifilis, t2.observacion, t2.estado FROM pom t2
    LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
    LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
    LEFT JOIN promotor t5 ON t5.idPromotor = t2.promotor_id
    LEFT JOIN persona t6 ON t6.idPersona = t5.persona_id
    LEFT JOIN poa t7 ON t7.idPoa = t2.poa_id
    WHERE t2.periodo= 1 AND t7.subreceptor_id = $SUBRECEPTOR AND t2.idPom = $POM";
    $detallar = $enlace->query($sqlD);
    while ($detalles = $detallar->fetch_assoc()) {
    ?>
        <div class="col-md-3">
            <table class="table table-bordered border-info" style="font-size: 12px;" aria-describedby="datos principales">
                <tr class="text-center"> 
                    <th colspan="4" id="">DATOS PRINCIPALES</th>
                </tr>
                <tr>
                    <th style="background-color:lightskyblue;" id="">Periodo:</th>
                    <td><?php echo $detalles['periodo']; ?></td>
                    <th style="background-color:lightskyblue;" id="">Mes:</th>
                    <td><?php echo $detalles['mes']; ?></td>
                </tr>
                <tr>
                    <th style="background-color:lightskyblue;" id="">Municipio:</th>
                    <td><?php echo $detalles['municipio']; ?></td>
                    <th style="background-color:lightskyblue;" id="">Fecha:</th>
                    <td><?php echo $detalles['fecha']; ?></td>
                </tr>
                <tr>
                    <th style="background-color:lightskyblue;" id="">Lugar:</th>
                    <td colspan="3"><?php echo $detalles['lugar']; ?></td>
                </tr>
                <tr>
                    <th style="background-color:lightskyblue;" id="">Inicio:</th>
                    <td><?php echo $detalles['horaInicio']; ?></td>
                    <th style="background-color:lightskyblue;" id="">Fin:</th>
                    <td><?php echo $detalles['horaFin']; ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-9">
            <table class="table table-bordered border-info" style="font-size: 12px;" aria-describedby="proyeccion de insumos">
                <tr>
                    <th colspan="8" class="text-center" id="">PROYECCION DE INSUMOS</th>
                </tr>
                <tr>
                    <th style="background-color:lightskyblue;" id="">Nuevos</th>
                    <td><?php echo $detalles['pNuevo']; ?></td>
                    <th style="background-color:lightskyblue;" id="">Recurrente</th>
                    <td><?php echo $detalles['pRecurrente']; ?></td>
                    <th style="background-color:lightskyblue;" id="">Total</th>
                    <td><?php echo round($detalles['total'], 4); ?></td>
                    <th style="background-color:lightskyblue;" id="">Condon natural</th>
                    <td><?php echo $detalles['cnatural']; ?></td>
                </tr>
                <tr>
                    <th style="background-color:lightskyblue;" id="">Condon de sabor</th>
                    <td><?php echo $detalles['csabor']; ?></td>
                    <th style="background-color:lightskyblue;" id="">Condon femenino</th>
                    <td><?php echo $detalles['cfemenino']; ?></td>
                    <th style="background-color:lightskyblue;" id="">Lubricante</th>
                    <td><?php echo $detalles['lubricante']; ?></td>
                    <th style="background-color:lightskyblue;" id="">Prueba VIH</th>
                    <td><?php echo $detalles['pruebaVIH']; ?></td>
                </tr>
                <tr>
                    <th style="background-color:lightskyblue;" id="">Auto-prueba VIH</th>
                    <td><?php echo $detalles['autoprueba']; ?></td>
                    <th style="background-color:lightskyblue;" id="">Reactivo experado</th>
                    <td><?php echo $detalles['reactivo']; ?></td>
                    <th style="background-color:lightskyblue;" id="">Sifilis</th>
                    <td><?php echo $detalles['sifilis']; ?></td>
                    <th style="background-color:lightskyblue;" id="">Codigo promotor</th>
                    <td><?php echo $detalles['codigo']; ?></td>

                </tr>
                <tr>
                    <th style="background-color:lightskyblue;" id="">Promotor</th>
                    <td colspan="2"><?php echo $detalles['nombres']; ?></td>
                    <th style="background-color:lightskyblue;" id="">Observaciones</th>
                    <td colspan="4"><?php echo $detalles['observacion']; ?></td>
                </tr>
            </table>
            <?php if($detalles['estado']=='ES01') { ?>
            <button class="btn btn-sm btn-warning" onclick="editarPOM();">Editar</button>
        </div>
    <?php }} ?>
</div>
            
            <div id="editar" style="display: none;">
                <?php include 'detalles/editarPom.php'; ?>
            </div>
            <?php include 'detalles/estados.php'; ?>
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
        <script src="../../js/pom.js"></script>
    </body>

</html>