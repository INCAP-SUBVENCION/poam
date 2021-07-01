<?php
include_once('../bd/conexion.php');
header('Content-Type: text/html; charset=ISO-8859-1');
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Operativo Anual</title>

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


    <body>
        <nav class="navbar navbar-dark bg-warning">
            <img src="../assets/images/vihinvertido.png" width="35">
            <a class="navbar-brand" href="poa.php">Inicio</a>
            <a href="">Faustino Lopez Ramos</a>
        </nav>


        <!-- Striped rows start -->
        <section class="section">


            <table class="table table-bordered border-primary">
                <thead class="text-center table-dark border">
                    <tr>
                        <td colspan="15" class="text-white text-xl"> <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#nuevoPoa">Nuevo</button> PLAN OPERATIVO ANUAL</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-white">DATOS PRINCIPALES </td>
                        <td colspan="10" class="text-white">INSUMOS PROYECTADOS POR MES</td>
                    </tr>
                    <tr style="font-size: 11px;">
                        <th>#</th>
                        <th>Municipio</th>
                        <th>Nuevos</th>
                        <th>Recurrentes</th>
                        <th>Total</th>
                        <th>Condon natural</th>
                        <th>Condon sabor</th>
                        <th>Condon femenino</th>
                        <th>Lubricantes</th>
                        <th>Prueba VIH</th>
                        <th>Auto prueba VIH</th>
                        <th>Reactivos esperados</th>
                        <th>Prueba Sifilis</th>
                        <th>Observaciones</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="text-center" style="font-size: 11px;">
                    <?php
                    $contador = 0;
                    $sql = "SELECT DISTINCT  m.nombre, p.nuevo, p.recurrente, (p.nuevo + p.recurrente) AS total, p.observacion, 
                                                i.cnatural, i.csabor, i.cfemenino, i.lubricante, i.pruebaVIH, i.autoPrueba, i.reactivoE, i.sifilis 
                                                FROM poa p LEFT JOIN insumo i ON i.poa_id =p.idPoa
                                                LEFT JOIN catalogo d ON d.idCatalogo = p.departamento
                                                LEFT JOIN catalogo m ON m.idCatalogo = p.municipio";
                    $resultado = mysqli_query($enlace, $sql);
                    $filas = mysqli_affected_rows($enlace);
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $contador++;
                        echo '
                                                        <tr>
                                                        <td>' . $contador . '</td>
                                                        <td>' . $fila['nombre'] . '</td>
                                                        <td>' . $fila['nuevo'] . '</td>
                                                        <td>' . $fila['recurrente'] . '</td>
                                                        <td style="font-weight: bolder;">' . round($fila['total'], 4) . '</td>
                                                        <td>' . $fila['cnatural'] . '</td>
                                                        <td>' . $fila['csabor'] . '</td>
                                                        <td>' . $fila['cfemenino'] . '</td>
                                                        <td>' . $fila['lubricante'] . '</td>
                                                        <td>' . $fila['pruebaVIH'] . '</td>
                                                        <td>' . $fila['autoPrueba'] . '</td>
                                                        <td>' . $fila['reactivoE'] . '</td>
                                                        <td>' . $fila['sifilis'] . '</td>
                                                        <td>' . $fila['observacion'] . '</td>';
                        echo ' <td> <a href="#" class="btn-sm btn-outline-warning"><i class="bi bi-pencil-square"></i> Editar</a> </td>';
                        echo '</tr>';
                    }
                    ?>

                </tbody>
            </table>
        </section>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>Subvencion 2021 &copy; incap.int</p>
                </div>
            </div>
        </footer>


        <!------ JS ------>
        <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/vendors/jquery/jquery.min.js"></script>
        <script src="../assets/vendors/alertifyjs/alertify.js"></script>
        <script src="../controlador/poa.js"></script>
        <script src="../controlador/utilidad.js"></script>
        <!-- Archivos externos --->
        <?php
        include 'modal/nuevoPoa.php';
        ?>
    </body>

</html>