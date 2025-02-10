<?php
$raiz = dirname(dirname(dirname(__file__)));
// die($raiz);
require_once($raiz.'/vista/vista.php');
require_once($raiz.'/marcas/models/MarcaModel.php');
require_once($raiz.'/lineas/models/LineaModel.php');

class marcasView extends vista
{
    protected $marcaModel;
    protected $lineaModel;

    public function __construct(){
        $this->marcaModel = new MarcaModel();
        $this->lineaModel = new LineaModel();
    }

    public function menuMarcas()
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=div, initial-scale=1.0">
            <title>Document</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        </head>
        <body class ="container">
            <div class="row mt-3" id="div_principal_marcas">
                <div class="col-lg-5">
                        <div>
                                <label>Marcas:</label>
                                <button 
                                        class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalNuevaMarca"
                                        onclick="formuNuevaMarca();"
                                        
                                >Nueva Marca
                                </button>
                                <div>
                                    <?php
                                    $marcas = $this->marcaModel->traerMarcas();
                                    $this->mostrarMarcas($marcas); 
                                    ?>
                                </div>
                        </div>
                </div>
                <div class="col-lg-5" id="div_lineas">
                        <div>
                            <label>Lineas</label>
                        </div>
                </div>
            </div>
            <?php  
                $this->modalNuevaMarca(); 
                $this->modalNuevaLinea(); 
            ?>
            
        </div>

        </body>
        </html>
        <script src="js/marcas.js"></script>
        <?php
    }


    public function mostrarMarcas($marcas)
    {
        ?>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Marca</th>
                    
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                       foreach($marcas as $marca)
                       {
                        
                          echo '<tr>';  
                          echo '<td><button 
                                        class="btn btn-secondary btn-sm"
                                        onclick="mostrarLineasMarca('.$marca['id'].');"
                                    >'.$marca['marca'].'</button></td>'; 
                          echo '</tr>';  
                        }  
                    ?>
                </tbody>
            </table>

        <?php
    }

    public function mostrarLineasMarca($idMarca)
    {
        $infoMarca =  $this->marcaModel->traerIdMarca($idMarca); 
        // echo '<pre>'; 
        // print_r($infoMarca); 
        // echo  '</pre>';
        // die();
        $lineasMarca = $this->lineaModel->traerLineasIdMarca($idMarca);  
        ?>
        <div>
            <div id="div_nueva_linea">
                <label>Lineas Marca :<?php echo $infoMarca['marca']; ?> </label>
                <button 
                        class="btn btn-primary btn-sm"
                        data-bs-toggle="modal" 
                        data-bs-target="#modalNuevaLinea"
                        onclick="formuNuevaLinea(<?php echo $idMarca;  ?>);"
                >Nueva Linea
                </button>
            </div>
            <div id="div_resultados_linea">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>Lineas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       foreach($lineasMarca as $linea)
                       {
                           echo '<tr>';  
                           echo '<td>'.$linea['linea'].'</td>'; 
                           echo '</tr>';  
                        }  
                        ?>
                    </tbody>
                 </table>
            </div>
        </div>
            
        <?php
    }


 
    public function formuNuevaMarca()
    {
      
        ?>
        <div class="row">
                <div class="col-md-4">
                    <label for="">Marca:</label>
                      <input class ="form-control" type="text" id="nombreMarca">          
                </div>
                <!-- <div class="col-md-6">
                    <label for="">Direccion:</label>
                      <input class ="form-control" type="text" id="direccionParqueadero">          
                </div>
                <div class="col-md-6">
                    <label for="">Telefono:</label>
                      <input class ="form-control" type="text" id="telefonoParqueadero">          
                </div>
                <div class="col-md-6">
                    <label for="">Email:</label>
                      <input class ="form-control" type="text" id="emailParqueadero">          
                </div>
                <div class="col-md-6">
                <label for="">Manejo Iva:</label>
                    <select class="form-control" id="manejaiva">
                        <option value="">Seleccione..</option>
                        <option value="0">NO</option>
                        <option value="1">SI</option>
                    </select> 
         
                </div>
              -->
        </div>
        <?php
    }
   
     
    public function formuNuevaLinea($idMarca)
    {
      
        ?>
        <input type="hidden" id="idMarcaLinea"  value = "<?php   echo $idMarca; ?>">
        <div class="row">
                <div class="col-md-4">
                    <label for="">Linea:</label>
                      <input class ="form-control" type="text" id="nombreLinea">          
                </div>
        </div>
        <?php
    }
   



    public function modalNuevaMarca()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalNuevaMarca" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Marca</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyNuevaMarca">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="marcas();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarNuevaMarca();" >Grabar</button>
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function modalNuevaLinea()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalNuevaLinea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Linea</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyNuevaLinea">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="mostrarLineasMarcasDesdeBotonCerrar();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarNuevaLinea();" >Grabar</button>
                </div>
                </div>
            </div>
            </div>

        <?php
    }


}   