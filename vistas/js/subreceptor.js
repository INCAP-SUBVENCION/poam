/**
 * Funcion para agregar nuevo subreceptor
 */
function agregarSubreceptor() {
    var codigo = document.getElementById('codigo').value;
    var nombre = document.getElementById('nombre').value;
    var cnatural = document.getElementById('cnatural').value;
    var csabor = document.getElementById('csabor').value;
    var cfemenino = document.getElementById('cfemenino').value;
    var lubricante = document.getElementById('lubricante').value;
    var pruebavih = document.getElementById('pruebavih').value;
    var autoprueba = document.getElementById('autoprueba').value;

    var accion = "agregarSubreceptor";

    $.ajax({
        type: "POST",
        url: "../php/subreceptor.php",
        data: {
            accion: accion,
            codigo: codigo,
            nombre: nombre,
            cnatural: cnatural,
            csabor: csabor,
            cfemenino: cfemenino,
            lubricante: lubricante,
            pruebavih: pruebavih,
            autoprueba: autoprueba
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarSub').trigger("reset");
                $('#nuevoSub').modal('hide')
                window.location.reload('vistas/configuracion/subreceptor.php');
            } else if (datos == 'Error') {
                alertify.error('ERROR!... No se pudo guardar');
            }
            else {
                alertify.warning('¡El subreceptor ya existe!...');
            }
        }
    });
}

/**
 * Funcion para agregar nuevo subreceptor
 */
function editarSubreceptor() {

    var id = document.getElementById('eid').value;
    var codigo = document.getElementById('ecodigo').value;
    var nombre = document.getElementById('enombre').value;
    var cnatural = document.getElementById('enatural').value;
    var csabor = document.getElementById('esabor').value;
    var cfemenino = document.getElementById('efemenino').value;
    var lubricante = document.getElementById('elubricante').value;
    var pruebavih = document.getElementById('eppvih').value;
    var autoprueba = document.getElementById('eautoprueba').value;

    var accion = "editarSubreceptor";

    $.ajax({
        type: "POST",
        url: "../php/subreceptor.php",
        data: {
            accion: accion,
            id: id,
            codigo: codigo,
            nombre: nombre,
            cnatural: cnatural,
            csabor: csabor,
            cfemenino: cfemenino,
            lubricante: lubricante,
            pruebavih: pruebavih,
            autoprueba: autoprueba
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡MODIFICADO!...');
                $('#editarSub').trigger("reset");
                window.location.reload('vistas/configuracion/subreceptor.php');
            }
            else {
                alertify.warning('¡No fue posible modificar el subreceptor!...');
            }

        }
    });
}
/**
 * Funcion para agregar el reactivo esperado para calcular el POA
 */
function agregarCobertura() {
    var subreceptor = parseInt(document.getElementById('sub').value);
    var departamento = parseInt(document.getElementById('departamento').value);
    var municipio = parseInt(document.getElementById('municipio').value);
    var nuevo = parseFloat(document.getElementById('nuevo').value);
    var recurrente = parseFloat(document.getElementById('recurrente').value);
    var reactivo = parseFloat(document.getElementById('reactivo').value);
    var periodo = document.getElementById('periodo').value;

    var accion = "agregarCobertura";

    $.ajax({
        type: "POST",
        url: "../php/subreceptor.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            departamento: departamento,
            municipio: municipio,
            nuevo: nuevo,
            recurrente: recurrente,
            reactivo: reactivo,
            periodo: periodo
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarCobertura').trigger("reset");
                window.location.reload('vistas/configuracion/subreceptor.php');
            } else if (datos == 'Duplicado') {
                alertify.warning('¡La cobertura ya existe!...');
            } else {
                alertify.error('ERROR!... No se pudo guardar');
            }

        }
    });
}

////////////////////////////    EDITAR  /////////////////////////////
function modalEditarPom(subreceptor) {
    var accion = "consultaEditar";
    $.ajax({
        type: "POST",
        url: "../php/subreceptor.php",
        data: {
            accion: accion,
            subreceptor: subreceptor
        },
        success: function (datos, status) {

            var sub = JSON.parse(datos);
            document.getElementById('eid').value = sub.idSubreceptor;
            document.getElementById('ecodigo').value = sub.codigo;
            document.getElementById('enombre').value = sub.nombre;
            document.getElementById('enatural').value = sub.enatural;
            document.getElementById('esabor').value = sub.esabor;
            document.getElementById('efemenino').value = sub.efemenino;
            document.getElementById('elubricante').value = sub.elubricante;
            document.getElementById("eppvih").value = sub.ppvih;
            document.getElementById("eautoprueba").value = sub.pautoprueba;

        }
    });
    $("#modalEditarSub").modal("show");
}

