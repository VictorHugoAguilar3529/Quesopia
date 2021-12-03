<?php

/**
 * Controlador para productos
 */
class AdmonProductos extends Controlador
{
  private $modelo;

  function __construct()
  {
    $this->modelo= $this->modelo("AdmonProductosModelo");
  }

  public function caratula(){
    //creamos sesion
    $sesion = new Sesion();
    if ($sesion->getLogin()) {
      //leemos los datos de la tabla
      $data=$this->modelo->getProductos();
      //leemos la llaves de tipoProducto
      $llaves=$this->modelo->getLlaves("MarcaProducto");
      //vista caratula
      $datos = [
        "titulo" => "administrativo Productos",
        "menu" => false,
        "admon" => true,
        "data" => $data,
        "MarcaProducto" =>$llaves
      ];
      $this->vista("admonProductosCaratulaVista",$datos);

    }else{
      header("location:".RUTA."admon");
    }
  }

  public function alta(){
    //definir arreglos
    $data = array();
    $errores =array();
    //leemos la llaves de MarcaProducto
    $llaves=$this->modelo->getLlaves("MarcaProducto");

         //Leemos los estatus del producto
    $statusProducto = $this->modelo->getLlaves("statusProducto");



    //recibir informacion de la vista
    if($_SERVER['REQUEST_METHOD']=="POST"){
      //Recibimos la información PHP7 isset()?valor1:valor2 => valor1 ?? valor2
      //si existe id es una modificacion, si no existe es una alta
      $id= $_POST['id'] ?? "";
      //
      $nom_prod =Valida::cadena($_POST['nom_prod'] ?? "");
      $desc_prod =Valida::cadena($_POST['content'] ?? "");
      $cos_prod =Valida::numero($_POST['cos_prod'] ?? "");
      $prec_prod =Valida::numero($_POST['prec_prod'] ?? "");

      //XAMP 5.0.3 
      //$img_prod = $_POST['imagen'];

      //XAMP 7.0.1
      $imagen = $_FILES['imagen']['name'];
      $imagen = Valida::archivo($imagen);


      //
      $status = $_POST['status'] ?? "";
      
      //validar nformacion
      if(empty($nom_prod)){
        array_push($errores,"el nombre del producto es requierido");
      }
     
      if(empty($desc_prod)){
        array_push($errores,"la descripcion del producto es requierida");
      }
      
      if(!is_numeric($cos_prod)){
        array_push($errores,"El costo deber ser un numero");
      }
      if(!is_numeric($prec_prod)){
        array_push($errores,"El precio deber ser un numero");
      }
      if($prec_prod<$cos_prod){
        array_push($errores,"El precio no deber ser menor al costo");
      
      }
      
      if(empty($imagen)){
        array_push($errores, "Debes seleccionar una imagen para el producto.");
      }else if(Valida::archivoImagen($_FILES['imagen']['tmp_name'])){


       //Cambiar el nombre del archivo
      $imagen = Valida::archivo(html_entity_decode($nom_prod));
      $imagen = strtolower($imagen.".jpg");

      //Subir el archivo
      if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
        //copiamos el archivo temporal
        copy($_FILES['imagen']['tmp_name'],"img/".$imagen);
        //Validar 240 px
        Valida::imagen($imagen,240);
      } else {
        array_push($errores, "Error al subir el archivo de imágen.");
      }
      }else {
        array_push($errores, "Formato de la imagen no aceptado.");
      }

      //crear arreglo de datos
      $data=[
      "id"=> $id,
      "nom_prod" => $nom_prod,
      "desc_prod" =>$desc_prod,
      "cos_prod" =>$cos_prod,
      "prec_prod" =>$prec_prod,
      "imagen" => $imagen
      
      ];
      var_dump($data);

      if(empty($errores)){

    //enviamos al modelo
        if(trim($id) == false){
          //alta
        if($this->modelo->altaProducto($data)){
                     header("location:".RUTA."admonProductos");
        }
      }else{
        //modificaion
        if($this->modelo->modificaProducto($data)){
                     header("location:".RUTA."admonProductos");
        }
      }

      }
    }

    //vista Alta
      $datos = [
        "titulo" => "Administrativo Productos Alta",
        "subtitulo" => "Alta de producto",
        "menu" => false,
        "admon" => true,
        "errores" => $errores,
        "MarcaProducto" =>$llaves,
        "statusProducto" => $statusProducto,
        "data" => $data
      ];
    
      $this->vista("AdmonProductosAltaVista",$datos);
  }

  public function baja($id=""){
    
    //Leemos la llaves de tipoProducto
    $llaves = $this->modelo->getLlaves("tipoProducto");

    //Leemos los estatus del producto
    $statusProducto = $this->modelo->getLlaves("statusProducto");

    

    //Leemos los datos del registro del id
    $data = $this->modelo->getProductosId($id);

    //Vista Alta
    $datos = [
     "titulo" => "Administrativo Productos Baja",
        "subtitulo" => "Baja producto",
        "menu" => false,
        "admon" => true,
        "errores" => [],
        "MarcaProducto" =>$llaves,
        "statusProducto" => $statusProducto,
        "data" => $data,
        "baja" => true
    ];
    $this->vista("admonProductosAltaVista",$datos);
  }

  public function bajaLogica($id='')
  {
   if (isset($id)) {
     if($this->modelo->bajaLogica($id)){
      header("location:".RUTA."admonProductos");
     }
   }
  }

  public function cambio($id=""){
    var_dump($id);
    //leemos la llaves de MarcaProducto
    $llaves=$this->modelo->getLlaves("MarcaProducto");

         //Leemos los estatus del producto
    $statusProducto = $this->modelo->getLlaves("statusProducto");

    //leemos los datos del registro del id
    $data=$this->modelo->getProductosId($id);

    //vista modifica
    $datos = [
        "titulo" => "Administrativo Productos Modicar",
        "subtitulo" => "Modifica producto", 
        "menu" => false,
        "admon" => true,
        "errores" => [],
        "MarcaProducto" =>$llaves,
        "statusProducto" => $statusProducto,
        "data" => $data
      ];
      var_dump($data);
      $this->vista("AdmonProductosAltaVista",$datos);
  

  }

   public function producto($id='',$regresa='')
  {
    //Leemos los datos del registro del id
    $data = $this->modelo->getProductosId($id);
    //
     //Enviamos el id del usuario
    $sesion = new Sesion();
    $idUsuario = $_SESSION["usuario"]["id"];
    //
    //Vista Alta
    $datos = [
      "titulo" => "Productos",
      "subtitulo" => $data["nom_prod"],
      "menu" => true,
      "admon" => false,
      "regresa" => $regresa,
      "idUsuario" => $idUsuario,
      "errores" => [],
      "data" => $data
    ];
    $this->vista("productoVista",$datos);
  }

}

?>