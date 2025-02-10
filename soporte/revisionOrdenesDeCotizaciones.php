<?php
include('../valotablapc.php');
include('../funciones.php');

//traer todas las cotizaciones que tengan numero de id_orden > 0 

function traerCotizacionesConIdOrden($conexion)
{
    $sql = "select * from cotizaciones where id_orden > 0 ";
    $consulta = mysql_query($sql,$conexion); 
    $arrOrdenes = get_table_assoc($consulta); 
    return $arrOrdenes;
}

function traerOrdenId($idOrden,$conexion)
{
    $sql = "select * from ordenes where id = '".$idOrden."'  ";
    $consulta = mysql_query($sql,$conexion); 
    $arrOrden = get_table_assoc($consulta); 
    return $arrOrden;
}

function traerDatosCarroId($idCarro,$conexion)
{
    $sql = "select * from carros where  idcarro = '".$idCarro."'  "; 
    $consulta = mysql_query($sql,$conexion); 
    $arrCarro = get_table_assoc($consulta); 
    return $arrCarro;
}

function actualizarPlacaEnOrden($idOrden,$placa,$conexion)
{
    $sql= "update ordenes set placa = '".$placa."'   where id = '".$idOrden."'  ";
    $consulta = mysql_query($sql,$conexion); 

}



$cotizacionesConidOrden = traerCotizacionesConIdOrden($conexion); 

echo '<table>';
echo '<tr>'; 
echo '<td>NoCotizacion</td>';
echo '<td>PLacaCotizacion</td>';
echo '<td>Orden</td>';
echo '<td>Placa</td>';
echo '</tr>';   
foreach($cotizacionesConidOrden as $cotizacion )
{
    $infoOrden = traerOrdenId($cotizacion['id_orden'],$conexion);
    $infoCarro = traerDatosCarroId($cotizacion['idcarro'],$conexion); 
    // echo '<pre>'; 
    // print_r($infoOrden); 
    // echo '</pre>';
    // die(); 
    if($infoOrden[0]['placa']=='')
    {
        // echo '<br>'.$cotizacion['id_orden'];
        
        echo '<tr>'; 
        echo '<td>'.$cotizacion['no_cotizacion'].'</td>';
        echo '<td>'.$infoCarro[0]['placa'].'</td>';
        echo '<td>'.$infoOrden[0]['orden'].'</td>';
        echo '<td>NO tiene</td>';
        echo '</tr>';   
        actualizarPlacaEnOrden($cotizacion['id_orden'],$infoCarro[0]['placa'],$conexion);
    }
    
}
echo '</table>';

?>