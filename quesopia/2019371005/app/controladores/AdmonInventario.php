<?php
/**
 * Controlador Inventario admon.
 */
class AdmonInventario extends Controlador{
  private $modelo;
  
  function __construct()
  {
    $this->modelo = $this->modelo("AdmonInventarioModelo");
  }

 
  public function caratula()
  {
    //Creamos sesion
    $sesion = new Sesion();

    if($sesion->getLogin()){


      //Leemos los datos de la tabla
      $data = $this->modelo->getInventario();
     

      $datos = [
        "titulo" => "Administrativo Inventario",
        "menu" => false,
        "admon" => true,
        "data" => $data
      ];
      $this->vista("admonInventarioCaratulaVista",$datos);
    } else {
      header("location:".RUTA."admon");
    }
  }


  public function alta()
  {
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      $errores = array();
      $data = array();
      $id = isset($_POST["id"])?$_POST["id"]:"";   //id producto
      $stock_inv = isset($_POST["stock_inv"])?$_POST["stock_inv"]:"";
      $id_src = isset($_POST["id_src"])?$_POST["id_src"]:"";
     
      //Validacion
      if ($id=="") {
        array_push($errores,"El id del producto es requerido");
      }
      
      if ($stock_inv=="") {
        array_push($errores,"El stock del producto es requerido");
      }
      if ($id_src=="") {
        array_push($errores,"El id de la sucursal es requerido");
      }

     
       //Crear arreglo de datos
      $data = [
          "id"=>$id,
          "num_prod" => $num_prod,
          "stock_inv" => $stock_inv,
          "id_src" => $id_src,
          
        ];
      //Verificamos que no haya errores
        if (empty($errores)) {
        if ($this->modelo->insertarDatos($data)) {
          header("location:".RUTA."AdmonInventario");
        } else {
          $datos = [
          "titulo" => "Error en el registro",
          "menu" => false,
          "errores" => [],
          "data" => [],
          "subtitulo" => "Error en la inserción del registro",
          "texto" => "Existió un error al insertar el registro, favor de intentarlo más tarde o comunicarse a soporte técnico.",
          "color" => "alert-danger",
          "url" => "admonInicio",
          "colorBoton" => "btn-danger",
          "textoBoton" => "Regresar"
          ];
          $this->vista("mensajeVista",$datos);
        }
      } else {
        $datos = [
        "titulo" => "Administrativo Inventario Alta",
        "menu" => false,
        "admon" => true,
        "errores" => $errores,
         "data" => $data
      ];
      $this->vista("admonInventarioAltaVista",$datos);
      }
    } else {
      $datos = [
        "titulo" => "Administrativo Inventario Alta",
        "menu" => false,
        "admon" => true,
        "data" => []
      ];
      $this->vista("admonInventarioAltaVista",$datos);
    }
  }

 
  public function cambio($id)
  {
     //Definiendo arreglos
    $errores = array();
    $data = array();

    //Recibiendo de la vista
     if ($_SERVER['REQUEST_METHOD']=="POST") {
      $errores = array();
      $data = array();
      $id = isset($_POST["id"])?$_POST["id"]:"";   //id producto
      $stock_inv = isset($_POST["stock_inv"])?$_POST["stock_inv"]:"";
      $id_src = isset($_POST["id_src"])?$_POST["id_src"]:"";
      //Validacion

        if ($id=="") {
        array_push($errores,"El id del producto es requerido");
      }

      if ($stock_inv=="") {
        array_push($errores,"El stock del producto es requerido");
      }
      if ($id_src=="") {
        array_push($errores,"El id de la sucursal es requerido");
      }

      if(empty($errores)){

  //Crear arreglo de datos
       $data = [
          "id"=>$id,
          "num_prod" => $num_prod,
          "stock_inv" => $stock_inv,
          "id_src" => $id_src,
          
        ];
        //var_dump($data);
               //Enviamos al modelo
        $errores = $this->modelo->modificaInventario($data);

        //Validamos la modificación
        if(empty($errores)){
          header("location:".RUTA."Admoninventario");
        }
              
      }
    }
    $data = $this->modelo->getInventarioId($id);
    //$llaves = $this->modelo->getLlaves("admonStatus");
    $datos = [
      "titulo" => "Administrativo Inventario Modifica",
      "menu" => false,
      "admon" => true,
      //"status" => $llaves,
      "errores" => $errores,
      "data" => $data
    ];
    $this->vista("admonInventarioModificaVista",$datos);
  }
}

?>