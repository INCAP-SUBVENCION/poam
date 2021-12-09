/**
 * Funcion que permite agregar nuevo POA para el semestre 1
 */
 function  agregarPoa() {

    var usuario     = parseInt(document.getElementById('usuario').value);
    var mes         = document.getElementById('mes').value;
    var departamento= document.getElementById('departamento').value;
    var municipio   = document.getElementById('municipio').value;
    var nuevo       = parseFloat(document.getElementById('nuevo').value);
    var recurrente  = parseFloat(document.getElementById('recurrente').value);
    var subreceptor = parseInt(document.getElementById('subreceptor').value);
    var observacion = document.getElementById('observacion').value;
    var periodo     = document.getElementById('periodo').value;
    var cnatural    = parseFloat(document.getElementById('cnatural').value);
    var csabor      = parseFloat(document.getElementById('csabor').value);
    var cfemenino   = parseFloat(document.getElementById('cfemenino').value);
    var lubricante  = parseFloat(document.getElementById('lubricante').value);
    var pruebaVIH   = parseFloat(document.getElementById('pruebaVIH').value);
    var autoPrueba  = parseFloat(document.getElementById('autoPrueba').value);
    var reactivoEs  = parseFloat(document.getElementById('reactivoEs').value);
    var sifilis     = parseFloat(document.getElementById('sifilis').value);

    var accion = "agregarPoa";

    $.ajax({
        type: "POST",
        url: "../../php/poa.php",
        data: {
            accion: accion,
            usuario: usuario,
            mes: mes,
            departamento: departamento,
            municipio: municipio,
            nuevo: nuevo,
            recurrente: recurrente,
            subreceptor: subreceptor,
            observacion: observacion,
            periodo: periodo,
            cnatural: cnatural,
            csabor: csabor,
            cfemenino: cfemenino,
            lubricante: lubricante,
            pruebaVIH: pruebaVIH,
            autoPrueba: autoPrueba,
            reactivoEs: reactivoEs,
            sifilis: sifilis
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarPoa').trigger("reset");
                window.location.reload('poa.php');
            } else if (datos == 'Duplicado') {
                alertify.warning('¡El POA ya existe!...');
            }
            else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }
        }
    });
}
/**
 * Funcion para calcular la proyeccion de insumos para el POA semestre 1
 */
function calcularProyeccionPOA() {
    var total = 0.0;
    var nuevo = parseFloat(document.getElementById('nuevo').value);
    var recurrente = parseFloat(document.getElementById('recurrente').value);
    total = nuevo + recurrente;
    var subreceptor = document.getElementById('subreceptor').value;
    var procentaje  = parseFloat(document.getElementById('reactivo').value);

    var accion = "calcularProyeccionPOA";

    $.ajax({
        type: "POST",
        url: "../../php/poa.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            total: total
        },
        success: function (datos) {
            var resultado   = datos.split(',');
            var cnatural    = parseFloat(resultado[0]);
            var csabor      = parseFloat(resultado[1]);
            var cfemenino   = parseFloat(resultado[2]);
            var lubricante  = parseFloat(resultado[3]);
            var pruebaVIH   = parseFloat(resultado[4]);
            var autoPrueba  = parseFloat(resultado[5]);
            var reactivo = total * procentaje;
            document.getElementById('cnatural').value   = cnatural.toFixed(2);
            document.getElementById('csabor').value     = csabor.toFixed(2);
            document.getElementById('cfemenino').value  = cfemenino.toFixed(2);
            document.getElementById('lubricante').value = lubricante.toFixed(2);
            document.getElementById('pruebaVIH').value  = pruebaVIH.toFixed(2);
            document.getElementById('autoPrueba').value = autoPrueba.toFixed(2);
            document.getElementById('reactivoEs').value = reactivo.toFixed(2);
            document.getElementById('sifilis').value    = total.toFixed(2);
            document.getElementById('total').value      = total.toFixed(2);
        }
    });
}
/**
 * Funcion que permite agregar una meta para calcular el POA
 */
function agregarResumen() {
    var cobertura   = document.getElementById('cobertura').value;
    var periodo     = document.getElementById('periodo').value;
    var meses       = document.getElementById('meses').value;
    var metaNuevos  = document.getElementById('metaNuevos').value;
    var metaRecurrentes = document.getElementById('metaRecurrentes').value;

    var accion = "agregarResumen";

    $.ajax({
        type: "POST",
          url: "../../php/poa.php",
        data:{
            accion: accion,
            cobertura: cobertura,
            periodo: periodo,
            meses: meses,
            metaNuevos: metaNuevos,
            metaRecurrentes: metaRecurrentes
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('¡GUARDADO!...');
                $('#agregarMeta').trigger("reset");
                window.location.reload('poa.php');
            } else if (datos == 'Duplicado') {
                alertify.warning('¡El resumen ya existe!...');
            } else {
                alertify.error("¡ERROR!... No se pudo guardar");
            }

        }
    });
}
/**
 * 
 * @param {*} sub 
 * @param {*} per 
 * @param {*} es 
 * @param {*} ea 
 */
function cambiarTodo(sub, per, es, ea) {
    var subreceptor = sub;
    var periodo = per;
    var estado = es;
    var estadoActual = ea;
    var accion = "cambiarTodo";
    if(confirm('Esta seguro que desea enviar todos a revision')){
        $.ajax({
            type: "POST",
            url: "../../php/poa.php",
            data:{
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
///////////////////////////////EDITAR////////////////////////////
function modalEditarPoa(subreceptor, periodo, poa) {
    var accion = "consultaEditar";
    $.ajax({
        type: "POST",
        url: "../../php/poa.php",
        data: {
            accion : accion,
            subreceptor: subreceptor,
            periodo: periodo,
            poa: poa
        }, 
    success: function (datos, status){
 
        var poa = JSON.parse(datos);
        $("#_mes").html(poa.mes);
        $("#_municipio").html(poa.municipio);
        $("#_nuevo").html(poa.nuevo);
        $("#_recurrente").html(poa.recurrente);
        $("#_total").html(poa.total);
        $("#_natural").html(poa.cnatural);
        $("#_sabor").html(poa.csabor);
        $("#_femenino").html(poa.cfemenino);
        $("#_lubricante").html(poa.lubricante);
        $("#_prueba").html(poa.pruebaVIH);
        $("#_autoprueba").html(poa.autoPrueba);
        $("#_reactivo").html(poa.reactivoE);
        $("#_sifilis").html(poa.sifilis);
        document.getElementById("enuevo").value=poa.nuevo;
        document.getElementById("erecurrente").value=poa.recurrente;
        document.getElementById("poa").value=poa.idPoa;
        document.getElementById("insumo").value=poa.idInsumo;
    }
});
    $("#modalEditarPoa").modal("show");
}

/**
 * Funcion para calcular la proyeccion de insumos para el POA a editar
 */
 function calcularProyeccionPOA_editar() {
    var total = 0.0;
    var nuevo = parseFloat(document.getElementById('enuevo').value);
    var recurrente = parseFloat(document.getElementById('erecurrente').value);
    total = nuevo + recurrente;
    var subreceptor = document.getElementById('esubreceptor').value;
    var procentaje  = parseFloat(document.getElementById('ereactivo').value);

    var accion = "calcularProyeccionPOA";

    $.ajax({
        type: "POST",
        url: "../../php/poa.php",
        data: {
            accion: accion,
            subreceptor: subreceptor,
            total: total
        },
        success: function (datos) {
            var resultado   = datos.split(',');
            var cnatural    = parseFloat(resultado[0]);
            var csabor      = parseFloat(resultado[1]);
            var cfemenino   = parseFloat(resultado[2]);
            var lubricante  = parseFloat(resultado[3]);
            var pruebaVIH   = parseFloat(resultado[4]);
            var autoPrueba  = parseFloat(resultado[5]);
            var reactivo = total * procentaje;
            document.getElementById('ecnatural').value   = cnatural;
            document.getElementById('ecsabor').value     = csabor.toFixed(2);
            document.getElementById('ecfemenino').value  = cfemenino.toFixed(2);
            document.getElementById('elubricante').value = lubricante.toFixed(2);
            document.getElementById('epruebaVIH').value  = pruebaVIH.toFixed(2);
            document.getElementById('eautoPrueba').value = autoPrueba.toFixed(2);
            document.getElementById('ereactivoEs').value = reactivo.toFixed(2);
            document.getElementById('esifilis').value    = total.toFixed(2);
            document.getElementById('etotal').value      = total.toFixed(2);
        }
    });
}


function  editarPoa() {
    var poa         = parseInt(document.getElementById('poa').value);
    var insumo      = parseInt(document.getElementById('insumo').value);
    var eusuario     = parseInt(document.getElementById('eusuario').value);
    var emes         = document.getElementById('emes').value;
    var edepartamento= document.getElementById('edepartamento').value;
    var emunicipio   = document.getElementById('emunicipio').value;
    var enuevo       = parseFloat(document.getElementById('enuevo').value);
    var erecurrente  = parseFloat(document.getElementById('erecurrente').value);
    var esubreceptor = parseInt(document.getElementById('esubreceptor').value);
    var eobservacion = document.getElementById('eobservacion').value;
    var eperiodo     = document.getElementById('eperiodo').value;
    var ecnatural    = parseFloat(document.getElementById('ecnatural').value);
    var ecsabor      = parseFloat(document.getElementById('ecsabor').value);
    var ecfemenino   = parseFloat(document.getElementById('ecfemenino').value);
    var elubricante  = parseFloat(document.getElementById('elubricante').value);
    var epruebaVIH   = parseFloat(document.getElementById('epruebaVIH').value);
    var eautoPrueba  = parseFloat(document.getElementById('eautoPrueba').value);
    var ereactivoEs  = parseFloat(document.getElementById('ereactivoEs').value);
    var esifilis     = parseFloat(document.getElementById('esifilis').value);

    var accion = "editarPoa";

    $.ajax({
        type: "POST",
        url: "../../php/poa.php",
        data: {
            accion: accion,
            poa: poa,
            insumo: insumo,
            eusuario: eusuario,
            emes: emes,
            edepartamento: edepartamento,
            emunicipio: emunicipio,
            enuevo: enuevo,
            erecurrente: erecurrente,
            esubreceptor: esubreceptor,
            eobservacion: eobservacion,
            eperiodo: eperiodo,
            ecnatural: ecnatural,
            ecsabor: ecsabor,
            ecfemenino: ecfemenino,
            elubricante: elubricante,
            epruebaVIH: epruebaVIH,
            eautoPrueba: eautoPrueba,
            ereactivoEs: ereactivoEs,
            esifilis: esifilis
        },
        success: function (datos) {
            if (datos == 'Exito') {
                alertify.success('!ACTUALIZADO!...');
                $('#modalEditarPoa').trigger("reset");
                window.location.reload('poa.php');
            }
            else {
                alertify.error("¡ERROR!... No se pudo actualizar");
            }
        }
    });
}