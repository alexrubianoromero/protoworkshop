<?php
    include('../valotablapc.php');
    $datosOrden = traernumeroorden($_REQUEST['id'],$conexion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="div_principal_gastos">
        <div>
            <input type="hidden" id="id" value="<?php  echo $_REQUEST['id'];  ?>">
            <h3>Gastos Orden   <?php echo $datosOrden['orden'];   ?></h3>
            <input type="text" id="proveedor" placeholder="proveedor">
            <input type="text" id="descripciongasto" placeholder="descripcion">
            <input type="text" id="valorgasto" placeholder="valor">
            <button onclick="agregarGasto('<?php     echo $_REQUEST['id'];   ?>');">Agregar Gasto</button>
        </div>
        <div id="div_resultados_gastos">
            <?php   traer_gastos($_REQUEST['id'],$conexion);   ?>
        </div>
    </div>
</body>
</html>
<?php
   function traernumeroorden($id,$conexion)
   {
        $sql ="select * from ordenes where id =   '".$id."'    ";
        $consulta = mysql_query($sql,$conexion);
        $datosOrden = mysql_fetch_assoc($consulta);
        return $datosOrden;  
   } 
   function traer_gastos($id,$conexion){
        $sql = "select * from gastosorden where idorden = '".$id."'   ";
        $consulta = mysql_query($sql,$conexion);
        $arrGastos = get_table_assoc($consulta);
        pintarTabla($arrGastos);
       
   }

   function get_table_assoc($datos)
    {
        $arreglo_assoc='';
        $i=0;	
        while($row = mysql_fetch_assoc($datos)){		
         $arreglo_assoc[$i] = $row;
         $i++;
        }
       return  $arreglo_assoc;
    }
    
    function pintarTabla($arrGastos)
    {
        $totalGastos = 0; 
        echo '<br><br>'; 
        echo '<table border="1">';  
        echo '<tr>'; 
        echo '<th>Fecha</th>';
        echo '<th>Proveedor</th>';
        echo '<th>Descripcion</th>';
        echo '<th>Valor</th>';
        echo '<th>Eliminar</th>';
        echo '</tr>';   
        foreach($arrGastos as $gasto)
        {
           echo '<tr>'; 
           echo '<td>'.$gasto['fecha'].'</td>';
           echo '<td>'.$gasto['proveedor'].'</td>';
           echo '<td>'.$gasto['descripcion'].'</td>';
           echo '<td>'.number_format($gasto['valor'],0,",",".").'</td>';
           echo '<td><button onclick="eliminargastoorden('.$gasto['id'].');">Eliminar</button></td>';
           echo '</tr>';   
           $totalGastos = $totalGastos + $gasto['valor']; 
        }
        echo '<tr>';
        echo '<td></td>';
        echo '<td>Total</td>'; 
        echo '<td>'.number_format($totalGastos,0,",",".").'</td>'; 
        echo '</tr>';   

        echo '</table>';
    }
?>