<?php include_once("encabezado.php"); ?>
<div class="card p-3" id="contenedor">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Iniciar sesión</a></li>
      <li class="breadcrumb-item">Datos de envío</li> 
      <li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
      <li class="breadcrumb-item"><a href="#">Verifica datos</a></li>
    </ol>
  </nav>
<h2>Datos de envío</h2>
<p>Favor de verificar los siguientes datos para su envío:</p>
<form action="<?php print RUTA; ?>carrito/formaPago/" method="POST">
    <div class="form-group text-left">
      <label for="n1">* primer nombre:</label>
      <input type="text" name="n1" id="n1" class="form-control" required placeholder="Escriba su primer nombre" 
      value='<?php isset($datos["data"]["n1"])? print $datos["data"]["n1"]:""; ?>' />
    </div>


     <div class="form-group text-left">
      <label for="n2">* segundo nombre:</label>
      <input type="text" name="n2" id="n2" class="form-control" required placeholder="Escriba su segundo nombre" 
      value='<?php isset($datos["data"]["n2"])? print $datos["data"]["n2"]:""; ?>' />
    </div>

    <div class="form-group text-left">
      <label for="ap">* Apellido Paterno:</label>
      <input type="text" name="ap" id="ap" class="form-control" required placeholder="Escriba su apellido paterno" value='<?php isset($datos["data"]["ap"])? print $datos["data"]["ap"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="am">Apellido Materno:</label>
      <input type="text" name="am" id="am" class="form-control" placeholder="Escriba su apellido materno" value='<?php isset($datos["data"]["am"])? print $datos["data"]["am"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="email">* Correo electrónico:</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Escriba su correo electrónico" value='<?php isset($datos["data"]["email"])? print $datos["data"]["email"]:""; ?>'/>
    </div>

   

    <div class="form-group text-left">
      <label for="enviar"></label>
      <input type="submit" value="Continuar"  class="btn btn-success" role="button"/>
    </div>
</form>
</div>
<?php include_once("piepagina.php"); ?>