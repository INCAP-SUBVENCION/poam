/**
 * Funcion para iniciar sesion
 */
function login() {
    var usuario = document.getElementById('usuario').value;
    var pass = document.getElementById('pass').value;

    var accion = "login";

    $.ajax({
        type: "POST",
        url: "login.php",
        data: {
            accion: accion,
            usuario: usuario,
            pass: pass
        },
        success: function (datos) {
            if (datos == 'Exito') {
                window.location.href = 'vistas/rutas.php';
                $('#login').trigger("reset");
            } else {
                alertify.error('Usuario o contraseña son incorrectos');
            }
        }
    })
}