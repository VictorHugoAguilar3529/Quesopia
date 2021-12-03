<?php
/**
 * Controlador usuarios admon.
 */
class AdmonUsuarios extends Controlador{
  private $modelo;
  
  function __construct()
  {
    $this->modelo = $this->modelo("AdmonUsuariosModelo");
  }

 
  public function caratula()
  {
    //Creamos sesion
    $sesion = new Sesion();

    if($sesion->getLogin()){


      //Leemos los datos de la tabla
      $data = $this->modelo->getUsuarios();
     

      $datos = [
        "titulo" => "Administrativo Usuarios",
        "menu" => false,
        "admon" => true,
        "data" => $data
      ];
      $this->vista("admonUsuariosCaratulaVista",$datos);
    } else {
      header("location:".RUTA."admon");
    }
  }


  public function alta()
  {
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      $errores = array();
      $data = array();
     $primerNombre = isset($_POST["primerNombre"])?$_POST["primerNombre"]:"";
      $segundoNombre = isset($_POST["segundoNombre"])?$_POST["segundoNombre"]:"";
      $apellidoPaterno = isset($_POST["apellidoPaterno"])?$_POST["apellidoPaterno"]:"";
      $apellidoMaterno = isset($_POST["apellidoMaterno"])?$_POST["apellidoMaterno"]:"";
      $usuario = isset($_POST["usuario"])?$_POST["usuario"]:"";
      $clave1 = isset($_POST["clave1"])?$_POST["clave1"]:"";
      $clave2 = isset($_POST["clave2"])?$_POST["clave2"]:"";
      //Validacion
      if ($primerNombre=="") {
        array_push($errores,"El primer nombre es requerido");
      }
      if ($segundoNombre=="") {
        array_push($errores,"El segundo nombre es requerido");
      }
      if ($apellidoPaterno=="") {
        array_push($errores,"El apellido paterno es requerido");
      }
      if ($apellidoMaterno=="") {
        array_push($errores,"El apellido materno es requerido");
      }

     if(empty($usuario)){
        array_push($errores,"El usuario es requerido.");
      }

      
      if ($clave1!=$clave2) {
        array_push($errores,"Las claves de acceso no coinciden");
      }
       //Crear arreglo de datos
      $data = [
          "primerNombre"=>$primerNombre,
          "segundoNombre" => $segundoNombre,
          "apellidoPaterno" => $apellidoPaterno,
          "apellidoMaterno" => $apellidoMaterno,
          "usuario" => $usuario,
          "clave1" => $clave1,
          "clave2" => $clave2,
        ];
      //Verificamos que no haya errores
        if (empty($errores)) {
        if ($this->modelo->insertarDatos($data)) {
          header("location:".RUTA."admonUsuarios");
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
        "titulo" => "Administrativo Usuarios Alta",
        "menu" => false,
        "admon" => true,
        "errores" => $errores,
         "data" => $data
      ];
      $this->vista("admonUsuariosVista",$datos);
      }
    } else {
      $datos = [
        "titulo" => "Administrativo Usuarios Alta",
        "menu" => false,
        "admon" => true,
        "data" => []
      ];
      $this->vista("admonUsuariosVista",$datos);
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
        $errores = $this->modelo->bajaLogica($id);

        //Si no hay errores regresamos
        if(empty($errores)){
          header("location:".RUTA."admonUsuarios");
        }
      }
    }

    $data = $this->modelo->getUsuarioId($id);
    $llaves = $this->modelo->getLlaves("admonStatus");

    //Abrir la vista
    $datos = [
        "titulo" => "Administrativo Usuarios Baja",
        "menu" => false,
        "admon" => true,
        "status" => $llaves,
        "errores" => $errores,
        "data" => $data
      ];
    $this->vista("admonUsuariosBorraVista",$datos);
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
      $primerNombre = isset($_POST["primerNombre"])?$_POST["primerNombre"]:"";
      $segundoNombre = isset($_POST["segundoNombre"])?$_POST["segundoNombre"]:"";
      $apellidoPaterno = isset($_POST["apellidoPaterno"])?$_POST["apellidoPaterno"]:"";
      $apellidoMaterno = isset($_POST["apellidoMaterno"])?$_POST["apellidoMaterno"]:"";
      $gmail = isset($_POST["gmail"])?$_POST["gmail"]:"";
      $clave1 = isset($_POST["clave1"])?$_POST["clave1"]:"";
      $clave2 = isset($_POST["clave2"])?$_POST["clave2"]:"";
      $status = isset($_POST['status'])?$_POST['status']:"";
      //Validacion
      if ($primerNombre=="") {
        array_push($errores,"El primer nombre es requerido");
      }
      if ($segundoNombre=="") {
        array_push($errores,"El segundo nombre es requerido");
      }
      if ($apellidoPaterno=="") {
        array_push($errores,"El apellido paterno es requerido");
      }
      if ($apellidoMaterno=="") {
        array_push($errores,"El apellido materno es requerido");
      }

     if(empty($gmail)){
        array_push($errores,"El usuario es requerido.");
      }

      
     if($status=="void"){
        array_push($errores,"Selecciona el status del usuario.");
      }
       if(!empty($clave1) && !empty($clave2)){
        if($clave1 != $clave2){
          array_push($errores,"Las valores no coinciden.");
        }
      }

      if(empty($errores)){

  //Crear arreglo de datos
       $data = [
          "id" => $id,
          "primerNombre"=>$primerNombre,
          "segundoNombre" => $segundoNombre,
          "apellidoPaterno" => $apellidoPaterno,
          "apellidoMaterno" => $apellidoMaterno,
          "gmail" => $gmail,
          "clave1" => $clave1,
          "clave2" => $clave2,
          "status" => $status,
        ];
        //var_dump($data);
               //Enviamos al modelo
        $errores = $this->modelo->modificaUsuario($data);

        //Validamos la modificación
        if(empty($errores)){
          header("location:".RUTA."admonUsuarios");
        }
              
      }
    }
    $data = $this->modelo->getUsuarioId($id);
    $llaves = $this->modelo->getLlaves("admonStatus");
    $datos = [
      "titulo" => "Administrativo Usuarios Modifica",
      "menu" => false,
      "admon" => true,
      "status" => $llaves,
      "errores" => $errores,
      "data" => $data
    ];
    $this->vista("admonUsuariosModificaVista",$datos);
  }
}

?>