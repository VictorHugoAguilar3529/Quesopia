<?php include_once("encabezado.php"); ?>
<h1 class="text-center">Inventario</h1>
<div class="card p-4 bg-light">
  <table class="table table-striped" width="100%">
  <thead>
    <tr>
    <th>id_inv</th>
    <th>id_prod</th>
    <th>Stock</th>
    <th>Status_inv</th>
    <th>id_src</th>
    <th>Modificar</th>
    
     
  </tr> 
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";

      print "<td>".$datos["data"][$i]["id_inv"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["id"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["stock_inv"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["status_inv"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["id_src"]."</td>";
     
      print "<td><a href='".RUTA."admonInventario/cambio/".$datos["data"][$i]["id"]."' class='btn btn-info'>Modificar Stock</a></td>";
      //print "<td><a href='".RUTA."admonUsuarios/baja/".$datos["data"][$i]["id"]."' class='btn btn-danger'>Borrar</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
  <a href="<?php print RUTA; ?>admonInventario/alta" class="btn btn-success">
 alta de inventario</a>
</div><!--card-->
<?php include_once("piepagina.php"); ?>