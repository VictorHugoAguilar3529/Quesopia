<?php
/**
 * Controlador Login
 */ 
class Tienda extends Controlador{
  private $modelo;

  function __construct()
  {
    $this->modelo = $this->modelo("TiendaModelo");
  }

  function caratula(){
    $sesion = new Sesion();
    if ($sesion->getLogin()) {


      $datos = [
        "titulo" => "Bienvenid@ a nuestra tienda",
        "menu" => true
      ];
      $this->vista("tiendaVista",$datos);
    } else {
      header("location:".RUTA);
    }
  }
}
?>