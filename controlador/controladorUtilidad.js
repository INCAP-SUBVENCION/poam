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
 * Funcion que permite sumar los datos deL POA semestre 1
 */ 
 function sumaPoa() {
    var suma =0.0;
    var nuevo = parseFloat(document.getElementById('nuevo').value);
    var recurrente = parseFloat(document.getElementById('recurrente').value);
    suma = nuevo + recurrente;
    document.getElementById('total').value = suma.toFixed(4);

}

/**
 * Funcion que permite llenar el reactivo segun sea el muncipio y subreceptor semestre 1
 */
 function obtenerReactivo() {

    var subreceptor  = document.getElementById('subreceptor').value;
    var departamento = document.getElementById('departamento').value;
    var municipio    = document.getElementById('municipio').value;

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

