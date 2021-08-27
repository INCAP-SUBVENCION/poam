/**
 * Funcion que permite agregar nuevo promotor
 */
function agregarPromotor(){
    var subreceptor = document.getElementById('subreceptor').value;
    var codigo      = document.getElementById('codigo').value;
    var documento   = document.getElementById('documento').value;
    var numero = document.getElementById('numero').value;
    var pnombre = document.getElementById('pnombre').value;
    var snombre = document.getElementById('snombre').value;
    var papellido = document.getElementById('papellido').value;
    var sapellido = document.getElementById('sapellido').value;
    var direccion = document.getElementById('direccion').value;
    var telefono = document.getElementById('telefono').value;
    var correo = document.getElementById('correo').value;
    var usuario =   document.getElementById('usuario').value;
    var rol = document.getElementById('rol').value;
    var dias = document.getElementById('dias').value;
    var cobertura   = $("#cobertura").val();
    console.log(cobertura)
    var accion = "agregarPromotor";

    $.ajax({
        type: "POST",
        url: "../php/promotor.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            codigo: codigo,
            cobertura: cobertura,
            documento: documento,
            numero: numero,
            pnombre: pnombre,
            snombre: snombre,
            papellido: papellido,
            sapellido: sapellido,
            direccion: direccion,
            telefono: telefono,
            correo: correo,
            usuario: usuario,
            rol: rol,
            dias: dias
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarPromotor').trigger("reset");
                window.location.reload('vistas/configuracion/promotor.php');
            } else if (datos == 'Duplicado') {
                alertify.warning('¡El promotor ya existe!...');
            }
            else {
                alertify.error('ERROR!... No se pudo guardar');
            }

        }
    });
}
