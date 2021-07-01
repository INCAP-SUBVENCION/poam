/**
 * Funcion que permite agregar nuevo POA
 */
 function agregarPoa() {

    var usuario     = parseInt(document.getElementById('usuario').value);
    var mes         = parseInt(document.getElementById('mes').value);
    var departamento = parseInt(document.getElementById('departamento').value);
    var municipio   = parseInt(document.getElementById('municipio').value);
    var nuevo       = parseFloat(document.getElementById('nuevo').value);
    var recurrente  = parseFloat(document.getElementById('recurrente').value);
    var subreceptor = parseInt(document.getElementById('subreceptor').value);
    var observacion = document.getElementById('observacion').value;
    var cnatural    = parseFloat(document.getElementById('cnatural').value);
    var csabor      = parseFloat(document.getElementById('csabor').value);
    var cfemenino   = parseFloat(document.getElementById('cfemenino').value);
    var lubricante  = parseFloat(document.getElementById('lubricante').value);
    var pruebaVIH   = parseFloat(document.getElementById('pruebaVIH').value);
    var autoPrueba  = parseFloat(document.getElementById('autoPrueba').value);
    var reactivoEs  = parseFloat(document.getElementById('reactivoEs').value);
    var sifilis     = parseFloat(document.getElementById('sifilis').value);

    var accion = "agregarPoa";

    $.ajax({
        type: "GET",
        url: "../servicio/poa.php",
        data: {
            accion: accion,
            usuario: usuario,
            mes: mes,
            departamento: departamento,
            municipio: municipio,
            nuevo: nuevo,
            recurrente: recurrente,
            subreceptor: subreceptor,
            observacion: observacion,
            cnatural: cnatural,
            csabor: csabor,
            cfemenino: cfemenino,
            lubricante: lubricante,
            pruebaVIH: pruebaVIH,
            autoPrueba: autoPrueba,
            reactivoEs: reactivoEs,
            sifilis: sifilis
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarPoa').trigger("reset");
                $('#nuevoPoa').modal('hide')
                window.location.reload('poa.php');
            } else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }

        }
    });

}
/**
 * Funcion paara calcular la proyeccion de insumos para el POA
 */
function calcularProyeccionPOA() {

    var subreceptor = document.getElementById('subreceptor').value;
    var total = parseFloat(document.getElementById('total').value);

    var accion = "calcularProyeccionPOA";

    $.ajax({
        type: "POST",
        url: "../servicio/poa.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            total: total
        },
        success: function (datos) {
            var resultado   = datos.split(',');
            var cnatural    = parseFloat(resultado[0]);
            var csabor      = parseFloat(resultado[1]);
            var cfemenino   = parseFloat(resultado[2]);
            var lubricante  = parseFloat(resultado[3]);
            var pruebaVIH   = parseFloat(resultado[4]);
            var autoPrueba  = parseFloat(resultado[5]);
            document.getElementById('cnatural').value   = cnatural.toFixed(4);
            document.getElementById('csabor').value     = csabor.toFixed(4);
            document.getElementById('cfemenino').value  = cfemenino.toFixed(4);
            document.getElementById('lubricante').value = lubricante.toFixed(4);
            document.getElementById('pruebaVIH').value  = pruebaVIH.toFixed(4);
            document.getElementById('autoPrueba').value = autoPrueba.toFixed(4);
            document.getElementById('sifilis').value    = total;
        }
    });

}
