<?php include_once("encabezado.php"); ?>
<h2 class="text-center">Registro</h2>
<form action="<?php print RUTA; ?>login/registro/" method="POST">
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
      <label for="telefono">* Telefono:</label>
      <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Escriba su número telefonico" required
      value='<?php isset($datos["data"]["telefono"])? print $datos["data"]["telefono"]:""; ?>' />
    </div>

    <div class="form-group text-left">
      <label for="rfc">* RFC:</label>
      <input type="text" name="rfc" id="rfc" class="form-control" placeholder="Escriba su RFC" required
      value='<?php isset($datos["data"]["rfc"])? print $datos["data"]["rfc"]:""; ?>' />
    </div>

       <div class="form-group text-left">
      <label for="numeroExterior">* Número Exterior:</label>
      <input type="text" name="numeroExterior" id="numeroExterior" class="form-control" placeholder="Escriba su número exterior" required
      value='<?php isset($datos["data"]["numeroExterior"])? print $datos["data"]["numeroExterior"]:""; ?>' />
    </div>

     <div class="form-group text-left">
      <label for="numeroIterior">* Número Interior:</label>
      <input type="text" name="numeroIterior" id="numeroIterior" class="form-control" placeholder="Escriba su número interior" required
      value='<?php isset($datos["data"]["numeroIterior"])? print $datos["data"]["numeroIterior"]:""; ?>' />
    </div>

    

    <div class="form-group text-left">
      <label for="codpos">* Código Postal:</label>
      <input type="text" name="codpos" id="codpos" class="form-control" placeholder="Escriba su código postal" required
      value='<?php isset($datos["data"]["codpos"])? print $datos["data"]["codpos"]:""; ?>' />
    </div>
    <div class="form-group text-left">
      <label for="calle">* Calle:</label>
      <input type="text" name="calle" id="calle" class="form-control" placeholder="Escriba su calle" required
      value='<?php isset($datos["data"]["calle"])? print $datos["data"]["calle"]:""; ?>' />
    </div>

      <div class="form-group text-left">
      <label for="email">* Correo electrónico:</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Escriba su correo electrónico" required
      value='<?php isset($datos["data"]["email"])? print $datos["data"]["email"]:""; ?>' />
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
      <label for="enviar"></label>
      <input type="submit" value="Enviar datos"  class="btn btn-success" role="button"/>
      <a href="<?php print RUTA; ?>login/" class="btn btn-info">Regresar</a>
    </div>
</form>
<?php include_once("piepagina.php"); ?>