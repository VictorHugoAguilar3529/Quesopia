<?php
/**
 * Manejo de la base de datos MySQL
 */

function conectar1(){
    $ServerName="localhost";
    $UserName="root";
    $Password="";
    $DataBase="dress_well";
    $Con=mysqli_connect($ServerName,$UserName,$Password,$DataBase);
    return $Con;
  }
  function consultar1($Con,$SQL){
    $Query=mysqli_query($Con,$SQL)or die (mysqli_error($Con));
    return $Query;
  }
  function cerrar1($Con){
    mysqli_close($Con);
  }
?>