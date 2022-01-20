<?php
include_once('../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: salir.php');
} else if (($_SESSION['rol'] != 'R001')) {
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
                            $sql = "SELECT t2.nombre, t2.apellido, t2.telefono, t2.correo, t3.codigo, t3.nombre as roles, t1.usuario
                            FROM usuario t1  LEFT JOIN persona t2 ON t2.idPersona = t1.persona_id LEFT JOIN catalogo t3 ON t3.codigo = t1.rol WHERE t1.idUsuario = $ID";
                            $resultado = $enlace->query($sql);
                            while ($perfil = $resultado->fetch_assoc()) {
                            ?>
                                <tr>
                                    <th>Nombres: </th>
                                    <td style="color:darkblue; font-weight: bold;"><?php echo $perfil['nombre']; ?></td>
                                    <th>Apellidos: </th>
                                    <td style="color:darkblue; font-weight: bold;"><?php echo $perfil['apellido']; ?></td>
                                </tr>
                                <tr>
                                    <th>Correo: </th>
                                    <td style="color:darkblue; font-weight: bold;"><?php echo $perfil['correo']; ?></td>
                                    <th>Rol: </th>
                                    <td style="color:darkblue; font-weight: bold;"><?php echo $perfil['roles']; ?></td>
                                </tr>

                            <?php } ?>
                        </table>
                        <div class="card text-dark bg-info mb-3" style="max-width: 40rem;">
                            <div class="card-header">CAMBIAR CONTRASEÑA</div>
                            <div class="card-body">
                                <form name="perfil" id="perfil" method="post" action="javascript: cambiarPass();">
                                    <div class="row">
                                        <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $ID; ?>">
                                        <div class="form-group input-group-sm col-sm-5">
                                            <label for="exampleFormControlTextarea1" class="form-label">Contraseña: </label>
                                            <input type="password" name="pass_1" id="pass_1" placeholder="Nueva contraseña" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group input-group-sm col-sm-5">
                                            <label for="exampleFormControlTextarea1" class="form-label">Confirmar</label>
                                            <input type="password" name="pass_2" id="pass_2" placeholder="Repetir" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group input-group-sm col-sm-2">
                                            <label for="exampleFormControlTextarea1" class="form-label">Cambiar</label>
                                            <input type="submit" value="Cambiar" class="btn btn-warning">
                                            <input type="reset" value="Cancelar">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!------ JS ------>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
    <script src="../js/usuario.js"></script>
    <?php
    include 'menu.php';
    ?>

</body>

</html>