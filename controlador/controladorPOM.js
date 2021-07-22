/**
 * Funcion para obtener el POA
 */
 function cargarPoa(id) {
    var id      = id;
    
    var accion  = "cargarPoa";

    $.ajax({
        type: "POST",
        url: "../../servicio/servicioPOM.php",
        data: {
            accion: accion,
            id: id
        },
        success: function (datos) {

            var resultado   = datos.split(',');
            document.getElementById('idP').value      = resultado[0];
            document.getElementById('periodo').value    = resultado[1];
            document.getElementById('mes').value        = resultado[2];
            document.getElementById('nombreMes').value  = resultado[3];
            document.getElementById('municipio').value    = resultado[4];
            document.getElementById('nombreMunicipio').value  = resultado[5];
        }
    });
}

/**
 * Funcion que permite obtener los datos del poa segun sea el municipio
 */
 function consultaPoa(){

    var subreceptor = document.getElementById('csubreceptor').value;
    var periodo     = document.getElementById('cperiodo').value;
    var municipio   = document.getElementById('cmunicipio').value;
    var mes         = document.getElementById('cmes').value;

    var accion      =  "consultaPoa";
 
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
 * Funcion para calcular el POM
 */
 function calcularPom() {
    var total       = parseFloat(document.getElementById('total').value);
    var subreceptor = document.getElementById('subreceptor').value;
    var procentaje  = parseFloat(document.getElementById('reactivo').value);

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
            document.getElementById('sifilis').value    = total;
        }
    });
}