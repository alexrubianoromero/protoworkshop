<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div = "contenidos">
<? 
include("../empresa.php");
include('../valotablapc.php');
include('../funciones.php');

$sql_clientes = "select idcliente,nombre,identi from $tabla3 where id_empresa = '".$_SESSION['id_empresa']."'   ";
$clientes = mysql_query($sql_clientes,$conexion);
?>
<div id="contenidos">
<br><br>
<h3>NUEVO INGRESO</h3>
<table width="58%" border="1">
  <tr>
    <td width="34%">PLACA</td>
    <td width="66%"><label>
      <input type="text" name="placa" id = "placa">
    </label></td>
  </tr>
  <tr>
    <td>PROPIETARIO</td>
    <td>
	<select id = "propietario" id = "propietario">
	<option value = "0">...</option>
		<?php
		while($cli = mysql_fetch_assoc($clientes))
		{
			echo '<option value = "'.$cli['idcliente'].'">'.$cli['nombre'].'</option>';
		}
	    ?>
	</select>
	</td>
  </tr>
  <tr>
    <td>MARCA</td>
    <td><input type="text" name="marca" id = "marca"></td>
  </tr>
  <tr>
    <td>TIPO</td>
    <td><input type="text" name="tipo" id = "tipo"></td>
  </tr>
  <tr>
    <td>MODELO</td>
    <td><input type="text" name="modelo" id = "modelo"></td>
  </tr>
  <tr>
    <td>COLOR</td>
    <td><input type="text" name="color" id = "color"></td>
  </tr>
  <tr>
    <td>VENCI SOAT </td>
    <td><input type="text" name="vencisoat" id = "vencisoat"></td>
  </tr>
  <tr>
    <td>VENCI TECNOMECANICA </td>
    <td><input type="text" name="revision" id = "revision"></td>
  </tr>
  <tr>
    <td>CHASIS</td>
    <td><input type="text" name="chasis" id = "chasis"></td>
  </tr>
  <tr>
    <td>MOTOR</td>
    <td><input type="text" name="motor" id = "motor"></td>
  </tr>
  <tr>
  <td>TIPO TRANSMISION</td>
      <td>
       <select id="transmision">
        <option value ="0">Seleccione Transmision</option>
        <option value="A">Automatica</option>
        <option value="M">Manual</option>
       </select> 
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><button type ="button"  id = "grabar_carro" >
    <h4>GRABAR</h4>
    </button></td>
    <td>&nbsp;</td>
  </tr>
</table>



</div>
<?php
include('../colocar_links2.php');
?>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
			   
			   /////////////////
			  
			   ////////////////
			   
			  
						$("#grabar_carro").click(function(){
              var validacion =  verificarDatosCarro();
              if(validacion==1)
              {
                  var data =  'placa=' + $("#placa").val();
                    data += '&propietario=' + $("#propietario").val();
                    data += '&marca=' + $("#marca").val();
                    data += '&tipo=' + $("#tipo").val();
                    data += '&modelo=' + $("#modelo").val();
                    data += '&color=' + $("#color").val();
                    data += '&vencisoat=' + $("#vencisoat").val();
                    data += '&revision=' + $("#revision").val();
                    data += '&chasis=' + $("#chasis").val();
                    data += '&motor=' + $("#motor").val();
                    data += '&transmision=' + $("#transmision").val();
    
                  $.post('grabar_datos_vehiculo.php',data,function(a){
                  //$(window).attr('location', '../index.php);
                  $("#contenidos").html(a);
                    //alert(data);
                  });	
              }
						 });
					////////////////////////

          
					
        });	//fin de la funcion principal 		
        
        function verificarDatosCarro()
        {
          if($("#placa").val()=='' || $("#placa").val().length != 6)
          {
              alert('por favor digite la placa debe tener 6 caracteres'  );
               $("#placa").focus();
              return 0;
          }
          if($("#propietario").val()=='0')
          {
              alert('por favor escoja un propietario'  );
               $("#propietario").focus();
               return 0;
          }
          if($("#marca").val()=='')
          {
              alert('por digite marca '  );
               $("#marca").focus();
               return 0;
          }
          if($("#tipo").val()=='')
          {
              alert('por digite tipo '  );
               $("#tipo").focus();
               return 0;
          }
          if($("#modelo").val()=='')
          {
              alert('por digite modelo '  );
               $("#modelo").focus();
               return 0;
          }
          if($("#color").val()=='')
          {
              alert('por digite color '  );
               $("#color").focus();
               return 0;
          }
          if($("#transmision").val()=='0')
          {
              alert('por favor escoja el tipo de  transmision '  );
               $("#transmision").focus();
               return 0;
          }

             return 1;
        }
</script>


