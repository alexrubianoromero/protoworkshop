<?php
$raiz = dirname(dirname(dirname(__file__)));
//  die('controller'.$raiz);
require_once($raiz.'/marcas/views/marcasView.php');
require_once($raiz.'/marcas/models/MarcaModel.php');
require_once($raiz.'/lineas/models/LineaModel.php');
// require_once($raiz.'/inventario_codigos/modelo/CodigosInventarioModelo.php');
// require_once($raiz.'/inventario_codigos/modelo/MovimientosInventarioModelo.php');

class marcasController
{
    protected $view; 
    protected $model;
    protected $marcaModel;
    protected $lineaModel;
    // private $movimientosModelo;  


    public function __construct()
    {

        // echo '<pre>'; 
        // print_r($_REQUEST);
        // echo '</pre>';
        // die(); 
        $this->view =  new marcasView();
        $this->model =  new MarcaModel();
        $this->lineaModel =  new LineaModel();

        if(!$_REQUEST['opcion'] || $_REQUEST['opcion']=='menuMarcas')
        {
            $this->view->menuMarcas();
        }
        if($_REQUEST['opcion']=='formuNuevaMarca')
        {
            $this->view->formuNuevaMarca();
        }
        if($_REQUEST['opcion']=='formuNuevaLinea')
        {
            $this->view->formuNuevaLinea($_REQUEST['idMarca']);
        }
        if($_REQUEST['opcion']=='grabarNuevaMarca')
        {
            $this->grabarNuevaMarca($_REQUEST);
        }
        if($_REQUEST['opcion']=='grabarNuevaLinea')
        {
            $this->grabarNuevaLinea($_REQUEST);
        }
        if($_REQUEST['opcion']=='mostrarLineasMarca')
        {
            $this->view->mostrarLineasMarca($_REQUEST['idMarca']);
        }

    }
    
    public function grabarNuevaMarca($request)
    {
        $this->model->grabarNuevaMarca($request);
        echo 'Marca grabada'; 
    }
    public function grabarNuevaLinea($request)
    {
        $this->lineaModel->grabarNuevaLinea($request);
        echo '<input type="hidden" id="idMarca" value = "'.$request['idMarca'].'">'; 
        echo 'Linea grabada'; 
    }
    
}  