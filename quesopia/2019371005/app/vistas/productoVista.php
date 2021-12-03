<?php include_once("encabezado.php"); 
print "<h2 class='text-center'>".$datos["subtitulo"]."</h2>";
print "<img src='".RUTA."img/".$datos["data"]["imagen"]."' class='rounded float-right'/>";
//Curso en línea
if($datos["data"]["baja"]==0){
  print "<h4>NOMBRE DEL PRODUCTO:</h4>"; 
  print "<p>".$datos["data"]["nom_prod"]."</p>";

  print "<h4>DESCRIPCION:</h4>";
  print "<p>".$datos["data"]["desc_prod"]."</p>";

  print "<h4>PRECIO:</h4>";
  print "<p>$".number_format($datos["data"]["prec_prod"],2)."</p>";


 
}
$regresa = ($datos["regresa"]=="")? "tienda" : $datos["regresa"];
print "<a href='".RUTA.$regresa."' class='btn btn-success'/>Regresa</a>";
print "&nbsp";
print "<a href='".RUTA."carrito/agregaProducto/";
print $datos["data"]["id"]."/"; //id del produto
print $datos["idUsuario"]."' "; //id del usuario
print "class='btn btn-success'/>Agregar al carrito</a>";
include_once("piepagina.php"); ?>