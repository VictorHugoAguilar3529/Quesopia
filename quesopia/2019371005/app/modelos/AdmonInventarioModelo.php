<?php
/**
 * Modelo Usuarios Admon.
 */
class AdmonInventarioModelo{
  private $db; 
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }

  public function insertarDatos($data){
    $clave = hash_hmac("sha512", $data["clave1"], "mimamamemima");
    $sql = "INSERT INTO inventario VALUES(0,";
    $sql.= " ".$data["id"]." , "; 
    $sql.= " ".$data["stock_inv"]." , ";
    $sql.= "1, "; 
    $sql.= "'".$data["id_src"]."') ";
   
    return $this->db->queryNoSelect($sql);
  }

    public function getInventario(){
    $sql = "SELECT * FROM inventario WHERE status_inv=1";
    $data = $this->db->querySelect($sql);
    return $data;
  }
   
  public function getInventarioId($id_inv){
    $sql = "SELECT * FROM inventario WHERE id_inv=".$id_inv;
    $data = $this->db->query($sql);
    return $data;
  }


   


    public function modificaInventario($data){
    $errores = array();
    $sql = "UPDATE inventario SET ";
    $sql.= " ".$data["id"]." , ";
    $sql.= " ".$data["stock_inv"]." , ";
    $sql.= "1, "; 
    $sql.= "'".$data["id_src"]."') ";
   
    return $this->db->queryNoSelect($sql);
  }
}

?>