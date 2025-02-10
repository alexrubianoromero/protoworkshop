<?php
// echo '<pre>'; 
// print_r($_REQUEST); 
// echo '</pre>';
     include('../valotablapc.php');
    $sql= "insert into gastosorden (idorden,descripcion,valor,fecha,proveedor) 
    values('".$_REQUEST['id']."','".$_REQUEST['descripcion']."','".$_REQUEST['valor']."',now(),'".$_REQUEST['proveedor']."')"; 
   //  die($sql); 
    $consulta = mysql_query($sql,$conexion);

   include('pantallagastosorden.php'); 
?>