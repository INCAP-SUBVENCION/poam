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
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Region:</label>
                                        <select id="region" name="region" class="form-control" style="font-size: 12px;" required>
                                            <option value="">Seleccionar</option>
                                            <option value="1">Region 1</option>
                                            <option value="2">Region 2</option>
                                            <option value="3">Region 3</option>
                                            <option value="4">Region 4</option>
                                            <option value="5">Region 5</option>
                                            <option value="1">Region 6</option>
                                            <option value="2">Region 7</option>
                                            <option value="3">Region 8</option>
                                        </select>
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
                                        <input type="number" min="0.0" max="1" step="0.01" name="reactivo" id="reactivo" class="form-control form-control-sm" style="font-size: 12px;" required>
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

                    <div class="col-sm-4">
                        <div class="input-group input-group-sm mb-1">
                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-search"></i></span>
                            <input class="form-control" type="text" id="buscador" placeholder="Buscar cobertura" />
                        </div>
                    </div>

                    <table class="table table-hover table-bordered" id="listadoCobertura">
                        <thead class="text-center" style="font-size:12px;">
                            <th>#</th>
                            <th>Subreceptor</th>
                            <th>Departamento</th>
                            <th>Municipio</th>
                            <th>Region</th>
                            <th># Nuevos</th>
                            <th># Recurrentes</th>
                            <th>% Reactividad</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody class="text-center" style="font-size:12px;">
                            <?php
                            $contador = 1;
                            $sqlC = "SELECT t1.idCobertura, t4.nombre as subreceptor, t2.nombre as departamento, t3.nombre as municipio, t1.region, t1.nuevo, t1.recurrente, t1.porcentaje
                                    FROM cobertura t1
                                    LEFT JOIN catalogo t2 ON t2.codigo = t1.departamento
                                    LEFT JOIN catalogo t3 ON t3.codigo = t1.municipio
                                    LEFT JOIN subreceptor t4 ON t4.idSubreceptor = t1.subreceptor_id ORDER BY t4.nombre";
                            $resultadoC = $enlace->query($sqlC);
                            while ($cobertura = $resultadoC->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $contador++; ?></td>
                                    <td><?php echo $cobertura['subreceptor']; ?></td>
                                    <td><?php echo $cobertura['departamento']; ?></td>
                                    <td><?php echo $cobertura['municipio']; ?></td>
                                    <td><?php echo 'Region' . ' ' . $cobertura['region']; ?></td>
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
    <script src="../js/subreceptor.js"></script>
    <script src="../js/utilidad.js"></script>
    <!---- ARCHIVOS EXTERNOS--->
    <?php include 'menu.php'; ?>
    <script type="text/javascript">
        jQuery("#buscador").keyup(function() {
            if (jQuery(this).val() != "") {
                jQuery("#listadoCobertura tbody>tr").hide();
                jQuery("#listadoCobertura td:contiene-palabra('" + jQuery(this).val() + "')").parent("tr").show();
            } else {
                jQuery("#listadoCobertura tbody>tr").show();
            }
        });
        jQuery.extend(jQuery.expr[":"], {
            "contiene-palabra": function(elem, i, match, array) {
                return (elem.textContent || elem.innerText || jQuery(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
        });
    </script>
</body>

</html>