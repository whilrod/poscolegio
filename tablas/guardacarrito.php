<?php
    require '../server/serverConexion.php';
    $item = $_POST['item'];
	$descripcion=strtoupper($_POST['descripcion']);
	$cantidad = $_POST['cantidadVendida'];
	$valor = $_POST['valor'];
	$stock = $_POST['stock'];
	$formapago = strtoupper($_POST['formapago']);
	$tipo = strtoupper($_POST['tipo']);
	$genero = strtoupper($_POST['genero']);
	$talla = $_POST['talla'];
	$precio = $_POST['precio'];
	$categoria=strtolower($_POST['categoria']);
	$cantidada=intval($stock)-intval($cantidad);
	
	$link= "";
	if ($categoria=="uniformes"){
	    $link="https://uniformescolegio.000webhostapp.com/tablas/uniformes.php";
	}elseif($categoria=="prendas"){
	    $link="https://uniformescolegio.000webhostapp.com/tablas/prendas.php";
	}elseif($categoria=="gala"){
	    $link="https://uniformescolegio.000webhostapp.com/tablas/gala.php";
	}else{
	    $link="https://uniformescolegio.000webhostapp.com/tablas/calzado.php";
	}
	
    //echo $item."<br>";
     //echo $categoria."<br>";
    $desc=$descripcion." TALLA " . $talla." - ".$genero. " - X ". $cantidad;
    //echo $desc;
    $sql= "INSERT INTO carrito (itemcarrito, categoriacarrito, descripcioncarrito, cantidadcarrito, preciocarrito, formapagocarrito, descventas,generoventas,tallaventas) VALUES ('$item','$categoria','$desc','$cantidad','$valor','$formapago','$descripcion','$genero','$talla') ";
    //echo $sql;
    $resultado = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="../css/normaliza.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Confirma Carrito</title>
</head>
<body>
        <div class="banner bg-3">
        <h6>&nbsp;</h6>
        <h2 class="t-stroke t-shadow-halftone" align="center"><?php echo $descripcion." TALLA " . $talla." - ".$genero. " - X ". $cantidad."<br>";
    echo "$ ".$valor." - ". $formapago; ?></h2>
    </div>
<input type="hidden" id="link" value="<?php echo $link; ?>" />
<script type="text/javascript">
   //Redireccionamiento tras 5 segundos
   var link = document.getElementById('link');
   
   setTimeout( function() { window.location.href = link.value; }, 2000 )    
</script>
</body>
</html>