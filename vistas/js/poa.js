/**
 * Funcion que permite agregar nuevo POA para el semestre 1
 */
 function  agregarPoa() {

    var usuario     = parseInt(document.getElementById('usuario').value);
    var mes         = document.getElementById('mes').value;
    var departamento= document.getElementById('departamento').value;
    var municipio   = document.getElementById('municipio').value;
    var nuevo       = parseFloat(document.getElementById('nuevo').value);
    var recurrente  = parseFloat(document.getElementById('recurrente').value);
    var subreceptor = parseInt(document.getElementById('subreceptor').value);
    var observacion = document.getElementById('observacion').value;
    var periodo     = document.getElementById('periodo').value;
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
        type: "POST",
        url: "../../php/poa.php",
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
            periodo: periodo,
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
                window.location.reload('poa.php');
            } else if (datos == 'Duplicado') {
                alertify.warning('¡El POA ya existe!...');
            }
            else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }
        }
    });
}
/**
 * Funcion para calcular la proyeccion de insumos para el POA semestre 1
 */
function calcularProyeccionPOA() {
    var total = 0.0;
    var nuevo = parseFloat(document.getElementById('nuevo').value);
    var recurrente = parseFloat(document.getElementById('recurrente').value);
    total = nuevo + recurrente;
    var subreceptor = document.getElementById('subreceptor').value;
    var procentaje  = parseFloat(document.getElementById('reactivo').value);

    var accion = "calcularProyeccionPOA";

    $.ajax({
        type: "POST",
        url: "../../php/poa.php",
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
            var reactivo = total * procentaje;
            document.getElementById('cnatural').value   = cnatural.toFixed(4);
            document.getElementById('csabor').value     = csabor.toFixed(4);
            document.getElementById('cfemenino').value  = cfemenino.toFixed(4);
            document.getElementById('lubricante').value = lubricante.toFixed(4);
            document.getElementById('pruebaVIH').value  = pruebaVIH.toFixed(4);
            document.getElementById('autoPrueba').value = autoPrueba.toFixed(4);
            document.getElementById('reactivoEs').value = reactivo.toFixed(4);
            document.getElementById('sifilis').value    = total.toFixed(4);
            document.getElementById('total').value      = total.toFixed(4);
        }
    });
}
/**
 * Funcion que permite agregar una meta para calcular el POA
 */
function agregarResumen() {
    var cobertura   = document.getElementById('cobertura').value;
    var periodo     = document.getElementById('periodo').value;
    var meses       = document.getElementById('meses').value;
    var metaNuevos  = document.getElementById('metaNuevos').value;
    var metaRecurrentes = document.getElementById('metaRecurrentes').value;

    var accion = "agregarResumen";

    $.ajax({
        type: "POST",
          url: "../../php/poa.php",
        data:{
            accion: accion,
            cobertura: cobertura,
            periodo: periodo,
            meses: meses,
            metaNuevos: metaNuevos,
            metaRecurrentes: metaRecurrentes
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarMeta').trigger("reset");
                window.location.reload('poa.php');
            } else if (datos == 'Duplicado') {
                alertify.warning('¡El resumen ya existe!...');
            } else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }

        }
    });
}

