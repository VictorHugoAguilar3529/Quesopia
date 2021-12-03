<?php include_once("encabezado.php"); ?>
        <h1 class="text-center">Login</h1>
        <div class="card p-4 bg-light">
  <form action="<?php print RUTA; ?>login/verifica/" method="POST">
    <div class="form-group text-left">
      <label for="usuario">Usuario:</label>
      <input type="text" name="usuario" class="form-control">
    </div>
    <div class="form-group text-left">
      <label for="clave">Clave acceso:</label>
      <input type="password" name="clave" class="form-control">
    </div>
    <div class="form-group text-left">
      <input type="submit" value="Enviar" class="btn btn-success">
    </div>
    <input type="checkbox" name="recordar" >
      <label for="recordar">Recordar</label>
  </form>
</div><!--card-->
  <a href="<?php print RUTA; ?>login/registro/" >Darse de alta en el sistema</a><br>
  <a href="<?php print RUTA; ?>login/olvido/">¿Olvidaste tu clave de acceso?</a>
<?php include_once("piepagina.php"); ?>