<?php
header('Content-Type: text/html; charset=ISO-8859-1'); 
include_once('../bd/conexion.php');

if (isset($_POST['accion'])) { $accion = $_POST['accion']; }
if (isset($_GET['accion'])) { $accion = $_GET['accion'];}

/**
 * Metodo que permite llenar muncipio en el combo segun sea el departamento
 */
if ($accion == "llenarMunicipio") {
    $departamento = $_POST['departamento'];

    $sql = "SELECT * FROM catalogo WHERE categoria = 'municipio' AND descripcion = '" . $departamento . "' ORDER BY codigo";
    $resultado = mysqli_query($enlace, $sql);
    $filas = mysqli_affected_rows($enlace);
    if ($filas) {
        echo "<option value=''>Seleccionar...</option>";
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo '<option value="' . $fila['idCatalogo'] . '">' . $fila['nombre'] . '</option>';
        }
    }
}

?>