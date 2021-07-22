/**
 * Funcion que permite obtener los datos del poa segun sea el municipio
 */
function consultaPoa() {

    var subreceptor = document.getElementById('subreceptor').value;
    var periodo = document.getElementById('cperiodo').value;
    var municipio = document.getElementById('cmunicipio').value;
    var mes = document.getElementById('cmes').value;

    var accion = "consultaPoa";

    $.ajax({
        type: "POST",
        url: "../../servicio/servicioPOM.php",
        data: {
            accion: accion,
            subreceptor, subreceptor,
            periodo: periodo,
            municipio: municipio,
            mes: mes
        },
        success: function (datos) {

            $('#resultadoPOA').html(datos)
        }
    });
}

/**
 * Funcion para obtener el POA
 */
function cargarPoa(id) {
    var id = id;

    var accion = "cargarPoa";

    $.ajax({
        type: "POST",
        url: "../../servicio/servicioPOM.php",
        data: {
            accion: accion,
            id: id
        },
        success: function (datos) {

            var resultado = datos.split(',');
            document.getElementById('poa').value = resultado[0];
            document.getElementById('periodo').value = resultado[1];
            document.getElementById('mes').value = resultado[2];
            document.getElementById('nombreMes').value = resultado[3];
            document.getElementById('municipio').value = resultado[4];
            document.getElementById('nombreMunicipio').value = resultado[5];
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
        url: "../../servicio/servicioPOM.php",
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
        url: "../../servicio/servicioPOM.php",
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
            document.getElementById('cnatural').value = cnatural.toFixed(4);
            document.getElementById('csabor').value = csabor.toFixed(4);
            document.getElementById('cfemenino').value = cfemenino.toFixed(4);
            document.getElementById('lubricante').value = lubricante.toFixed(4);
            document.getElementById('pruebaVIH').value = pruebaVIH.toFixed(4);
            document.getElementById('autoPrueba').value = autoPrueba.toFixed(4);
            document.getElementById('reactivoEs').value = reactivo.toFixed(4);
            document.getElementById('sifilis').value = total;
        }
    });
}

/**
 * Metodo que permite agregar nuevo POM
 */
function agregarPOM() {

    var poa = document.getElementById('poa').value;
    var estado = document.getElementById('estado').value;
    var descripcion = document.getElementById('descripcion').value;
    var periodo = document.getElementById('periodo').value;
    var mes = document.getElementById('mes').value;
    var municipio = document.getElementById('municipio').value;
    var inicio = document.getElementById('inicio').value;
    var fin = document.getElementById('fin').value;

    var promotor = document.getElementById('promotor').value;
    var supervisado = document.getElementById('supervisado').value;
    var supervisor = document.getElementById('supervisor').value;
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
}
