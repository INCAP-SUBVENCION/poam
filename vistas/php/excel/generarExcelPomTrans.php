<?php
include_once('../../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set("America/Guatemala");
session_start();
$PERIODO = $_POST['periodo'];
$SUBRECEPTOR = $_POST['sub'];
$MES = $_POST['meses'];
$CONTADOR = 1;
$sql_p1 = "SELECT DISTINCT t2.idPom, t2.periodo, t3.nombre AS mes, t4.nombre AS municipio, t2.lugar, t2.fecha, 
t2.horaInicio, t2.horaFin, t6.codigo, CONCAT(t6.nombre, ' ', t6.apellido) as nombres, t2.pNuevo, t2.pRecurrente,
(t2.pNuevo + t2.pRecurrente) as total, t2.cnatural, t2.csabor, t2.lubricante, t2.pruebaVIH, t2.autoprueba, 
t2.reactivo, t2.sifilis, t2.observacion, t2.supervisado, CONCAT(p.nombre,' ',p.apellido) AS supervisor, t2.movil, t8.nombre as estados FROM pom t2
LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
LEFT JOIN promotor t5 ON t5.idPromotor = t2.promotor_id
LEFT JOIN persona t6 ON t6.idPersona = t5.persona_id
LEFT JOIN poa t7 ON t7.idPoa = t2.poa_id
LEFT JOIN catalogo t8 ON t8.codigo = t2.estado
LEFT JOIN usuario u ON u.idUsuario = t2.supervisor
LEFT JOIN persona p ON p.idPersona = u.persona_id
WHERE t2.periodo= '$PERIODO' AND t7.subreceptor_id = $SUBRECEPTOR AND t2.mes = '$MES'";
$resultado_p1 = $enlace->query($sql_p1);

$html = '';
$html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
$html .= '<table border=1>';
$html .= '<th scope>#</th>';
$html .= '<th scope>Periodo</th>';
$html .= '<th scope>Mes</th>';
$html .= '<th scope>Municipio</th>';
$html .= '<th scope>Lugar</th>';
$html .= '<th scope>Fecha</th>';
$html .= '<th scope>Inicio</th>';
$html .= '<th scope>Fin</th>';
$html .= '<th scope>Codigo</th>';
$html .= '<th scope>Promotor</th>';
$html .= '<th scope>Nuevos</th>';
$html .= '<th scope>Recurrentes</th>';
$html .= '<th scope>Total</th>';
$html .= '<th scope>Condon Natural</th>';
$html .= '<th scope>Condon Sabor</th>';
$html .= '<th scope>Lubricante</th>';
$html .= '<th scope>Prueba VIH</th>';
$html .= '<th scope>Auto-prueba VIH</th>';
$html .= '<th scope>Reactivo esperado</th>';
$html .= '<th scope>Sifilis</th>';
$html .= '<th scope>Observaciones</th>';
$html .= '<th scope>Supervisado</th>';
$html .= '<th scope>Supervisor</th>';
$html .= '<th scope>Unidad Movil</th>';
$html .= '<th scope>Estado</th>';
while ($periodo_1 = $resultado_p1->fetch_assoc()){ 

    $html .= '<tr>';
    $html .= '<td>'.$CONTADOR++.'</td>';
    $html .= '<td>'.$periodo_1['periodo'].'</td>';
    $html .= '<td>'.$periodo_1['mes'].'</td>';
    $html .= '<td>'.$periodo_1['municipio'].'</td>';
    $html .= '<td>'.$periodo_1['lugar'].'</td>';
    $html .= '<td>'.$periodo_1['fecha'].'</td>';
    $html .= '<td>'.$periodo_1['horaInicio'].'</td>';
    $html .= '<td>'.$periodo_1['horaFin'].'</td>';
    $html .= '<td>'.$periodo_1['codigo'].'</td>';
    $html .= '<td>'.$periodo_1['nombres'].'</td>';
    $html .= '<td>'.round($periodo_1['pNuevo'],2).'</td>';
    $html .= '<td>'.round($periodo_1['pRecurrente'],2).'</td>';
    $html .= '<td>'.round($periodo_1['total'],2).'</td>';
    $html .= '<td>'.round($periodo_1['cnatural'],2).'</td>';
    $html .= '<td>'.round($periodo_1['csabor'],2).'</td>';
    $html .= '<td>'.round($periodo_1['lubricante'],2).'</td>';
    $html .= '<td>'.round($periodo_1['pruebaVIH'],2).'</td>';
    $html .= '<td>'.round($periodo_1['autoprueba'],2).'</td>';
    $html .= '<td>'.round($periodo_1['reactivo'],2).'</td>';
    $html .= '<td>'.round($periodo_1['sifilis'],2).'</td>';
    $html .= '<td>'.$periodo_1['observacion'].'</td>';
    if($periodo_1['supervisado'] == 1){
        $html .= '<td>Si</td>';
    } else {
        $html .= '<td>No</td>'; 
    }
    $html .= '<td>'.$periodo_1['supervisor'].'</td>';
    if($periodo_1['movil']==1) { 
        $html .= '<td>Si</td>';
    } else { 
        $html .= '<td>No</td>'; 
    }
    $html .= '<td>'.$periodo_1['estados'].'</td>';
    $html .= '</tr>';
}
$html .= '</table>';
header('Content-Type: application/xlsx');
header('Content-Disposition: attachment; filename=pomTrans.xls');
echo $html;
exit;
