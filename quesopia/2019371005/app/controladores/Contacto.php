<?php
/**
 * Controlador Contacto
 */
class Contacto extends Controlador{
  private $modelo;

  function __construct(){}

  function caratula(){
    $sesion = new Sesion();
    if ($sesion->getLogin()) {
      //
      //
      $datos = [
        "titulo" => "Contactanos",
        "activo" => "contacto",
        "menu" => true
      ];
      $this->vista("contactoVista",$datos);
    } else {
      header("location:".RUTA);
    }
  }


  public function enviar(){
    $errores = array();
    $data = array();
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      //
      // Recuperar la informacion
      //
      $correo = $_POST["correo"]??"";
      $nombre = $_POST["nombre"]??"";
      $observacion = $_POST["observacion"]??"";
      if ($correo=="") {
        array_push($errores,"El correo es requerido");
      }
      if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        array_push($errores,"El correo electrónico no es válido");
      }
      if ($nombre=="") {
        array_push($errores,"Su nombre es requerido para poder continuar.");
      }
      if ($observacion=="") {
        array_push($errores,"Su observacion es requerida para poder continuar.");
      }
      if(count($errores)==0){
        // Correo del administrador
        $email = "ga.gallegos0027@gmail.com";
        /**
        * Enviar correo
        **/
        $msg = $nombre."Su correo a sido enviado correctamente<br>";
        $msg.= $nombre."<br>";
        $msg.= $observacion;

        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type:text/html; charset=UTF-8\r\n"; 
        $headers .= "From: ".$nombre."\r\n"; 
        $headers .= "Replay-to: ".$correo."\r\n";

        $asunto = "Dress Well Cliente";
        
        if(@mail($email,$asunto, $msg, $headers)){
            $datos = [
            "titulo" => "Envio de contacto directo",
            "menu" => true,
            "errores" => [],
            "data" => [],
            "subtitulo" => "Dress Well agradece su preferencia",
            "texto" => "En breve los administradores de la tienda se pondran en contacto con usted...",
            "color" => "alert-danger",
            "url" => "tienda",
            "colorBoton" => "btn-danger",
            "textoBoton" => "Regresar"
            ];
            $this->vista("mensajeVista",$datos);
          }else {
            $datos = [
            "titulo" => "Envio de contacto directo",
            "menu" => true,
            "errores" => [],
            "data" => [],
            "subtitulo" => "Error al mandar el correo.",
            "texto" => "Existe un problema al momento del correo, espere un momento e intentelo mas tarde",
            "color" => "alert-danger",
            "url" => "tienda",
            "colorBoton" => "btn-danger",
            "textoBoton" => "Regresar"
            ];
            $this->vista("mensajeVista",$datos);
    }
    } 
    if(count($errores)){
      $datos = [ 
      "titulo" => "Contacto",
      "menu" => true,
      "errores" => $errores,
      "subtitulo" => "Envio de correo",
      "data" => []
      ];
      $this->vista("contactoVista",$datos);
    }
  }
}
}
?>