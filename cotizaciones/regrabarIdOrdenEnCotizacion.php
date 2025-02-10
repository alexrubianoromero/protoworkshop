<?php
// echo '<pre>'; 
// print_r($_REQUEST); 
// echo '</pre>';
// die('desde fucionar cotizaciobes');
include('../valotablapc.php'); 

$sql = "select * from ordenes where orden = '".$_REQUEST['orden']."'  ";
$consulta = mysql_query($sql,$conexion); 
$filas = mysql_num_rows($consulta);
$arrOrden = mysql_fetch_assoc($consulta);
if($filas >0){
    $sql = "update cotizaciones 
            set fusionadaconorden   =  '".$arrOrden['id']."'   
            ,id_orden   =  '".$arrOrden['id']."'  
            where id_cotizacion =  '".$_REQUEST['idCotizacion']."'   "; 
    // die($sql);
    $consulta = mysql_query($sql,$conexion);
}    

echo 'se realizo regrabacion';


?>