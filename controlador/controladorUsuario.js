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
    var agregar     = document.getElementById('agregar').value;
    var editar      = document.getElementById('editar').value;
    var usuarios    = document.getElementById('usuarios').value;
    var sub         = document.getElementById('subreceptores').value;
    var poas        = document.getElementById('poas').value;
    var poms        = document.getElementById('poms').value;
    var coberturas  = document.getElementById('coberturas').value;
    var promotores  = document.getElementById('promotores').value;
    var resumen     = document.getElementById('resumen').value;
    var catalogos     = document.getElementById('catalogos').value;

    var accion = "agregarUsuario";

    $.ajax({
        type: "POST",
        url: "../servicio/servicioUsuario.php",
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
            subreceptor: subreceptor,
            agregar: agregar,
            editar: editar,
            usuarios: usuarios,
            sub: sub,
            poas: poas,
            poms: poms,
            coberturas: coberturas,
            promotores: promotores,
            resumen: resumen,
            catalogos: catalogos
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarUsuario').trigger("reset");
                window.location.reload('vistas/usuario.php');
            } else if(datos == 'Duplicado'){
              alertify.warning('!El usuario ya existe');
            }
            else {
                alertify.error('ERROR!... No se pudo guardar');
            }

        }
    });
}
