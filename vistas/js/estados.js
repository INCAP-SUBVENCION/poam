/**
 * Funcion que permite establecer y obetner los datos basicos para el cambio de estado del POA
 * @param {*} id identificador del POA
 * @param {*} usuario identificador del usuario quien lo crea o cambia el estado del POA
 * @param {*} estado identificador del estado a cambiar
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
 * Funcion que permite establecer y obetner los datos basicos para el cambio de estado de la actividad
 * @param {*} id identificador de la actividad
 * @param {*} usuario identificador de usuario quien lo creo o cambia el estado de la actividad
 * @param {*} estado identificador del estado a cambiar
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

function modalEnviarCambioPom(id, usuario, estado) {

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
            document.getElementById("cambio_id").value = id;
            document.getElementById("cambio_mes").value = pom.mes;
            document.getElementById("cambio_municipio").value = pom.municipio;
            document.getElementById("cambio_lugar").value = pom.lugar;
            document.getElementById("cambio_fecha").value = pom.fecha;
            document.getElementById("cambio_inicia").value = pom.horaInicio;
            document.getElementById("cambio_finaliza").value = pom.horaFin;
            document.getElementById("cambio_usuario").value = usuario;
            document.getElementById("cambio_estado").value = estado;
            document.getElementById("cambio_nuevo").value = pom.pNuevo;
            document.getElementById("cambio_recurrente").value = pom.pRecurrente;
            document.getElementById("cambio_total").value = pom.total;
        }
    });
    $("#modalEnviarCambioPom").modal("show");
}

/**
 * Funcion que permite mostrar un modal para solicitar correccion de la actividad
 * @param {*} id identificador de la actividadd
 * @param {*} usuario identificador del usuario que realiza la accion
 * @param {*} estado identificador del estado a cambiar
 */
function modalCorreccionPom(id, usuario, estado) {

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
            document.getElementById("correccion_id").value = id;
            document.getElementById("correccion_mes").value = pom.mes;
            document.getElementById("correccion_municipio").value = pom.municipio;
            document.getElementById("correccion_lugar").value = pom.lugar;
            document.getElementById("correccion_fecha").value = pom.fecha;
            document.getElementById("correccion_inicia").value = pom.horaInicio;
            document.getElementById("correccion_finaliza").value = pom.horaFin;
            document.getElementById("correccion_usuario").value = usuario;
            document.getElementById("correccion_estado").value = estado;
            document.getElementById("correccion_nuevo").value = pom.pNuevo;
            document.getElementById("correccion_recurrente").value = pom.pRecurrente;
            document.getElementById("correccion_total").value = pom.total;
        }
    });
    $("#modalCorreccionPom").modal("show");
}
/**
 * Funcion que permite cambiar el estado de la actividad
 */
function cambiarEstadoPom() {
    var usuario = document.getElementById('estado_usuario').value;
    var pom = document.getElementById('estado_id').value;
    var estado = document.getElementById('estado_estado').value;
    var descripcion = document.getElementById('estado_descripcion').value;

    var accion = "cambiarEstadoPom";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            usuario: usuario,
            pom: pom,
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
function enviarCambiosPom() {
    var usuario = document.getElementById('cambio_usuario').value;
    var pom = document.getElementById('cambio_id').value;
    var estado = document.getElementById('cambio_estado').value;
    var descripcion = document.getElementById('cambio_descripcion').value;

    var accion = "cambiarEstadoPom";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            usuario: usuario,
            pom: pom,
            estado: estado,
            descripcion: descripcion
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                document.getElementById('cambio_usuario').value = "";
                document.getElementById('cambio_id').value = "";
                document.getElementById('cambio_estado').value = "";
                document.getElementById('cambio_descripcion').value = "";
                $("#modalEnviarCambioPom").modal("hide");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }
        }
    });
}
/**
 * Funcion que permite solicitar correcciones a la actividad
 */
function correccionPom() {
    var usuario = document.getElementById('correccion_usuario').value;
    var pom = document.getElementById('correccion_id').value;
    var estado = document.getElementById('correccion_estado').value;
    var descripcion = document.getElementById('correccion_descripcion').value;

    var accion = "cambiarEstadoPom";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            usuario: usuario,
            pom: pom,
            estado: estado,
            descripcion: descripcion
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                document.getElementById('correccion_usuario').value = "";
                document.getElementById('correccion_id').value = "";
                document.getElementById('correccion_estado').value = "";
                document.getElementById('correccion_descripcion').value = "";
                $("#modalCorreccionPom").modal("hide");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }
        }
    });
}

/**
 * Funcion que permite mostar modal para ver el estado de la actividad del POM
 * @param {*} id identificador de la actividad del pom
 */
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
/**
 * Funcion que permite mostrar un modal para cambiar todos los estados de las actividades del POM
 */
function modalCambiarTodoEstadoPom() {
    $("#modalCambiarTodoEstadoPom").modal("show");
}
/**
 * Funcion que permite cambiar el estado de todas la actividad del POM
 */
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


function cambiarEstadoPomPromotor() { 
    var subreceptor = document.getElementById('csubreceptor').value;
    var periodo = document.getElementById('_periodo').value;
    var estadoA = document.getElementById('cestadoA').value;
    var usuario = document.getElementById('cusuario').value;
    var estadoN = document.getElementById('cestadoN').value;
    var descripcion = document.getElementById('cobservacion').value;
    var promotores = document.getElementById('promotores').value;
    var accion = "cambiarEstadoPomPromotor";
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
            descripcion: descripcion,
            promotores: promotores
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
/**
 * Funcion que permite mostrar un modal para cabiar todo el estado del POA
 */
function modalCambiarTodoEstadoPoa() {
    $("#modalCambiarTodoEstadoPoa").modal("show");
}
/**
 * Funcion que permite cambiar todo el estao del POA
 */
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
/**
 * Funcion que permite mostar el estado del la actividad
 * @param {*} id identificador de la actividad
 */
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

/**
 * Metodo que permite mostar un modal para recalendarizar la actividad del POM
 * @param {*} id identificador de la actividad
 * @param {*} usuario identificador del usuario que cambia el estado de la actividad
 * @param {*} estado identificador del estado a cambiar
 */
function modalReprogramacionPom(id, usuario, estado) {

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
            document.getElementById("asupervisado").value = pom.supervisado;
            var s = pom.supervisado;
            if (s == '0') {
                document.getElementById("_supervisado").value = "No";
            } else {
                document.getElementById("_supervisado").value = "Si";
            }
            document.getElementById("asupervisor").value = pom.supervisor;
        }
    });
    $("#modalReprogramacionPom").modal("show");
}
/**
 * Funcion que permite reprogramacion una actividad del POM
 */
function reprogramacionPom() {

    var pom = document.getElementById('aid').value;
    var usuario = document.getElementById('ausuario').value;
    var estado = document.getElementById('aestado').value;
    var afecha = document.getElementById('afecha').value;
    var alugar = document.getElementById('alugar').value;
    var ainicia = document.getElementById('ainicia').value;
    var afinaliza = document.getElementById('afinaliza').value;
    var asupervisado = document.getElementById('asupervisado').value;
    var asupervisor = document.getElementById('asupervisor').value;
    var nfecha = document.getElementById('nfecha').value;
    var nlugar = document.getElementById('nlugar').value;
    var ninicio = document.getElementById('ninicio').value;
    var nfin = document.getElementById('nfin').value;
    var nsupervisado = document.getElementById('nsupervisado').value;
    var nsupervisor = document.getElementById('nsupervisor').value;
    var descripcion = document.getElementById('descripcion').value;
    var accion = "reprogramacionPom";
    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            usuario: usuario,
            pom: pom,
            estado: estado,
            afecha: afecha,
            alugar: alugar,
            ainicia: ainicia,
            afinaliza: afinaliza,
            asupervisado: asupervisado,
            asupervisor: asupervisor,
            nfecha: nfecha,
            nlugar: nlugar,
            ninicio: ninicio,
            nfin: nfin,
            nsupervisado: nsupervisado,
            nsupervisor: nsupervisor,
            descripcion: descripcion
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡SOLICITUD ENVIADA!...');
                document.getElementById('nfecha').value = "";
                document.getElementById('nlugar').value = "";
                document.getElementById('ninicio').value = "";
                document.getElementById('nfin').value = "";
                document.getElementById('nsupervisado').value = "";
                document.getElementById('nsupervisor').value = "";
                $("#modalReprogramacionPom").modal("hide");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo enviar");
            }
        }
    });

}
/**
 * Metodo que permite mostar un modal para aceptar recalendarizar la actividad del POM
 * @param {*} id identificador de la actividad
 * @param {*} usuario identificador del usuario que cambia el estado de la actividad
 */
function modalAceptarReprogramacion(id, usuario) {

    var accion = "consultaReprogramacion";

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
            document.getElementById("ausuario").value = usuario;
            document.getElementById("periodo").value = pom.periodo;
            document.getElementById("ames").value = pom.mess;
            document.getElementById("amunicipio").value = pom.municipios;
            document.getElementById("anuevo").value = pom.pNuevo;
            document.getElementById("arecurrente").value = pom.pRecurrente;
            document.getElementById("atotal").value = pom.total;
            document.getElementById("alugar").value = pom.lugara;
            document.getElementById("afecha").value = pom.fechaa;
            document.getElementById("ainicia").value = pom.inicioa;
            document.getElementById("afinaliza").value = pom.fina;
            document.getElementById("asupervisado").value = pom.supervisadoa;
            var s = pom.supervisadoa;
            if (s == '0') {
                document.getElementById("_supervisado").value = "No";
            } else {
                document.getElementById("_supervisado").value = "Si";
            }
            document.getElementById("asupervisor").value = pom.supervisora;
            document.getElementById("nlugar").value = pom.lugarn;
            document.getElementById("nfecha").value = pom.fechan;
            document.getElementById("ninicia").value = pom.inicion;
            document.getElementById("nfinaliza").value = pom.finn;
            document.getElementById("nsupervisado").value = pom.supervisadon;
            var s = pom.supervisadon;
            if (s == '0') {
                document.getElementById("nsuper").value = "No";
            } else {
                document.getElementById("nsuper").value = "Si";
            }
            document.getElementById("nsupervisor").value = pom.supervisorn;
            document.getElementById("motivo").value = pom.descripcion;
        }
    });
    $("#modalAceptarReprogramacion").modal("show");
}
/**
 * Funcion que permite aceptar la solcitud de cambio de estado
 */
function aceptarReprogramacion() {
    var usuario = document.getElementById('ausuario').value;
    var pom = document.getElementById('aid').value;
    var estado = document.getElementById('aestado').value;
    var descripcion = document.getElementById('dess').value;

    var accion = "cambiarEstadoPom";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            usuario: usuario,
            pom: pom,
            estado: estado,
            descripcion: descripcion
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡SOLICITUD ACEPTADA!...');
                $("#modalReprogramacionPom").modal("hide");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }
        }
    });
}
function modalRechazarReprogramacion() {
    $("#modalRechazarReprogramacion").modal("show");
}

function modalRechazarCancelacion() {
    $("#modalRechazarCancelacion").modal("show");
}
/**
 * Funcion que permite rechazar la solicitud de reprogramacion
 */
function rechazarReprogramacion() {

    var pom = document.getElementById('aid').value;
    var usuario = document.getElementById('ausuario').value;
    var estado = document.getElementById('restado').value;
    var afecha = document.getElementById('afecha').value;
    var alugar = document.getElementById('alugar').value;
    var ainicia = document.getElementById('ainicia').value;
    var afinaliza = document.getElementById('afinaliza').value;
    var asupervisado = document.getElementById('asupervisado').value;
    var asupervisor = document.getElementById('asupervisor').value;
    var nfecha = document.getElementById('nfecha').value;
    var nlugar = document.getElementById('nlugar').value;
    var ninicio = document.getElementById('ninicia').value;
    var nfin = document.getElementById('nfinaliza').value;
    var nsupervisado = document.getElementById('nsupervisado').value;
    var nsupervisor = document.getElementById('nsupervisor').value;
    var descripcion = document.getElementById('razon').value;
    var accion = "rechazarReprogramacion";
    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            usuario: usuario,
            pom: pom,
            estado: estado,
            afecha: afecha,
            alugar: alugar,
            ainicia: ainicia,
            afinaliza: afinaliza,
            asupervisado: asupervisado,
            asupervisor: asupervisor,
            nfecha: nfecha,
            nlugar: nlugar,
            ninicio: ninicio,
            nfin: nfin,
            nsupervisado: nsupervisado,
            nsupervisor: nsupervisor,
            descripcion: descripcion
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡SOLICITUD RECHAZADA!...');
                $("#modalReprogramacionPom").modal("hide");
                $("#modalRechazarSolicitud").modal("hide");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo enviar");
            }
        }
    });

}
/**
 * Funcion que permite mostar un modal para reprogramar una actividad
 * @param {*} id identificador de la actividad
 * @param {*} usuario identificador del usuario que realiza la actividad
 * @param {*} estado identificador del estado a cambiar
 */
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
            document.getElementById("_ida").value = id;
            document.getElementById("mesa").value = pom.mes;
            document.getElementById("municipioa").value = pom.municipio;
            document.getElementById("fechaa").value = pom.fecha;
            document.getElementById("lugara").value = pom.lugar;
            document.getElementById("iniciaa").value = pom.horaInicio;
            document.getElementById("finalizaa").value = pom.horaFin;
            document.getElementById("usuarioa").value = usuario;
            document.getElementById("estadoa").value = estado;
            document.getElementById("nuevoa").value = pom.pNuevo;
            document.getElementById("recurrentea").value = pom.pRecurrente;
            document.getElementById("totala").value = pom.total;
            document.getElementById("supervisadoa").value = pom.supervisado;
            var s = pom.supervisado;
            if (s == '0') {
                document.getElementById("_super").value = "No";
            } else {
                document.getElementById("_super").value = "Si";
            }
            document.getElementById("supervisora").value = pom.supervisor;
        }
    });
    $("#modalRecalendarizacionPom").modal("show");
}
/**
 * Funcion que permite reprogramacion una actividad del POM
 */
function recalendarizacionPom() {
 
    var pom = document.getElementById('_ida').value;
    var usuario = document.getElementById('usuarioa').value;
    var estado = document.getElementById('estadoa').value;
    var afecha = document.getElementById('fechaa').value;
    var alugar = document.getElementById('lugara').value;
    var ainicia = document.getElementById('iniciaa').value;
    var afinaliza = document.getElementById('finalizaa').value;
    var asupervisado = document.getElementById('supervisadoa').value;
    var asupervisor = document.getElementById('supervisora').value;
    var nfecha = document.getElementById('_nfecha').value;
    var ninicio = document.getElementById('_ninicio').value;
    var nfin = document.getElementById('_nfin').value;
    var descripcion = document.getElementById('_descripcion').value;
    var accion = "recalendarizacionPom";
    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            usuario: usuario,
            pom: pom,
            estado: estado,
            afecha: afecha,
            alugar: alugar,
            ainicia: ainicia,
            afinaliza: afinaliza,
            asupervisado: asupervisado,
            asupervisor: asupervisor,
            nfecha: nfecha,
            ninicio: ninicio,
            nfin: nfin,
            descripcion: descripcion
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡SOLICITUD ENVIADA!...');
                document.getElementById('nfecha').value = "";
                document.getElementById('ninicio').value = "";
                document.getElementById('nfin').value = "";
                $("#modalRecalendarizacionPom").modal("hide");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo enviar");
            }
        }
    });
}
/**
 * Metodo que permite mostar un modal para aceptar recalendarizar la actividad del POM
 * @param {*} id identificador de la actividad
 * @param {*} usuario identificador del usuario que cambia el estado de la actividad
 */
function modalAceptarRecalendarizacion(id, usuario) {

    var accion = "consultaRecalendarizacion";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            id: id
        },
        success: function (datos) {
            var pom = JSON.parse(datos);
            document.getElementById("pomid").value = id;
            document.getElementById("mesa").value = pom.mess;
            document.getElementById("municipioa").value = pom.municipios;
            document.getElementById("usuarioa").value = usuario;
            document.getElementById("nuevoa").value = pom.pNuevo;
            document.getElementById("recurrentea").value = pom.pRecurrente;
            document.getElementById("totala").value = pom.total;
            document.getElementById("fechaa").value = pom.fechaa;
            document.getElementById("iniciaa").value = pom.inicioa;
            document.getElementById("finalizaa").value = pom.fina;
            document.getElementById("_fechan").value = pom.fechan;
            document.getElementById("_inician").value = pom.inicion;
            document.getElementById("_finalizan").value = pom.finn;
        }
    });
    $("#modalAceptarRecalendarizacion").modal("show");
}
/**
 * Funcion que permite aceptar la solcitud de cambio de estado
 */
function aceptarRecalendarizacion() {
    var usuario = document.getElementById('usuarioa').value;
    var pom = document.getElementById('pomid').value;
    var estado = document.getElementById('estadoa').value;
    var descripcion = document.getElementById('descrip').value;

    var accion = "cambiarEstadoPom";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion: accion,
            usuario: usuario,
            pom: pom,
            estado: estado,
            descripcion: descripcion
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡SOLICITUD ACEPTADA!...');
                $("#modalReprogramacionPom").modal("hide");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }
        }
    });
}

/**
 * Funcion que permite mostrar modal para cancelar la actividad
 * @param {*} id identificador de la actividad
 * @param {*} usuario identificador el usuario que realiza la accion
 * @param {*} estado identificador del estado a cambiar
 */
function modalCancelarActividad(id, usuario, estado) {

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
    $("#modalCancelarActividad").modal("show");
}
/**
 * Funcion que permite aceptar la cancelacion de la actividad
 * @param {*} id identificador del la actividad
 * @param {*} usuario identificador del usuario que realiza la accion
 * @param {*} estado identificador del estado a cambiar
 */
function modalAceptarCancelacion(id, usuario, estado) {

    var accion = "consultaCancelar";

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
            document.getElementById("estado_descripcion").value = pom.descripcion;
        }
    });
    $("#modalAceptarCancelacion").modal("show");
}
/**
 * Funcion que permite rechazar la cancelacion
 * @param {*} estado estado a cambiar
 */
function rechazarCancelacion(estado) {
    var usuario = document.getElementById('estado_usuario').value;
    var poa = document.getElementById('estado_id').value;
    var estado = estado;
    var descripcion = document.getElementById('razon').value;

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