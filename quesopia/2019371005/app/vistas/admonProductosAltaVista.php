<?php include_once("encabezado.php"); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script>
<script src="<?php print RUTA; ?>js/admonProductosAltaVista.js"></script>
<h1 class="text-center">
  <?php
  if(isset($datos["subtitulo"])){
    print $datos["subtitulo"];
  }
  ?>
</h1>
<div class="card p-4 bg-light">
  <form action="<?php print RUTA; ?>admonProductos/alta/" method="POST" enctype="multipart/form-data">


     <div class="form-group text-left">
      <label for="nom_prod">* Nombre del producto:</label>
      <input type="text" name="nom_prod" class="form-control"
      placeholder="Escribe el nombre del producto."
      value="<?php 
      print isset($datos['data']['nom_prod'])?$datos['data']['nom_prod']:''; 
      ?>"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
    </div>


   
    <div class="form-group text-left">
      <label for="content">* Descripción:</label>
      <textarea name="content" id="editor" rows="10"
       <?php
      if (isset($datos["baja"])) {
        print "disabled ";
      }
      ?>
      >
      <?php
      if(isset($datos['data']['descripcion'])){
        print$datos['data']['descripcion'];
      }
      ?>
      </textarea>
      
    </div>




      <div class="form-group text-left">
      <label for="cos_prod">* Costo Producto:</label>
      <input type="text" name="cos_prod" class="form-control" 
      pattern="^(\d|-)?(\d|,)*\.?\d*$" 
      placeholder="Escribe el costo del producto"
      value="<?php 
      print isset($datos['data']['cos_prod'])?$datos['data']['cos_prod']:''; 
      ?>"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
    </div>

      <div class="form-group text-left">
      <label for="prec_prod">* Precio Producto:</label>
      <input type="text" name="prec_prod" class="form-control" 
      pattern="^(\d|-)?(\d|,)*\.?\d*$" 
      placeholder="Escribe el precio del producto"
      value="<?php 
      print isset($datos['data']['prec_prod'])?$datos['data']['prec_prod']:''; 
      ?>"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
    </div>

    <div class="form-group text-left">
      <label for="imagen">* Imagen del producto:</label>
      <input type="file" name="imagen" id="imagen" accept="image/jpeg"/
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
      <?php
      if (isset($datos['data']['imagen'])) {
        print "<p>".$datos['data']['imagen']."</p>";
      }
      ?>
    </div>



    <div class="form-group text-left">
      <input type="hidden" name="id" id="id" value="
      <?php
        if (isset($datos['data']['id'])) {
          print $datos['data']['id'];
        } else {
          print "";
        }
      ?>
      ">

      <?php
      if (isset($datos["baja"])) { ?>
        <a href="<?php print RUTA; ?>admonProductos/bajaLogica/<?php print $datos['data']['id']; ?>" class="btn btn-danger">Borrar</a>
        <a href="<?php print RUTA; ?>admonProductos" class="btn btn-danger">Regresar</a>
        <p><b>Advertencia: una vez borrado el registro, no podrá recuperar la información</b></p>
      <?php } else { ?> 
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA; ?>admonProductos" class="btn btn-info">Regresar</a>
    <?php } ?> 
    </div>
  </form>
</div><!--card-->
<?php include_once("piepagina.php"); ?>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>