<?php
include_once('../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: ../error.php');
}
$ID  = $_SESSION['idUsuario'];
$ROL = $_SESSION['rol'];
if ($ROL != 'R001') {
    header('Location: salir.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../../assets/vendors/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="../../assets/vendors/datatable/jquery.dataTables.min.css">
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
                    <em class="bi bi-justify fs-3"></em>
                </a>
            </header>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3><em class="bi bi-person-plus"></em> USUARIOS</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="configuracion.php">Configuracion</a></li>
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
                                <div class="text-white text-center" style="background-color:navy;">REGISTRO DE USUARIOS</div>
                                <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                                    <div class="row">
                                    <div class="form-group input-group-sm col-sm-2">
                                            <label class="form-label">Codigo:</label>
                                            <input type="text" name="codigo" id="codigo" class="form-control form-control-sm" style="font-size: 12px;" required>
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

                                        <div class="form-group input-group-sm col-sm-2">
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
                                        <div class="form-group input-group-sm col-sm-4">
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
                                        <div class="form-group input-group-sm col-sm-3">
                                            <br>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-sm btn-outline-success"><i class="bi bi-plus-circle-fill"></i> Guardar</button>
                            <button type="reset" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>



                    <table class="table table-hover table-bordered" id="listadoUsuario" aria-describedby="">
                        <thead class="text-center" style="font-size: 12px;">
                            <th scope="">#</th>
                            <th scope="">Nombres</th>
                            <th scope="">Apellidos</th>
                            <th scope="">Usuario</th>
                            <th scope="">Telefono</th>
                            <th scope="">Correo</th>
                            <th scope="">Rol</th>
                            <th scope="">Subreceptor</th>
                            <th scope="">Estado</th>
                        </thead>
                        <tfoot>
                        <th scope="">#</th>
                            <th scope="">Nombres</th>
                            <th scope="">Apellidos</th>
                            <th scope="">Usuario</th>
                            <th scope="">Telefono</th>
                            <th scope="">Correo</th>
                            <th scope="">Rol</th>
                            <th scope="">Subreceptor</th>
                            <th scope="">Estado</th>
                        </tfoot>
                        <tbody class="text-center" style="font-size: 12px;">
                            <?php
                            $cont = 1;
                            $sql1 = "SELECT p.nombre, p.apellido, p.telefono, p.correo, u.usuario, r.nombre as rol, s.nombre as subreceptor, u.estado FROM usuario u
                            LEFT JOIN subreceptor s ON u.subreceptor_id = s.idSubreceptor
                            LEFT JOIN catalogo r ON u.rol=r.codigo
                            LEFT JOIN persona p ON p.idPersona=u.Persona_id ORDER BY rol";
                            $resultado1 = $enlace->query($sql1);
                            while ($usuario = $resultado1->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $cont++; ?></td>
                                    <td><?php echo $usuario['nombre']; ?></td>
                                    <td><?php echo $usuario['apellido']; ?></td>
                                    <td><?php echo $usuario['usuario']; ?></td>
                                    <td><?php echo $usuario['telefono']; ?></td>
                                    <td><?php echo $usuario['correo']; ?></td>
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
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
    <script src="../../assets/vendors/datatable/jquery.dataTables.min.js"></script>
    <script src="../js/usuario.js"></script>
    <?php include 'menu.php'; ?>

    <script type="text/javascript">
                $(document).ready(function() {
        /**
         * Metodo que permite filtrar pom del periodo 3
         */
        $('#listadoUsuario').DataTable( {
        initComplete: function () {
            this.api().columns([6,7]).every( function () {
                var column = this;
                var select = $('<select><option value="">Filtar</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search( val ? '^'+val+'$' : '', true, false ).draw();
                    } );
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
            }
            } );

        } );
    </script>
</body>

</html>
