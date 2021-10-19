<?php
    include_once('../../bd/conexion.php');
    header("Content-Type: text/html;charset=utf-8");
    date_default_timezone_set("America/Guatemala");
	session_start();

    if (isset($_POST['accion'])) { $accion = $_POST['accion']; }
    if (isset($_GET['accion'])) { $accion = $_GET['accion'];}

    /**
     * Metodo que permite agregar un nuevo subreceptor
     * */
    if ($accion == "agregarSubreceptor") {

        $codigo     = $_POST['codigo'];
        $nombre     = $_POST['nombre'];
        $cnatural   = $_POST['cnatural'];
        $csabor     = $_POST['csabor'];
        $cfemenino  = $_POST['cfemenino'];
        $lubricante = $_POST['lubricante'];
        $pruebavih  = $_POST['pruebavih'];
        $autoprueba = $_POST['autoprueba'];

        $_duplicado =$enlace->query("SELECT * FROM subreceptor WHERE codigo = '$codigo'");
        if(mysqli_num_rows($_duplicado)){
            echo "Duplicado";
        } else {
            $sql1 = "CALL agregarSubreceptor('$codigo', '$nombre', $cnatural, $csabor, $cfemenino, $lubricante, $pruebavih, $autoprueba)";
            $resultado1 = mysqli_query($enlace, $sql1);
            $sub = mysqli_affected_rows($enlace);
            if ($sub > 0) {
                echo "Exito";
            } else {
                echo "Error";
            }
        }
    }
    /**
     * Metodo que permite agregar un nuevo subreceptor
     * */
    if ($accion == "editarSubreceptor") {

        $id         = $_POST['id'];
        $codigo     = $_POST['codigo'];
        $nombre     = $_POST['nombre'];
        $cnatural   = $_POST['cnatural'];
        $csabor     = $_POST['csabor'];
        $cfemenino  = $_POST['cfemenino'];
        $lubricante = $_POST['lubricante'];
        $pruebavih  = $_POST['pruebavih'];
        $autoprueba = $_POST['autoprueba'];

            $sqlEditar = "CALL editarSubreceptor($id, '$codigo', '$nombre', $cnatural, $csabor, $cfemenino, $lubricante, $pruebavih, $autoprueba)";
            $resultadoEditar = mysqli_query($enlace, $sqlEditar);
            $editar = mysqli_affected_rows($enlace);
            if ($editar > 0) {
                echo "Exito";
            } else {
                echo "Error";
            }
    }
    /**
     * Metodo que permite agregar reactivo esperado
     * */
    if ($accion == "agregarCobertura") {

        $subreceptor    = $_POST['subreceptor'];
        $departamento   = $_POST['departamento'];
        $municipio      = $_POST['municipio'];
        $region         = $_POST['region'];
        $nuevo          = $_POST['nuevo'];
        $recurrente     = $_POST['recurrente'];
        $reactivo       = $_POST['reactivo'];

        $_duplicado =$enlace->query("SELECT * FROM cobertura WHERE subreceptor_id = $subreceptor AND departamento = '$departamento'AND municipio = '$municipio'");
        if(mysqli_num_rows($_duplicado)){
            echo "Duplicado";
        } else {
            $sql2 = "CALL agregarCobertura($subreceptor, $departamento, $municipio, $region, $nuevo, $recurrente, $reactivo)";
            $resultado2 = mysqli_query($enlace, $sql2);
            $cobertura = mysqli_affected_rows($enlace);
            if ($cobertura > 0) {
                echo "Exito";
            } else {
                echo "Error";
            }
        }

    }
