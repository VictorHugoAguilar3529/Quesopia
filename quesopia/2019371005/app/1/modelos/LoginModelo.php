<?php
/**
 * Login Modelo
 */
class LoginModelo{
  private $db;
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }

  function insertarRegistro($data){
    $r = false;
     if ($this->validaCorreo($data["email"])) {
      $clave = hash_hmac("sha512", $data["clave1"], "mimamamemima");
      $sql = "INSERT INTO administrador VALUES(0,";
      $sql.= "'".$data["primerNombre"]."', ";
      $sql.= "'".$data["segundoNombre"]."', ";
      $sql.= "'".$data["apellidoPaterno"]."', ";
      $sql.= "'".$data["apellidoMaterno"]."', ";    
      $sql.= "'".$data["email"]."', ";  
      $sql.= "'".$clave."')";
      $r = $this->db->queryNoSelect($sql);
    } 
    return $r;
  }

  function validaCorreo($email){
    $sql = "SELECT * FROM cliente WHERE email='".$email."'";
    $data = $this->db->query($sql);
    return (count($data)==0)?true:false;
  }

}
?>