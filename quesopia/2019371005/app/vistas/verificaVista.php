<?php include_once("encabezado.php"); ?>
<div class="card" id="contenedor">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Iniciar sesión</a></li>
      <li class="breadcrumb-item"><a href="#">Datos de envío</a></li>
      <li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
      <li class="breadcrumb-item">Verifica datos</li>
    </ol>
  </nav>
  <h2>Verifique los datos antes de continuar</h2>
<?php
  //
  //Variables de trabajo
  //
  $verifica = false;
  $subtotal = 0;

  //
  print "Modo de pago: ".$datos["pago"]."<br>";
  print "Nombre: ".$datos["data"]["n1"]." ".$datos["data"]["n2"]." ".$datos["data"]["ap"]." ".$datos["data"]["am"]."<br>";
 
  //
  //desplegar el carrito
      //
     print "<tr>";
    print "<th width='12%'>Producto</th>";
    print "<th width='58%'>Descripción</th>";
    print "<th width='1.8%'>Cant.</th>";
    print "<th width='10.12%'>Precio</th>"; 
    print "<th width='10.12%'>Subtotal</th>";
    print "<th width='1%'>&nbsp;</th>";
    print "</tr>";
    //ciclo
    for ($i=0; $i < count($datos["carrito"]); $i++) { 

  //var_dump($datos);
  //Variables de trabajo
  $desc = "<b>".$datos["carrito"][$i]["nom_prod"]."</b>";
  $desc.= $datos["carrito"][$i]["prec_prod"];
  $nom = $datos["carrito"][$i]["nom_prod"];
  $num = $datos["carrito"][$i]["id"];
  $can = $datos["carrito"][$i]["cantidad"];
  $pre =$datos["carrito"][$i]["prec_prod"];
  $img = $datos["carrito"][$i]["imagen"];
 // $des = $datos["data"][$i]["descuento"];
  //$env = $datos["data"][$i]["envio"];
  $tot = $can*$pre;
  //
  print "<tr>";
  print "<td><img src='".RUTA."img/".$img."' width='105' alt'".$nom."'></td>";
  print "<td>".$desc."..</td>";
  print "<td class='text-right'>";
  print number_format($can,0)."' min='1' max='99'/>";
  print "</td>";
  print "<td class='text-right'>$".number_format($pre,2)."</td>";
  print "<td class='text-right'>$".number_format($tot,2)."</td>";
  print "<td>&nbsp;</td>";
  print "</tr>";
    //
    //Subtotales
    //
    $subtotal += $tot;
   
  }
  $total = $subtotal;
  print "</table>";
  print "<hr>";
  //
  //Tabla de totales
  //
  print "<table width='100%' class='text-right'>";
  print "<tr>";
  print "<td width='79.85%'></td>";
  print "<td width='11.55%'>Subtotal:</td>";
  print "<td width='9.20%'>$".number_format($subtotal,2)."</td>";
  print "</tr>";



  print "<tr>";
  print "<td width='79.85%'></td>";
  print "<td width='11.55%'>Total:</td>";
  print "<td width='9.20%'>$".number_format($total,2)."</td>";
  print "</tr>";

  print "<tr>";
  print "<td></td>";
  print "<td></td>";
  print "<td><a href='".RUTA."carrito/gracias' class='btn btn-success' role='button'>Pagar</a></td>";
  print "</tr>";
  print "</table>";

?>
</div>
<?php include_once("piepagina.php"); ?>