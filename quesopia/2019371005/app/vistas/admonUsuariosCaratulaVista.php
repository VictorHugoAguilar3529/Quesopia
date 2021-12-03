<?php include_once("encabezado.php"); ?>
<h1 class="text-center">Lista de usuarios</h1>
<div class="card p-4 bg-light">
  <table class="table table-striped" width="100%">
  <thead>
    <tr>
    <th>id</th>
    <th>Primer nombre</th>
    <th>Segundo nombre</th>
    <th>Apellido paterno</th>
    <th>Apellido materno</th>
    <th>Correo</th>
    <th>Modifica</th>
    <th>Borrar</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      print "<td>".$datos["data"][$i]["id"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["email"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["n1"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["ap"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["ap"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["am"]."</td>";
      print "<td><a href='".RUTA."admonUsuarios/cambio/".$datos["data"][$i]["id"]."' class='btn btn-info'>Modificar</a></td>";
      print "<td><a href='".RUTA."admonUsuarios/baja/".$datos["data"][$i]["id"]."' class='btn btn-danger'>Borrar</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
  <a href="<?php print RUTA; ?>admonUsuarios/alta" class="btn btn-success">
  Dar de alta un usuario</a>
</div><!--card-->
<?php include_once("piepagina.php"); ?>