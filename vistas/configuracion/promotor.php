<?php
include_once '../../bd/conexion.php';
header('Content-Type: text/html;charset=utf-8');
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: ../error.php');
}
    $ID = $_SESSION['idUsuario'];
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
    <title>Promotor</title>
    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../../assets/vendors/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="../../assets/css/multi-select/multi-select.css">
    <link rel="stylesheet" href="../../assets/vendors/datatable/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
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
                                    <li class="breadcrumb-item"><a href="configuracion.php">Configuracion</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Promotor</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <form name="agregarPromotor" id="agregarPromotor" action="javascript: agregarPromotor();" method="POST">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card border-primary mb-1">
                                    <div class="text-white text-center" style="background-color:navy;">REGISTRO DE PROMOTORES</div>
                                    <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                                        <div class="row">
                                            <input type="hidden" name="rol" id="rol" value="R007">
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">Primer nombre:</label>
                                                <input type="text" name="pnombre" id="pnombre" class="form-control form-control-sm" style="font-size: 12px;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">Segundo nombre:</label>
                                                <input type="text" name="snombre" id="snombre" class="form-control form-control-sm" style="font-size: 12px;">
                                            </div>
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">Primer apellido: </label>
                                                <input type="text" name="papellido" id="papellido" onchange="creaUsuario();" class="form-control form-control-sm" style="font-size: 12px;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">Segundo apellido: </label>
                                                <input type="text" name="sapellido" id="sapellido" class="form-control form-control-sm" style="font-size: 12px;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Usuario: </label>
                                                <input type="text" name="usuario" id="usuario" class="form-control form-control-sm" style="color:dodgerblue;" style="font-size: 12px;" disabled>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Codigo:</label>
                                                <input type="text" name="codigo" id="codigo" class="form-control form-control-sm" style="font-size: 12px;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-5">
                                                <label class="form-label">Subreceptor:</label>
                                                <select name="subreceptor" id="subreceptor" class="form-control" onchange="obtenerCobertura();" style="font-size: 12px;" required>
                                                    <option value="">Seleccionar...</option>
                                                    <?php
                                                    $csub = 'SELECT *FROM subreceptor';
                                                    $rsub = $enlace->query($csub);
                                                    while ($sub = $rsub->fetch_assoc()) { ?>
                                                        <option value="<?php echo $sub['idSubreceptor']; ?>"><?php echo $sub['nombre']; ?></option>
                                                    <?php }
                                                    $rsub->close();
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">Telefono</label>
                                                <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" style="font-size: 12px;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-5">
                                                <label class="form-label">Correo</label>
                                                <input type="text" name="correo" id="correo" class="form-control form-control-sm" style="font-size: 12px;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label"># Dias </label>
                                                <input type="number" min="0" name="dias" id="dias" class="form-control form-control-sm" placeholder="Dias laborales" title="Numero de dias laborales" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-4">
                                                <br>
                                                <button type="submit" class="btn btn-sm btn-outline-success"><i class="bi bi-save2-fill"></i> Guardar</button>
                                                <button type="reset" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-octagon-fill"></i> Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-primary">
                                    <div class="text-white text-center" style="background-color:navy;">MUNCIPIOS DE COBERTURA</div>
                                    <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                                        <div class="form-group input-group-sm col-sm-3">
                                            <select name="cobertura[]" id='cobertura' multiple='multiple' class="form-control" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table table-hover" id="listadoPromotor">
                        <thead class="text-center" style="font-size: 12px;">
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Subreceptor</th>
                            <th>Nombre completo</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Horas laborales</th>
                            <th>Opcion</th>
                        </thead>
                        <tbody class="text-center" style="font-size: 12px;">
                            <?php
                            $contador = 1;
                            $sqlPromotor = "SELECT t2.codigo, t4.nombre as subreceptor, t2.nombre, t2.apellido, 
                            t2.telefono, t2.correo, t3.estado, t3.dias FROM usuario t1
                            LEFT JOIN persona t2 ON t2.idPersona = t1.persona_id
                            RIGHT JOIN promotor t3 ON t3.persona_id = t2.idPersona
                            LEFT JOIN subreceptor t4 ON t4.idSubreceptor = t1.subreceptor_id ORDER BY subreceptor";
                            $consultaPromotor = $enlace->query($sqlPromotor);
                            while ($promotor = $consultaPromotor->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $contador++; ?></td>
                                    <td><?php echo $promotor['codigo']; ?></td>
                                    <td><?php echo $promotor['subreceptor']; ?></td>
                                    <td><?php echo $promotor['nombre'] . ' ' . $promotor['apellido']; ?></td>
                                    <td><?php echo $promotor['telefono']; ?></td>
                                    <td><?php echo $promotor['correo']; ?></td>
                                    <td>
                                        <?php if ($promotor['estado'] == 1) {
                                            echo '<i class="bi bi-check-circle-fill text-success"></i>';
                                        } else {
                                            echo '<i class="bi bi-x-circle-fill text-danger"></i>';
                                        } ?>
                                    </td>
                                    <td><?php echo $promotor['dias']; ?></td>
                                    <td>
                                        <a class="btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarSub<?php echo $promotor['idSubreceptor']; ?>" style="font-size: 12px;">
                                            <i class="bi bi-pencil-fill"></i></a>
                                    </td>
                                </tr>
                            <?php }
                            $consultaPromotor->close();
                            ?>
                        </tbody>
                        <tfoot>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Subreceptor</th>
                            <th>Nombre completo</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Horas laborales</th>
                            <th>Opcion</th>
                        </tfoot>
                    </table>
            </div>
            </section>
        </div>
    </div>
    </div>
    <!------ JS ------>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../../assets/js/multi-select/jquery.multi-select.js" charset="utf-8"></script>
    <script src="../../assets/vendors/datatable/jquery.dataTables.min.js"></script>
    <script src="../js/promotor.js"></script>
    <script src="../js/utilidad.js" charset="utf-8"></script>

    <?php include 'menu.php'; ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#listadoPromotor').DataTable({
                initComplete: function() {
                    this.api().columns([ 2, 3]).every(function() {
                        var column = this;
                        var select = $('<select><option value="">Filtar</option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                }
            });
        });
    </script>
</body>

</html>