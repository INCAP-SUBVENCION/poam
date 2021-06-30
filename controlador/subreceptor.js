function agregarSubreceptor() {
    var codigo = document.getElementById('codigo').value;
    var nombre = document.getElementById('nombre').value;
    var cnatural = document.getElementById('cnatural').value;
    var csabor = document.getElementById('csabor').value;
    var cfemenino = document.getElementById('cfemenino').value;
    var lubricante = document.getElementById('lubricante').value;
    var pruebavih = document.getElementById('pruebavih').value;
    var autoprueba = document.getElementById('autoprueba').value;

    var accion = "agregarSubreceptor";

    $.ajax({
        type: "GET",
        url: "../servicio/subreceptor.php",
        data: {
            accion: accion,
            codigo: codigo,
            nombre: nombre,
            cnatural: cnatural,
            csabor: csabor,
            cfemenino: cfemenino,
            lubricante: lubricante,
            pruebavih: pruebavih,
            autoprueba: autoprueba
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarSub').trigger("reset");
                $('#nuevoSub').modal('hide')
                window.location.reload('vistas/subreceptor.php');
            } else {
                alertify.error('ERROR!... No se pudo guardar');
            }

        }
    });
}