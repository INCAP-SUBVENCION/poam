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
    <title>Subreceptor</title>

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

                            <h3><i class="bi bi-diagram-2-fill"></i> SUBRECEPTORES</h3>
                            <p class="text-subtitle text-muted">Registro de subreceptores</p>
                        </div>

                    </div>
                </div>
                <section class="section">
                    <ul class="nav nav-tabs mb-1" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active btn btn-outline-primary" data-bs-toggle="pill" data-bs-target="#registroSubreceptor" type="button" role="tab" aria-selected="true">
                                <i class="bi bi-people-fill"></i> Subreceptor </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link btn btn-outline-primary" data-bs-toggle="pill" data-bs-target="#registroReactivo" type="button" role="tab" aria-controls="semestre_2" aria-selected="false">
                                <i class="bi bi-broadcast"></i> Cobertura</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="semenstres">

                        <div class="tab-pane fade show active" id="registroSubreceptor" role="tabpanel" aria-labelledby="sementre-1">


                            <div class="card border-primary mb-3" style="max-width: 60rem;">
                                <div class="card-headertext-white text-center" style="background-color:darkblue; color:snow">REGISTRO DE SUBRECEPTOR</div>
                                <div class="card-body text-primary bg-light-warning" style="font-size: 11px;">
                                    <form name="agregarSub" id="agregarSub" action="javascript: agregarSubreceptor();" method="GET">
                                        <div class="row">
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Codigo:</label>
                                                <input type="text" name="codigo" id="codigo" class="form-control form-control-sm" style="font-size: 12px;font-weight: bolder; color:darkblue;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-6">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" style="font-size: 12px;font-weight: bolder; color:darkblue;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Condon natural:</label>
                                                <input type="number" min="0" name="cnatural" id="cnatural" class="form-control form-control-sm" style="font-size: 12px;font-weight: bolder; color:darkblue;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Condon sabor:</label>
                                                <input type="number" min="0" name="csabor" id="csabor" class="form-control form-control-sm" style="font-size: 12px;font-weight: bolder; color:darkblue;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Condon femenino:</label>
                                                <input type="number" min="0" name="cfemenino" id="cfemenino" class="form-control form-control-sm" style="font-size: 12px;font-weight: bolder; color:darkblue;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Lubricante:</label>
                                                <input type="number" min="0" name="lubricante" id="lubricante" class="form-control form-control-sm" style="font-size: 12px;font-weight: bolder; color:darkblue;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">% Prueba VIH:</label>
                                                <input type="number" min="0" max="1" step="0.01" name="pruebavih" id="pruebavih" class="form-control form-control-sm" style="font-size: 12px;font-weight: bolder; color:darkblue;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">% Auto-prueba VIH:</label>
                                                <input type="number" min="0" max="1" step="0.01" name="autoprueba" id="autoprueba" class="form-control form-control-sm" style="font-size: 12px;font-weight: bolder; color:darkblue;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">...........................................................</label>
                                                <button type="submit" class="btn btn-outline-success"><i class="bi bi-save2-fill"></i> Guardar</button>
                                                <button type="reset" class="btn btn-outline-danger"><i class="bi bi-x-octagon-fill"></i> Cancelar</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>

                            <table class="table table-striped table-light table-bordered">
                                <thead class="table-dark text-center">
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
                                <tbody class="text-center">
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

                        <div class="tab-pane fade" id="registroReactivo" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card border-primary mb-3" style="max-width: 85rem;">
                                <div class="card-headertext-white text-center" style="background-color:darkblue; color:snow">REGISTRO DE COBERTURA</div>
                                <div class="card-body text-primary bg-light-warning" style="font-size: 12px;">
                                    <form name="agregarCobertura" id="agregarCobertura" action="javascript: agregarCobertura();" method="GET">
                                        <div class="row">
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">Subreceptor:</label>
                                                <select name="sub" id="sub" class="form-select" style="font-size: 12px;" required>
                                                    <option value="">Seleccionar...</option>
                                                    <?php
                                                    $sql = "SELECT * FROM subreceptor";
                                                    $resultado = mysqli_query($enlace, $sql);
                                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                                        echo '<option value="' . $fila['idSubreceptor'] . '">' . $fila['nombre'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Departamento:</label>
                                                <select name="departamento" id="departamento" class="form-select" onchange="llenarMunicipio();" style="font-size: 12px;" required>
                                                    <option value="">Seleccionar...</option>
                                                    <?php
                                                    $sql = "SELECT * FROM catalogo WHERE categoria = 'departamento' ORDER BY codigo AND categoria";
                                                    $resultado = mysqli_query($enlace, $sql);
                                                    $filas = mysqli_affected_rows($enlace);
                                                    if ($filas) {
                                                        while ($fila = mysqli_fetch_assoc($resultado)) {
                                                            echo '<option value="' . $fila['idCatalogo'] . '">' . $fila['nombre'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">Muinicipio:</label>
                                                <select id="municipio" name="municipio" class="form-select" style="font-size: 12px;" required></select>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">% Reactividad:</label>
                                                <input type="number" min="0.0" step="0.01" name="reactivo" id="reactivo" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <button type="submit" class="btn btn-success"><i class="bi bi-check"></i> Guardar</button>
                                                <button type="reset" class="btn btn-danger"><i class="bi bi-x"></i> Cancelar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <table class="table table-striped table-light table-bordered">
                                <thead class="table-dark text-center">
                                    <th>#</th>
                                    <th>Subreceptor</th>
                                    <th>Departamento</th>
                                    <th>Municipio</th>
                                    <th>% Reactividad</th>
                                    <th>Opciones</th>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $contador = 1;
                                    $sql = "SELECT t4.nombre as subreceptor, t2.nombre as departamento, t3.nombre as municipio, t1.porcentaje 
                                    FROM cobertura t1
                                    LEFT JOIN catalogo t2 ON t2.idCatalogo = t1.departamento
                                    LEFT JOIN catalogo t3 ON t3.idCatalogo = t1.municipio
                                    LEFT JOIN subreceptor t4 ON t4.idSubreceptor = t1.subreceptor_id ORDER BY t4.nombre;";
                                    $consulta = mysqli_query($enlace, $sql);
                                    while ($data = mysqli_fetch_assoc($consulta)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $contador++; ?></td>
                                            <td><?php echo $data['subreceptor']; ?></td>
                                            <td><?php echo $data['departamento']; ?></td>
                                            <td><?php echo $data['municipio']; ?></td>
                                            <td><?php echo $data['porcentaje']; ?></td>
                                            <td>
                                                <a class="btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarSub<?php echo $data['idSubreceptor']; ?>"><i class="bi bi-pencil-fill"></i> Editar</a>
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
                    </div>
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
    <script src="../controlador/controladorSubreceptor.js"></script>
    <script src="../controlador/controladorUtilidad.js"></script>
    <!---- ARCHIVOS EXTERNOS--->
    <?php
    include 'componente/menu.php';
    ?>
</body>

</html>