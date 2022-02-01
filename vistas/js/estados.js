/**
 * Funcion que permite establecer y obetner los datos basicos para el cambio de estado del POA
 * @param {*} id identificador del poa
 * @param {*} usuario identificador del usuario quien lo crea o cambia el estado del POA
 * @param {*} estado estado a cambiar
 */
function modalCambiarEstadoPoa(id, usuario, estado) {

    var accion = "consultaPoa";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            id: id
        },
        success: function (datos, status) {

            var poa = JSON.parse(datos);
            document.getElementById("estado_id").value = id
            document.getElementById("estado_mes").value = poa.mes;
            document.getElementById("estado_municipio").value = poa.municipio;
            document.getElementById("estado_nuevo").value = poa.nuevo;
            document.getElementById("estado_recurrente").value = poa.recurrente;
            document.getElementById("estado_total").value = poa.total;
            document.getElementById("estado_usuario").value = usuario;
            document.getElementById("estado_estado").value = estado;
        }
    });
    $("#modalCambiarEstado").modal("show");
}

/**
 * Funcion que permite cambiar el estado del POA
 */
function cambiarEstadoPoa() {

    var usuario = document.getElementById('estado_usuario').value;
    var poa = document.getElementById('estado_id').value;
    var estado = document.getElementById('estado_estado').value;
    var descripcion = document.getElementById('estado_descripcion').value;

    var accion = "cambiarEstadoPoa";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            usuario: usuario,
            poa: poa,
            estado: estado,
            descripcion: descripcion
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                document.getElementById('estado_usuario').value = "";
                document.getElementById('estado_id').value = "";
                document.getElementById('estado_estado').value = "";
                document.getElementById('estado_descripcion').value = "";
                $("#modalCambiarEstado").modal("hide");
                window.location.reload('poa.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }
        }
    });
}

/**
 * Funcion que permite establecer y obetner los datos basicos para el cambio de estado del POM
 * @param {*} id identificador del POM 
 * @param {*} usuario identificador de usuario quien lo creo o cambia el estado del POM
 * @param {*} estado estado a cambiar
 */
function modalCambiarEstadoPom(id, usuario, estado) {

    var accion = "consultaPoM";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            id: id
        },
        success: function (datos) {

            var pom = JSON.parse(datos);
            document.getElementById("estado_id").value = id;
            document.getElementById("estado_mes").value = pom.mes;
            document.getElementById("estado_municipio").value = pom.municipio;
            document.getElementById("estado_lugar").value = pom.lugar;
            document.getElementById("estado_fecha").value = pom.fecha;
            document.getElementById("estado_inicia").value = pom.horaInicio;
            document.getElementById("estado_finaliza").value = pom.horaFin;
            document.getElementById("estado_usuario").value = usuario;
            document.getElementById("estado_estado").value = estado;
            document.getElementById("estado_nuevo").value = pom.pNuevo;
            document.getElementById("estado_recurrente").value = pom.pRecurrente;
            document.getElementById("estado_total").value = pom.total;
        }
    });
    $("#modalCambiarEstado").modal("show");
}

/**
 * Funcion que permite cambiar el estado de POM
 */
function cambiarEstadoPom() {
    var usuario = document.getElementById('estado_usuario').value;
    var poa = document.getElementById('estado_id').value;
    var estado = document.getElementById('estado_estado').value;
    var descripcion = document.getElementById('estado_descripcion').value;

    var accion = "cambiarEstadoPom";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            usuario: usuario,
            poa: poa,
            estado: estado,
            descripcion: descripcion
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                document.getElementById('estado_usuario').value = "";
                document.getElementById('estado_id').value = "";
                document.getElementById('estado_estado').value = "";
                document.getElementById('estado_descripcion').value = "";
                $("#modalCambiarEstado").modal("hide");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }
        }
    });
}

function modalEstadoPom(id) {

    var accion = "estadoPom";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        dataType: 'JSON',
        data: {
            accion: accion,
            id: id 
        },
        success: function (response) {
            var len = response.length;
            for (var i = 0; i < len; i++) {

                var estados = response[i].estados;
                var fecha = response[i].fecha;
                var nombre = response[i].nombre;
                var apellido = response[i].apellido;
                var descripcion = response[i].descripcion;
                var html =
                    '<li>' +
                    '<h5 class="float-right">' + estados + '</h5>' +
                    '<a class="float-right">' + nombre + ' ' + apellido + ': ' + fecha + '</a>' +
                    '<p>' + descripcion + '</p>' +
                    '</li>';

                $("#estados").append(html);
            }
        }
    });
    $("#modalEstadoPom").modal("show");
    $('#modalEstadoPom').on('hidden.bs.modal', function () {
        location.reload();
    })
}


function modalCambiarTodoEstadoPom(id) {
    $("#modalCambiarTodoEstadoPom").modal("show");
}

function cambiarTodoEstadoPom() {
    var subreceptor = document.getElementById('csubreceptor').value;
    var periodo = document.getElementById('_periodo').value;
    var estadoA = document.getElementById('cestadoA').value;
    var usuario = document.getElementById('cusuario').value;
    var estadoN = document.getElementById('cestadoN').value;
    var descripcion = document.getElementById('cobservacion').value;

    var accion = "cambiarTodoEstadoPom";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            periodo: periodo,
            estadoA: estadoA,
            usuario: usuario,
            estadoN: estadoN,
            descripcion: descripcion
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡SE ENVIO TODO!...');
                $("#modalCambiarTodoEstadoPom").modal("hide");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo enviar ");
            }
        }
    });
}

function modalCambiarTodoEstadoPoa(id) {
    $("#modalCambiarTodoEstadoPoa").modal("show");
}

 
function cambiarTodoEstadoPoa() {
    var subreceptor = document.getElementById('csubreceptor').value;
    var periodo = document.getElementById('_periodo').value;
    var estadoA = document.getElementById('cestadoA').value;
    var usuario = document.getElementById('cusuario').value;
    var estadoN = document.getElementById('cestadoN').value;
    var descripcion = document.getElementById('cobservacion').value;

    var accion = "cambiarTodoEstadoPoa";
 
    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            periodo: periodo,
            estadoA: estadoA,
            usuario: usuario,
            estadoN: estadoN,
            descripcion: descripcion
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡SE ENVIO TODO!...');
                $("#modalCambiarTodoEstadoPoa").modal("hide");
                window.location.reload('poa.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo enviar ");
            }
        }
    });
}

function modalEstadoPoa(id) {

    var accion = "estadoPoa";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        dataType: 'JSON',
        data: {
            accion: accion,
            id: id 
        },
        success: function (response) {
            var len = response.length;
            for (var i = 0; i < len; i++) {

                var estados = response[i].estados;
                var fecha = response[i].fecha;
                var nombre = response[i].nombre;
                var apellido = response[i].apellido;
                var descripcion = response[i].descripcion;
                var html =
                    '<li>' +
                    '<h5 class="float-right">' + estados + '</h5>' +
                    '<a class="float-right">' + nombre + ' ' + apellido + ': ' + fecha + '</a>' +
                    '<p>' + descripcion + '</p>' +
                    '</li>';

                $("#estados").append(html);
            }
        }
    });
    $("#modalEstadoPoa").modal("show");
    $('#modalEstadoPoa').on('hidden.bs.modal', function () {
        location.reload();
    })
}


function modalRecalendarizacionPom(id, usuario, estado) {

    var accion = "consultaPoM";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            id: id
        },
        success: function (datos) {

            var pom = JSON.parse(datos);
            document.getElementById("aid").value = id;
            document.getElementById("ames").value = pom.mes;
            document.getElementById("amunicipio").value = pom.municipio;
            document.getElementById("alugar").value = pom.lugar;
            document.getElementById("afecha").value = pom.fecha;
            document.getElementById("ainicia").value = pom.horaInicio;
            document.getElementById("afinaliza").value = pom.horaFin;
            document.getElementById("ausuario").value = usuario;
            document.getElementById("aestado").value = estado;
            document.getElementById("anuevo").value = pom.pNuevo;
            document.getElementById("arecurrente").value = pom.pRecurrente;
            document.getElementById("atotal").value = pom.total;
            document.getElementById("asupervisor").value = pom.supervisor;
        } 
    });
    $("#modalRecalendarizacionPom").modal("show");
}

function recalendarizacionPom() {
    var usuario = document.getElementById('re_usuario').value;
    var poa = document.getElementById('re_id').value;
    var estado = document.getElementById('re_estado').value;
    var descripcion = document.getElementById('re_descripcion').value;

    var accion = "cambiarEstadoPom";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            usuario: usuario,
            poa: poa,
            estado: estado,
            descripcion: descripcion
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡SOLICITUD ENVIADA!...');
                document.getElementById('re_usuario').value = "";
                document.getElementById('re_id').value = "";
                document.getElementById('re_estado').value = "";
                document.getElementById('re_descripcion').value = "";
                $("#modalRecalendarizacionPom").modal("hide");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo enviar");
            }
        }
    });
}