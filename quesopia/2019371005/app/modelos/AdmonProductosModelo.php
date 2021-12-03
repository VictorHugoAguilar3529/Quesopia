<?php
/**
 * Modelo Productos Admon.
 */
class AdmonProductosModelo{
  private $db;
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }

  public function insertarDatos($data){
  }

  public function getProductos(){
    $sql = "SELECT * FROM producto WHERE baja=0";
    $data = $this->db->querySelect($sql);
    return $data;
  }

  public function getLlaves($tipo){
    $sql = "SELECT * FROM llaves WHERE tipo='".$tipo."' ORDER BY indice DESC";
    $data = $this->db->querySelect($sql);
    return $data;
  }


  

  public function getProductosId($id){
    $sql = "SELECT * FROM producto WHERE id=".$id;
    $data = $this->db->query($sql);
    return $data;
  }

  public function bajaLogica($id){
     $salida = true;
    $sql = "UPDATE producto SET baja=1 WHERE id=".$id;
    if(!$this->db->queryNoSelect($sql)){
      $salida = false;
    }
    return $salida;
  }

  public function modificaProducto($data){
    $salida = false;
    if(!empty($data["id"])){
    $sql="UPDATE producto SET ";//id
    $sql.="nom_prod='".$data['nom_prod']."',";//nombre
    $sql.="desc_prod='".$data['desc_prod']."',";//descripcion
    $sql.="cos_prod=".$data['cos_prod'].",";//costo
    $sql.="prec_prod=".$data['prec_prod'].",";//precio
    $sql.="imagen='".$data['imagen']."',";//imagen
    $sql.="baja=0 ";//baja
    $sql.= " WHERE id=".$data['id']; 

    //enviamos a la base de datos
    $salida=$this->db->queryNoSelect($sql);

    }
    
    return $salida;
  }

  public function altaProducto($data){
    var_dump($data);
    $sql="INSERT INTO producto VALUES(0,";//id
    $sql.="'".$data['nom_prod']."',";//nombre
    $sql.="'".$data['desc_prod']."',";//descripcion
    $sql.="".$data['cos_prod'].",";//costo
    $sql.="".$data['prec_prod'].",";//precio
    $sql.="'".$data['imagen']."',";//imagen
    $sql.="0)";//baja

      
    return $this->db->queryNoSelect($sql);
  }
}

?>