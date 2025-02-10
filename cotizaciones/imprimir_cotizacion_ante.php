<!DOCTYPE html><head>
<meta charset="UTF-8"/>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<title>Untitled Document</title>
<?php
include('../valotablapc.php');

$sql_iva = "select iva from $tabla17 ";
$consulta_iva = mysql_query($sql_iva,$conexion);
$arr_iva = mysql_fetch_assoc($consulta_iva);
$iva = $arr_iva['iva'];
$sql_numero_cotizacion ="select cot.fecha,cot.id_cotizacion,cot.no_cotizacion,
cot.kilometraje,
cli.identi,cli.direccion,cli.nombre,cli.email,cli.telefono,c.color,c.marca,c.placa,c.modelo 
,cot.coniva,c.tipo,c.transmision
from $cotizaciones cot
inner join $tabla4 c on (c.idcarro = cot.idcarro)
inner join $tabla3 cli on (cli.idcliente = c.propietario)
where 
id_cotizacion = '".$_REQUEST['id_cotizacion']."'  ";
$consulta_cotizacion = mysql_query($sql_numero_cotizacion,$conexion);
$arr_cot = mysql_fetch_assoc($consulta_cotizacion);
$ancho_tabla= "90%";
?>


<div id = "datos_cotizacion"  align="center">
<table width="<?php echo $ancho_tabla ?>" border="1">
  <tr>
    <td><div align="center"><img src="../logos/autoscad_largo.png" width="170" height="79"></div></td>
    <td><div id="titulos">
      <div align="center">COTIZACION No: <?php echo  $arr_cot['no_cotizacion']; ?><br>
         <BR>
        Cra 50 No 129-07</div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" align="center"> FECHA: <?php echo $arr_cot['fecha']; ?></td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla ?>" border="1">
  <tr>
    <td>Empresa</td>
    <td><?php  echo $arr_cot['nombre']  ?></td>
	  <td>ID</td>
      <td colspan="3"><label><?php  echo $arr_cot['identi']  ?>
      </label></td>
	</tr>
	 <tr>
    <td>Direccion</td>
    <td><label><?php  echo $arr_cot['direccion']  ?></label></td>
	  <td>Telefono</td>
	    <td><?php  echo $arr_cot['telefono']  ?></td>
	    <td>Marca</td>
	    <td><?php  echo $arr_cot['marca']  ?></td>
    </tr>
	 <tr>
	   <td>Nombre</td>
	   <td><?php echo $arr_cot['nombre']; ?></td>
	   <td>Kilome</td>
	   <td><?php  echo $arr_cot['kilometraje']  ?></td>
	   <td>Modelo</td>
	   <td><?php  echo $arr_cot['modelo']  ?></td>
	 </tr>
	 <tr>
	   <td>Mail</td>
	   <td><?php echo $arr_cot['email']; ?></td>
	   <td>Color</td>
	   <td><?php echo $arr_cot['color']; ?></td>
	   <td>Placas</td>
	   <td><?php  echo $arr_cot['placa']  ?><input type="hidden" name="idcarro" id="idcarro" ></td>
  </tr>
  <tr>
    <td>linea:<?php  echo $arr_cot['tipo']  ?> </td>
    <td>Transmision:
			<?php
					if($arr_cot['transmision'] == ''){$tipoTransmision = 'Sin Info';} 
					if($arr_cot['transmision'] == 'M'){$tipoTransmision = 'MANUAL';} 
					if($arr_cot['transmision'] == 'A'){$tipoTransmision = 'AUTOMATICA';} 
					echo $tipoTransmision  ;
				?>
			</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  </table>
	<table width="<?php echo $ancho_tabla ?>" border="1">
  <tr align="center">
    <td>ITEM</td>
    <td>DESCRIPCION MANO DE OBRA  </td>
    <td>CANTIDAD</td>
    <td>TOTAL</td>
  </tr>
  <?php
$suma_mano =mostrar_items_parametro($item_orden_cotizaciones,$_REQUEST['id_cotizacion'],'M',$conexion,$ancho_tabla);
?>
 <tr align="center">
    <td>ITEM</td>
    <td>DESCRIPCION REPUESTOS </td>
    <td>CANTIDAD</td>
    <td>TOTAL</td>
  </tr>
  <?php
$suma_aceites=mostrar_items_parametro($item_orden_cotizaciones,$_REQUEST['id_cotizacion'],'A',$conexion,$ancho_tabla);
$suma_repuestos=mostrar_items_parametro($item_orden_cotizaciones,$_REQUEST['id_cotizacion'],'R',$conexion,$ancho_tabla);


///////////////////////////////////////////////////////////
$subtotales = $suma_mano  + $suma_repuestos +$suma_aceites; 
$suma_repuestos_y_mano_sin_aceites  = $suma_repuestos + $suma_mano;
// die('valor de coniva'.$arr_cot['coniva']);
if($arr_cot['coniva']==1)
{
  $valor_iva = ($suma_repuestos_y_mano_sin_aceites * $iva)/100;
}else{
  $valor_iva = 0;
}

$total = $subtotales + $valor_iva;


?>

 <!-- <tr>
  <td colspan="3"></td>
    <td align="right" >SUBTOTALES</td>
    <td align="right"><?php echo '$'.number_format($subtotales, 0, ',', '.'); ?></td>
  </tr>
   -->
  <tr>
    <td colspan="3" align="right">SUBTOTAL</td>
  
    <td align="right" ><?php echo '$'.number_format($subtotales, 0, ',', '.'); ?></td>
  </tr>
  <?php
  if($arr_cot['coniva']==1)
  {
    echo '<tr>';
    echo   '<td colspan="3"align="right">IVA</td>';
    echo '<td align="right">';
    echo '$'.number_format($valor_iva, 0, ',', '.'); 
    echo  '</td>';
    echo '</tr>';
    echo '<tr>';
  }
  ?>


    <td colspan="3" align="right">TOTAL</td>
  
    <td align="right"><?php echo '$'.number_format($total, 0, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan ='3' align="center">6 MESES DE GARANTIA EN REPUESTOS Y MANOS DE OBRA</td>
   </tr> 
</table>
</div>
<?php
function mostrar_items_parametro($tabla,$id_cotizacion,$parametro,$conexion,$ancho_tabla){
  $sql_items = "select * from $tabla  where no_factura = '".$id_cotizacion."'  and repman = '".$parametro."' ";
  //echo'<br>consulta'.$sql_items;
  $consulta_items_cotizacion =mysql_query($sql_items,$conexion);
  $filas = mysql_num_rows($consulta_items_cotizacion);
  
 //echo '<br>'.$filas;
  $no_item =1;
  $suma_item = 0;
  //echo '<table border="1"  width="'.$ancho_tabla.'">';
  
 while ($item = mysql_fetch_assoc($consulta_items_cotizacion))
 {
      echo '<tr>';
      echo '<td align="center">'.$no_item.'</td>';
      echo '<td>'.$item['descripcion'].'</td>';
      echo '<td align="center">'.$item['cantidad'].'</td>';
      echo '<td align ="right">';
      if($item['sumar']=="1"){
        echo  '$'.number_format($item['total_item'], 0, ',', '.');
      }
      echo '</td>';
      echo '</tr>';
      $no_item ++;
      if($item['sumar']=="1"){
      $suma_item = $suma_item + $item['total_item'];
      }
  }//fin de while
  if($parametro!='A')
  {
   completar_espacios_cotiza($filas);
 }

 

 return $suma_item;
  //echo '</table>';
  
}

function completar_espacios_cotiza($filas){
  $no_filas_pintar = 12 - $no_filas;
  for( $i=1; $i <= $no_filas_pintar;$i++)
  {
    echo '<tr>';
    echo '<td>&nbsp;</td>';
    echo '<td>&nbsp;</td>';
    echo '<td>&nbsp;</td>';
    echo '<td>&nbsp;</td>';
    // echo '<td>&nbsp;</td>';
    echo '</tr>';
  }

}//fin de funcion completar_espacios_cotiza
?>