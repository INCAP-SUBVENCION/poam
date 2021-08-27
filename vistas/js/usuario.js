/**
 * Funcion que permite agregar nuevo usuario
 */
function agregarUsuario() {

    var documento   = document.getElementById('documento').value;
    var numero      = document.getElementById('numero').value;
    var pnombre     = document.getElementById('pnombre').value;
    var snombre     = document.getElementById('snombre').value;
    var papellido   = document.getElementById('papellido').value;
    var sapellido   = document.getElementById('sapellido').value;
    var direccion   = document.getElementById('direccion').value;
    var telefono    = document.getElementById('telefono').value;
    var correo      = document.getElementById('correo').value;
    var rol         = document.getElementById('rol').value;
    var subreceptor = document.getElementById('subreceptor').value;

    var accion = "agregarUsuario";

    $.ajax({
        type: "POST",
        url: "../php/usuario.php",
        data: {
            accion: accion,
            documento: documento,
            numero: numero,
            pnombre: pnombre,
            snombre: snombre,
            papellido: papellido,
            sapellido: sapellido,
            direccion: direccion,
            telefono: telefono,
            correo: correo,
            rol: rol,
            subreceptor: subreceptor
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarUsuario').trigger("reset");
                window.location.reload('vistas/configuracion/usuario.php');
            } else if(datos == 'Duplicado'){
              alertify.warning('!El usuario ya existe');
            }
            else {
                alertify.error('ERROR!... No se pudo guardar');
            }
        }
    });
}
