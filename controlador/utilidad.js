/**
 * Funcion que perminte llenar combo con los municipios segun el departamento
 */
 function llenarMunicipio() {

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
 * Funcion que permite sumar los datos deL POA
 */
 function sumaPoa() {
    var suma =0.0;
    var nuevo = parseFloat(document.getElementById('nuevo').value);
    var recurrente = parseFloat(document.getElementById('recurrente').value);
    suma = nuevo + recurrente;
    document.getElementById('total').value = suma.toFixed(4);

}