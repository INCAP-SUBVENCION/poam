$(document).ready(function () {
    $("#supervisor").hide();
    $('#super').on('change', function () {
        var c = document.getElementById('super').checked;
        if (c) {
            $("#supervisor").show();
            document.getElementById('supervisado').value = 1;
        } else {
            $("#supervisor").hide();
            document.getElementById('supervisado').value = 0;
        }
    });

});
/**
 * Funcion que perminte llenar combo con los municipios segun el departamento semestre 1
 */
function llenarMunicipio() {

    var departamento = document.getElementById('departamento').value;

    var accion = "llenarMunicipio";

    $.ajax({
        type: "POST",
        url: "../servicio/servicioUtilidad.php",
        data: {
            accion: accion,
            departamento: departamento
        },
        success: function (datos) {
            $("#municipio").html(datos);
        }
    });
}
/**
 * Funcion que perminte llenar combo con los municipios segun el departamento semestre 1
 */
function llenarMunicipioCobertura() {

    var subreceptor = document.getElementById('subreceptor').value;
    var departamento = parseInt(document.getElementById('departamento').value);
    var accion = "municipioCobertura";

    $.ajax({
        type: "POST",
        url: "../../servicio/servicioUtilidad.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            departamento: departamento
        },
        success: function (datos) {
            $("#municipio").html(datos);
        }
    });
}

/**
 * Funcion para obtener los meses segun el semestre
 */
function periodo_mes() {

    var periodo = document.getElementById('periodo').value;

    var accion = "periodo_mes";

    $.ajax({
        type: "POST",
        url: "../../servicio/servicioUtilidad.php",
        data: {
            accion: accion,
            periodo: periodo
        },
        success: function (datos) {
            $("#mes").html(datos);
        }
    });
}

function obtenerMeta() {

    var municipio   = document.getElementById('municipio').value;
    var subreceptor = document.getElementById('subreceptor').value;

    var accion = "obtenerMeta";

    $.ajax({
        type: "POST",
        url: "../../servicio/servicioUtilidad.php",
        data: {
            accion: accion,
            municipio: municipio,
            subreceptor: subreceptor
        },
        success: function (datos) {
            var respuesta   = datos.split(',');
            var nuevos      = respuesta[0];
            var recurrentes = respuesta[1];
            var id          = respuesta[2];
            document.getElementById('nuevo').value      = nuevos;
            document.getElementById('recurrente').value = recurrentes;
            document.getElementById('cobertura').value  = id;
        }
    });
}

/**
 * Funcion para obtener los datos de nuevo segun sea el municipio
 */
function obtenerResumen(){

    var periodo    = document.getElementById('periodo').value;
    var municipio   = document.getElementById('municipio').value;
    var subreceptor = document.getElementById('subreceptor').value;

    var accion = "obtenerResumen";

    $.ajax({
        type: "POST",
        url: "../../servicio/servicioUtilidad.php",
        data: {
            accion: accion,
            periodo: periodo,
            municipio: municipio,
            subreceptor: subreceptor
        },
        success: function (datos) {
            var respuesta = datos.split(',')
            var nuevos = respuesta[0];
            var recurrentes = respuesta[1];
            document.getElementById('nuevo').value = nuevos;
            document.getElementById('recurrente').value=recurrentes;
        }
    });
}

/**
 * Funcion que permite llenar el reactivo segun sea el muncipio y subreceptor semestre 1
 */
 function obtenerReactivo() {

    var subreceptor = document.getElementById('subreceptor').value;
    var departamento = document.getElementById('departamento').value;
    var municipio = document.getElementById('municipio').value;

    var accion = "llenarReactivo";

    $.ajax({
        type: "POST",
        url: "../../servicio/servicioUtilidad.php",
        data: {
            accion: accion,
            subreceptor, subreceptor,
            departamento: departamento,
            municipio: municipio
        },
        success: function (datos) {
            var reactividad = datos.concat(' %');
            document.getElementById('reactivo').value = datos;
            $("#porcentaje").html(reactividad);
        }
    });
}

function calcularMeta(){
  var metaNuevo       = 0.0;
  var metaRecurrente  = 0.0;
  var nuevo       = document.getElementById('nuevo').value;
  var recurrente  = document.getElementById('recurrente').value;
  var nMeses      = document.getElementById('meses').value;
  metaNuevo     = nuevo / nMeses;
  metaRecurrente= recurrente / nMeses;
  document.getElementById('metaNuevos').value     = metaNuevo.toFixed(4);
  document.getElementById('metaRecurrentes').value= metaRecurrente.toFixed(4);
}

function calculos() {
    obtenerReactivo();
    obtenerResumen();
}
