<?php include_once("encabezado.php"); ?>
<h1 class="text-center">Alta de un usuario administrativo</h1>
<div class="card p-4 bg-light">
  <form action="<?php print RUTA; ?>admonUsuarios/alta/" method="POST">
    <div class="form-group text-left">
      <label for="primerNombre">* Primer Nombre:</label>
      <input type="text" name="primerNombre" id="primerNombre" class="form-control" required placeholder="Escriba su  primer nombre"
      value='<?php isset($datos["data"]["primerNombre"])? print $datos["data"]["primerNombre"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="segundoNombre"> Segundo Nombre:</label>
      <input type="text" name="segundoNombre" id="segundoNombre" class="form-control" required placeholder="Escriba su segundo nombre" required value='<?php isset($datos["data"]["segundoNombre"])? print $datos["data"]["segundoNombre"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="apellidoPaterno">* Apellido Paterno:</label>
      <input type="text" name="apellidoPaterno" id="apellidoPaterno" class="form-control" required placeholder="Escriba su apellido paterno" required value='<?php isset($datos["data"]["apellidoPaterno"])? print $datos["data"]["apellidoPaterno"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="apellidoMaterno">Apellido Materno:</label>
      <input type="text" name="apellidoMaterno" id="apellidoMaterno" class="form-control" placeholder="Escriba su apellido materno" required
      value='<?php isset($datos["data"]["apellidoMaterno"])? print $datos["data"]["apellidoMaterno"]:""; ?>' />
    </div>


    

      <div class="form-group text-left">
      <label for="usuario">* Correo electrónico:</label>
      <input type="email" name="usuario" id="usuario" class="form-control" placeholder="Escriba su correo electrónico" required
      value='<?php isset($datos["data"]["usuario"])? print $datos["data"]["usuario"]:""; ?>' />
    </div>


    <div class="form-group text-left">
      <label for="clave1">* Clave de acceso:</label>
      <input type="password" name="clave1" id="clave1" class="form-control" placeholder="Escriba su clave de acceso" required value='<?php isset($datos["data"]["clave1"])? print $datos["data"]["clave1"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="clave2">* Repetir clave de acceso:</label>
      <input type="password" name="clave2" id="clave2" class="form-control" placeholder="Verifique su clave de acceso" required value='<?php isset($datos["data"]["clave2"])? print $datos["data"]["clave2"]:""; ?>'/>
    </div>

  
    <div class="form-group text-left">
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA; ?>admonUsuarios" class="btn btn-info">Regresar</a>
    </div>
  </form>
</div><!--card-->
<?php include_once("piepagina.php"); ?>