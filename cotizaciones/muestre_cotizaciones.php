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

$sql_cotizaciones = "select cot.id_cotizacion,cot.no_cotizacion,cot.fecha , c.placa,cli.nombre,cot.id_factura,id_orden,coniva,cot.fusionadaconorden   
from  $cotizaciones  cot
inner join $tabla4 c on  (c.idcarro = cot.idcarro)
inner join $tabla3 cli on (cli.idcliente = c.propietario)


order by id_cotizacion desc";

$consulta_cotizaciones = mysql_query($sql_cotizaciones,$conexion);

echo '<div id="cotizaciones" align="center" ">';
echo '<h2>COTIZACIONES</h2>';
echo '<table border="1" class="  table-hover table-condensed">';
echo '<tr>';
echo '<td>No Cotizacion</td>';
echo '<td>Asociar</td>';
echo '<td>No Factura</td>';
echo '<td>Orden</td>';
echo '<td>Fecha</td>';
echo '<td>Nombre</td>';
echo '<td>Carro</td>';
echo '<td>Con_iva</td>';
echo '<td>Modificar</td>';
echo '<td>Imprimir</td>';
echo '</tr>';
while ($coti =mysql_fetch_assoc($consulta_cotizaciones))
{
	echo '<tr>';

	echo '<td>'.$coti['no_cotizacion'].'</td>';
	if($coti['fusionadaconorden'] == 0 && $coti['id_orden'] == 0 ){
		// echo '<td><button id="fusionar" class="btn btn-info fusionar" value ="'.$coti['id_cotizacion'].'"  data-toggle="modal" data-target="#myModalClientes">Fusionar</button></td>';
		//  echo '<td><button     data-toggle="modal" data-target="#myModalClientes" >Editar</button></td>';
		echo '<td><button class="btn btn-info fusionar" value ="'.$coti['id_cotizacion'].'" data-toggle="modal" data-target="#myModalClientes" >Asociar</button></td>';
	}
	else{
		echo '<td>';
		echo '</td>';
	}
	

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
	echo '<td>';
	if($coti['id_orden'] == 0 ){
	echo '<a href ="modificar_cotizacion.php?id_cotizacion='.$coti['id_cotizacion'].'" >Modificar</a>';
	}
	echo '</td>';
	echo '<td><a href="imprimir_cotizacion.php?id_cotizacion='.$coti['id_cotizacion'].'" target="_blank">Imprimir</a></td>';
	echo '<tr>';
}
echo '</table>';
echo '<div>';





?>


	
	<div  class="modal fade " id="myModalClientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header" id="headerNuevoCliente">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Asociar items de  contizacion con Orden</h4>
			</div>
			<div id="cuerpoModalClientes" class="modal-body">
				
				
			</div>
			<div class="modal-footer" id="footerNuevoCliente">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="recargarCotizaciones();">Cerrar</button>
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
			</div>
		</div>
	</div>
	
  

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>  
<script src="../js/bootstrap.min.js"></script>
<script src="../cotizaciones/js/cotizaciones.js"></script>   

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

	$(".fusionar").click(function()
	{   
		// var idCotizacion = 'idCotizacion=' + $(this).attr('value');
		var data =  'idCotizacion=' + $(this).attr('value');
		// alert(idCotizacion); 
		const http=new XMLHttpRequest();
		const url = '../cotizaciones/fusionarcotizacionorden.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				document.getElementById("cuerpoModalClientes").innerHTML = this.responseText;
			}
		};

		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send("idCotizacion="+data);
			
	

	})

	
</script>
<script>
    
    function fusionar(idCotizacion){
		var validacion = validarFusionar();
		var orden = document.getElementById('ordenfusionar').value;
		if(validacion)
		{
			var seguro = confirm('Esta seguro de fusionar esta cotizacion con la  orden '+ orden );
			if(seguro)
			{
				// alert('buenas '+idCotizacion+' orden '+orden);
				const http=new XMLHttpRequest();
				const url = '../cotizaciones/realizarfusionarcotizacionorden.php';
				http.onreadystatechange = function(){
					if(this.readyState == 4 && this.status ==200){
						document.getElementById("cuerpoModalClientes").innerHTML = this.responseText;
					}
				};

				http.open("POST",url);
				http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				http.send("idCotizacion="+idCotizacion
							+ "&orden="+orden);
			}
			setTimeout(() => {
				regrabarIdOrdenEnCotizacion(idCotizacion,orden);
			}, 300);
			
		}

    }

	regrabarIdOrdenEnCotizacion(idCotizacion,orden)
	{
		const http=new XMLHttpRequest();
				const url = '../cotizaciones/regrabarIdOrdenEnCotizacion.php';
				http.onreadystatechange = function(){
					if(this.readyState == 4 && this.status ==200){
						// document.getElementById("cuerpoModalClientes").innerHTML = this.responseText;
					}
				};

				http.open("POST",url);
				http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				http.send("idCotizacion="+idCotizacion
							+ "&orden="+orden);
	}



	function validarFusionar()
	{
		
		if( document.getElementById('ordenfusionar').value == '')
		{
				alert('No se ha digitado un numero de orden  valido');
		  		return false;
		}
		return true;

	}

	function recargarCotizaciones(){
		const http=new XMLHttpRequest();
		const url = '../cotizaciones/muestre_cotizaciones.php';
				http.onreadystatechange = function(){
					if(this.readyState == 4 && this.status ==200){
						document.getElementById("cotizaciones").innerHTML = this.responseText;
					}
				};

		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send();
	}
	// $("#btn_realizar_fusion").click(function()
	// {   
	// 	alert('click en realizar fusion'); 
		// var idCotizacion = 'idCotizacion=' + $(this).attr('value');
		// var data =  'ordenfusionar=' + $("#ordenfusionar").val();
		// const http=new XMLHttpRequest();
		// const url = '../cotizaciones/realizarfusionarcotizacionorden.php';
		// http.onreadystatechange = function(){
		//     if(this.readyState == 4 && this.status ==200){
		//         document.getElementById("cuerpoModalClientes").innerHTML = this.responseText;
		//     }
		// };

		// http.open("POST",url);
		// http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// http.send("idCotizacion="+data);
			


	// })
</script>
