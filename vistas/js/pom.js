/**
 * Funcion que permite obtener los datos del poa segun sea el municipio
 */
function consultaPoa() {

    var subreceptor = document.getElementById('subreceptor').value;
    var periodo = document.getElementById('cperiodo').value;
    var municipio = document.getElementById('cmunicipio').value;
    var mes = document.getElementById('cmes').value;
    var promotor = document.getElementById('promotor').value;
    var dias = document.getElementById('dias').value;

    var accion = "consultaPoa";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            subreceptor, subreceptor,
            periodo: periodo,
            municipio: municipio,
            mes: mes,
            promotor: promotor,
            dias
        },
        success: function (datos) {
            obtenerCantidadPromotor(subreceptor, municipio);
            $('#resultadoPOA').html(datos);
        }
    });
}

/**
 * Funcion para obtener el POA
 */
function cargarPoa(id, prom, dias) {

    var id = id;
    var promotor = prom;
    var dias = dias;

    var accion = "cargarPoa";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            id: id
        },
        success: function (datos) {
            var respuesta = datos.split(',');
            var nuevos = respuesta[6] / promotor;
            var rnuevos = nuevos/dias;
            var recurrentes = (respuesta[7] / promotor);
            var rrecurrentes = recurrentes / dias;

            document.getElementById('poa').value = respuesta[0];
            document.getElementById('periodo').value = respuesta[1];
            document.getElementById('mes').value = respuesta[2];
            document.getElementById('nombreMes').value = respuesta[3];
            document.getElementById('municipio').value = respuesta[4];
            document.getElementById('nombreMunicipio').value = respuesta[5];
            document.getElementById('nuevo').value = rnuevos.toFixed(2);
            document.getElementById('recurrente').value = rrecurrentes.toFixed(2);

        }
    });
}

/**
 * Funcion que permite llenar el reactivo segun sea el muncipio y subreceptor
 */
function llenarReactivo() {

    var subreceptor = document.getElementById('subreceptor').value;
    var municipio = document.getElementById('cmunicipio').value;

    var accion = "llenarReactivo";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            municipio: municipio
        },
        success: function (datos) {
            var reactividad = datos * 100;
            document.getElementById('reactivo').value = datos;
            $("#porcentaje").html(reactividad + ' %');
        }
    });
}
/**
 * Funcion para calcular el POM
 */
function calcularPom() {
    var total = parseFloat(document.getElementById('total').value);
    var subreceptor = document.getElementById('subreceptor').value;
    var procentaje = parseFloat(document.getElementById('reactivo').value);

    var accion = "calcularPom";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            total: total
        },
        success: function (datos) {
            var resultado = datos.split(',');
            var cnatural = parseFloat(resultado[0]);
            var csabor = parseFloat(resultado[1]);
            var cfemenino = parseFloat(resultado[2]);
            var lubricante = parseFloat(resultado[3]);
            var pruebaVIH = parseFloat(resultado[4]);
            var autoPrueba = parseFloat(resultado[5]);
            var reactivo = total * procentaje;
            document.getElementById('cnatural').value = cnatural.toFixed(2);
            document.getElementById('csabor').value = csabor.toFixed(2);
            document.getElementById('cfemenino').value = cfemenino.toFixed(2);
            document.getElementById('lubricante').value = lubricante.toFixed(2);
            document.getElementById('pruebaVIH').value = pruebaVIH.toFixed(2);
            document.getElementById('autoPrueba').value = autoPrueba.toFixed(2);
            document.getElementById('reactivoEs').value = reactivo.toFixed(2);
            document.getElementById('sifilis').value = total;
        }
    });
}
/**
 * Metodo que permite agregar nuevo POM
 */
function agregarPOM() {

    var poa = document.getElementById('poa').value;
    var usuario = document.getElementById('usuario').value;
    var periodo = document.getElementById('periodo').value;
    var mes = document.getElementById('mes').value;
    var municipio = document.getElementById('municipio').value;
    var fecha = document.getElementById('fecha').value;
    var inicio = document.getElementById('inicio').value;
    var fin = document.getElementById('fin').value;
    var lugar = document.getElementById('lugar').value;
    var promotor = document.getElementById('promotor').value;
    var nuevo = document.getElementById('nuevo').value;
    var recurrente = document.getElementById('recurrente').value;
    var cnatural = document.getElementById('cnatural').value;
    var csabor = document.getElementById('csabor').value;
    var cfemenino = document.getElementById('cfemenino').value;
    var lubricante = document.getElementById('lubricante').value;
    var pruebaVIH = document.getElementById('pruebaVIH').value;
    var autoPrueba = document.getElementById('autoPrueba').value;
    var reactivoEs = document.getElementById('reactivoEs').value;
    var sifilis = document.getElementById('sifilis').value;
    var observacion = document.getElementById('observacion').value;
    var subreceptor = document.getElementById('subreceptor').value;

    var accion = "agregarPOM";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            poa: poa,
            usuario: usuario,
            periodo: periodo,
            mes: mes,
            municipio: municipio,
            fecha: fecha,
            inicio: inicio,
            fin: fin,
            lugar: lugar,
            promotor: promotor,
            nuevo: nuevo,
            recurrente: recurrente,
            cnatural: cnatural,
            csabor: csabor,
            cfemenino: cfemenino,
            lubricante: lubricante,
            pruebaVIH: pruebaVIH,
            autoPrueba: autoPrueba,
            reactivoEs: reactivoEs,
            sifilis: sifilis,
            observacion: observacion,
            subreceptor: subreceptor
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarPom').trigger("reset");
                window.location.reload('pom.php');
            } else if (datos == 'Duplicado') {
                alertify.warning('¡El POM ya existe!...');
            }
            else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }
        }
    });
}
/**
 * Funcion que permite obtener el numero de promotres asignados a cada municipio
 */
function obtenerCantidadPromotor() {

    var subreceptor = document.getElementById('subreceptor').value;
    var municipio = document.getElementById('cmunicipio').value;

    var accion = "obtenerCantidadPromotor";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            municipio: municipio
        },
        success: function (datos) {
            var resultado = datos.split(',');
            var nPromtor = resultado[0];
            var dias = resultado[1];
            document.getElementById('promotor').value = nPromtor;
            document.getElementById('dias').value = dias;
        }
    });
}
