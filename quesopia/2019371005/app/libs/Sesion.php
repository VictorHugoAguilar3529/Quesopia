<?php
/**
 * Manejar sesión
 */
class Sesion{
  private $login = false;
  private $usuario;
  
  function __construct()
  {
    session_start();
    if (isset($_SESSION["usuario"])) {
      $this->usuario = $_SESSION["usuario"];
      $this->login = true;

      //
      //Calculo del total del carrito 
      //
      $idUsuario = $_SESSION["usuario"]["id"];
      $_SESSION["carrito"] = $this->totalCarrito($idUsuario)??0;

     // var_dump($_SESSION["carrito"]);
      //

    } else {
      unset($this->usuario);
      $this->login = false;
    }
  }

  public function iniciarLogin($usuario){
    if ($usuario) {
      $this->usuario = $_SESSION["usuario"] = $usuario;
      $this->login = true;
    }
  }

  public function finalizarLogin(){
    unset($_SESSION["usuario"]);
    unset($this->usuario);
    $this->login = false;
  }

  public function getLogin(){
    return $this->login;
  }

  public function getUsuario(){ 
    return $this->usuario;
  }


    public function totalCarrito($idUsuario)
  {
    $db = new MySQLdb();
    $sql = "SELECT SUM(p.prec_prod * c.cantidad) as tot ";
    $sql.= "FROM carrito as c, producto as p ";
    $sql.= "WHERE c.idUsuario = ".$idUsuario." AND ";
    $sql.= "c.idProducto=p.id AND c.estado=0 ";
    $data = $db->query($sql);
    $tot = $data["tot"]??0;
    $db->cerrar();
    return $tot;
    //var_dump($tot);
  }
}

?>