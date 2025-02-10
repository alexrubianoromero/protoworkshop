<?php
$raiz = dirname(dirname(dirname(__file__)));
// die($raiz);
require_once($raiz.'/vista/vista.php');
require_once($raiz.'/marcas/models/MarcaModel.php');

class registroClientesView extends vista
{
    protected $marcaModel;

    public function __construct(){
        $this->marcaModel = new MarcaModel();
    
    }

    public function pantallaInicialRegistroCliente()
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
            <title>Document</title>
        </head>
        <body>
            <div class="col-lg-6 offset-1 mt-3">
                    <div align="center">
                        <img src="../logos/logokaymo.png" width="200" >
                        <h2>Registro Clientes</h2>
                    </div>
                <div id="div_principal_registro" style="padding:10px;">
                    <?php  $this->pantallaRegistro();  ?>
                </div>

            </div>
        </body>
        </html>
        <script src="../registroclientes/js/registro.js"></script>
       
        <?php    
    } 


    public function pantallaRegistro()
    {
        ?>
        <div>

            <div class="row">
                <span style="color:red; font-size:30px;" id="spanmensaje"></span>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <label>Identi: </label>
                    <input type="text"  id="identi" class="form-control" onkeyup="reviseIdenti();">
                </div>
                <div class="col-lg-6">
                    <label>Nombre: </label>
                    <input type="text"  id="nombre" class="form-control">
                </div>
                <div class="col-lg-6">
                    <label>Celular: </label>
                    <input type="text"  id="celular" class="form-control">
                </div>
                <div class="col-lg-6">
                    <label>Email: </label>
                    <input type="text"  id="email" class="form-control">
                </div>
                <div class="col-lg-6 mt-3" align="center">
                    <button id="btnRegistrar" class="btn btn-primary btn-lg btn-block" onclick = "registrarCliente();">Registrar </button>
                </div>
            </div>
        </div>
            
            <?php
    }
    public function muestreInfoCliente($infoCliente)
    {
        ?>
        <div>

            <div class="row">
                
            </div>
            <input type="hidden" id="idcliente" value="<?php  echo $infoCliente['idcliente'] ?>">
            <div class="row">
                <div class="col-lg-6">
                    <label>Identi: </label>
                    <span><?php echo $infoCliente['identi']   ?></span>
                </div>
                <div class="col-lg-6">
                    <label>Nombre: </label>
                    <span><?php echo $infoCliente['nombre']   ?></span>
                </div>
                <div class="col-lg-6">
                    <label>Celular: </label>
                    <span><?php echo $infoCliente['telefono']   ?></span>
                </div>
                <div class="col-lg-6">
                    <label>Email: </label>
                    <span><?php echo $infoCliente['email']   ?></span>
                </div>
            </div>
            <div class="row">
                <span  style="color:blue;" >INFORMACION VEHICULO</span>
            </div>
            <div id="div_mostrar_moto">

                        <div class="row">
                        <span style="color:red; font-size:30px;" id="spanmensajeplaca"></span>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Placa: </label>
                                <input type="text"  id="placa" class="form-control" onkeyup="revisePlaca();">
                            </div>
                            <div class="col-lg-6">
                                <label>Marca: </label>
                                <select class="form-control"  id="marca" onchange="mostrarLineasMarca();">
                                   <option value="">Seleccione...</option>
                                        <?php
                                        $marcas =  $this->marcaModel->traerMarcas();
                                        foreach($marcas as $marca)
                                        {
                                            echo '<option value ="'.$marca['marca'].'" >'.$marca['marca'].'</option>'; 
                                        }
                                        ?>

                                </select>
                                <!-- <input type="text"  id="marca" class="form-control"> -->
                            </div>
                            <div class="col-lg-6">
                                <label>Linea: </label>
                                <select id="linea" class="form-control"></select>
                                <!-- <input type="text"  id="linea" class="form-control"> -->
                            </div>
                            <div class="col-lg-6">
                                <label>Modelo: </label>
                                <input type="text"  id="modelo" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label>Color: </label>
                                <input type="text"  id="color" class="form-control">
                            </div>
                        </div>
                        <div>
                            <button  
                                id="btnRegistrarPlaca" 
                                class="btn btn-primary mt-3" 
                                onclick = "registrarMoto();"
                                >Grabar 
                            </button>
                        </div>
                    
                </div>
                
            </div>
            
            <?php
    }

    public function muestreInfoMoto($infoMoto)
    {
        ?>
            <div class="row">
                <div class="col-lg-6">
                    <label>Placa: </label>
                    <span><?php echo $infoMoto['placa']   ?></span>
                </div>
                <div class="col-lg-6">
                    <label>Marca: </label>
                    <span><?php echo $infoMoto['marca']   ?></span>
                </div>
                <div class="col-lg-6">
                    <label>Linea: </label>
                    <span><?php echo $infoMoto['tipo']   ?></span>
                </div>
                <div class="col-lg-6">
                    <label>Modelo: </label>
                    <span><?php echo $infoMoto['modelo']   ?></span>
                </div>
                <div class="col-lg-6">
                    <label>Color: </label>
                    <span><?php echo $infoMoto['color']   ?></span>
                </div>
            </div>
        <?php
    }
    public function mostrarLineasMarca($lineas)
    {
        foreach($lineas as $linea)
        {
            echo '<option value="">Seleccione...</option>';
            echo '<option value="'.$linea['linea'].'">'.$linea['linea'].'</option>';
        }
    }
}    