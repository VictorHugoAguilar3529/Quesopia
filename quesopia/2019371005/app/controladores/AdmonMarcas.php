<?php
/**
 * Controlador usuarios admon.
 */
class AdmonMarcas extends Controlador{
  private $modelo;
  
  function __construct()
  {
    $this->modelo = $this->modelo("AdmonMarcasModelo");
  }

 
  public function caratula()
  {
    //Creamos sesion
    $sesion = new Sesion();

    if($sesion->getLogin()){


      //Leemos los datos de la tabla
      $data = $this->modelo->getMarcas();
     

      $datos = [
        "titulo" => "Administrativo Usuarios",
        "menu" => false,
        "admon" => true,
        "data" => $data
      ];
      $this->vista("admonMarcasCaratulaVista",$datos);
    } else {
      header("location:".RUTA."admon");
    }
  }


  public function alta()
  {
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      $errores = array();
      $data = array();
     $nom_mrc = isset($_POST["nom_mrc"])?$_POST["nom_mrc"]:"";
   
      //Validacion
      if ($nom_mrc=="") {
        array_push($errores,"El nombre de la marca es requerido");
      }

       //Crear arreglo de datos
      $data = [
          "nom_mrc"=>$nom_mrc,
        
        ]; 

           var_dump($data);
      //Verificamos que no haya errores
        if (empty($errores)) {

       
        if ($this->modelo->insertarDatosMarca($data)) {
         
          header("location:".RUTA."admonMarcas");
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
        "titulo" => "Administrativo Marcas Alta",
        "menu" => false,
        "admon" => true,
        "errores" => $errores,
         "data" => $data
      ];
      
      $this->vista("admonMarcasVista",$datos);
      }
    } else {
      $datos = [
        "titulo" => "Administrativo Marcas Alta",
        "menu" => false,
        "admon" => true,
        "data" => []

      ];

      $this->vista("admonMarcasAltaVista",$datos);
    }
  }

  public function baja($id="")
  {
   //Definiendo arreglos
    $errores = array();
    $data = array();

    //Recibiendo de la vista
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      $id = isset($_POST['id'])?$_POST['id']:"";
      if(!empty($id)){
        $errores = $this->modelo->bajaM($id);

        //Si no hay errores regresamos
        if(empty($errores)){
          header("location:".RUTA."admonMarcas");
        }
      }
    }

    $data = $this->modelo->getMarcasId($id);
    //$llaves = $this->modelo->getLlaves("admonStatus");

    //Abrir la vista
    $datos = [
        "titulo" => "Administrativo Marcas Baja",
        "menu" => false,
        "admon" => true,
        //"status" => $llaves,
        "errores" => $errores,
        "data" => $data
      ];
    $this->vista("admonMarcasBorraVista",$datos);
  }


  public function cambio($id)
  {
     //Definiendo arreglos
    $errores = array();
    $data = array();

    //Recibiendo de la vista
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      
      //Limpiando variables
      $id = isset($_POST['id'])?$_POST['id']:"";
      $nom_mrc = isset($_POST["nom_mrc"])?$_POST["nom_mrc"]:"";
     
      //Validacion
   

     


    if ($nom_mrc=="") {
        array_push($errores,"El nombre de la marca es requerido");
      }
    

      if(empty($errores)){

  //Crear arreglo de datos
       $data = [
          "id" => $id,
          "nom_mrc"=>$nom_mrc,
   
        ];
        //var_dump($data);
               //Enviamos al modelo
        $errores = $this->modelo->modificaMarcas($data);

        //Validamos la modificación
        if(empty($errores)){
          header("location:".RUTA."admonMarcas");
        }
              
      }
    }
    $data = $this->modelo->getMarcasId($id);
   
    $datos = [
      "titulo" => "Administrativo Marcas Modifica",
      "menu" => false,
      "admon" => true,
     
      "errores" => $errores,
      "data" => $data
    ];
    $this->vista("admonMarcasModificaVista",$datos);
  }
}

?>