<?php
/**
 * Controlador Buscar
 */
class Buscar extends Controlador{
  private $modelo;

  function __construct()
  {
    $this->modelo = $this->modelo("BuscarModelo");
  }

  function caratula(){
    
  }
  public function producto()
  {
    $buscar = $_POST["buscar"]??"";
    if (!empty($buscar)) {
      //
      //Leer los productos mas vendidos
      //
      $data = $this->modelo->getProductosBuscar($buscar);
      //
      if(count($data)==0){
        $datos = [
          "titulo" => "El articulo no se ha encontrado",
          "menu" => true,
          "errores" => [],
          "data" => [],
          "subtitulo" => "No hay ningun articulo disponible",
          "texto" => "El articulo '".$buscar."' no existe o no se encuentra disponible en nuestra tienda por el momento.",
          "color" => "alert-danger",
          "url" => "tienda",
          "colorBoton" => "btn-danger",
          "textoBoton" => "Regresar"
          ];
          $this->vista("mensajeVista",$datos);

      }else{
        $datos = [
        "titulo" => "Productos Encontrados.",
        "data" => $data,
        "menu" => true
      ];
      $this->vista("buscarVista",$datos);
      }
    } else {
      header("location:".RUTA);
      }
      
  }
}
?>