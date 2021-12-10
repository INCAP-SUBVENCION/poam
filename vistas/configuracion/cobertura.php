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
    <title>Cobertura</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
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
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3><i class="bi bi-arrows-fullscreen"></i> COBERTURAS</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="configuracion.php">Configuracion</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cobertura</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <form name="agregarCobertura" id="agregarCobertura" action="javascript: agregarCobertura();" method="GET">
                        <div class="card border-primary mb-3" style="max-width: 85rem;">
                            <div class="text-white text-center" style="background-color:navy;">REGISTRO DE COBERTURA</div>
                            <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                                <div class="row">
                                    <div class="form-group input-group-sm col-sm-1">
                                        <label class="form-label">Periodo:</label>
                                        <select name="periodo" id="periodo" class="form-select" style="font-size: 12px;" onchange="periodo_mes();" required>
                                            <option value="">...</option>
                                            <option value="3">III</option>
                                            <option value="4">IV</option>
                                            <option value="5">V</option>
                                            <option value="6">VI</option>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Subreceptor:</label>
                                        <select name="sub" id="sub" class="form-select" style="font-size: 12px;" required>
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            $sqlSub = "SELECT * FROM subreceptor";
                                            $resultadoSub = $enlace->query($sqlSub);
                                            while ($sub = $resultadoSub->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $sub['idSubreceptor']; ?>"><?php echo $sub['nombre']; ?></option>
                                            <?php
                                            }
                                            $resultadoSub->close();
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Departamento:</label>
                                        <select name="departamento" id="departamento" class="form-select" onchange="llenarMunicipio();" style="font-size: 12px;" required>
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            $sqlDep = "SELECT * FROM catalogo WHERE categoria = 'departamento' ORDER BY codigo AND categoria";
                                            $resultadoDep = $enlace->query($sqlDep);
                                            while ($departamento = $resultadoDep->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $departamento['codigo']; ?>"><?php echo $departamento['nombre']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Muinicipio:</label>
                                        <select id="municipio" name="municipio" class="form-control" style="font-size: 12px;" required></select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-1">
                                        <label class="form-label">Nuevos:</label>
                                        <input type="number" min="0.0" step="0.01" name="nuevo" id="nuevo" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-1">
                                        <label class="form-label">Recurrentes:</label>
                                        <input type="number" min="0.0" step="0.01" name="recurrente" id="recurrente" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-1">
                                        <label class="form-label">Reactividad:</label>
                                        <input type="number" min="0.000" max="1" step="0.001" name="reactivo" id="reactivo" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>

                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check"></i> Guardar</button>
                                <button type="reset" class="btn btn-sm btn-danger"><i class="bi bi-x"></i> Cancelar</button>
                            </div>
                            <div class="form-group input-group-sm col-sm-2 md-end">

                            </div>
                    </form>

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="btn btn-sm" id="periodo-1-tab" data-bs-toggle="pill" data-bs-target="#periodo_1" type="button" role="tab" aria-controls="periodo_1" aria-selected="true">Periodo III</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="btn btn-sm" id="periodo-2-tab" data-bs-toggle="pill" data-bs-target="#periodo_2" type="button" role="tab" aria-controls="periodo_2" aria-selected="false">Periodo IV</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="btn btn-sm" id="periodo-3-tab" data-bs-toggle="pill" data-bs-target="#periodo_3" type="button" role="tab" aria-controls="periodo_3" aria-selected="false">Periodo V</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="periodo_1" role="tabpanel" aria-labelledby="periodo-1-tab">
                            <table class="table table-hover table-bordered" id="listadoCobertura_p3">
                                <thead class="text-center" style="font-size:12px;">
                                    <th>#</th>
                                    <th>Subreceptor</th>
                                    <th>Departamento</th>
                                    <th>Municipio</th>
                                    <th># Nuevos</th>
                                    <th># Recurrentes</th>
                                    <th>% Reactividad</th>
                                    <th>Opciones</th>
                                </thead>
                                <tfoot>
                                    <th>#</th>
                                    <th>Subreceptor</th>
                                    <th>Departamento</th>
                                    <th>Municipio</th>
                                    <th># Nuevos</th>
                                    <th># Recurrentes</th>
                                    <th>% Reactividad</th>
                                </tfoot>
                                <tbody class="text-center" style="font-size:12px;">
                                    <?php
                                    $contador = 1;
                                    $sqlC = "SELECT t1.idCobertura, t4.nombre as subreceptor, t2.nombre as departamento,
                                    t3.nombre as municipio, t1.nuevo, t1.recurrente, t1.porcentaje
                                    FROM cobertura t1
                                    LEFT JOIN catalogo t2 ON t2.codigo = t1.departamento
                                    LEFT JOIN catalogo t3 ON t3.codigo = t1.municipio
                                    LEFT JOIN subreceptor t4 ON t4.idSubreceptor = t1.subreceptor_id WHERE t1.periodo=3";
                                    $resultadoC = $enlace->query($sqlC);
                                    while ($cobertura = $resultadoC->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $contador++; ?></td>
                                            <td><?php echo $cobertura['subreceptor']; ?></td>
                                            <td><?php echo $cobertura['departamento']; ?></td>
                                            <td><?php echo $cobertura['municipio']; ?></td>
                                            <td><?php echo $cobertura['nuevo']; ?></td>
                                            <td><?php echo $cobertura['recurrente']; ?></td>
                                            <td><?php echo $cobertura['porcentaje']; ?></td>
                                            <td>
                                                <a class="btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarCobertura<?php echo $cobertura['idCobertura']; ?>"><i class="bi bi-pencil-fill"></i> Editar</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    $resultadoC->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="periodo_2" role="tabpanel" aria-labelledby="periodo-2-tab">
                        <table class="table table-hover table-bordered" id="listadoCobertura_p3">
                                <thead class="text-center" style="font-size:12px;">
                                    <th>#</th>
                                    <th>Subreceptor</th>
                                    <th>Departamento</th>
                                    <th>Municipio</th>
                                    <th># Nuevos</th>
                                    <th># Recurrentes</th>
                                    <th>% Reactividad</th>
                                    <th>Opciones</th>
                                </thead>
                                <tfoot>
                                    <th>#</th>
                                    <th>Subreceptor</th>
                                    <th>Departamento</th>
                                    <th>Municipio</th>
                                    <th># Nuevos</th>
                                    <th># Recurrentes</th>
                                    <th>% Reactividad</th>
                                </tfoot>
                                <tbody class="text-center" style="font-size:12px;">
                                    <?php
                                    $contador = 1;
                                    $sqlC = "SELECT t1.idCobertura, t4.nombre as subreceptor, t2.nombre as departamento,
                                    t3.nombre as municipio, t1.nuevo, t1.recurrente, t1.porcentaje
                                    FROM cobertura t1
                                    LEFT JOIN catalogo t2 ON t2.codigo = t1.departamento
                                    LEFT JOIN catalogo t3 ON t3.codigo = t1.municipio
                                    LEFT JOIN subreceptor t4 ON t4.idSubreceptor = t1.subreceptor_id WHERE t1.periodo=4";
                                    $resultadoC = $enlace->query($sqlC);
                                    while ($cobertura = $resultadoC->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $contador++; ?></td>
                                            <td><?php echo $cobertura['subreceptor']; ?></td>
                                            <td><?php echo $cobertura['departamento']; ?></td>
                                            <td><?php echo $cobertura['municipio']; ?></td>
                                            <td><?php echo $cobertura['nuevo']; ?></td>
                                            <td><?php echo $cobertura['recurrente']; ?></td>
                                            <td><?php echo $cobertura['porcentaje']; ?></td>
                                            <td>
                                                <a class="btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarCobertura<?php echo $cobertura['idCobertura']; ?>"><i class="bi bi-pencil-fill"></i> Editar</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    $resultadoC->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="periodo_3" role="tabpanel" aria-labelledby="periodo-3-tab">...</div>
                    </div>


                </section>

            </div>
        </div>
    </div>

    <!------ JS ------>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../../assets/vendors/alertifyjs/alertify.js"></script>
    <script src="../../assets/vendors/datatable/jquery.dataTables.min.js"></script>
    <script src="../js/subreceptor.js"></script>
    <script src="../js/utilidad.js"></script>
    <!---- ARCHIVOS EXTERNOS--->
    <?php include 'menu.php'; ?>

    <script type="text/javascript">
        $(document).ready(function() {
            /**
             * Metodo que permite filtrar pom del periodo 3
             */
            $('#listadoCobertura_p3').DataTable({
                initComplete: function() {
                    this.api().columns([1, 2, 3]).every(function() {
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
            $('#listadoCobertura_p4').DataTable({
                initComplete: function() {
                    this.api().columns([1, 2, 3]).every(function() {
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