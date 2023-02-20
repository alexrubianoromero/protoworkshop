<?php

// echo '<pre>'; 
// print_r($_REQUEST); 
// echo '</pre>';
//debe ser una orden que no halla sido fusionada antes 
//hay que buscar el id de esa orden y veriricar que no exista en la tabla de cotizaciones 
//ese id en la columna dew fusionar o de crear orden a partir de cotizacion 
//verificar que exista ese numero de orden 
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
    <div align="center">
        Digite el numero de la orden para asociar los items de la cotizacion:
        <input type="text" id="ordenfusionar">
        <br>
        <button class="btn btn-primary" id="btn_realizar_fusion" onclick="fusionar(<?php  echo $_REQUEST['idCotizacion'];   ?>);">Asociar</button>
    </div>
</body>
</html>

