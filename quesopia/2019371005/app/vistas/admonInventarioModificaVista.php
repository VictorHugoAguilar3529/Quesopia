<?php include_once("encabezado.php"); ?>
<h1 class="text-center">Modifica un Inventario</h1>
<div class="card p-4 bg-light">
  <form action="<?php print RUTA; ?>admonInventario/cambio/" method="POST">


      <label for="id">* id producto:</label>
      <input type="text" name="id" id="id" class="form-control" required placeholder="Escriba el id del producto"
      value='<?php isset($datos["data"]["id"])? print $datos["data"]["id"]:""; ?>'/>
    </div>

 

    <div class="form-group text-left">
      <label for="stock_inv">* Stock del inventario:</label>
      <input type="text" name="stock_inv" id="stock_inv" class="form-control" required placeholder="Escriba el stock del producto" required
       value='<?php isset($datos["data"]["stock_inv"])? print $datos["data"]["stock_inv"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="id_src">id de sucursal:</label>
      <input type="text" name="id_src" id="id_src" class="form-control" placeholder="Escriba el id de la sucursal" required
      value='<?php isset($datos["data"]["id_src"])? print $datos["data"]["id_src"]:""; ?>' />
    </div>




    <div class="form-group text-left">
      <input type="hidden" id="id" name="id" value="<?php print $datos['data']['id']; ?>"/>
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA; ?>admonInventario" class="btn btn-info">Regresar</a>
    </div>
  </form>
</div><!--card-->
<?php include_once("piepagina.php"); ?>