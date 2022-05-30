<?php

/** REPORTE EN BARRAS */
// ENERO
$sql_en = "SELECT m.nombre AS Municipios, ROUND(SUM(p.pNuevo), 2) AS nuevos FROM pom p 
LEFT JOIN catalogo m ON m.codigo = p.municipio 
WHERE subreceptor_id = $SUBRECEPTOR AND periodo = 3 AND mes = 'MP31'  
AND estado NOT IN (SELECT estado FROM pom HAVING estado IN ('PR01', 'PR02', 'PR03','ES01','ES02','ES03','ES05','ES06')) 
GROUP BY Municipios";
$resultado_en = $enlace->query($sql_en);
$enero  = mysqli_affected_rows($enlace);
if ($enero > 0) {
    $en = 0;
    while ($enero = $resultado_en->fetch_assoc()) {
        $valoresx_en[$en] = $enero['Municipios'];
        $valoresy_en[$en] = $enero['nuevos'];
        $en++;
    }
    $datosx_en = json_encode($valoresx_en);
    $datosy_en = json_encode($valoresy_en);
} else {
    $valoresx_en = "";
    $valoresy_en = "";
}
$resultado_en->close();

// FEBRERO
$sql_fb = "SELECT m.nombre AS Municipios, ROUND(SUM(p.pNuevo), 2) AS nuevos FROM pom p 
LEFT JOIN catalogo m ON m.codigo = p.municipio 
WHERE subreceptor_id = $SUBRECEPTOR AND periodo = 3 AND mes = 'MP32'  
AND estado NOT IN (SELECT estado FROM pom HAVING estado IN ('PR01', 'PR02', 'PR03','ES01','ES02','ES03','ES05','ES06')) 
GROUP BY Municipios";
$resultado_fb = $enlace->query($sql_fb);
$febrero  = mysqli_affected_rows($enlace);
if ($febrero > 0) {
    $fb = 0;
    while ($febrero = $resultado_fb->fetch_assoc()) {
        $valoresx_fb[$fb] = $febrero['Municipios'];
        $valoresy_fb[$fb] = $febrero['nuevos'];
        $fb++;
    }
    $datosx_fb = json_encode($valoresx_fb);
    $datosy_fb = json_encode($valoresy_fb);
} else {
    $valoresx_fb = "";
    $valoresy_fb = "";
}
$resultado_fb->close();

// MARZO
$sql_mz = "SELECT m.nombre AS Municipios, ROUND(SUM(p.pNuevo), 2) AS nuevos FROM pom p 
LEFT JOIN catalogo m ON m.codigo = p.municipio 
WHERE subreceptor_id = $SUBRECEPTOR AND periodo = 3 AND mes = 'MP33'  
AND estado NOT IN (SELECT estado FROM pom HAVING estado IN ('PR01', 'PR02', 'PR03','ES01','ES02','ES03','ES05','ES06')) 
GROUP BY Municipios";
$resultado_mz = $enlace->query($sql_mz);
$marzo  = mysqli_affected_rows($enlace);
if ($marzo > 0) {
    $mz = 0;
    while ($marzo = $resultado_mz->fetch_assoc()) {
        $valoresx_mz[$mz] = $marzo['Municipios'];
        $valoresy_mz[$mz] = $marzo['nuevos'];
        $mz++;
    }
    $datosx_mz = json_encode($valoresx_mz);
    $datosy_mz = json_encode($valoresy_mz);
} else {
    $valoresx_mz = "";
    $valoresy_mz = "";
}
$resultado_mz->close();
// ABRIL
$sql_ab = "SELECT m.nombre AS Municipios, ROUND(SUM(p.pNuevo), 2) AS nuevos FROM pom p 
LEFT JOIN catalogo m ON m.codigo = p.municipio 
WHERE subreceptor_id = $SUBRECEPTOR AND periodo = 3 AND mes = 'MP34'  
AND estado NOT IN (SELECT estado FROM pom HAVING estado IN ('PR01', 'PR02', 'PR03','ES01','ES02','ES03','ES05','ES06')) 
GROUP BY Municipios";
$resultado_ab = $enlace->query($sql_ab);
$abril  = mysqli_affected_rows($enlace);
if ($abril > 0) {
    $ab = 0;
    while ($abril = $resultado_ab->fetch_assoc()) {
        $valoresx_ab[$ab] = $abril['Municipios'];
        $valoresy_ab[$ab] = $abril['nuevos'];
        $ab++;
    }
    $datosx_ab = json_encode($valoresx_ab);
    $datosy_ab = json_encode($valoresy_ab);
} else {
    $valoresx_ab = "";
    $valoresy_ab = "";
}
$resultado_ab->close();
// MAYO
$sql_my = "SELECT m.nombre AS Municipios, ROUND(SUM(p.pNuevo), 2) AS nuevos FROM pom p 
LEFT JOIN catalogo m ON m.codigo = p.municipio 
WHERE subreceptor_id = $SUBRECEPTOR AND periodo = 3 AND mes = 'MP35'  
AND estado NOT IN (SELECT estado FROM pom HAVING estado IN ('PR01', 'PR02', 'PR03','ES01','ES02','ES03','ES05','ES06')) 
GROUP BY Municipios";
$resultado_my = $enlace->query($sql_my);
$mayo  = mysqli_affected_rows($enlace);
if ($mayo > 0) {
    $my = 0;
    while ($mayo = $resultado_my->fetch_assoc()) {
        $valoresx_my[$my] = $mayo['Municipios'];
        $valoresy_my[$my] = $mayo['nuevos'];
        $my++;
    }
    $datosx_my = json_encode($valoresx_my);
    $datosy_my = json_encode($valoresy_my);
} else {
    $valoresx_my = "";
    $valoresy_my = "";
}
$resultado_my->close();
// JUNIO
$sql_jn = "SELECT m.nombre AS Municipios, ROUND(SUM(p.pNuevo), 2) AS nuevos FROM pom p 
            LEFT JOIN catalogo m ON m.codigo = p.municipio 
            WHERE subreceptor_id = $SUBRECEPTOR AND periodo = 3 AND mes = 'MP36'  
            AND estado NOT IN (SELECT estado FROM pom HAVING estado IN ('PR01', 'PR02', 'PR03','ES01','ES02','ES03','ES05','ES06')) 
            GROUP BY Municipios";
$resultado_jn = $enlace->query($sql_jn);
$junio  = mysqli_affected_rows($enlace);
if ($junio > 0) {
    $jn = 0;
    while ($junio = $resultado_jn->fetch_assoc()) {
        $valoresx_jn[$jn] = $junio['Municipios'];
        $valoresy_jn[$jn] = $junio['nuevos'];
        $jn++;
    }
    $datosx_jn = json_encode($valoresx_jn);
    $datosy_jn = json_encode($valoresy_jn);
} else {
    $valoresx_jn = "";
    $valoresy_jn = "";
}
$resultado_jn->close();
/** REPORTE GENERAL DE NUEVOS POA */
$sql_poa_n = "SELECT t2.nombre AS mes, ROUND(SUM(nuevo), 2) AS nuevos FROM poa t1  LEFT JOIN catalogo t2 ON t2.codigo = t1.mes 
                WHERE subreceptor_id = $SUBRECEPTOR AND periodo = 3  AND t1.estado='ES04' GROUP BY mes";
$resultado_poa_n = $enlace->query($sql_poa_n);
$poa_n  = mysqli_affected_rows($enlace);
if ($poa_n > 0) {
    $pn = 0;
    while ($poa_n = $resultado_poa_n->fetch_assoc()) {
        $valoresx_poa_n[$pn] = $poa_n['mes'];
        $valoresy_poa_n[$pn] = $poa_n['nuevos'];
        $pn++;
    }
    $datosx_poa_n = json_encode($valoresx_poa_n);
    $datosy_poa_n = json_encode($valoresy_poa_n);
} else {
    $valoresx_poa_n = "";
    $valoresy_poa_n = "";
}
$resultado_poa_n->close();
/** REPORTE GENERAL DE NUEVOS POM */
$sql_pom_n = "SELECT m.nombre AS mes, ROUND(SUM(pNuevo), 2) AS nuevos FROM pom p 
                LEFT JOIN catalogo m ON m.codigo = p.mes WHERE subreceptor_id = $SUBRECEPTOR AND periodo = 3  
                AND p.estado NOT IN (SELECT estado FROM pom HAVING estado IN ('PR01', 'PR02', 'PR03','ES01','ES02','ES03','ES05','ES06')) 
                GROUP BY mes";
$resultado_pom_n = $enlace->query($sql_pom_n);
$pom_n  = mysqli_affected_rows($enlace);
if ($pom_n > 0) {
    $pm_n = 0;
    while ($pom_n = $resultado_pom_n->fetch_assoc()) {
        $valoresx_pom_n[$pm_n] = $pom_n['mes'];
        $valoresy_pom_n[$pm_n] = $pom_n['nuevos'];
        $pm_n++;
    }
    $datosx_pom_n = json_encode($valoresx_pom_n);
    $datosy_pom_n = json_encode($valoresy_pom_n);
} else {
    $valoresx_pom_n = "";
    $valoresy_pom_n = "";
}
$resultado_pom_n->close();
/** REPORTE GENERAL DE RECURRENTES POA */
$sql_poa_r = "SELECT t2.nombre AS mes, ROUND(SUM(recurrente), 2) AS recurrentes FROM poa t1  LEFT JOIN catalogo t2 ON t2.codigo = t1.mes 
WHERE subreceptor_id = $SUBRECEPTOR AND periodo = 3  AND t1.estado='ES04' GROUP BY mes";
$resultado_poa_r = $enlace->query($sql_poa_r);
$poa_r  = mysqli_affected_rows($enlace);
if ($poa_r > 0) {
    $pr = 0;
    while ($poa_r = $resultado_poa_r->fetch_assoc()) {
        $valoresx_poa_r[$pr] = $poa_r['mes'];
        $valoresy_poa_r[$pr] = $poa_r['recurrentes'];
        $pr++;
    }
    $datosx_poa_r = json_encode($valoresx_poa_r);
    $datosy_poa_r = json_encode($valoresy_poa_r);
} else {
    $valoresx_poa_r = "";
    $valoresy_poa_r = "";
}
$resultado_poa_r->close();
/** REPORTE GENERAL DE RECURRENTES POM */
$sql_pom_r = "SELECT m.nombre AS mes, ROUND(SUM(pRecurrente), 2) AS recurrentes FROM pom p 
            LEFT JOIN catalogo m ON m.codigo = p.mes WHERE subreceptor_id = $SUBRECEPTOR AND periodo = 3  
            AND p.estado NOT IN (SELECT estado FROM pom HAVING estado IN ('PR01', 'PR02', 'PR03','ES01','ES02','ES03','ES05','ES06')) 
            GROUP BY mes";
$resultado_pom_r = $enlace->query($sql_pom_r);
$pom_r  = mysqli_affected_rows($enlace);
if ($pom_r > 0) {
    $pm_r = 0;
    while ($pom_r = $resultado_pom_r->fetch_assoc()) {
        $valoresx_pom_r[$pm_r] = $pom_r['mes'];
        $valoresy_pom_r[$pm_r] = $pom_r['recurrentes'];
        $pm_r++;
    }
    $datosx_pom_r = json_encode($valoresx_pom_r);
    $datosy_pom_r = json_encode($valoresy_pom_r);
} else {
    $valoresx_pom_r = "";
    $valoresy_pom_r = "";
}
$resultado_pom_r->close();
/** REPORTE GENERAL DE ACTIVIDADES POM */
$sql_a = "SELECT e.nombre AS estado, COUNT(p.estado) AS cantidad FROM pom p  LEFT JOIN catalogo e ON e.codigo = p.estado WHERE subreceptor_id = $SUBRECEPTOR 
AND p.estado NOT IN (SELECT estado FROM pom HAVING estado IN ('PR01', 'PR02', 'PR03','ES01','ES02','ES03','ES05')) GROUP BY estado";
$resultado_a = $enlace->query($sql_a);
$actividad  = mysqli_affected_rows($enlace);
if ($actividad > 0) {
    $a = 0;
    while ($actividad = $resultado_a->fetch_assoc()) {
        $valoresx_a[$a] = $actividad['estado'];
        $valoresy_a[$a] = $actividad['cantidad'];
        $a++;
    }
    $datosx_a = json_encode($valoresx_a);
    $datosy_a = json_encode($valoresy_a);
} else {
    $valoresx_a = "";
    $valoresy_a = "";
}
$resultado_a->close();
?>
<div class="row">
    <div class="card">
        <div class="card-header">Periodo III</div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <div id="nuevos"></div>
                </div>
                <div class="col-md-6">
                    <div id="recurrentes"></div>
                </div>
                <div class="col-md-12">
                    <div id="columnas"></div>
                </div>
                <div class="col-md-12">
                    <div id="myDiv"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        /**
         * GRAFICA DE COLUMNAS
         */

        // ENERO
        datosx_en = <?php echo json_encode($valoresx_en); ?>;
        datosy_en = <?php echo json_encode($valoresy_en); ?>;
        var enero = {
            x: datosx_en,
            y: datosy_en,
            name: 'Enero',
            type: 'bar',
            marker: {
                line: {
                    color: 'rgb(8,48,107)',
                    width: 1
                },
                color: 'rgb(255, 243, 0)'
            }
        };
        // FEBRERO
        datosx_fb = <?php echo json_encode($valoresx_fb); ?>;
        datosy_fb = <?php echo json_encode($valoresy_fb); ?>;
        var febrero = {
            x: datosx_fb,
            y: datosy_fb,
            name: 'Febrero',
            type: 'bar',
            marker: {
                line: {
                    color: 'rgb(8,48,107)',
                    width: 1
                },
                color: 'rgb(50, 150, 255 )'
            }
        };
        // MARZO
        datosx_mz = <?php echo json_encode($valoresx_mz); ?>;
        datosy_mz = <?php echo json_encode($valoresy_mz); ?>;
        var marzo = {
            x: datosx_mz,
            y: datosy_mz,
            name: 'Marzo',
            type: 'bar',
            marker: {
                line: {
                    color: 'rgb(8,48,107)',
                    width: 1
                },
                color: 'rgb(150, 150, 150)'
            }
        };
        // ABRIL
        datosx_ab = <?php echo json_encode($valoresx_ab); ?>;
        datosy_ab = <?php echo json_encode($valoresy_ab); ?>;
        var abril = {
            x: datosx_ab,
            y: datosy_ab,
            name: 'Abril',
            type: 'bar',
            marker: {
                line: {
                    color: 'rgb(8,48,107)',
                    width: 1
                },
                color: 'rgb(255, 87, 51)'
            }
        };
        // MAYO
        datosx_my = <?php echo json_encode($valoresx_my); ?>;
        datosy_my = <?php echo json_encode($valoresy_my); ?>;
        var mayo = {
            x: datosx_my,
            y: datosy_my,
            name: 'Mayo',
            type: 'bar',
            marker: {
                line: {
                    color: 'rgb(8,48,107)',
                    width: 1
                },
                color: 'rgb(134, 255, 51)'
            }
        };

        // JUNIO
        datosx_jn = <?php echo json_encode($valoresx_jn); ?>;
        datosy_jn = <?php echo json_encode($valoresy_jn); ?>;
        var junio = {
            x: datosx_jn,
            y: datosy_jn,
            name: 'Junio',
            type: 'bar',
            marker: {
                line: {
                    color: 'rgb(8,48,107)',
                    width: 1
                },
                color: 'rgb(6, 57, 112)'
            }
        };

        var data = [enero, febrero, marzo, abril, mayo, junio];

        var layout = {
            height: 300,
            title: 'Nuevos',
            barmode: 'group',
            bargap: 0.10,
            bargroupgap: 0.1,
            margin: {
                "t": 75,
                "b": 75,
                "l": 30,
                "r": 20
            },
            xaxis: {
                tickfont: {
                    size: 9,
                    color: 'rgb(107, 107, 107)'
                }
            },
            legend: {
                x: 1,
                y: 1,
                bgcolor: 'rgba(255, 255, 255, 0)',
                bordercolor: 'rgba(255, 255, 255, 0)'
            }
        };

        Plotly.newPlot('columnas', data, layout);
        /**
         * GRAFICA DE LINEAS 
         */
        datosx_poa_n = <?php echo json_encode($valoresy_poa_n); ?>;
        datosy_poa_n = <?php echo json_encode($valoresx_poa_n); ?>;
        var poa = {
            x: datosy_poa_n,
            y: datosx_poa_n,
            mode: 'Lines',
            name: 'Planificado'
        };

        datosx_pom_n = <?php echo json_encode($valoresy_pom_n); ?>;
        datosy_pom_n = <?php echo json_encode($valoresx_pom_n); ?>;
        var pom = {
            x: datosy_pom_n,
            y: datosx_pom_n,
            mode: 'lines+markers',
            name: 'Realizado'
        };

        var data = [poa, pom];

        var layout = {
            height: 250,
            title: 'Nuevos POA - POM',
            margin: {
                "t": 75,
                "b": 25,
                "l": 30,
                "r": 20
            }
        };

        Plotly.newPlot('nuevos', data, layout);
        /**
         * GRAFICA DE LINEAS 
         */
        datosx_poa_r = <?php echo json_encode($valoresy_poa_r); ?>;
        datosy_poa_r = <?php echo json_encode($valoresx_poa_r); ?>;
        var poa = {
            x: datosy_poa_r,
            y: datosx_poa_r,
            mode: 'Lines',
            name: 'Planificado'
        };

        datosx_pom_r = <?php echo json_encode($valoresy_pom_r); ?>;
        datosy_pom_r = <?php echo json_encode($valoresx_pom_r); ?>;
        var pom = {
            x: datosy_pom_r,
            y: datosx_pom_r,
            mode: 'lines+markers',
            name: 'Realizado'
        };

        var data = [poa, pom];

        var layout = {
            title: 'Recurrentes POA - POM',
            height: 250,
            margin: {
                "t": 75,
                "b": 25,
                "l": 30,
                "r": 20
            }
        };

        Plotly.newPlot('recurrentes', data, layout);
        /**
         * GRAFICA DE BARRAS 
         */
        datosx_a = <?php echo json_encode($valoresy_a); ?>;
        datosy_a = <?php echo json_encode($valoresx_a); ?>;
        var data = [{
            y: datosy_a,
            x: datosx_a,
            type: 'bar',
            orientation: 'h'
        }]

        var layout = {
            title: 'Reporte actividades',
            showlegend: false,
            height: 250,
            margin: {
                "t": 75,
                "b": 25,
                "l": 250,
                "r": 20
            }
        }

        Plotly.newPlot('myDiv', data, layout, {
            displayModeBar: true
        })


    });
</script>