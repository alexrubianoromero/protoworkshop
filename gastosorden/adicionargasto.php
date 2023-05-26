<?php
     include('../valotablapc.php');
    $sql= "insert into gastosorden (idorden,descripcion,valor,fecha) 
    values('".$_REQUEST['id']."','".$_REQUEST['descripcion']."','".$_REQUEST['valor']."',now())"; 
    $consulta = mysql_query($sql,$conexion);

   include('pantallagastosorden.php'); 
?>