<?php
include('../valotablapc.php');
// echo '<pre>'; 
// print_r($_REQUEST);
// echo '</pre>';
// die();

$sql = "select coniva from cotizaciones where id_cotizacion = ".$_REQUEST['id_cotizacion']."  ";
$consulta = mysql_query($sql,$conexion);
$arreglo = mysql_fetch_assoc($consulta);
// die($arreglo[coniva]);
if($arreglo[coniva]==0){
    $nuevoValor = 1;
}else{
    $nuevoValor = 0;

}  
$sql = "update cotizaciones set coniva =  ".$nuevoValor."  where id_cotizacion =  ".$_REQUEST['id_cotizacion']."    ";
$consulta = mysql_query($sql,$conexion);

include('../cotizaciones/muestre_cotizaciones.php'); 
?>