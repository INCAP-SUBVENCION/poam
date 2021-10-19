<?php
include_once('../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: salir.php');
} else if (($_SESSION['rol'] != 'R007')) {
    header('Location: ../../error.php');
}
$ID = $_SESSION['idUsuario'];
$ROL = $_SESSION['rol'];
$SUBRECEPTOR = $_SESSION['subreceptor_id'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

    <title>Principal</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/app.css">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: smaller;
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="main">
            <header class="mb-1">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">

                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h2><i class="bi bi-person-badge"></i> Perfil</h2>
                        <table class="table table-borderless">
                            <?php
                            $sql = "SELECT t2.documento, t2.numero, t2.nombre, t2.apellido, t2.direccion, t2.telefono, t2.email, t3.codigo, t3.nombre as roles, t1.usuario
                    FROM usuario t1  LEFT JOIN persona t2 ON t2.idPersona = t1.persona_id LEFT JOIN catalogo t3 ON t3.codigo = t1.rol WHERE t1.idUsuario = $ID";
                            $resultado = $enlace->query($sql);
                            while ($perfil = $resultado->fetch_assoc()) {
                            ?>
                                <tr>
                                    <th>Tipo documento: </th>
                                    <td style="color:darkblue; font-weight: bold;"><?php if ($perfil['documento'] == 1) {
                                                                                        echo "DPI";
                                                                                    } else {
                                                                                        echo "Pasaporte";
                                                                                    } ?></td>
                                    <th># Documento: </th>
                                    <td style="color:darkblue; font-weight: bold;"><?php echo $perfil['numero']; ?></td>
                                    <th>Nombres: </th>
                                    <td style="color:darkblue; font-weight: bold;"><?php echo $perfil['nombre']; ?></td>
                                    <th>Apellidos: </th>
                                    <td style="color:darkblue; font-weight: bold;"><?php echo $perfil['apellido']; ?></td>
                                </tr>
                                <tr>
                                    <th>Direccion: </th>
                                    <td style="color:darkblue; font-weight: bold;"><?php echo $perfil['direccion']; ?></td>
                                    <th># Telefono: </th>
                                    <td style="color:darkblue; font-weight: bold;"><?php echo $perfil['telefono']; ?></td>
                                    <th>Correo: </th>
                                    <td style="color:darkblue; font-weight: bold;"><?php echo $perfil['email']; ?></td>
                                    <th>Rol: </th>
                                    <td style="color:darkblue; font-weight: bold;"><?php echo $perfil['roles']; ?></td>
                                </tr>
                                <tr class="text-center">
                                    <th colspan="4">Cambiar contraseña</th>
                                </tr>

                                <tr>
                                    <th>Nueva contraseña: </th>
                                    <td> <input type="password" id="pass_1" class="form-control form-control-sm"> </td>
                                    <th>Confirmar contraseña: </th>
                                    <td> <input type="password" id="pass_2" class="form-control form-control-sm"> </td>
                                    <td> <button class="btn btn-info" onclick="cambiarContraseña()">Cambiar</button> </td>
                                </tr>
                            <?php } ?>
                        </table>
                        <div id="error" class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i> La contraseña no coinciden
                        </div>
                    </div>
                </div>
                <section class="section">

                </section>
            </div>
        </div>

    </div>
    <!------ JS ------>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../js/usuario.js"></script>
    <?php
    include 'menu.php';
    ?>

</body>

</html>