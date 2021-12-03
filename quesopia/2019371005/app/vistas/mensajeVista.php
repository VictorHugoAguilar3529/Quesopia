<?php include_once("encabezado.php"); 
print "<h2 class='text-center'>".$datos["subtitulo"]."</h2>";
print "<div class='alert ".$datos["color"]." mt-3'>";
print $datos["texto"];
print "</div>";
print "<a href='".RUTA.$datos["url"]."' class='btn ".$datos["colorBoton"]."'/>";
print $datos["textoBoton"]."</a>";
include_once("piepagina.php"); ?>