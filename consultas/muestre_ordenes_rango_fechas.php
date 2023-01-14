<?php
session_start();
include('../valotablapc.php');

// echo '<pre>'; 
// print_r($_REQUEST); 
// echo '</pre>';
// die();
$sql_ordenes = "select o.fecha,o.orden,o.placa,o.kilometraje,o.observaciones,i.codigo,i.descripcion
,i.valor_unitario,i.cantidad,i.total_item,estado
 from $tabla14 o
 inner join $tabla15 i on (i.no_factura = o.id)
where 1=1 ";

if($_REQUEST['fechain']!="")
{
	$sql_ordenes .=" and fecha > '".$_REQUEST['fechain']."' ";
}
if($_REQUEST['fechafin']!="")
{
	$sql_ordenes .=" and fecha < '".$_REQUEST['fechafin']."' ";
}

$sql_ordenes .="  and i.anulado = 0   order by o.id "; 


$consulta_ordenes = mysql_query($sql_ordenes,$conexion);
//echo 'consulta<br>'.$sql_ordenes;
?>
<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="initial-scale=1">
<title>Untitled Document</title> 
<link rel="stylesheet" href="css/normalize.css">
 <link rel="stylesheet" href="css/style_menu_navegacion.css"> 
  <link rel="stylesheet" href="css/style.css"> 
</head>

<body>
<br>
<?php
echo '<table border = "1">';
echo '<tr>';
echo '<td>FECHA</td>';
echo '<td align="center">ORDEN</td>';
echo '<td>PLACA</td>';
echo '<td>KILOMETRAJE</td>';
echo '<td>CODIGO</td>';
echo '<td>DESCRIPCION COD</td>';
echo '<td align="right">VR UNIT</td>';
echo '<td align="center">CANTIDAD</td>';
echo '<td align="right">TOTAL ITEM</td>';
echo '</tr>';

while($ordenes = mysql_fetch_assoc($consulta_ordenes))
	{
		echo '<tr>';
		echo '<td>'.$ordenes['fecha'].'</td>';
		echo '<td align="center">'.$ordenes['orden'].'</td>';
		echo '<td>'.$ordenes['placa'].'</td>';
		echo '<td>'.$ordenes['kilometraje'].'</td>';
		echo '<td>'.$ordenes['codigo'].'</td>';
		echo '<td>'.$ordenes['descripcion'].'</td>';
		echo '<td  align="right">'.$ordenes['valor_unitario'].'</td>';
		echo '<td align="center">'.$ordenes['cantidad'].'</td>';
		echo '<td  align="right">'.$ordenes['total_item'].'</td>';
		echo '</tr>';
	}
echo '</table>';	
?>

</body>
</html>
<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>   