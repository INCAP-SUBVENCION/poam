<?php
include_once('../../../bd/conexion.php');
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set("America/Guatemala");
session_start();
$PERIODO = $_POST['periodo'];
$SUBRECEPTOR = $_POST['sub'];
$MUNICIPIO = $_POST['muni'];
$MES = $_POST['me'];
$CONTADOR = 1;
$sql_p1 = "SELECT DISTINCT t1.idPoa, t5.nombre as mes, t4.nombre as municipio, t1.nuevo, t1.recurrente, 
(t1.nuevo + t1.recurrente) AS total, t1.observacion, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, 
t2.pruebaVIH, t2.reactivoE, t2.sifilis, t6.nombre as estados, t1.subreceptor_id
FROM poa t1
LEFT JOIN insumo t2 ON t2.poa_id = t1.idPoa
LEFT JOIN catalogo t3 ON t3.codigo = t1.departamento
LEFT JOIN catalogo t4 ON t4.codigo = t1.municipio
LEFT JOIN catalogo t5 ON t5.codigo = t1.mes
LEFT JOIN catalogo t6 ON t6.codigo = t1.estado
WHERE t1.subreceptor_id = $SUBRECEPTOR AND t1.periodo = $PERIODO OR t4.codigo = '$MUNICIPIO' OR t5.codigo = '$MES'";
$resultado_p1 = $enlace->query($sql_p1);

$html = '';
$html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
$html .= '<table border=1>';
$html .= '<th scope>#</th>';
$html .= '<th scope>Mes</th>';
$html .= '<th scope>Municipio</th>';
$html .= '<th scope>Nuevos</th>';
$html .= '<th scope>Recurrentes</th>';
$html .= '<th scope>Total</th>';
$html .= '<th scope>Condon Natural</th>';
$html .= '<th scope>Condon Sabor</th>';
$html .= '<th scope>Lubricante</th>';
$html .= '<th scope>Prueba VIH</th>';
$html .= '<th scope>Reactivo esperado</th>';
$html .= '<th scope>Sifilis</th>';
$html .= '<th scope>Observaciones</th>';
$html .= '<th scope>Estado</th>';
while ($periodo_1 = $resultado_p1->fetch_assoc()){ 

    $html .= '<tr>';
    $html .= '<td>'.$CONTADOR++.'</td>';
    $html .= '<td>'.$periodo_1['mes'].'</td>';
    $html .= '<td>'.$periodo_1['municipio'].'</td>';
    $html .= '<td>'.round($periodo_1['nuevo'],2).'</td>';
    $html .= '<td>'.round($periodo_1['recurrente'],2).'</td>';
    $html .= '<td>'.round($periodo_1['total'],2).'</td>';
    $html .= '<td>'.round($periodo_1['cnatural'],2).'</td>';
    $html .= '<td>'.round($periodo_1['csabor'],2).'</td>';
    $html .= '<td>'.round($periodo_1['lubricante'],2).'</td>';
    $html .= '<td>'.round($periodo_1['pruebaVIH'],2).'</td>';
    $html .= '<td>'.round($periodo_1['reactivoE'],2).'</td>';
    $html .= '<td>'.round($periodo_1['sifilis'],2).'</td>';
    $html .= '<td>'.$periodo_1['observacion'].'</td>';
    $html .= '<td>'.$periodo_1['estados'].'</td>';

    $html .= '</tr>';
}
$html .= '</table>';
header('Content-Type: application/xlsx');
header('Content-Disposition: attachment; filename=poaTrans.xls');
echo $html;
exit;
?>