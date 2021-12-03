<?php
/**
 * Login Carrito
 */
class CarritoModelo{
  private $db;
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }

  public function verificaProducto($idProducto, $idUsuario)
  {
    $sql = "SELECT * FROM carrito WHERE idUsuario=".$idUsuario." ";
    $sql.= "AND idProducto=".$idProducto;
    $r = $this->db->querySelect($sql);
    //var_dump($r); 
    return count($r);
 
  }

  public function agregaProducto($idProducto, $idUsuario)
  {
  

  $sql="INSERT INTO carrito (id, estado, IdUsuario, IdProducto, cantidad, fecha) VALUES ('','0',$idUsuario,$idProducto,'1', NOW())";
    // die($sql);

    return $this->db->queryNoSelect($sql);



  //  return count($r);
  }

 

  public function getCarrito($idUsuario)
  {
    $sql = "SELECT c.idUsuario as idUsuario, ";
    $sql.= "c.idProducto as id, ";
    $sql.= "c.cantidad as cantidad, ";
    $sql.= "p.prec_prod as prec_prod, ";
    $sql.= "p.imagen as imagen, ";
    $sql.= "p.desc_prod as desc_prod, ";
    $sql.= "p.nom_prod as nom_prod ";
    $sql.= "FROM carrito as c, producto as p ";
    $sql.= "WHERE idUsuario='".$idUsuario."' AND ";
    $sql.= "estado=0 AND ";
    $sql.= "c.idProducto=p.id";
    //
    return $this->db->querySelect($sql);
  }

   public function actualiza($idUsuario, $idProducto, $cantidad)
  {
    $sql = "UPDATE carrito ";
    $sql.= "SET cantidad=".$cantidad." ";
    $sql.= "WHERE idUsuario=".$idUsuario." AND ";
    $sql.= "idProducto=".$idProducto;
    return $this->db->queryNoSelect($sql);
  }


    public function borrar($idProducto, $idUsuario)
  {
    $sql = "DELETE FROM carrito WHERE idUsuario=".$idUsuario." AND ";
    $sql.= "idProducto=".$idProducto;
    return $this->db->queryNoSelect($sql);
  }


   public function cierraCarrito($idUsuario,$estado)
  {
    $sql = "UPDATE carrito ";
    $sql.= "SET estado=".$estado." ";
    $sql.= "WHERE idUsuario=".$idUsuario." AND ";
    $sql.= "estado=0";
    return $this->db->queryNoSelect($sql);
  }
}
?>