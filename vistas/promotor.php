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
    <title>Promotor</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../assets/vendors/alertifyjs/css/themes/default.css">
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
                            <h3><i class="bi bi-people-fill"></i> Promotores</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                   <li class="breadcrumb-item"><a href="principal.php">Inicio</a></li>
                                    <li class="breadcrumb-item"><a href="#">Configuracion</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Promotor</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <form name="agregarPromotor" id="agregarPromotor" action="javascript: agregarPromotor();" method="POST">
                        <div class="card border-primary" style="max-width: 90rem;">
                            <div class="card-headertext-white text-center bg-info" style="color:black">REGISTRO DE PROMOTORES</div>
                            <div class="card-body text-primary bg-light-warning">

                                <div class="row">
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Codigo:</label>
                                        <input type="text" name="codigo" id="codigo" class="form-control form-control-sm"  required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Subreceptor:</label>
                                        <select name="subreceptor" id="subreceptor" class="form-control" onchange="obtenerCobertura();" style="font-size: 12px;" required>
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            $csub = "SELECT *FROM subreceptor";
                                            $rsub = $enlace->query($csub);
                                            while ($sub = $rsub->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $sub['idSubreceptor'] ?>"><?php echo $sub['nombre'] ?></option>
                                            <?php
                                            }
                                            $rsub->close();
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Municipio:</label>
                                        <select name="cobertura" id="cobertura" class="form-control" style="font-size: 12px;" required>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Tipo documento</label>
                                        <select name="documento" id="documento" class="form-control"  required>
                                            <option value="">Seleccionar</option>
                                            <option value="1">DPI</option>
                                            <option value="0">Pasaporte</option>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Numero:</label>
                                        <input type="text" maxlength="13" name="numero" id="numero" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Primer nombre:</label>
                                        <input type="text" name="pnombre" id="pnombre" class="form-control form-control-sm"  required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Segundo nombre:</label>
                                        <input type="text" name="snombre" id="snombre" class="form-control form-control-sm" >
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Primer apellido: </label>
                                        <input type="text" name="papellido" id="papellido" onchange="creaUsuario();" class="form-control form-control-sm"  required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Segundo apellido: </label>
                                        <input type="text" name="sapellido" id="sapellido" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-4">
                                        <label class="form-label">Direccion: </label>
                                        <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Telefono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Correo</label>
                                        <input type="text" name="correo" id="correo" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Usuario: </label>
                                        <input type="text" name="usuario" id="usuario" class="form-control form-control-sm" style="color:dodgerblue;" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Rol: </label>
                                        <input type="text" name="rolNombre" id="rolNombre" class="form-control form-control-sm" value="Promotor" style="color:dodgerblue;" disabled>
                                        <input type="hidden" name="rol" id="rol" value="R007">
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <br>
                                        <button type="submit" class="btn btn-sm btn-outline-success"><i class="bi bi-save2-fill"></i> Guardar</button>
                                        <button type="reset" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-octagon-fill"></i> Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <table class="table table-hover table-bordered">
                        <thead style="font-size: 12px;">
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Subreceptor</th>
                            <th>Municipio</th>
                            <th>Nombre completo</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Opcion</th>
                        </thead>
                        <tbody class="text-center" style="font-size: 12px;">
                            <?php
                            $contador = 1;
                            $sql = "SELECT t1.codigo, t4.nombre as subreceptor, t6.nombre as municipio, t2.nombre, t2.apellido, t2.direccion, t2.telefono, t2.email, t1.estado FROM promotor t1
                            LEFT JOIN persona t2 ON t2.idPersona = t1.persona_id
                            LEFT JOIN cobertura t3 ON t3.idCobertura = t1.cobertura_id
                            LEFT JOIN subreceptor t4 ON t4.idSubreceptor = t3.subreceptor_id
                            LEFT JOIN catalogo t6 ON t6.codigo = t3.municipio;";
                            $consulta = $enlace->query($sql);
                            while ($data = $consulta->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $contador++; ?></td>
                                    <td><?php echo $data['codigo']; ?></td>
                                    <td><?php echo $data['subreceptor']; ?></td>
                                    <td><?php echo $data['municipio']; ?></td>
                                    <td><?php echo $data['nombre'] . ' ' . $data['apellido']; ?></td>
                                    <td><?php echo $data['direccion']; ?></td>
                                    <td><?php echo $data['telefono']; ?></td>
                                    <td><?php echo $data['email']; ?></td>
                                    <td>
                                        <?php
                                        if ($data['estado'] == 1) {
                                            echo '<i class="bi bi-check-circle-fill text-success"></i>';
                                        } else {
                                            echo '<i class="bi bi-x-circle-fill text-danger"></i>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarSub<?php echo $data['idSubreceptor']; ?>" style="font-size: 12px;">
                                            <i class="bi bi-pencil-fill"></i></a>
                                    </td>
                                </tr>
                                <?php
                                include 'modal/editarSubreceptor.php';
                                ?>
                            <?php
                            }
                            ?>
                        </tbody>

                    </table>

            </div>
            </section>

        </div>
    </div>
    </div>
    <!------ JS ------>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendors/alertifyjs/alertify.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../controlador/controladorPromotor.js"></script>
    <script src="../controlador/controladorUtilidad.js" charset="utf-8"></script>

    <?php
    include 'componente/menuConfig.php';
    ?>
</body>

</html>
