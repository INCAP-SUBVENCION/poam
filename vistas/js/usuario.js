/**
 * Funcion que permite agregar nuevo usuario
 */
function agregarUsuario() {
    
    var codigo      = document.getElementById('codigo').value;
    var pnombre     = document.getElementById('pnombre').value;
    var snombre     = document.getElementById('snombre').value;
    var papellido   = document.getElementById('papellido').value;
    var sapellido   = document.getElementById('sapellido').value;
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
            codigo: codigo,
            pnombre: pnombre,
            snombre: snombre,
            papellido: papellido,
            sapellido: sapellido,
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

function cambiarContraseña(){
    var pass_1 = document.getElementById('pass_1').value;
    var pass_2 = document.getElementById('pass_2').value;

    if(pass_1 != pass_2){
     
    }


}