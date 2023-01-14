<?php
// echo '<pre>'; 
// print_r($_REQUEST); 
// echo '</pre>';
session_start();
date_default_timezone_set('America/Bogota');
include('../valotablapc.php');
$fechapan =  time();
$fechapan = date ( "Y/m/j" , $fechapan );
// traer la informacion de la cotizacion 
// con sus items 
// crear la orden 
// crear los items 
// marcar la cotizacion com orden 

$cotizacion = traerInfoCotizacion($_REQUEST['id_cotizacion'],$conexion); 
$datosCarro = traerInfCarro($cotizacion['idcarro'],$conexion); 
echo '<pre>'; 
print_r($datosCarro); 
echo '</pre>';

$contaor = traerContaor($conexion);
$siguienteOrden = $contaor +1 ; 

// crear la orden 
crearOrden($cotizacion,$datosCarro,$siguienteOrden,$fechapan, $conexion);


function crearOrden($cotizacion,$datosCarro,$siguienteOrden,$fechapan,$conexion)
{

    $observacion = "Creada a partir de una cotizacion ";
        $sql_grabar_orden = "insert into ordenes (orden,placa,sigla,fecha,observaciones,radio,antena,repuesto,herramienta,otros,

        iva,id_empresa,estado,kilometraje,mecanico,tipo_orden,kilometraje_cambio,fecha_entrega,notificacion,gasolina,hora) 

        values (

        '".$siguienteOrden."',

        '".$datosCarro['placa']."',

        '',

        '".$fechapan."',

        '".$observacion."',

        '".$_POST['radio']."',

        '".$_POST['antena']."',

        '".$_POST['repuesto']."',

        '".$_POST['herramienta']."',

        '".$_POST['otros']."',

        '16',

        '".$_SESSION['id_empresa']."',

        '0',

        '".$cotizacion['kilometraje']."',

        '".$_POST['mecanico']."',

        '1',

        '".$_POST['kilometraje_cambio']."',

        '".$_POST['fecha_entrega']."',

        '".$_POST['notificacion']."',

        '".$_POST['gasolina']."',
        '".$hora_actual ."'

        )";


}

function traerContaor($conexion)
{
    $sql_numero_actual_orden = "select contaor from empresa "; 
    $consu = mysql_query($sql_numero_actual_orden,$conexion);
    $contaor = mysql_fetch_assoc($consu);
    $contaor = $contaor['contaor'];
    return $contaor;
} 

function traerInfoCotizacion($idcotizacion,$conexion)
    {
        $sql_coti = "select * from cotizaciones where id_cotizacion = '".$idcotizacion."'   ";
        // die($sql_coti);
        $consulta = mysql_query($sql_coti,$conexion); 
        $cotizacion = mysql_fetch_assoc($consulta);
        return $cotizacion; 
    }

    function traerInfCarro($idcarro,$conexion)
    {
        $sql_traer_carro =     "select * from carros where idcarro = '".$idcarro."' "; 
        $consulta = mysql_query($sql_traer_carro,$conexion); 
        $carro = mysql_fetch_assoc($consulta);
        return $carro; 
    }

    

?>