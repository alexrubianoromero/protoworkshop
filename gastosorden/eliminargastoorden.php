<?php
    include('../valotablapc.php');
    
        // function traerDatosIdGasto($id)
        // {
        //     $sql = "select * from gastosorden where id = '".$id."'  ";
        //     $consulta = mysql_query($sql,$conexion);
        //     $arreglo = mysql_fecth_assoc($consulta);
        //     return $arreglo;  
        // }

    // $datosIdGasto = traerDatosIdGasto($_REQUEST['idGasto']);
    // $_REQUEST['id'] = $datosIdGasto['idorden'];


    $sql = "delete from gastosorden    where id = '".$_REQUEST['idGasto']."'  ";
    $consulta = mysql_query($sql,$conexion);
    
    include('pantallagastosorden.php'); 
    
    
?>