<!DOCTYPE html>

<head>
<meta charset="UTF-8"/>
    <!-- <link rel="stylesheet" href="../css/normalize.css"> -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>
	#btnConSinIva{
		margin-top: 7px;
		margin-bottom: 7px;
		margin-left: 5px;
		margin-right: 5px;
	}
	#letrasboton{
		font-size: 11px;
	}
</style>
</head>
<body>
<?php

include('../valotablapc.php');

$sql_cotizaciones = "select cot.id_cotizacion,cot.no_cotizacion,cot.fecha , c.placa,cli.nombre,cot.id_factura,id_orden,coniva   
from  $cotizaciones  cot
inner join $tabla4 c on  (c.idcarro = cot.idcarro)
inner join $tabla3 cli on (cli.idcliente = c.propietario)


order by id_cotizacion desc";

$consulta_cotizaciones = mysql_query($sql_cotizaciones,$conexion);

echo '<div id="cotizaciones" align="center">';
echo '<h2>COTIZACIONES</h2>';
echo '<table border = "1" >';
echo '<tr>';
echo '<td>No Cotizacion</td>';
echo '<td>No Factura</td>';
echo '<td>Orden</td>';
echo '<td>FECHA</td>';
echo '<td>NOMBRE</td>';
echo '<td>CARRO</td>';
echo '<td>CON_IVA</td>';
echo '<td>MODIFICAR</td>';
echo '<td>IMPRIMIR</td>';
echo '</tr>';
while ($coti =mysql_fetch_assoc($consulta_cotizaciones))
{
	echo '<tr>';

	echo '<td>'.$coti['no_cotizacion'].'</td>';


	if($coti['id_factura'] > 0 )
	{
		$sql_factura = "select * from $tabla11 where id_factura =  '".$coti['id_factura']."'  ";
		$con_nofactura = mysql_query($sql_factura,$conexion);
		$arr_nofactura = mysql_fetch_assoc($con_nofactura);
		$nofactura = $arr_nofactura['numero_factura'];
	   echo '<td align="center">'.$nofactura.'</td>';
    }
    else
    {
		echo '<td></td>';
    	// echo '<td><a href="../cotizaciones/facturar_cotizacion.php?id_cotizacion='.$coti['id_cotizacion'].'">FACTURAR</a></td>';
    }	
	
	// echo '<td><a href="../orden/ordenes_cotizacion.php?id_cotizacion='.$coti['id_cotizacion'].'">CREAR ORDEN </a></td>';
	//solamente si no tiene creada una orden 
	if($coti['id_orden'] == 0 ){
		echo '<td><a href="../orden/orden_captura_honda.php?id_cotizacion='.$coti['id_cotizacion'].'&placa123='.$coti['placa'].'">CREAR ORDEN </a></td>';
	}else{
		//mostrar el numero de la orden 
		$sqlNumeroOrden = "select orden from ordenes where id = '".$coti['id_orden']."' "; 
		$consultaOrden = mysql_query($sqlNumeroOrden,$conexion);
		$arrOrden = mysql_fetch_assoc($consultaOrden);
		$numeroOrden =    $arrOrden['orden'];
		echo '<td>'.$numeroOrden.'</td>';
	}
	echo '<td>'.$coti['fecha'].'</td>';
	echo '<td>'.$coti['nombre'].'</td>';
	echo '<td>'.$coti['placa'].'</td>';
	if($coti['coniva']==0)
	{
		echo '<td align="center"><button 
		class="btnColocarIva btn btn-primary" 
		id="btnConSinIva"  value = "1" onclick="cambiarIva('.$coti['id_cotizacion'].'); ">
		<span id="letrasboton">APLICAR IVA</span></button></td>';
	}else{
		echo '<td align="center"><button 
		class="btnColocarIva btn btn-default" 
		id="btnConSinIva"  value = "1" onclick="cambiarIva('.$coti['id_cotizacion'].'); ">
		<span id="letrasboton">QUITAR IVA</span></button></td>';
	}

	echo '<td><a href ="modificar_cotizacion.php?id_cotizacion='.$coti['id_cotizacion'].'" >Modificar</a></td>';
	echo '<td><a href="imprimir_cotizacion.php?id_cotizacion='.$coti['id_cotizacion'].'" target="_blank">Imprimir</a></td>';
	echo '<tr>';
}
echo '</table>';
echo '<div>';


?>


</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../jquery-2.1.1.js"></script>  
<script src="jquery-2.1.1.js"></script>   
<script src="js/cotizaciones.js"></script>   

<script>
	function cambiarIva(e){
    // alert('cambiar iva___ '+e);
	const http=new XMLHttpRequest();
    const url = '../cotizaciones/cambiarValorIva.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cotizaciones").innerHTML = this.responseText;
        }
    };

    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("id_cotizacion="+e);
}
</script>