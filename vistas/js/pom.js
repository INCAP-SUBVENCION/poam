/**
 * Funcion que permite obtener los datos del poa segun sea el municipio
 */
function consultaPoa() {

    var subreceptor = document.getElementById('subreceptor').value;
    var periodo = document.getElementById('cperiodo').value;
    var municipio = document.getElementById('cmunicipio').value;
    var mes = document.getElementById('cmes').value;
    var promotor = document.getElementById('promotor').value;
    var dias = document.getElementById('dias').value;

    var accion = "consultaPoa";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            periodo: periodo,
            municipio: municipio,
            mes: mes,
            promotor: promotor,
            dias
        },
        success: function (datos) {
            obtenerCantidadPromotor(subreceptor, municipio);
            $('#resultadoPOA').html(datos);
        }
    });
}

/**
 * Funcion para obtener el POA
 */
function cargarPoa(id, prom, dias) {

    var id = id;
    var promotor = prom;
    var dias = dias;

    var accion = "cargarPoa";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            id: id
        },
        success: function (datos) {
            var respuesta = datos.split(',');
            var nuevos = respuesta[6] / promotor;
            var rnuevos = nuevos / dias;
            var recurrentes = (respuesta[7] / promotor);
            var rrecurrentes = recurrentes / dias;

            document.getElementById('poa').value = respuesta[0];
            document.getElementById('periodo').value = respuesta[1];
            document.getElementById('mes').value = respuesta[2];
            document.getElementById('nombreMes').value = respuesta[3];
            document.getElementById('municipio').value = respuesta[4];
            document.getElementById('nombreMunicipio').value = respuesta[5];
            document.getElementById('nuevo').value = rnuevos.toFixed(2);
            document.getElementById('recurrente').value = rrecurrentes.toFixed(2);

        }
    });
}

/**
 * Funcion que permite llenar el reactivo segun sea el muncipio y subreceptor
 */
function llenarReactivo() {

    var subreceptor = document.getElementById('subreceptor').value;
    var municipio = document.getElementById('cmunicipio').value;

    var accion = "llenarReactivo";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
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
 * Funcion para calcular el POM
 */
function calcularPom() {
    var total = parseFloat(document.getElementById('total').value);
    var subreceptor = document.getElementById('subreceptor').value;
    var procentaje = parseFloat(document.getElementById('reactivo').value);

    var accion = "calcularPom";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            total: total
        },
        success: function (datos) {
            var resultado = datos.split(',');
            var cnatural = parseFloat(resultado[0]);
            var csabor = parseFloat(resultado[1]);
            var cfemenino = parseFloat(resultado[2]);
            if(subreceptor='2'){
                var lubricante = total;
            } else {
                var lubricante = parseFloat(resultado[3]);
            }
            var pruebaVIH = parseFloat(resultado[4]);
            var autoPrueba = parseFloat(resultado[5]);
            var reactivo = total * procentaje;
            document.getElementById('cnatural').value = cnatural.toFixed(2);
            document.getElementById('csabor').value = csabor.toFixed(2);
            document.getElementById('cfemenino').value = cfemenino.toFixed(2);
            document.getElementById('lubricante').value = lubricante.toFixed(2);
            document.getElementById('pruebaVIH').value = pruebaVIH.toFixed(2);
            document.getElementById('autoPrueba').value = autoPrueba.toFixed(2);
            document.getElementById('reactivoEs').value = reactivo.toFixed(2);
            document.getElementById('sifilis').value = total;
        }
    });
}
/**
 * Metodo que permite agregar nuevo POM
 */
function agregarPOM() {
    var subreceptor = document.getElementById('subreceptor').value;
    var poa = document.getElementById('poa').value;
    var usuario = document.getElementById('usuario').value;
    var periodo = document.getElementById('periodo').value;
    var mes = document.getElementById('mes').value;
    var municipio = document.getElementById('municipio').value;
    var fecha = document.getElementById('fecha').value;
    var inicio = document.getElementById('inicio').value;
    var fin = document.getElementById('fin').value;
    var lugar = document.getElementById('lugar').value;
    var promotores = document.getElementById('promotores').value;
    var nuevo = document.getElementById('nuevo').value;
    var recurrente = document.getElementById('recurrente').value;
    var cnatural = document.getElementById('cnatural').value;
    var csabor = document.getElementById('csabor').value;
    var cfemenino = document.getElementById('cfemenino').value;
    var lubricante = document.getElementById('lubricante').value;
    var autoPrueba = document.getElementById('autoPrueba').value;
    if(subreceptor = '2') {
        var pruebaVIH = 0;
    } else {
        var pruebaVIH = document.getElementById('pruebaVIH').value;
        }
    if(subreceptor = '2') {
        var reactivoEs = 0;
    } else {
        var reactivoEs = document.getElementById('reactivoEs').value;
        }
    if(subreceptor ='2') {
        var sifilis = 0;
    } else {
        var sifilis = document.getElementById('sifilis').value;
        }
    var observacion = document.getElementById('observacion').value;
    var movil = document.getElementById('movil').value;
    var supervisado = document.getElementById('supervisado').value;
    var supervisor = document.getElementById('supervisor').value;
    var estado = document.getElementById('creado').value;

    var accion = "agregarPOM";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            poa: poa,
            usuario: usuario,
            periodo: periodo,
            mes: mes,
            municipio: municipio,
            fecha: fecha,
            inicio: inicio,
            fin: fin,
            lugar: lugar,
            promotores: promotores,
            nuevo: nuevo,
            recurrente: recurrente,
            cnatural: cnatural,
            csabor: csabor,
            cfemenino: cfemenino,
            lubricante: lubricante,
            pruebaVIH: pruebaVIH,
            autoPrueba: autoPrueba,
            reactivoEs: reactivoEs,
            sifilis: sifilis,
            observacion: observacion,
            subreceptor: subreceptor,
            movil: movil,
            supervisado: supervisado,
            supervisor: supervisor,
            estado: estado
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarPom').trigger("reset");
                window.location.reload('pom.php');
            } else if (datos == 'Duplicado') {
                alertify.warning('¡El POM ya existe!...');
            }
            else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }
        }
    });
}
/**
 * Funcion que permite obtener el numero de promotres asignados a cada municipio
 */
function obtenerCantidadPromotor() {

    var subreceptor = document.getElementById('subreceptor').value;
    var municipio = document.getElementById('cmunicipio').value;

    var accion = "obtenerCantidadPromotor";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            municipio: municipio
        },
        success: function (datos) {
            var resultado = datos.split(',');
            var nPromtor = resultado[0];
            var dias = resultado[1];
            document.getElementById('promotor').value = nPromtor;
            document.getElementById('dias').value = dias;
        }
    });
}
/**
 * 
 * @param {*} sub identificador del subreceptor
 * @param {*} per identificador del periodo
 * @param {*} es  identificador del estado
 */
function enviarTodoPom(sub, per, es, actual) {

    var subreceptor = sub;
    var periodo = per;
    var estado = es;
    var estadoActual = actual;
    var accion = "enviarTodoPom";

    if (confirm('Esta seguro que desea enviar todos a revision')) {
        $.ajax({
            type: "POST",
            url: "../../php/pom.php",
            data: {
                accion: accion,
                subreceptor: subreceptor,
                periodo: periodo,
                estado: estado,
                estadoActual: estadoActual
            },
            success: function (datos) {
                if (datos == 'Exito') {
                    alertify.success('¡ENVIADO A REVISION!...');
                    window.location.reload('poa.php');
                } else {
                    alertify.error("¡ERROR!... No se pudo enviar a REVISION");
                }

            }
        });
    }
}

////////////////////// EDITAR ////////////////////////////////////
/**
 * Funcion que permite mostrar un modal con los datos del POM a editar
 * @param {*} subreceptor identificador del subreceptor
 * @param {*} periodo identificador del periodo
 * @param {*} pom identificador del POM
 */
function modalEditarPom(subreceptor, periodo, pom) {
    var accion = "consultaEditar";
    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            periodo: periodo,
            pom: pom
        },
        success: function (datos, status) {

            var pom = JSON.parse(datos);
            document.getElementById("epom").value = pom.idPom;
            document.getElementById("epoa").value = pom.idPoa;
            document.getElementById("eperiodo").value = pom.periodo;
            document.getElementById("rmunicipio").value = pom.municipio;
            document.getElementById("emunicipio").value = pom.cmunicipio;
            document.getElementById("rmes").value = pom.mes;
            document.getElementById("emes").value = pom.cmes;
            document.getElementById("efecha").value = pom.fecha;
            document.getElementById("einicio").value = pom.horaInicio;
            document.getElementById("efin").value = pom.horaFin;
            document.getElementById("elugar").value = pom.lugar;
            document.getElementById("enuevo").value = pom.pNuevo;
            document.getElementById("esupervisor").value = pom.supervisor;
            document.getElementById("eobservacion").value = pom.observacion;
            document.getElementById("esupervisado").value = pom.supervisado;
            document.getElementById("esupervisor").value = pom.supervisor;
        }
    });
    $("#modalEditarPom").modal("show");
}


/**
 * Funcion para calcular el POM
 */
function calcularPomEditar() {
    var total = parseFloat(document.getElementById('etotal').value);
    var subreceptor = document.getElementById('esubreceptor').value;
    var procentaje = parseFloat(document.getElementById('ereactivo').value);

    var accion = "calcularPom";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            total: total
        },
        success: function (datos) {
            var resultado = datos.split(',');
            var cnatural = parseFloat(resultado[0]);
            var csabor = parseFloat(resultado[1]);
            var cfemenino = parseFloat(resultado[2]);
            if(subreceptor='2'){
                var lubricante = total;
            } else {
                var lubricante = parseFloat(resultado[3]);
            }
            var pruebaVIH = parseFloat(resultado[4]);
            var autoPrueba = parseFloat(resultado[5]);
            var reactivo = total * procentaje;

            document.getElementById('ecnatural').value = cnatural.toFixed(2);
            document.getElementById('ecsabor').value = csabor.toFixed(2);
            document.getElementById('ecfemenino').value = cfemenino.toFixed(2);
            document.getElementById('elubricante').value = lubricante.toFixed(2);
            document.getElementById('epruebaVIH').value = pruebaVIH.toFixed(2);
            document.getElementById('eautoPrueba').value = autoPrueba.toFixed(2);
            document.getElementById('ereactivoEs').value = reactivo.toFixed(2);
            document.getElementById('esifilis').value = total;

        }
    });
}

/**
 * Funcion que permite editar POM
 */
function editarPOM() {

    var pom = document.getElementById('epom').value;
    var periodo = document.getElementById('eperiodo').value;
    var mes = document.getElementById('emes').value;
    var municipio = document.getElementById('emunicipio').value;
    var fecha = document.getElementById('efecha').value;
    var inicio = document.getElementById('einicio').value;
    var fin = document.getElementById('efin').value;
    var lugar = document.getElementById('elugar').value;
    var promotores = document.getElementById('epromotores').value;
    var nuevo = document.getElementById('enuevo').value;
    var recurrente = document.getElementById('erecurrente').value;
    var cnatural = document.getElementById('ecnatural').value;
    var csabor = document.getElementById('ecsabor').value;
    var cfemenino = document.getElementById('ecfemenino').value;
    var lubricante = document.getElementById('elubricante').value;
    var pruebaVIH = document.getElementById('epruebaVIH').value;
    var autoPrueba = document.getElementById('eautoPrueba').value;
    var reactivoEs = document.getElementById('ereactivoEs').value;
    var sifilis = document.getElementById('esifilis').value;
    var observacion = document.getElementById('eobservacion').value;
    var subreceptor = document.getElementById('esubreceptor').value;
    var movil = document.getElementById('emovil').value;
    var supervisado = document.getElementById('esupervisado').value;
    var supervisor = document.getElementById('esupervisor').value;

    var accion = "editarPOM";

    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            pom: pom,
            periodo: periodo,
            mes: mes,
            municipio: municipio,
            fecha: fecha,
            inicio: inicio,
            fin: fin,
            lugar: lugar,
            promotores: promotores,
            nuevo: nuevo,
            recurrente: recurrente,
            cnatural: cnatural,
            csabor: csabor,
            cfemenino: cfemenino,
            lubricante: lubricante,
            pruebaVIH: pruebaVIH,
            autoPrueba: autoPrueba,
            reactivoEs: reactivoEs,
            sifilis: sifilis,
            observacion: observacion,
            subreceptor: subreceptor,
            movil: movil,
            supervisado: supervisado,
            supervisor: supervisor
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡ACTUALIZADO!...');
                $('#editarPom').trigger("reset");
                window.location.reload('pom.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo ACTUALIZAR...");
            }
        }
    });
}

/**
 * Funcion que permite mostrar los datos del POM para anular
 */
function modalAnularPom(subreceptor, periodo, pom) {
    var accion = "consultaEditar";
    $.ajax({
        type: "POST",
        url: "../../php/pom.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            periodo: periodo,
            pom: pom
        },
        success: function (datos, status) {

            var pom = JSON.parse(datos);
            document.getElementById('periodo_').value = pom.periodo;
            document.getElementById('mes_').value = pom.mes;
            document.getElementById('municipio_').value = pom.municipio;
            document.getElementById('lugar_').value = pom.lugar;
            document.getElementById('municipio_').value = pom.municipio;
            document.getElementById('fecha_').value = pom.fecha;
            document.getElementById('aPom').value = pom.idPom;
        }
    });
    $("#modalAnularPom").modal("show");
}

function anularPOM() {

    var pom = document.getElementById('aPom').value;
    var subreceptor = document.getElementById('subreceptor').value;


    var accion = "anularPOM";

    if (confirm('Esta seguro que desea Anular el POM!')) {
        $.ajax({
            type: "POST",
            url: "../../php/pom.php",
            data: {
                accion: accion,
                subreceptor: subreceptor,
                pom: pom
            },
            success: function (datos) {
                if (datos == 'Exito') {
                    alertify.success('¡ANULADO!...');
                    window.location.reload('poa.php');
                } else {
                    alertify.error("¡ERROR!... No se pudo enviar a ANULAR");
                }

            }
        });
    }
}
