<?php
// die('buenas ');
date_default_timezone_set('America/Bogota');
$raiz = dirname(dirname(__file__));
// die ($raiz);
require_once($raiz.'/marcas/controllers/marcasController.php');  
$marcasController = new marcasController();

?>
