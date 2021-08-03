<?php
include_once('../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
$ID = $_SESSION['idUsuario'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../assets/vendors/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../assets/css/app.css">
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
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3><i class="bi bi-person-plus"></i> USUARIOS</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                   <li class="breadcrumb-item"><a href="principal.php">Inicio</a></li>
                                    <li class="breadcrumb-item"><a href="#">Configuracion</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <form name="agregarUsuario" id="agregarUsuario" action="javascript: agregarUsuario();" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-headertext-white text-center bg-info">REGISTRO DE USUARIOS</div>
                                <div class="card-body bg-light-warning" style="font-size: 12px;">
                                    <div class="row">
                                        <div class="form-group input-group-sm col-sm-2">
                                            <label class="form-label">Documento:</label>
                                            <select name="documento" id="documento" class="form-control form-control-sm" style="font-size: 12px;">
                                                <option value="">Seleccionar...</option>
                                                <option value="1">DPI</option>
                                                <option value="0">Pasaporte</option>
                                            </select>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-2">
                                            <label class="form-label"># Documento:</label>
                                            <input type="text" name="numero" id="numero" class="form-control form-control-sm" style="font-size: 12px;" required>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-2">
                                            <label class="form-label">Primer nombre:</label>
                                            <input type="text" name="pnombre" id="pnombre" class="form-control form-control-sm" style="font-size: 12px;" required>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-2">
                                            <label class="form-label">Segundo nombre:</label>
                                            <input type="text" name="snombre" id="snombre" class="form-control form-control-sm" style="font-size: 12px;">
                                        </div>
                                        <div class="form-group input-group-sm col-sm-2">
                                            <label class="form-label">Primer apellido:</label>
                                            <input type="text" name="papellido" id="papellido" class="form-control form-control-sm" style="font-size: 12px;" required>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-2">
                                            <label class="form-label">Segundo apellido:</label>
                                            <input type="text" name="sapellido" id="sapellido" class="form-control form-control-sm" style="font-size: 12px;" required>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-3">
                                            <label class="form-label">Direccion:</label>
                                            <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" style="font-size: 12px;" required>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-1">
                                            <label class="form-label">Telefono:</label>
                                            <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" style="font-size: 12px;" required>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-3">
                                            <label class="form-label">Correo:</label>
                                            <input type="text" name="correo" id="correo" class="form-control form-control-sm" style="font-size: 12px;" required>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-2">
                                            <label class="form-label">Rol:</label>
                                            <select name="rol" id="rol" class="form-control form-control-sm" style="font-size: 12px;" required>
                                                <option value="">Seleccionar..</option>
                                                <?php
                                                $resultado = $enlace->query("SELECT codigo, nombre FROM catalogo WHERE codigo NOT IN(SELECT codigo FROM catalogo WHERE codigo = 'R007') AND categoria='rol'");
                                                while ($rol = $resultado->fetch_assoc()) {
                                                ?>
                                                    <option value="<?php echo $rol['codigo'] ?>"><?php echo $rol['nombre'] ?></option>
                                                <?php
                                                }
                                                $resultado->close();
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-3">
                                            <label class="form-label">Subreceptor:</label>
                                            <select name="subreceptor" id="subreceptor" class="form-control form-control-sm" style="font-size: 12px;" required>
                                                <option value="">Seleccionar..</option>
                                                <?php
                                                $resultado = $enlace->query("SELECT * FROM subreceptor");
                                                while ($sub = $resultado->fetch_assoc()) {
                                                ?>
                                                    <option value="<?php echo $sub['idSubreceptor'] ?>"><?php echo $sub['nombre'] ?></option>
                                                <?php
                                                }
                                                $resultado->close();
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card-headertext-white text-center bg-info">PERMISO</div>
                                <div class="card-body bg-light-warning">
                                    <div class="row">
                                        <table class="table-sm">
                                            <tr>
                                                <td><label>Agregar</label></td>
                                                <td> <select name="agregar" id="agregar">
                                                        <option value="0">Deshabilitado</option>
                                                        <option value="1">Habilitado</option>

                                                    </select>
                                                </td>
                                                <td><label>Gestionar Subreceptores</label></td>
                                                <td> <select name="subreceptores" id="subreceptores">
                                                        <option value="0">Deshabilitado</option>
                                                        <option value="1">Habilitado</option>
                                                    </select>
                                                </td>
                                                <td><label>Gestionar POA</label></td>
                                                <td> <select name="poas" id="poas">
                                                        <option value="0">Deshabilitado</option>
                                                        <option value="1">Habilitado</option>
                                                    </select>
                                                </td>
                                                <td><label>Gestionar POM</label></td>
                                                <td> <select name="poms" id="poms">
                                                        <option value="0">Deshabilitado</option>
                                                        <option value="1">Habilitado</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Editar</label></td>
                                                <td> <select name="editar" id="editar">
                                                        <option value="0">Deshabilitado</option>
                                                        <option value="1">Habilitado</option>
                                                    </select>
                                                </td>
                                                <td><label>Gestionar Usuarios</label></td>
                                                <td> <select name="usuarios" id="usuarios">
                                                        <option value="0">Deshabilitado</option>
                                                        <option value="1">Habilitado</option>
                                                    </select>
                                                </td>
                                                <td><label>Gestionar Coberturas</label></td>
                                                <td> <select name="coberturas" id="coberturas">
                                                        <option value="0">Deshabilitado</option>
                                                        <option value="1">Habilitado</option>
                                                    </select> </td>
                                                <td><label>Gestionar Promotores</label></td>
                                                <td> <select name="promotores" id="promotores">
                                                        <option value="0">Deshabilitado</option>
                                                        <option value="1">Habilitado</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Gestionar catalogos</label></td>
                                                <td> <select name="catalogos" id="catalogos">
                                                        <option value="0">Deshabilitado</option>
                                                        <option value="1">Habilitado</option>
                                                    </select>
                                                </td>
                                                <td><label>Gestionar Resumen de metas</label></td>
                                                <td> <select name="resumen" id="resumen">
                                                        <option value="0">Deshabilitado</option>
                                                        <option value="1">Habilitado</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-sm btn-outline-success"><i class="bi bi-plus-circle-fill"></i> Guardar</button>
                            <button type="reset" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
                        </div>
                    </form>
                    <table class="table table-striped table-light">
                        <thead class="table-dark text-center" style="font-size: 12px;">
                            <th>#</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Usuario</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Subreceptor</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody class="text-center" style="font-size: 12px;">
                            <?php
                            $cont = 1;
                            $sql1 = "SELECT p.nombre, p.apellido, p.direccion, p.telefono, p.email, u.usuario, r.nombre as rol, s.nombre as subreceptor, u.estado FROM usuario u
                            LEFT JOIN subreceptor s ON u.subreceptor_id = s.idSubreceptor
                            LEFT JOIN catalogo r ON u.rol=r.codigo
                            LEFT JOIN persona p ON p.idPersona=u.Persona_id";
                            $resultado1 = $enlace->query($sql1);
                            while ($usuario = $resultado1->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $cont++; ?></td>
                                    <td><?php echo $usuario['nombre']; ?></td>
                                    <td><?php echo $usuario['apellido']; ?></td>
                                    <td><?php echo $usuario['usuario']; ?></td>
                                    <td><?php echo $usuario['direccion']; ?></td>
                                    <td><?php echo $usuario['telefono']; ?></td>
                                    <td><?php echo $usuario['email']; ?></td>
                                    <td><?php echo $usuario['rol'] ?></td>
                                    <td><?php echo $usuario['subreceptor'] ?></td>
                                    <td><?php if ($usuario['estado'] == '1') {
                                            echo '<p class="text-success"><i class="bi bi-check-square"></i> Activo <p>';
                                        } else {
                                            echo '<p class="text-danger"><i class="bi bi-x-square-fill"></i> Deshabilitado<p>';
                                        }
                                        ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>

    <!------ JS ------>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../assets/vendors/alertifyjs/alertify.js"></script>
    <script src="../controlador/controladorUsuario.js"></script>
    <?php
    include 'componente/menuConfig.php';
    include 'modal/nuevoUsuario.php';
    ?>
</body>

</html>