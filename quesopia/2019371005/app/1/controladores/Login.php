<?php
/**
 * Controlador Login
 */
class Login extends Controlador{
  private $modelo;

  function __construct()
  {
    $this->modelo = $this->modelo("LoginModelo");
  }

  function caratula(){
    $datos = [
      "titulo" => "Login",
      "menu" => false
    ];
    $this->vista("loginVista",$datos);
  }

  function olvido(){
    print "Hola desde el olvido";
  }

  function registro(){
      $errores = array();
       $data = array();
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      $primerNombre = isset($_POST["primerNombre"])?$_POST["primerNombre"]:"";
      $segundoNombre = isset($_POST["segundoNombre"])?
      $_POST["segundoNombre"]:"";
      $apellidoPaterno = isset($_POST["apellidoPaterno"])?
      $_POST["apellidoPaterno"]:"";
      $apellidoMaterno = isset($_POST["apellidoMaterno"])?$_POST["apellidoMaterno"]:"";
      $telefono = isset($_POST["telefono"])?$_POST["telefono"]:"";
      $rfc = isset($_POST["rfc"])?$_POST["rfc"]:"";
      $numeroExterior = isset($_POST["numeroExterior"])?$_POST["numeroExterior"]:"";
      $numeroIterior = isset($_POST["numeroIterior"])?$_POST["numeroIterior"]:"";
      $codpos = isset($_POST["codpos"])?$_POST["codpos"]:"";
      $calle = isset($_POST["calle"])?$_POST["calle"]:"";
      $email = isset($_POST["email"])?$_POST["email"]:"";
      $clave1 = isset($_POST["clave1"])?$_POST["clave1"]:"";
      $clave2 = isset($_POST["clave2"])?$_POST["clave2"]:"";

      //

        $data = [
        "primerNombre"=>$primerNombre,
        "segundoNombre" => $segundoNombre,
        "apellidoPaterno" => $apellidoPaterno,
        "apellidoMaterno" => $apellidoMaterno,
        "telefono" => $telefono,
        "rfc" => $rfc,
        "numeroExterior" => $numeroExterior,
        "numeroIterior" => $numeroIterior,
        "codpos" => $codpos,
        "calle" => $calle,
        "email" => $email,
        "clave1" => $clave1,
        "clave2" => $clave2,
      ];
      //Validación
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
      if ($telefono=="") {
        array_push($errores,"El telefono es requerido");
      }
      if ($rfc=="") {
        array_push($errores,"El RFC es requerido");
      }
      if ($numeroExterior=="") {
        array_push($errores,"El número exterior es requerido");
      }
      if ($numeroIterior=="") {
        array_push($errores,"El número interior es requerido");
      }
      if ($codpos=="") {
        array_push($errores,"El código postal es requerido");
      }
      if ($calle=="") {
        array_push($errores,"La calle es requerida");
      }
     
      if ($clave1!=$clave2) {
        array_push($errores,"Las claves de acceso no coinciden");
      }
      
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errores,"El correo electrónico no es válido");
      }
      
     if(count($errores)==0){
        $r = $this->modelo->insertarRegistro($data);
        if($r){
          print "Se insertó correctamente el registro ";
        } else {
          print "No se insertó el registro";
        }
      } else {
        $datos = [
        "titulo" => "Registro usuario",
        "menu" => false,
        "errores" => $errores,
        "data" => $data
        ];
        $this->vista("loginRegistroVista",$datos);
      }
    } else {
      $datos = [
      "titulo" => "Registro usuario",
      "menu" => false
      ];
      $this->vista("loginRegistroVista",$datos);
    } 
  }
}
?>