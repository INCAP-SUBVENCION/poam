<?php
include_once('bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--- CSS --->
    <link rel="stylesheet" href="assets/css/auth.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/vendors/alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="assets/vendors/alertifyjs/css/themes/default.css">

    <title>Inicio de sesion</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: smaller;
        }
    </style>
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="text-center">
                        <img src="assets/images/vih.png" width="150" alt="">
                    </div>
                    <h4 class="auth-title text-center">Iniciar sesion</h4>
                    <form name="login" id="login" method="POST" action="javascript: login();">
                        <div class="form-group position-relative has-icon-left">
                            <input type="text" name="usuario" id="usuario" class="form-control form-control-xl" placeholder="Usuario">
                            <div class="form-control-icon">
                                <em class="bi bi-person"></em>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <input type="password" name="pass" id="pass" class="form-control form-control-xl" placeholder="Contraseña">
                            <div class="form-control-icon">
                                <em class="bi bi-shield-lock"></em>
                            </div>
                        </div>
                        <input type="submit" value="Entrar" class="btn btn-primary btn-block btn-lg shadow-lg">
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                
                <div class="text-center">
                    <img src="assets/images/p.png" width="500" alt="">
                    <h3 class="auth-title text-center">Sistema de Planificación Operativa Anual y Mensual </h3>
                    <br>
                    <img src="assets/images/logo.png" width="250" alt="">
                    <img src="assets/images/sica.png" width="250" alt="">
                </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!--- JS --->
    <script src="assets/vendors/alertifyjs/alertify.js"></script>
    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="login.js"></script>

</body>

</html>