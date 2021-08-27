function modalCambiarEstadoPoa(id, usuario) {

    var id = id;
    var accion = "consultaPoa";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion : accion,
            id:id
        },
    success: function (datos, status){

        var poa = JSON.parse(datos);
        document.getElementById("estado_id").value = id
        document.getElementById("estado_mes").value = poa.mes;
        document.getElementById("estado_municipio").value = poa.municipio;
        document.getElementById("estado_nuevo").value = poa.nuevo;
        document.getElementById("estado_recurrente").value = poa.recurrente;
        document.getElementById("estado_total").value = poa.total;
        document.getElementById("estado_usuario").value = usuario;
        document.getElementById("estado_estado").value = "ES12";
    }
});
    $("#modalCambiarEstado").modal("show");
}

function cambiarEstadoPoa(){
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
        success: function(datos){
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

function modalCambiarEstadoPom(id, usuario) {

    var id = id;
    var accion = "consultaPoM";

    $.ajax({
        type: "POST",
        url: "../../php/estados.php",
        data: {
            accion : accion,
            id:id
        },
    success: function (datos, status){

        var pom = JSON.parse(datos);
        document.getElementById("estado_id").value          = id;
        document.getElementById("estado_mes").value         = pom.mes;
        document.getElementById("estado_municipio").value   = pom.municipio;
        document.getElementById("estado_lugar").value       = pom.lugar;
        document.getElementById("estado_fecha").value       = pom.fecha;
        document.getElementById("estado_inicia").value      = pom.horaInicio;
        document.getElementById("estado_finaliza").value    = pom.horaFin;
        document.getElementById("estado_usuario").value     = usuario;
        document.getElementById("estado_estado").value      = "ES02";
    }
});
    $("#modalCambiarEstado").modal("show");
}


function cambiarEstadoPom(){
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
        success: function(datos){
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
