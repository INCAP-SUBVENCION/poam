function agregarPromotor(){
    var documento = document.getElementById('documento').value;
    var numero = document.getElementById('numero').value;
    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellido').value;
    var direccion = document.getElementById('direccion').value;
    var telefono = document.getElementById('telefono').value;
    var correo = document.getElementById('correo').value;
    var codigo = document.getElementById('codigo').value;
    var subreceptor = document.getElementById('subreceptor').value;

    var accion = "agregarPromotor";

    $.ajax({
        type: "POST",
        url: "../servicio/servicioPromotor.php",
        data: {
            accion: accion,
            documento: documento,
            numero: numero,
            nombre: nombre,
            apellido: apellido,
            direccion: direccion,
            telefono: telefono,
            correo: correo,
            codigo: codigo,
            subreceptor: subreceptor
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarPromotor').trigger("reset");
                window.location.reload('vistas/promotor.php');
            } else {
                alertify.error('ERROR!... No se pudo guardar');
            }

        }
    });
}