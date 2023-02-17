<?php
include('../valotablapc.php');
$sql="update item_orden_cotizaciones  set sumar = '".$_REQUEST['value']."' where id_item = '".$_REQUEST['idItem']."'  "; 
$consulta = mysql_query($sql,$conexion);
include('../cotizaciones/mostrar_items.php');
mostrar_items($_REQUEST['id_cotizacion']);
?>