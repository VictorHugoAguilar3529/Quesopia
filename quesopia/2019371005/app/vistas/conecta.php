<?php
  function conectar(){
    $ServerName="localhost";
    $UserName="root";
    $Password="";
    $DataBase="quesopia";
    $Con=mysqli_connect($ServerName,$UserName,$Password,$DataBase);
    return $Con;
  }
  function consultar($Con,$SQL){
    $Query=mysqli_query($Con,$SQL)or die (mysqli_error($Con));
    return $Query;
  }
  function cerrar($Con){
    mysqli_close($Con);
  }
 ?>
 