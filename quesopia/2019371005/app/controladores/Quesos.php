<?php
/**
 * Controlador Quesos
 */
class Quesos extends Controlador{
  private $modelo;

  function __construct()
  {
    $this->modelo = $this->modelo("QuesosModelo");
  }

 function caratula(){
    $sesion = new Sesion();
    if ($sesion->getLogin()) {
      //
      //Leer los productos mas vendidos
      //
      $data = $this->getQuesos();
      //
      $datos = [
        "titulo" => "Quesos en línea",
        "activo" => "Quesos",
        "data" => $data,
        "menu" => true
      ];
      $this->vista("QuesosVista",$datos);
    } else {
      header("location:".RUTA);
    }
  }
  public function getQuesos()
  {
    $data = array();
    $data = $this->modelo->getQuesos();
    return $data;
  }
}
?>