/**
 * Funcion que perminte llenar combo con los municipios segun el departamento semestre 1
 */
function llenarMunicipio() {

    var departamento = document.getElementById('departamento').value;

    var accion = "llenarMunicipio";

    $.ajax({
        type: "POST",
        url: "../php/utilidad.php",
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
        url: "../../php/utilidad.php",
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
 * Funcion que perminte llenar combo con los municipios segun el departamento semestre 1 a editar
 */
 function llenarMunicipioCobertura_editar() {

    var subreceptor = document.getElementById('esubreceptor').value;
    var departamento = parseInt(document.getElementById('edepartamento').value);
    var accion = "municipioCobertura";

    $.ajax({
        type: "POST",
        url: "../../php/utilidad.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            departamento: departamento
        },
        success: function (datos) {
            $("#emunicipio").html(datos);
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
        url: "../../php/utilidad.php",
        data: {
            accion: accion,
            periodo: periodo
        },
        success: function (datos) {
            $("#mes").html(datos);
        }
    });
}

/**
 * Funcion para obtener los meses segun el semestre para editar
 */
 function periodo_mes_editar() {

    var periodo = document.getElementById('eperiodo').value;

    var accion = "periodo_mes";

    $.ajax({
        type: "POST",
        url: "../../php/utilidad.php",
        data: {
            accion: accion,
            periodo: periodo
        },
        success: function (datos) {
            $("#emes").html(datos);
        }
    });
}

/**
 * Funcio que permite obtener los datos de las metas nueva y recurrentes
 */
function obtenerMeta() {
    
    var municipio   = document.getElementById('municipio').value;
    var subreceptor = document.getElementById('subreceptor').value;
    var periodo     = document.getElementById('periodo').value;

    var accion = "obtenerMeta";
 
    $.ajax({
        type: "POST",
        url: "../../php/utilidad.php",
        data: {
            accion: accion,
            municipio: municipio,
            subreceptor: subreceptor,
            periodo: periodo
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
function obtenerResumen() {

    var periodo    = document.getElementById('periodo').value;
    var municipio   = document.getElementById('municipio').value;
    var subreceptor = document.getElementById('subreceptor').value;

    var accion = "obtenerResumen";

    $.ajax({
        type: "POST",
        url: "../../php/utilidad.php",
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
 * Funcion que permite llenar el reactivo segun sea el muncipio y subreceptor 
 */
 function obtenerReactivo() {

    var subreceptor = document.getElementById('subreceptor').value;
    var departamento = document.getElementById('departamento').value;
    var municipio = document.getElementById('municipio').value;

    var accion = "obtenerReactivo";

    $.ajax({
        type: "POST",
        url: "../../php/utilidad.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            departamento: departamento,
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
 * Funcion que permite calcular la meta segun seal el subreceptor
 */
function calcularMeta(){

  var metaNuevo       = 0.0;
  var metaRecurrente  = 0.0;
  var nuevo       = document.getElementById('nuevo').value;
  var recurrente  = document.getElementById('recurrente').value;
  var nMeses      = document.getElementById('meses').value;
  metaNuevo     = nuevo / nMeses;
  metaRecurrente= recurrente / nMeses;
  document.getElementById('metaNuevos').value     = metaNuevo.toFixed(2);
  document.getElementById('metaRecurrentes').value= metaRecurrente.toFixed(2);
}
/**
 * funcion que permite llamar varias fuciones para crear el POA
 */
function calculos() {
    obtenerReactivo();
    obtenerResumen();
}

function sumarPom(){

    var nuevo = parseFloat(document.getElementById('nuevo').value);
    var recurrente = parseFloat(document.getElementById('recurrente').value);
    var suma = nuevo + recurrente;
    parseFloat(document.getElementById('total').value = suma.toFixed(2));

}
/**
 * Funcion que permite obtener los municipios de cobertura
 */
function obtenerCobertura(){

    var subreceptor = document.getElementById('subreceptor').value;

    var accion = "obtenerCobertura";

    $.ajax({
        type: "POST",
        url: "../php/utilidad.php",
        data: {
            accion: accion,
            subreceptor: subreceptor
        },
        success: function (datos) {
            $("#cobertura").html(datos).multiSelect();
        }
    });
}
/**
 * Funcion que permite obtener el mes para crear el POM
 */
function obtenerMesPom(){

    var subreceptor = document.getElementById('subreceptor').value;
    var periodo     = document.getElementById('cperiodo').value;
    var municipio = document.getElementById('cmunicipio').value;


    var accion = "obtenerMesPom";

    $.ajax({
        type: "POST",
        url: "../../php/utilidad.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            periodo: periodo,
            municipio: municipio
        },
        success: function (datos) {
            $("#cmes").html(datos);
        }
    });
}
/**
 * Funcion para crear el nombre de usuario
 */
function creaUsuario(){
    var pnombre = document.getElementById('pnombre').value;
    var snombre = document.getElementById('snombre').value;
    var papellido = document.getElementById('papellido').value;
    var usuario = pnombre.substr(-20,1) + snombre.substr(-20,1)+papellido;
    document.getElementById('usuario').value = usuario.toLowerCase();
}
////////////////////////////EDITAR//////////////////////////////////////
/**
 * Funcion que permite llenar el reactivo segun sea el muncipio y subreceptor 
 */
 function obtenerReactivo_editar() {

    var subreceptor = document.getElementById('esubreceptor').value;
    var departamento = document.getElementById('edepartamento').value;
    var municipio = document.getElementById('emunicipio').value;

    var accion = "obtenerReactivo";

    $.ajax({
        type: "POST",
        url: "../../php/utilidad.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            departamento: departamento,
            municipio: municipio
        },
        success: function (datos) {
            var reactividad = datos * 100;
            document.getElementById('ereactivo').value = datos;
            $("#eporcentaje").html(reactividad + ' %');
        }
    });
}
/**
 * Funcion para obtener los datos del municipio
 */
 function obtenerResumen_editar(){

    var periodo    = document.getElementById('eperiodo').value;
    var municipio   = document.getElementById('emunicipio').value;
    var subreceptor = document.getElementById('esubreceptor').value;

    var accion = "obtenerResumen";

    $.ajax({
        type: "POST",
        url: "../../php/utilidad.php",
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
            document.getElementById('enuevo').value = nuevos;
            document.getElementById('erecurrente').value=recurrentes;
        }
    });
}

function calculos_editar() {
    obtenerResumen_editar()
    obtenerReactivo_editar();
}

/**
 * Metodo para obtener el reactivo segun sea el municipio
 */
function obtenerReactivoEditar() {

    var subreceptor = document.getElementById('esubreceptor').value;
    var municipio = document.getElementById('emunicipio').value;

    var accion = "obtenerReactivoEditar";

    $.ajax({
        type: "POST",
        url: "../../php/utilidad.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            municipio: municipio
        },
        success: function (datos) {
            var reactividad = datos * 100;
            document.getElementById('ereactivo').value = datos;
            $("#eporcentaje").html(reactividad + ' %');
        }
    });
}
/**
 * Metodo que permite sumar los nuevos y recurrentes a editar
 */
function sumarPomEditar(){

    var nuevo = parseFloat(document.getElementById('enuevo').value);
    var recurrente = parseFloat(document.getElementById('erecurrente').value);
    var suma = nuevo + recurrente;
    parseFloat(document.getElementById('etotal').value = suma.toFixed(2));

}

function supervisor(periodo, id) {
    var accion = "supervisor";
    $.ajax({
        type: "POST",
        url: "../../php/utilidad.php",
        data: {
            accion: accion,
            supervisor: id,
            periodo: periodo
        },
        success: function (datos) {
            $('#resultadoSupervisor').html(datos);
        }
    });
}

function supervisores(periodo, subreceptor) {
    var supervisor = document.getElementById('supers').value;
    var accion = "supervisores";

    $.ajax({
        type: "POST",
        url: "../../php/utilidad.php",
        data: {
            accion: accion,
            supervisor: supervisor,
            periodo: periodo,
            subreceptor: subreceptor
        },
        success: function (datos) {
            $('#resultadoSupervisor').html(datos);
        }
    });
}
