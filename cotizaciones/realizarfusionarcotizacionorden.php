<?php

// echo '<pre>'; 
// print_r($_REQUEST); 
// echo '</pre>';
// die('desde fucionar cotizaciobes');

include('../valotablapc.php'); 
//realizar verificaciones 
// que el numero de la orden este bien 
//buscar el numero de la orden 



$sql = "select * from ordenes where orden = '".$_REQUEST['orden']."'  ";
$consulta = mysql_query($sql,$conexion); 
$filas = mysql_num_rows($consulta);
$arrOrden = mysql_fetch_assoc($consulta);

$verifiqueIdORden = verificarIdOrdenNoestarAsociadoOtraCoti($arrOrden['id'],$conexion);

if($verifiqueIdORden['filas'] > 0)
{
    echo 'Orden '.$_REQUEST['orden'].' Asociada a cotizacion No '.$verifiqueIdORden['cotizacion'].'<br>No se puede asociar ';
    die();
}

if($filas >0){
    //validar que no halla sido fusionada antes la orden 
    $valOrdenFusionAnterior = valOrdenNoCreadaAPartirDeOrden($arrOrden['id'],$conexion);
    if($valOrdenFusionAnterior['valida'] =='0'){
        // echo 'no se ha creado a partir de una orden';
        //hacer la fusion
        //traer los items de la orden

         //marcar la cotizacion con el id de la orden con la que se fusiono
       actualizarIdOrdenEnCotizacion($_REQUEST['idCotizacion'],$arrOrden['id'],$conexion);

       $itemsCotizacion =  traerItemsCheckeadosCotizacion($_REQUEST['idCotizacion'],$conexion);

       //realizar la adicion de estos items a la orden ;
       adicionarItemsAOrden($arrOrden['id'],$itemsCotizacion,$conexion);
       //marcar la cotizacion con el id de la orden con la que se fusiono
       actualizarIdOrdenEnCotizacion($_REQUEST['idCotizacion'],$arrOrden['id'],$conexion);


    }else{
        echo 'orden '.$_REQUEST['orden'].'  fusionada o creada a partir de la cotizacion '.$valOrdenFusionAnterior['cotizacion'];
        echo '<br> No es posible funcionar la cotizacion con esta orden'; 
    }
    //validar que no halla sido creada a partir de una cotizacion 
    
} //fin de if($filas >0)
else{
    echo 'El numero de orden no existe'; 
}




function valOrdenNoCreadaAPartirDeOrden($idOrden,$conexion)
{
    $sql = "select * from cotizaciones where id_orden = '".$idOrden."'  "; 
    $consulta = mysql_query($sql,$conexion);
    $filas = mysql_num_rows($consulta);
    if($filas>0){
        $arrCoti =mysql_fetch_assoc($consulta);
        $cotizacion = $arrCoti['no_cotizacion'];
        $valida = 1;
    }else{
        $valida=0;
        $cotizacion = '';
    } 
    $respu['valida']=$valida;
    $respu['cotizacion'] = $cotizacion;
    return $respu; 
}

function traerItemsCheckeadosCotizacion($idCotizacion,$conexion){
    $sql = "select * from item_orden_cotizaciones where no_factura = '".$idCotizacion."' and sumar='1'  "; 
    $consulta = mysql_query($sql,$conexion); 
    return $consulta;
}

function adicionarItemsAOrden($idOrden,$itemsCotizacion,$conexion)
{
    $numeroItems = 0;
    while($item = mysql_fetch_assoc($itemsCotizacion))
    {
        $sqlAdicionarItem = "insert into item_orden (no_factura, codigo, descripcion, cantidad,
        total_item,valor_unitario,estado,anulado,repman,fecha)    
          values('".$idOrden."','".$item['codigo']."','".$item['descripcion']."'
          ,'".$item['cantidad']."','".$item['total_item']."','".$item['valor_unitario']."'
          ,'0','0','".$item['repman']."',now()
        ); 
        ";
        $consulta = mysql_query($sqlAdicionarItem,$conexion); 
        $numeroItems ++;
    }
    echo '<br>Se realizo la adicion de '.$numeroItems.' items a la orden ';
}

function actualizarIdOrdenEnCotizacion($idCotizacion,$idOrden,$conexion)
{
    $sql = "update cotizaciones 
        set fusionadaconorden   =  '".$idOrden."'   
          ,id_orden   =  '".$idOrden."'  
        where id_cotizacion =  '".$idCotizacion."'   "; 
    // die($sql);
    $consulta = mysql_query($sql,$conexion);
}



function verificarIdOrdenNoestarAsociadoOtraCoti($idOrden,$conexion)
{
    $sql="select * from cotizaciones where fusionadaconorden = '".$idOrden."'";
    // die($sql);
    $consulta = mysql_query($sql,$conexion); 
    $filas = mysql_num_rows($consulta);
    $arrInfoCoti = mysql_fetch_assoc($consulta);
    $respu['filas'] = $filas;
    $respu['cotizacion']= $arrInfoCoti['no_cotizacion'];
    // echo 'arreglo<pre>'; 
    // print_r($respu); 
    // echo '</pre>';
    // die();
    return $respu;
}


?>


