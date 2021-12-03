<?php
/**
 * Cursos Modelo
 */
class QuesosModelo{
  private $db;
  
  function __construct() 
  {
    $this->db = new MySQLdb();
  }

 
   public function getQuesos(){
    $sql = "SELECT * FROM producto WHERE baja=0";
    $data = $this->db->querySelect($sql);
    return $data;
  }
}
?>
