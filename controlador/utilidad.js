/**
 * Funcion que perminte llenar combo con los municipios segun el departamento semestre 1
 */
 function llenarMunicipio() {

    var departamento = document.getElementById('departamento').value;

    var accion = "llenarMunicipio";

    $.ajax({
        type: "POST",
        url: "../../servicio/utilidad.php",
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
 * Funcion que perminte llenar combo con los municipios segun el departamento semestre 2
 */
 function llenarMunicipio1() {

    var departamento = document.getElementById('departamento1').value;

    var accion = "llenarMunicipio";

    $.ajax({
        type: "POST",
        url: "../../servicio/utilidad.php",
        data: {
            accion: accion,
            departamento: departamento
        },
        success: function (datos) {
            $("#municipio1").html(datos);

        }
    });
}
/**
 * Funcion que perminte llenar combo con los municipios segun el departamento para el reactivo esperado
 */
 function llenarMunicipio2() {

    var departamento = document.getElementById('departamento').value;

    var accion = "llenarMunicipio";

    $.ajax({
        type: "POST",
        url: "../servicio/utilidad.php",
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
 * Funcion que permite sumar los datos deL POA semestre 2
 */
 function sumaPoa1() {
    var suma =0.0;
    var nuevo = parseFloat(document.getElementById('nuevo1').value);
    var recurrente = parseFloat(document.getElementById('recurrente1').value);
    suma = nuevo + recurrente;
    document.getElementById('total1').value = suma.toFixed(4);

}


