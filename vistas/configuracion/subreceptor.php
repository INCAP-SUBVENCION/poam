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
    <title>Subreceptor</title>

    <!-------------  CSS  ---------------->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
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
                            <h3><i class="bi bi-diagram-2-fill"></i> SUBRECEPTORES</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="configuracion.php">Configuracion</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Subreceptor</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card border-primary mb-1" style="max-width: 60rem;">
                        <div class="text-white text-center" style="background-color:navy;">REGISTRO DE SUBRECEPTOR</div>
                        <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                            <form name="agregarSub" id="agregarSub" action="javascript: agregarSubreceptor();" method="GET">
                                <div class="row">
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Codigo:</label>
                                        <input type="text" name="codigo" id="codigo" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-6">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Condon natural:</label>
                                        <input type="number" min="0" name="cnatural" id="cnatural" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Condon sabor:</label>
                                        <input type="number" min="0" name="csabor" id="csabor" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Condon femenino:</label>
                                        <input type="number" min="0" name="cfemenino" id="cfemenino" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Lubricante:</label>
                                        <input type="number" min="0" name="lubricante" id="lubricante" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">% Prueba VIH:</label>
                                        <input type="number" min="0" max="1" step="0.01" name="pruebavih" id="pruebavih" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">% Auto-prueba VIH:</label>
                                        <input type="number" min="0" max="1" step="0.01" name="autoprueba" id="autoprueba" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-4">
                                        <br>
                                        <button type="submit" class="btn btn-sm btn-outline-success"><i class="bi bi-save2-fill"></i> Guardar</button>
                                        <button type="reset" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-octagon-fill"></i> Cancelar</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    </form>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm mb-1">
                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-search"></i></span>
                            <input class="form-control" type="text" id="buscador" placeholder="Buscar subreceptor" />
                        </div>
                    </div>
                    <table class="table table-hover table-bordered" id="listadoSubreceptor" name="listadoSubreceptor">
                        <thead class="text-center" style="font-size:12px;">
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th># Condon natural</th>
                            <th># Condon sabor</th>
                            <th># Condon femenino</th>
                            <th># Lubricante</th>
                            <th>% Prueba VIH</th>
                            <th>% Auto-prueba VIH</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody class="text-center" style="font-size:12px;">
                            <?php
                            $contador = 1;
                            $sql = "SELECT * FROM subreceptor";
                            $consulta = mysqli_query($enlace, $sql);
                            while ($data = mysqli_fetch_assoc($consulta)) {
                            ?>
                                <tr>
                                    <td><?php echo $contador++; ?></td>
                                    <td><?php echo $data['codigo']; ?></td>
                                    <td><?php echo $data['nombre']; ?></td>
                                    <td><?php echo $data['enatural']; ?></td>
                                    <td><?php echo $data['esabor']; ?></td>
                                    <td><?php echo $data['efemenino']; ?></td>
                                    <td><?php echo $data['elubricante']; ?></td>
                                    <td><?php echo $data['ppvih']; ?></td>
                                    <td><?php echo $data['pautoprueba']; ?></td>
                                    <td>
                                        <a class="btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarSub<?php echo $data['idSubreceptor']; ?>"><i class="bi bi-pencil-fill"></i> Editar</a>
                                    </td>
                                    <?php include 'modal/editarSubreceptor.php'; ?>
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
                jQuery("#listadoSubreceptor tbody>tr").hide();
                jQuery("#listadoSubreceptor td:contiene-palabra('" + jQuery(this).val() + "')").parent("tr").show();
            } else {
                jQuery("#listadoSubreceptor tbody>tr").show();
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