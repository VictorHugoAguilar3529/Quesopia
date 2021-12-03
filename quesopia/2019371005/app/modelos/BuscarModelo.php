<?php
/**
 * Buscar Modelo
 */
class BuscarModelo{
  private $db;
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }

  function getProductosBuscar($buscar){
  	$sql = "SELECT * FROM producto WHERE ";
  //	$sql .= "desc_prod LIKE '%".$buscar."%' OR ";
  	$sql .= "nom_prod LIKE '%".$buscar."%' ";
  //	$sql .= "modelo LIKE '%".$buscar."%'";

  	//
  	$data = $this->db->querySelect($sql);
  	return $data;
  }
}
?>