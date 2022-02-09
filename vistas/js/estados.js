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
/**
 * Funcion que permite mostar modal para ver el estado de la actividad del POM
 * @param {*} id Identificador de la actividad del pom
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
 * @param {*} id 
 */
function modalCambiarTodoEstadoPom() {
    $("#modalCambiarTodoEstadoPom").modal("show");
}
/**
 * Funcion que permite cambiar el estado de todas las actividades del POM
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
/**
 * Funcion que permite mostrar un modal para cabiar todo el estado del POA
 * @param {*} id 
 */
function modalCambiarTodoEstadoPoa(id) {
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
 * Funcion que permite mostar el estado del POA
 * @param {*} id identificador del POA
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
 * @param {*} estado estado a cambiar
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
            if(s == '0') {
            document.getElementById("_supervisado").value = "No";
            } else {
            document.getElementById("_supervisado").value = "Si";
            }
            document.getElementById("asupervisor").value = pom.supervisor;
        } 
    });
    $("#modalRecalendarizacionPom").modal("show");
}
/**
 * Funcion que permite recalecalendarizar una actividad del POM
 */
function recalendarizacionPom() {
 
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
 * @param {*} estado estado a cambiar
 */
 function modalAceptarRecalendarizacion(id, usuario, estado) {
    
    var accion = "consultaAceptar";
    
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
            if(s == '0') {
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
            if(s == '0') {
            document.getElementById("nsuper").value = "No";
            } else {
            document.getElementById("nsuper").value = "Si";
            }
            document.getElementById("nsupervisor").value = pom.supervisorn;
            document.getElementById("motivo").value = pom.descripcion;
        } 
    });
    $("#modalRecalendarizacionPom").modal("show");
}


function modalRechazarSolicitud() {
    $("#modalRechazarSolicitud").modal("show");
}

function aceptarSolicitud() {
    var usuario = document.getElementById('ausuario').value;
    var poa = document.getElementById('aid').value;
    var estado = document.getElementById('aestado').value;
    var descripcion = document.getElementById('dess').value;

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
                alertify.success('¡SOLICITUD ACEPTADA!...');
                $("#modalRecalendarizacionPom").modal("hide");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }
        }
    });
}


function rechazarRecalendarizacion() {
 
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
    var accion = "rechazarRecalendarizacion";
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
                $("#modalRecalendarizacionPom").modal("hide");
                $("#modalRechazarSolicitud").modal("hide");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo enviar");
            }
        }
    });
   
}