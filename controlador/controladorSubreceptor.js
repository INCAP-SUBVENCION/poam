/**
 * Funcion para agregar nuevo subreceptor
 */
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
        type: "POST",
        url: "../servicio/servicioSubreceptor.php",
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
/**
 * Funcion para agregar el reactivo esperado para calcular el POA
 */
 function agregarCobertura() {
    var subreceptor   = parseInt(document.getElementById('sub').value);
    var departamento  = parseInt(document.getElementById('departamento').value);
    var municipio     = parseInt(document.getElementById('municipio').value);
    var region        = document.getElementById('region').value;
    var nuevo         = parseFloat(document.getElementById('nuevo').value);
    var recurrente    = parseFloat(document.getElementById('recurrente').value);
    var reactivo      = parseFloat(document.getElementById('reactivo').value);


    var accion = "agregarCobertura";

    $.ajax({
        type: "POST",
        url: "../servicio/servicioSubreceptor.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            departamento: departamento,
            municipio: municipio,
            region: region,
            nuevo: nuevo,
            recurrente: recurrente,
            reactivo: reactivo
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarCobertura').trigger("reset");
                window.location.reload('vistas/subreceptor.php');
            } else {
                alertify.error('ERROR!... No se pudo guardar');
            }

        }
    });
}
